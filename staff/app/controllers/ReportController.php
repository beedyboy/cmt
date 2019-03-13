<?php
/**
* 
*/
class ReportController extends Controller
{
	
	public function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Event'); 

		$this->view->setLayout('app');

	}

	 
 
public function index()
{
 	$db = DB::getInstance(); 

 	$org_id =(int)$this->org_id;
 	$event = $db->query("SELECT DISTINCT cat_id FROM events WHERE org_id = $org_id");
 	$this->view->event = $db->results();

 	$this->view->displayErrors = $this->validate->displayErrors(); 
 $this->view->render("report/index");
}




 
public function fetchEvent($id)
{
 	$db = DB::getInstance(); 
 	$org_id =(int)$this->org_id;
 	$event = $db->query("SELECT * FROM events WHERE cat_id = $id");
 	// $this->view->event = $db->results();
 echo "<select class='form-control' id='getReportFromEvt'>
 		<option value=''>Choose One</option>";

 	foreach ($db->results() as $value)
 	 {
 		echo "<option value='".$value->id."'> $value->evt_desc</option>";
 	}



 echo "</select>";
}



public function getReportFromEvt($id)
{
	$Category = new Category('categories');
	$Payment = new Payment('payments'); 
	$User = new User('users');
	$Event = new Event('events');
  $eventRecord = $this->Event->findById($id);
  ?>

<div>
<div class="column column-4 card1"> 
		
 <div class="card">
<div class="card-body "> 

<p class="card-title"><strong><?=$Category->findById($eventRecord->cat_id)->cat_name;?></strong></p>
<div class="subtitle"><?=$eventRecord->evt_desc;?></div>
</div> 
   
</div>

	</div>

<!-- summary starts here -->
<div id="Summary" class="column column-4 card3"> 
		
<?php


$field = [ 	'conditions'=> ['evt_id = ?'],  'bind' => [(int)$eventRecord->id] ];
	$amount = 0;
	 $data  = $Payment->find($field);

	 if(count($data) < 1):
echo "No payment has been made so far";

	 else:
	foreach ($data as $value)
	 {
		$amount += removeComma($value->amount);
	 }

$last = array_values(array_slice($data, -1))[0];
  // $last->amount;
	echo '<div class="card">
<div class="card-header"> 
Payment Summary:
</div>
<div class="card-body"> 

<p class="card-title"><strong>Total Amount:</strong> Gh&cent '.formatMoney($amount, true).'</p>
<div class="subtitle"><strong>Last Transaction Amount:</strong>  Gh&cent '.$last->amount.'</div>
<div class="subtitle"><strong>Paid in By:</strong>  '.$last->pay_by.'</div>
<div class="subtitle"><strong>Received By:</strong>  '.$User->findById($last->received_by)->acc_first_name.' '.$User->findById($last->received_by)->acc_last_name.'</div>
</div> 
  
</div>';

endif;

?>


	</div>
	<!-- summary ends up here -->
	<!-- created and update by starts here -->

<div class="column column-4 card2">
	<div class="card">	
<div class="row mobile"> 
	<div class="column column-6"> 
 <div class="card-body">
  
<p class="card-title"><strong>Created By:</strong></p>
<div class="subtitle">    
    
<?php
 $created =  $User->findById($eventRecord->created_by); 
		echo $created->acc_first_name. " ".$created->acc_last_name.'<br />'.
             $eventRecord->created_at;
		?> 

		</div>
</div>
	
	</div>
 <!--updated part -->
	<div class="column column-6"> 
 <div class="card-body">
  
<p class="card-title"><strong>Updated By:</strong></p>
<div class="subtitle">    
    
<?php 
$updated =  $User->findById($eventRecord->updated_by); 
		echo $updated->acc_first_name. " ".$updated->acc_last_name.'<br />'.
			 $eventRecord->updated_at;
		?>
		 </div>
</div>
	
	</div>
	<!--  ends up -->

</div>


	</div>
	</div>
	<!-- created and update by ends up here -->



<div class="column column-12">
	<?php  $data  = $Payment->find([ 'conditions'=> ['evt_id = ?'],  'bind' => [ (int)$eventRecord->id] ]); ?>
	<?php if(count($data) > 0): ?>	
 <button class="btn btn-warning printAllPayment" title="Print Preview" id="<?=(int)$eventRecord->id?>" style="height:35px;"><i class="fas fa-print fa-fw"></i> Print Preview</button> 

         <a href="<?=base_url.'report/csv/'.(int)$eventRecord->id?>"><button class="btn btn-info" title="Export to Excel" style="height:35px;"><i class="fa fa-file-excel fa-fw"></i> Export as Excel</button></a>

  <a href="<?=base_url.'report/audit/'.(int)$eventRecord->id?>"><button class="btn btn-secondary" title="Export to Excel" style="height:35px;"><i class="fa fa-file-excel fa-fw"></i> Audit Trail</button></a>

  <button class="split-btn" id="reportMore"><i class="fa fa-fw fa-check-circle"></i> More</button>
<div class="split-dropdown">
  <button class="split-btn" style="border-left:1px solid navy">
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="split-content">
    <a href="#" class="printAlSelectedlReport"><i class="fa fa-print fa-fw"></i> Print Selected </a>
    <a href="#" class="csvAlSelectedlReport"><i class="fa fa-file-excel fa-fw"></i> Export Selected as Excel</a> 
  
  </div> 
</div>
 <hr />

 <h2>Payments</h2>
 
             <table  class="table  hoverable"  data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="reportCheckAll" name="reportCheckAll"  /> </th>
                           <th>Description </th> 
                           <th>Paid By </th> 
                           <th>Amount </th> 
                           <th>Phone Number </th> 
                         <th>Received By </th> 
                         <th>Received on </th> 
                         <th>Updated at </th> 
                         <th>Updated By </th>  
                   
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
  <?php
                  
 	$x = 1;
   foreach ($data as $Payment)
     {
                    # code...
     ?>

<tr> 
<td> <input type="checkbox" name="reportCheck[]" value="<?=$Payment->id?>" class="reportCheckCase"> </td>
<td class="beedy-tooltip ">
<?php $cat = $Event->findById($Payment->evt_id)->evt_desc;  ?>
<?=(strlen($cat) < 15)? $cat : substr($cat, 0,15).'...' ?>
 <span class="top" ><?=$cat?></span>
 </td> 
<td><?php echo $Payment->pay_by; ?> </td> 
<td><?php echo $Payment->amount; ?> </td>  
<td><?php echo $Payment->phone; ?> </td>  
<td>
<?php 
$created =  $User->findById($Payment->received_by); 
		echo $created->acc_first_name. " ".$created->acc_last_name;?> 
</td> 
<td><?php echo $Payment->created_at; ?> </td> 
<td><?php echo $Payment->updated_at; ?> </td> 
<td>
<?php 
$updated =  $User->findById($Payment->updated_by); 
		echo $updated->acc_first_name. " ".$updated->acc_last_name;
  ?> 
  </td> 

 

</tr>
 
<?php 
$x++; 
 } 
  
echo "</tbody> 
	 </table>";
endif;
echo "</div>


</div>";
 
	 
}

public function pdfHeader($id)
{
$Category = new Category('categories');
	$Payment = new Payment('payments'); 
	$User = new User('users');
	$Event = new Event('events');
  $eventRecord = $this->Event->findById($id);
  ?>
  <div class="row mobile">
<div class="column column-4 card1"> 
		
 <div class="card">
<div class="card-body "> 

<p class="card-title"><strong><?=$Category->findById($eventRecord->cat_id)->cat_name;?></strong></p>
<div class="subtitle"><?=$eventRecord->evt_desc;?></div>
</div> 
   
</div>

	</div>

<!-- summary starts here -->
<div id="Summary" class="column column-4 card3"> 
		
<?php


$field = [ 	'conditions'=> ['evt_id = ?'],  'bind' => [(int)$eventRecord->id] ];
	$amount = 0;
	 $data  = $Payment->find($field);

	 if(count($data) < 1):
echo "No payment has been made so far";

	 else:
	foreach ($data as $value)
	 {
		$amount += removeComma($value->amount);
	 }

$last = array_values(array_slice($data, -1))[0];
  // $last->amount;
	echo '<div class="card">
<div class="card-header"> 
Payment Summary:
</div>
<div class="card-body"> 

<p class="card-title"><strong>Total Amount:</strong> Gh&cent '.formatMoney($amount, true).'</p>
<div class="subtitle"><strong>Last Transaction Amount:</strong>  Gh&cent '.$last->amount.'</div>
<div class="subtitle"><strong>Paid in By:</strong>  '.$last->pay_by.'</div>
<div class="subtitle"><strong>Received By:</strong>  '.$User->findById($last->received_by)->acc_first_name.' '.$User->findById($last->received_by)->acc_last_name.'</div>
</div> 
  
</div>';

endif;

?>


	</div>
	<!-- summary ends up here -->
	<!-- created and update by starts here -->

<div class="column column-4 card2">
	<div class="card">	
<div class="row mobile"> 
	<div class="column column-6"> 
 <div class="card-body">
  
<p class="card-title"><strong>Created By:</strong></p>
<div class="subtitle">    
    
<?php
 $created =  $User->findById($eventRecord->created_by); 
		echo $created->acc_first_name. " ".$created->acc_last_name.'<br />'.
             $eventRecord->created_at;
		?> 

		</div>
</div>
	
	</div>
 <!--updated part -->
	<div class="column column-6"> 
 <div class="card-body">
  
<p class="card-title"><strong>Updated By:</strong></p>
<div class="subtitle">    
    
<?php 
$updated =  $User->findById($eventRecord->updated_by); 
		echo $updated->acc_first_name. " ".$updated->acc_last_name.'<br />'.
			 $eventRecord->updated_at;
		?>
		 </div>
</div>
	
	</div>
	<!--  ends up -->

</div>


	</div>
	</div>
	</div>
	<!-- created and update by ends up here -->
	<?php 
}
 
 /**
  * [printAll description]
  * @return [type] [description]
  */
        public function printAll($evt_id)
        {
 
            ob_clean();
            $Payment = new Payment('payments');
            $Event = new Event('events');
 			$data  = $Payment->find([ 'conditions'=> ['evt_id = ?'],  'bind' => [ (int)$evt_id] ]);
 
 			$this->pdfHeader($evt_id);  
 			 echo "<span clas='badge centered-text'><strong>Payment Record</strong></span><hr />";
 
            $htmlTable="<table  class='table  hoverable'>
                 	<thead>
                     <tr> 
                          <th>SN</th>
                     
                           <th>Paid By </th> 
                           <th>Amount (Ghc) </th> 
                           <th>Phone Number </th> 
                         <th>Received By </th> 
                         <th>Received on </th> 
                         <th>Updated at </th> 
                         <th>Updated By </th>  
                     </thead>
                     </tr>
                     <tbody>";

                  if(count($data) > 0):  
             	$User = new User('users');
                 $x = 1; 
                 $amount = 0; 
                 foreach($data as $Payment): 
					 $created =  $User->findById($Payment->received_by);  
					 $updated =  $User->findById($Payment->updated_by); 
					 $amount += removeComma($Payment->amount);
               		 $htmlTable .="<tr>"; 
                     $htmlTable .="<td>".$x."</td>";
                     // $htmlTable .="<td>".$Event->findById($Payment->evt_id)->evt_desc."</td>";
                     $htmlTable .="<td>".$Payment->pay_by."</td>";
                     $htmlTable .="<td>".$Payment->amount."</td>";
                     $htmlTable .="<td>".$Payment->phone."</td>"; 
                     $htmlTable .="<td>".$created->acc_first_name. ' '.$created->acc_last_name."</td>"; 
                     $htmlTable .="<td>".$Payment->created_at."</td>";
                     $htmlTable .="<td>".$Payment->updated_at."</td>"; 
                     $htmlTable .="<td>".$updated->acc_first_name. ' '.$updated->acc_last_name."</td>";
                
                $htmlTable .="</tr>";
                 $x++;
                 endforeach;
                $htmlTable .= "<tr>
                		<td></td>
                		<td> Total:</td>
                 		<td colspan='3'>".
                 		formatMoney($amount,true)."
                 		</td>
                 		<tr>
                 		</tbody>"; 
                endif;
           
           $htmlTable .=" </table>";

                echo $htmlTable;
                ob_end_flush();
 
        }




public function printSelected()
{
        $User = new User('users');
        $Event = new Event('events');
 		$Payment = new Payment('payments');  
            
   		 $post = $_POST['reportCheck']; 
         $last = array_values(array_slice($post, -1))[0];
             ob_start();
            $this->pdfHeader($Payment->findById($last)->evt_id);
            echo "<span clas='badge centered-text'><strong>Payment Record</strong></span><hr />";
 
            $htmlTable="<table  class='table  hoverable'>
                 	<thead>
                     <tr> 
                          <th>SN</th>
                     
                           <th>Paid By </th> 
                           <th>Amount (Ghc) </th> 
                           <th>Phone Number </th> 
                         <th>Received By </th> 
                         <th>Received on </th> 
                         <th>Updated at </th> 
                         <th>Updated By </th>  
                     </thead>
                     </tr>
                     <tbody>";


            
                  $x = 1;
                 $amount = 0; 
            foreach($post as $id): 
                $created =  $User->findById($Payment->findById($id)->received_by);  
				$updated =  $User->findById($Payment->findById($id)->updated_by); 
				$amount += removeComma($Payment->findById($id)->amount);
                $htmlTable .="<tr>"; 
                $htmlTable .="<td>".$x."</td>";
                // $htmlTable .="<td>".$Event->findById($Payment->findById($id)->evt_id)->evt_desc."</td>";
                $htmlTable .="<td>".$Payment->findById($id)->pay_by."</td>";
                $htmlTable .="<td>".$Payment->findById($id)->amount."</td>";
                $htmlTable .="<td>".$Payment->findById($id)->phone."</td>"; 
                $htmlTable .="<td>".$created->acc_first_name. ' '.$created->acc_last_name."</td>"; 
                $htmlTable .="<td>".$Payment->findById($id)->created_at."</td>";
                $htmlTable .="<td>".$Payment->findById($id)->updated_at."</td>"; 
                $htmlTable .="<td>".$updated->acc_first_name. ' '.$updated->acc_last_name."</td>";

            $htmlTable .="</tr>";
            $x++;
            endforeach;
            $htmlTable .= "<tr>
                		<td></td>
                		<td> Total:</td>
                 		<td colspan='3'>".
                 		formatMoney($amount,true)."
                 		</td>
                 		<tr>
                 		</tbody>"; 
             $htmlTable .=" </table>";

                echo $htmlTable;
                ob_end_flush();
              
 
        }


  public function csv($evt_id)
  {
            
            $time = date("Y-m-d");
            $day = date("l");
            

            $User = new User('users');
	        $Event = new Event('events');
	 		$Payment = new Payment('payments'); 
 			$data  = $Payment->find([ 'conditions'=> ['evt_id = ?'],  'bind' => [ (int)$evt_id] ]);
 
  		 
            $last = array_values(array_slice($data, -1))[0]; 
            $name = $Event->findById($last->evt_id)->evt_desc;

                

            $head = "$name \t"."-".$day."\t"."-".$time;
            $filename = $head.".csv";
              
             header('Content-type: application/csv'); 
             header('Content-Disposition: attachment; filename=' . $filename);

             $output = fopen('php://output', 'w');
             //fputcsv($output, $head);
            fputcsv($output, array('#','Paid By', ' Amount (Ghc) ', 'Phone Number', 'Received By', 'Received on', 'Updated at', 'Updated By '));


            if(count($data) > 0):  
             
             $x = 1;
             $amount = 0;
            foreach($data as $Payment): 
             $created =  $User->findById($Payment->received_by);  
 			 $updated =  $User->findById($Payment->updated_by); 
 			 $amount +=  removeComma($Payment->amount);
             $row = array($x,
             $Payment->pay_by,
             $Payment->amount,
             $Payment->phone,
             $created->acc_first_name. ' '.$created->acc_last_name, 
             $Payment->created_at,
             $Payment->updated_at,
             $updated->acc_first_name. ' '.$updated->acc_last_name);

            fputcsv($output, $row);
            $x++;
            endforeach;
            fputcsv($output, array('','', ' ', '', '', '', '', ''));
             $amount = formatMoney($amount,true);
            fputcsv($output, array('','Total Amount', $amount));
 
            endif;
        }

/**
 * 
 */

public function csvSelected()
{		

            $time = date("Y-m-d");
            $day = date("l");
	        $User = new User('users');
	        $Event = new Event('events');
	 		$Payment = new Payment('payments');  
	            
	   		$post = $_POST['reportCheck']; 
	        $last = array_values(array_slice($post, -1))[0];
	        $name = $Event->findById($Payment->findById($last)->evt_id)->evt_desc;
             
            $head = "$name \t"."-".$day."\t"."-".$time;
            $filename = $head.".csv";
  
             header('Content-type: application/csv'); //Change File type CSV/TXT etc
             header('Content-Disposition: attachment; filename=' . $filename);
             ob_start();
            

             $output = fopen('php://output', 'w');
             //fputcsv($output, $head);
            fputcsv($output, array('#','Paid By', ' Amount (Ghc)', 'Phone Number', 'Received By', 'Received on', 'Updated at', 'Updated By '));

            $row = array(); 
             $x = 1;
             $amount = 0;
            foreach($post as $id): 
             
 			 $created =  $User->findById($Payment->findById($id)->received_by);  
 			 $updated =  $User->findById($Payment->findById($id)->updated_by); 
             $amount +=  removeComma($Payment->findById($id)->amount);

             $row = array($x,
             $Payment->findById($id)->pay_by,
             $Payment->findById($id)->amount,
             $Payment->findById($id)->phone,
             $created->acc_first_name. ' '.$created->acc_last_name, 
             $Payment->findById($id)->created_at,
             $Payment->findById($id)->updated_at,
             $updated->acc_first_name. ' '.$updated->acc_last_name);

            fputcsv($output, $row);
            $x++;
            endforeach;
             fputcsv($output, array('','', ' ', '', '', '', '', ''));
             $amount = formatMoney($amount,true);
            fputcsv($output, array('','Total Amount', $amount));
 
             $xlsData = ob_get_contents();
            ob_end_clean();

            $response = array(

                'op' => 'ok',
                'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
                'name' =>$filename

                );
            die(json_encode($response));

 
        }

 public function audit($evt_id)
  {
            
            $time = date("Y-m-d");
            $day = date("l");
             $amount = 0;
            

            $User = new User('users');
	        $Event = new Event('events');
	 		$Payment = new Payment('payments'); 

	 		$db = DB::getInstance();
  
 
 			$d = $db->query("SELECT * FROM payment_audit WHERE evt_id =  $evt_id ");
 	 
 			$data = $d->results();
 			// $data  = $Payment->find([ 'conditions'=> ['evt_id = ?'],  'bind' => [ (int)$evt_id] ]);
 
  		 
            $last = array_values(array_slice($data, -1))[0]; 
            $name = $Event->findById($last->evt_id)->evt_desc;

                

            $head = "$name \t"."-".$day."\t"."-".$time;
            $filename = $head.".csv";
              
             header('Content-type: application/csv'); 
             header('Content-Disposition: attachment; filename=' . $filename);

             $output = fopen('php://output', 'w');
             //fputcsv($output, $head);
            fputcsv($output, array('#','Paid By', ' Amount (Ghc) ', 'Phone Number', 'Received By', 'Received on', 'Updated at', 'Updated By ', 'Transaction Type'));


            if(count($data) > 0):  
             
             $x = 1;
            foreach($data as $Payment): 
             $created =  $User->findById($Payment->received_by);  
 			 $updated =  $User->findById($Payment->updated_by); 
 			 $amount +=  removeComma($Payment->amount);
             $row = array($x,
             $Payment->pay_by,
             $Payment->amount,
             $Payment->phone,
             $created->acc_first_name. ' '.$created->acc_last_name, 
             $Payment->created_at,
             $Payment->updated_at,
             $updated->acc_first_name. ' '.$updated->acc_last_name,
             $Payment->tranType);

            fputcsv($output, $row);
            $x++;
            endforeach;

            fputcsv($output, array('','', ' ', '', '', '', '', '', ''));
            $amount = formatMoney($amount,true);
            fputcsv($output, array('','Total Amount', $amount));
 

            endif;
        }




//ends here
}
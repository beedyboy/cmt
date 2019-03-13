<?php
/**
* 
*/
class EventController extends Controller
{
	
	function __construct($controller, $action)
	{
		# code...
		parent::__construct($controller, $action);
		$this->load_model('Event');
		  
		 if(!Auth::check()): Router::redirect('auth/login'); endif;
		 	// $this->org_id = Auth::auth('org_id'); 
	}


public function index()
{

 
 	// $params = [	 'conditions'=> ['org_id = ?'],	 'bind' => [$this->org_id] 	 ];	
 		$this->view->displayErrors = $this->validate->displayErrors();
	  	$this->view->data  = $this->Event->find();
		$this->view->render('event/index'); 
		$this->view->extra('layouts/beedy_kaydee');  
}

 

public function list()
{
	$User = new User('users');
	$Category = new Category('categories'); 
	 $data  = $this->Event->paginate(PAGE_LIMIT,['conditions'=> 'org_id = ?', 'bind' => [$this->view->Beedy->getCompanyId()] ]);
 	$x = 1;
   foreach ($data as $Event)
  {
             
  ?>

<tr> 
<td><?=$x;?></td>
<td><?php echo $Category->findById($Event->cat_id)->cat_name; ?> </td> 
<td class="beedy-tooltip ">
<span class="top" ><?=$Event->evt_desc?></span>
<?=(strlen($Event->evt_desc) < 15)? $Event->evt_desc : substr($Event->evt_desc, 0,15).'...' ?>
 </td>  
<td><?php echo $Event->evt_date; ?> </td>  
<td>
<?php $created =  $User->findById($Event->created_by); 
		echo $created->acc_first_name. " ".$created->acc_last_name;?> 
</td> 
<td><?php echo $Event->created_at; ?> </td> 
<td><?php echo $Event->updated_at; ?> </td> 
<td>
<?php $updated =  $User->findById($Event->updated_by); 
		echo $updated->acc_first_name. " ".$updated->acc_last_name;
  ?> </td> 

<td> 
        <?php   if(actionAcl('Event', 'u')):  ?>
<button type="button" name="modEvent" part='list' id="<?php echo $Event->id; ?>" class="btn btn-primary btn-xs modEvent">
	<i class="fas fa-pencil-alt fa-fw"></i> Edit</button>
<?php endif; ?>
	</td>

	<td>
	        <?php   if(actionAcl('Event', 'r')):  ?>
	  <a href="<?=base_url.'event/show/'.$Event->id; ?>" class="btn btn-info btn-xs">
	<i class="fas fa-eye fa-fw"></i> Details</a>
<?php endif; ?>
 </td>
</tr>
 
<?php 
$x++; 
 } 
  ?> 
  <tr><td colspan="4"><?=pageLinks();?></td></tr>
  <?php
}




public function show($id)
{ 

	  	$this->view->data  = $this->Event->findById($id);
 		$this->view->displayErrors = $this->validate->displayErrors();
		$this->view->render('event/show'); 
		$this->view->extra('layouts/beedy_kaydee');  
}
 
 

public function create()
{
// 	$Category = new Category('categories'); 
// $ary = [
// 'conditions'=> 'org_id = ?',
//  'bind' => [Auth::auth('org_id')] 
//  		];

//  $this->view->Category = $Category->findWhere('categories', $ary); 
 
	 $this->view->displayErrors = $this->validate->displayErrors();
		$this->view->extra('event/create');
}


public function store()
{
  
 
		if($_POST)
		{
			
			$data = array();
 
			$this->validate->check($_POST, [ 
										'evt_desc'=> [
													'display'=> 'Event Description',
													'required'=> true,
													'max' => 100
													]
												 
										]);
		  
		   if($this->validate->passed())
				{
					 
						  	$fields = [										 
										'evt_desc' => Input::get('evt_desc'),									 
										'evt_date' => Input::get('evt_date'),									 
										'cat_id' => Input::get('cat_id'), 									 
										'org_id' => $this->view->Beedy->getCompanyId(),		 
										'created_by' => getUserId(),		 
										'created_at' => '',		 
										'updated_by' => getUserId(),		 
										'updated_at' => ''		 
							];	
 
				  
 	$params = [	 'conditions'=> ['org_id = ?', 'cat_id = ?', 'evt_desc = ?'], 'bind' => [$this->org_id, Input::get('cat_id'), Input::get('evt_desc')] ];	  
	$data  = $this->Event->find($params);
 	

				if(count($data) < 1):
						$send = $this->Event->insert($fields);
						
						if($send): 
							//Session::flash('success', 'New Category has been added successfully');
						  	$data['status'] = "success";
							$data['msg']  =   'New Event has been added successfully';
   
				  		else:
				  		$data['status'] = "db_error";
						$data['msg'] = "Error: Event was not added. Please try again later";
				 			

				  		endif;
				  		else:
				  			$data['status'] = "error";
							$data['msg'] = "Error: This Event description may already exist. Please try again with a concrete description";
				  		endif;
				}
				else{
					$data['status'] = "error";
						$data['msg'] = $this->validate->displayErrors();
				}
					 

				unset($_POST);
				echo json_encode($data);  		
 
		}	
 //store ends down here
}
  


/**
 * [edit function]
 * @param  [type] $id [primary key to be edited]
 * @return [type]     [view]
 */
public function edit($id, $part='')
{		
	$Category = new Category('categories'); 
$ary = [
'conditions'=> 'org_id = ?',
 'bind' => [Auth::auth('org_id')] 
 		];

 	$this->view->Category = $Category->findWhere('categories', $ary); 
 	$this->view->part = $part;
 	$this->view->data = $this->Event->findById($id);
	 $this->view->displayErrors = $this->validate->displayErrors(); 
		$this->view->extra('event/edit');
}
public function update()
{
  
	if($_POST)
		{
			
			$data = array();
 
			$this->validate->check($_POST, [ 
										'evt_desc'=> [
													'display'=> 'Event Description',
													'required'=> true,
													'max' => 100
													]
												 
										]);
		  
		   if($this->validate->passed())
				{
					 
						  	$fields = [										 
										'evt_desc' => Input::get('evt_desc'),									 
										'evt_date' => Input::get('evt_date'),									 
										'cat_id' => Input::get('cat_id'), 									 
										'org_id' => $this->view->Beedy->getCompanyId(), 
										'updated_by' => getUserId(),		 
										'updated_at' => ''		 
							];	
 
				  
 	$params = [	 'conditions'=> ['org_id = ?', 'cat_id = ?', 'evt_desc = ?', 'evt_date = ?'], 'bind' => [$this->org_id, Input::get('cat_id'), Input::get('evt_desc'), Input::get('evt_date')] ];	  
	$existing = $this->Event->find($params);
 	

						 $part = Input::get('part');
 
				$Event = $this->Event->findById(Input::get('id'));
		   		 
		   	 
			if($Event->evt_desc != Input::get('evt_desc') || $Event->cat_id != Input::get('cat_id') || $Event->evt_date != Input::get('evt_date')):

					if(count($existing) < 1):
						$send = $this->Event->update($fields, (int)Input::get('id'));
						
						if($send): 
							if($part == 'details'):
							Session::flash('success', 'Event record updated successfully');
							$data['status'] = "redirect";
							$data['msg']  =   base_url.'event/show'.DS.Input::get('id'); 
			 			else:
			 				$data['status'] = "success";
							$data['msg']  =   'Event record updated successfully';
							endif;
						  	
   
				  		else:
				  		$data['status'] = "db_error";
						$data['msg'] = "Error: Event was not updated. Please try again later";
				 			

				  		endif;
				  		else:
				  			$data['status'] = "error";
							$data['msg'] = "Error: This Event description may already exist. Please try again with a concrete description";
				  		endif;
				  		 
				  		endif;
				}
				else{
					$data['status'] = "error";
						$data['msg'] = $this->validate->displayErrors();
				}
					 

				unset($_POST);
				echo json_encode($data);  		
 
		}	
	 
 //update ends down here
}
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Category
     * 
     */
    public function destroy($id)
    {
       $del = $this->Event->delete($id); 
      if($del):
        Session::flash('success', "Event Deleted Successfully"); 
    Router::redirect('event/index');
      else: 
      	Session::flash('error', "Error deleting this data... Please try again later"); 
        Router::redirect('event/show'.DS.$id);
      endif;
	 

    }


}
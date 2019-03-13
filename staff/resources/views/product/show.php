<?php $this->setSiteTitle('Event'); ?>
 
 <?php $this->start('body') ?>
<style>
    
</style>
 

<h1> Event Details </h1>
 <div class="  ">
	 	<?=$this->displayErrors ?>
	 	<?php  Session::flash('success'); ?>
	 	<?php  Session::flash('error'); ?>
	 </div>
     <input type="hidden" id="evt_id"  name="evt_id" value="<?=$this->data->id?>">
 <?php
$User = new User('users');
	$Category = new Category('categories'); 
 ?>
 <div class="grid mobile "> 
 
<div class="column column-12"> 

<div class="row mobile">

	<div class="column column-4 card1"> 
		
 <div class="card">
<div class="card-body "> 

<p class="card-title"><strong><?=$Category->findById($this->data->cat_id)->cat_name;?></strong></p>
<div class="subtitle"><?=$this->data->evt_desc;?></div>
</div> 
  <div class="card-footer">
     
        <?php   if(actionAcl('Event', 'd')):  ?>
  	  <a  name="delEvent" href="<?=base_url.'event/destroy/'.$this->data->id; ?>" class="btn btn-danger  pull-left ">
	<i class="fas fa-trash fa-fw"></i> Delete</a>
        <?php   endif; if(actionAcl('Event', 'u')):  ?>
<button type="button" name="modEvent" part='details' id="<?=$this->data->id?>" class="btn is-primary pull-right modEvent">
 <i class="fas fa-pencil-alt fa-fw"></i> Edit</button>
         <?php   endif;  ?>
</div>
</div>

	</div>

<div id="paySummary" class="column column-4 card3"> 
		


	</div>

<div class="column column-4 card2">
	<div class="card">	
<div class="row mobile"> 
	<div class="column column-6"> 
 <div class="card-body">
  
<p class="card-title"><strong>Created By:</strong></p>
<div class="subtitle">    
    
<?php
 $created =  $User->findById($this->data->created_by); 
		echo $created->acc_first_name. " ".$created->acc_last_name.'<br />'.
             $this->data->created_at;
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
$updated =  $User->findById($this->data->updated_by); 
		echo $updated->acc_first_name. " ".$updated->acc_last_name.'<br />'.
			 $this->data->updated_at;
		?>
		 </div>
</div>
	
	</div>
	<!--  ends up -->

</div>


	</div>
	</div>

</div>
  
 

<div class="column column-12">
	
 <hr />

 <h2>Payments</h2>
        <?php   if(actionAcl('Payment', 'c')):  ?>
  <Button class="btn btn-success  createFund"  data-toggle="tooltip" id="<?=$this->data->id?>" title="Pay Now" style="height:35px;" /><i class="fa fa-fw fa-money-bill-alt"></i> Pay Now</button>
<?php endif;?>

 <?php   if(actionAcl('Payment', 'r')):  ?>
 <button class="btn btn-warning printAllPayment" title="Print Preview" id="<?=$this->data->id?>" style="height:35px;"><i class="fas fa-print fa-fw"></i> Print Preview</button> 

         <a href="<?=base_url.'report/csv/'.$this->data->id?>"><button class="btn btn-info" title="Export to Excel" style="height:35px;"><i class="fa fa-file-excel fa-fw"></i> Export as Excel</button></a>

  <a href="<?=base_url.'report/audit/'.$this->data->id?>"><button class="btn btn-secondary" title="Export to Excel" style="height:35px;"><i class="fa fa-file-excel fa-fw"></i> Audit Trail</button></a>

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
<?php endif;?>
     <div id="alert_message_mod"></div>
             <?php   if(actionAcl('Payment', 'r')):  ?>
             <table  class="table  hoverable" id="payTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="reportCheckAll" name="reportCheckAll"  /></th>
                           <th>Description </th> 
                           <th>Paid By </th> 
                           <th>Amount </th> 
                           <th>Phone Number </th> 
                         <th>Received By </th> 
                         <th>Received on </th> 
                         <th>Updated at </th> 
                         <th>Updated By </th> 
                          <th>Edit </th>
                   
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>
                <?php else: echo "You are not allowed to see payments record"; endif;  ?>
</div>


</div> 
</div>
           

              <?php $this->end() ?> 
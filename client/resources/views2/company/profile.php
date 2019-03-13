<?php $this->setSiteTitle('Company\'s Profile'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<!-- <h1>Users' List</h1> -->
         <hr />
       <div class="notice">
        
	    <?=$this->displayErrors ?>
	    <?php  Session::flash('success'); ?>
	    <?php  Session::flash('error'); ?>
	   </div>   
	     <div id="alert_message_mod">


	     </div>       
            

	<div class="grid mobile">
		<div class="column column-8">


				<form action="<?=base_url?>company/update" method="post" class="updateCompany" role="form"> 
					<input type="hidden" name="id" value="<?=$this->data->id?>"> 
								 
				<div class="form-group">
				<label>Organization Name</label> 
				<input type="text" name="org_name" id="org_name" class="form-control" value="<?=$this->data->org_name?>">
				 </div>

				<div class="form-group">
				<label>Organization Number </label> 
				<input type="text" name="org_num" id="org_num" class="form-control" value="<?=$this->data->org_num?>">
				</div>

				<div class="form-group">
				<label>Email</label> 
				<input type="email" name="org_email" id="org_email" class="form-control" value="<?=$this->data->org_email?>">
				</div>

						
				<div class="form-group">
				<label>Address</label> 
				<textarea name="org_address" id="org_address" class="form-control"><?=$this->data->org_address?> </textarea> 
				 </div>
				  
				<div class="form-group">
				 
				 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save Changes</button>
				 </div>

				 
				</form>
  
			
		</div>


		<div class="column column-4">
				
 <button class="btn is-primary updatePassword">Subscribe to another Feature</button>  


 <ul type="square">
<!--  <h2>Feature's Packages</h2> -->
 <?php
 

    $Feature = new Feature('features'); 
  echo "<h2>Feature (".$Feature->findById($this->data->fid)->name.")</h2><hr/>";
 

 
  $permissions = json_decode($Feature->findById($this->data->fid)->permissions, true); 

// dnd($permissions); 
if(array_key_exists('Category', $permissions))
{ 
	
	if(!empty($permissions['Category']))
	{
		foreach ($permissions['Category'] as $category)
		 {
			 
		echo aclHelper($category, 'Categories');

		}
	 }
}
//Event 
if(array_key_exists('Event', $permissions))
{ 
 
	if(!empty($permissions['Event']))
	{

		foreach ($permissions['Event'] as $event)
		 {
			 
		echo aclHelper($event, 'Events');

		}
	} 
}
//Payment
if(array_key_exists('Payment', $permissions))
{ 
 	if(!empty($permissions['Payment']))
 	{

		foreach ($permissions['Payment'] as $payment)
		 {
			 
		echo aclHelper($payment, 'Payments');

		}
	}		 
}

//User
if(array_key_exists('User', $permissions))
{ 
 if(!empty($permissions['User']))
 {

		foreach ($permissions['User'] as $user)
		 {
			 
		echo aclHelper($user, 'User');

		}
	}		 
}
	
//Role
if(array_key_exists('Role', $permissions))
{ 
 
	if(!empty($permissions['Role']))
	{ 
		foreach ($permissions['Role'] as $role)
		 {
		 
		echo aclHelper($role, 'Role');

		}
	} 
}
	
//Other
if(array_key_exists('Other', $permissions))
{ 
		 
		if(!empty($permissions['Other']))
		{

			foreach ($permissions['Other'] as $other)
			 {
				if($other == "*"):

			echo "<li> Manage Reports</li>";

			echo "<li> Manage Settings</li>";
			echo "<li> Manage Company Profile</li>";

				else:
			echo "<li>Manage $other</li>";

				endif;
			}
		}
		 
}
		 	 

// dnd($obj);
/*
if(array_key_exists('Category', $permissions))
{
	foreach ($permissions['Category'] as $key => $value) {
		# code...
	echo $value;
}

}
*/

 ?>

</ul>

		</div>
	</div>

 
</div>
           
<?php $this->end() ?>

 
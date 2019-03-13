<?php $this->setSiteTitle('User Management'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<!-- <h1>Users' List</h1> -->
         <hr />
       <div class="notice">
       <?php
	     	 if($this->data->acc_question == null):
	     	 	echo "<div class='alert alert-danger'>You have not set your account recovery question</div>
	     	 	<a href='#' class='btn btn-primary addAccRecovery'>Set Account Recovery Now?</a>";

	     	endif;
	     	?>
	    <?=$this->displayErrors ?>
	    <?php  Session::flash('success'); ?>
	    <?php  Session::flash('error'); ?>
	   </div>   
	     <div id="alert_message_mod">


	     </div>       
            

	<div class="grid mobile">
		<div class="column column-8">


				<form action="<?=base_url?>user/update" method="post" class="updateUser" role="form"> 
					<input type="hidden" name="id" value="<?=$this->data->id?>">
					<input type="hidden" name="rid" value="<?=$this->data->rid?>">
				 
				 
				  <div class="form-group">
				<label>FirstName</label> 
				<input type="text" name="acc_first_name" id="acc_first_name" class="form-control" value="<?=$this->data->acc_first_name?>">
				 </div>

				 <div class="form-group">
				<label>LastName</label>
				 <input type="text" name="acc_last_name" id="acc_last_name"  class="form-control" value="<?=$this->data->acc_last_name?>">
				 </div>

				<div class="form-group">
				<label>Email</label> 
				<input type="email" name="acc_email" id="acc_email" class="form-control" value="<?=$this->data->acc_email?>">
				</div>
				 
				<div class="form-group">
				<label>Phone</label> 
				<input type="text" name="acc_phone" id="acc_phone" class="form-control" value="<?=$this->data->acc_phone?>">
				</div>
				  
				  
				<div class="form-group">
				 
				 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save Changes</button>
				 </div>

				 
				</form>
  
			
		</div>


		<div class="column column-4">
				<button class="btn is-primary updatePassword">Change Password</button> 
				<button class='btn is-primary addAccRecovery'>Set Account Recovery Now?</button> 


 <ul type="square">
 <?php

    $Role = new Role('roles'); 
  echo "<h2>Role (".$Role->findById($this->data->rid)->name.")</h2><hr/>";
 
 echo "<h5><strong>Your Permissions </strong>";
  $permissions = json_decode( $Role->findById($this->data->rid)->permissions, true); 

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
		 	 
 
 ?>
 </h5>
</ul>

		</div>
	</div>

 
</div>
           
<?php $this->end() ?>

 
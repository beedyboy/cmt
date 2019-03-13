<?php $this->setSiteTitle('Roles'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 

<h1> Role Details </h1>
 
     
 <?php
// dnd($this->data);
 ?>
 <div class="grid mobile ">

 
 
<div class="column offset-4 column-4">
  <?php if(actionAcl('Role', 'u')):  ?>
  <a href="<?=base_url?>role/edit/<?=$this->data->id?>" class="btn btn-default pull-right"><i class="fas fa-pencil-alt fa-fw"></i>Edit</a>
<?php endif; ?>
<p class="card-title"><strong><?=$this->data->name;?></strong></p>
<div class="subtitle"><?=$this->data->description;?></div>
 
  
 
 <hr />

 <h2>Permissions</h2>
 <ul type="square">
 <?php

 
 
  $permissions = json_decode($this->data->permissions, true); 

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
           

              <?php $this->end() ?> 
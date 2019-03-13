<?php $this->setSiteTitle('Roles'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 

<h1> Role Management </h1>
         <hr />
            <?php if(actionAcl('Role', 'c')):  ?>
         <a href="<?=base_url?>role/create" class="btn btn-success  m-b-1 pull-right"  data-toggle="tooltip"  title="Add New Role" style="height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Role</a>
 		<?php endif; ?>
 <div class="grid mobile ">
 
<div class="alert ">
	 	<?=$this->displayErrors ?>
	 	<?php  Session::flash('success'); ?>
	 	<?php  Session::flash('error'); ?>
	 </div>

<?php

foreach ($this->data as $role) 
{
?>
 
<div class="column column-3">
<div class="card">
<div class="card-body">
  
<p class="card-title"><strong><?=$role->name;?></strong></p>
<div class="subtitle"><?=$role->description;?></div>
</div>
<div class="card-footer">
 <?php if(actionAcl('Role', 'r')):  ?>
  <a href="<?=base_url?>role/show/<?=$role->id?>" class="btn btn-info">Details</a>

   <?php endif;
    if(actionAcl('Role', 'u')):  ?>
  <a href="<?=base_url?>role/edit/<?=$role->id?>" class="btn btn-default"><i class="fas fa-pencil-alt fa-fw"></i>Edit</a>
<?php endif; ?>
</div>
</div>
</div>
 

 <?php
}

?>



</div>


</div>






</div>
           

              <?php $this->end() ?>

 
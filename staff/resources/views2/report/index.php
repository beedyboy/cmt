<?php $this->setSiteTitle('Report'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
  
 <div class="grid mobile ">
 
<div class="alert ">
	 	<?=$this->displayErrors ?>
	 	<?php  Session::flash('success'); ?>
	 	<?php  Session::flash('error'); ?>
	 </div> 
 
<div class="column column-12"> 

<form action="" class="form-inline">
  


<div class="form-group">
<label>Category</label> 
<select name="name" id="reportCat" class="form-control">

<option value="">--Select One--</option>
<?php
$Category = new Category('categories');
foreach ($this->event as $value)
 {
 ?>

<option value="<?=$value->cat_id?>"><?=$Category->findById($value->cat_id)->cat_name?></option>

 <?php
}

?>

</select>

 </div>



<div class="form-group">
<label>Event</label> 
<div id="allEventList">
<select name="name" id="" class="form-control">
<option value="">Select Category First</option>
</select>
</div>
</div>


</form>

<div class="reporting">
  
</div>

</div>

<?php 
 // dnd($this->event);

?>
    

 


</div>
<?php $this->end() ?>

 
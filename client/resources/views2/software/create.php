  
<?php $this->setSiteTitle('New Subscriber'); ?>
 <?php $this->start('body') ?>
 
 <style>
 	
 </style>
<div  class="grid mobile">
<div  class="column offset-1-3 column-4 ">
<h1>Register</h1>
	 

<div class=" "> 
	 	<?=$this->displayErrors; ?>
	 	<?php  Session::flash('success'); ?>
	 </div>

<form action="<?=base_url ?>software/create" method="post"  class="submitForm " role="form">
	
<div class="form-group">
<label>Organization Name</label> 
<input type="text" name="org_name" id="org_name" class="form-control" value="<?=$this->post['org_name']?>">
 </div>

<div class="form-group">
<label>Organization Number </label> 
<input type="text" name="org_num" id="org_num" class="form-control" value="<?=$this->post['org_num']?>">
</div>

<div class="form-group">
<label>Email</label> 
<input type="email" name="org_email" id="org_email" class="form-control" value="<?=$this->post['org_email']?>">
</div>

<div class="form-group">
<label>Choose a Feature</label> 
 
<select name="fid" id="fid" class="form-control">
	<option value="">Select Feature</option>
<?php  
foreach ($this->features as $feature) {
	# code...
	echo '<option value="'.$feature->id.'">'.$feature->name.'</option>';
}
 ?>

</select>
</div>

<div class="form-group">
<label>Address</label> 
<textarea name="org_address" id="org_address" class="form-control" value="<?=$this->post['org_address']?>"> </textarea> 
 </div>

<div class="form-group">
 
 <button class="btn btn-primary"><span class="fas fa-save"></span> Save</button>
 </div>

 
</form>
 
 
</div>
</div>
              <?php $this->end() ?>
 

<div id="alert_message_mod"> 
	 	 
	 </div> 

<form action="<?=base_url?>admin/update" method="post" class="updateAdmin" role="form"> 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
 
 
  <div class="form-group">
<label>FirstName</label> 
<input type="text" name="firstname" id="firstname" class="form-control" value="<?=$this->data->firstname?>">
 </div>

 <div class="form-group">
<label>Last Names</label>
 <input type="text" name="lastname" id="lastname"  class="form-control" value="<?=$this->data->lastname?>">
 </div>


<div class="form-group">
<label>Gender: </label> 
<input type="radio" name="gender" value="Male" <?php if($this->data->gender == 'Male'): echo 'checked'; endif;?>>Male
<input type="radio" name="gender" value="Female" <?php if($this->data->gender == 'Female'): echo 'checked'; endif;?>>Female
</div>

<div class="form-group">
<label>Choose a Role</label> 
 
<select name="role"  class="form-control">
	<option value="">Select Role</option>
<?php  
foreach ($this->Role as $role) {
	# code...
	?>
	<option value="<?=$role->id?>" <?=($role->id == $this->data->role)? "selected" : ""?> ><?=$role->name?></option>

	
	<?php
}
 ?>

</select>
</div>
<div class="form-group">
<label>Email</label> 
<input type="email" name="email" id="email" class="form-control" value="<?=$this->data->email?>">
</div>
 
 
<!-- <div class="form-group">
<label>Phone</label> 
<input type="text" name="phone" id="phone" class="form-control" value="<?=$this->data->phone?>">
</div> -->
  
 
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Update Changes</button>
 </div>

 
</form>
  
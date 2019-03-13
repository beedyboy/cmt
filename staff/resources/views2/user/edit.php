 

<div id="alert_message_mod"> 
	 	 
	 </div> 

<form action="<?=base_url?>user/update" method="post" class="updateUser" role="form"> 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
 
 
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
<label>User Role</label> 
 
<select name="rid" id="rid" class="form-control">
	<option value="">Select Role</option>
<?php  
foreach ($this->Role as $role) 
{  

 ?>
<option value="<?=$role->id?>" <?=($role->id == $this->data->rid)? "selected" : ""?> ><?=$role->name?></option>
<?php }

?>

</select>
</div>
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save Changes</button>
 </div>

 
</form>
  
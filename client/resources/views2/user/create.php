 

<div id="alert_message_mod"> 
	 	 
	 </div>

<form  method="post"  class="storeUser" role="form">
	
<input type="hidden" name="org_id" value="<?=Auth::auth('org_id');?>">
<input type="hidden" name="acc_status" value="Active">
<div class="form-group">

<label>FirstName</label> 
<input type="text" name="acc_first_name" id="acc_first_name" class="form-control">
 </div>

 <div class="form-group">
<label>LastName</label>
 <input type="text" name="acc_last_name" id="acc_last_name"  class="form-control">
 </div>

<div class="form-group">
<label>Email</label> 
<input type="email" name="acc_email" id="acc_email" class="form-control">
</div>
 

 
<div class="form-group">
<label>Choose a Password</label> 
<input type="password" name="acc_password" id="acc_password"  class="form-control">
</div>

<div class="form-group">
<label>Confirm Password</label> 
<input type="password" name="confirm" id="confirm"  class="form-control"> 
 </div>
 
 

<div class="form-group">
<label>User Role</label> 
 
<select name="rid" id="rid" class="form-control">
	<option value="">Select Role</option>
<?php  
foreach ($this->Role as $role) {
	# code...
	echo '<option value="'.$role->id.'">'.$role->name.'</option>';
}
 ?>

</select>
</div>
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save New</button>
 </div>

 
</form>
  
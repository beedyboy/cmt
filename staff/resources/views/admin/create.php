
<div class="alert_message_mod"> 
	 	 
	 </div>
<form  method="post"  class="storeAdmin" role="form"> 
<div class="form-group">

<label>FirstName</label> 
<input type="text" name="firstname" id="firstname" class="form-control">
 </div>

 <div class="form-group">
<label>Last Name</label>
 <input type="text" name="lastname" id="lastname"  class="form-control">
 </div>

<div class="form-group">
<label>Gender: </label> 
<input type="radio" name="gender" value="Male" >Male
<input type="radio" name="gender" value="Female" >Female
</div>
 

 
<div class="form-group">
<label>Choose a Role</label> 
 
<select name="role"  class="form-control">
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
<label>Email</label> 
<input type="email" name="email" id="email" class="form-control">
</div>
 

 
<div class="form-group">
<label>Choose a Password</label> 
<input type="password" name="password" id="password"  class="form-control">
</div>

<div class="form-group">
<label>Confirm Password</label> 
<input type="password" name="confirm" id="confirm"  class="form-control"> 
 </div>
 
 

 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save New</button>
 </div>

 
</form>
   


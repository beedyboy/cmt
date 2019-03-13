 

<div id="alert_message_mod"> 
	 	 
	 </div>

<form  method="post"  class="storeUpdatePassword" role="form">
	 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
 
 
<div class="form-group">
<label>Enter New Password</label> 
<input type="password" name="acc_password" id="acc_password"  class="form-control">
</div>

<div class="form-group">
<label>Confirm Password</label> 
<input type="password" name="confirm" id="confirm"  class="form-control"> 
 </div> 
 
<div class="form-group">
 
 <button type="submit" class="btn btn-info"><span class="fas fa-save"></span> Change Password</button>
 </div>

 
</form>
  
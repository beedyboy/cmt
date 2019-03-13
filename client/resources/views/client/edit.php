<div class="alert_message_mod"> 
	 	 
	 </div>

<form action="<?=base_url?>user/update" method="post" class="updateUser" role="form"> 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
 
 
  <div class="form-group">
<label>FirstName</label> 
<input type="text" name="acc_first_name" id="firstname" class="form-control" value="<?=$this->data->acc_first_name?>">
 </div>

 <div class="form-group">
<label>Last Name</label>
 <input type="text" name="acc_last_name" id="lastname"  class="form-control" value="<?=$this->data->acc_last_name?>">
 </div>


<div class="form-group">
<label>Gender: </label> 
<input type="radio" name="gender" value="Male" <?php if($this->data->gender == 'Male'): echo 'checked'; endif;?>>Male
<input type="radio" name="gender" value="Female" <?php if($this->data->gender == 'Female'): echo 'checked'; endif;?>>Female
</div>

<div class="form-group">
<label>Email</label> 
<input type="email" name="acc_email" id="email" class="form-control" value="<?=$this->data->acc_email?>">
</div>
 
 
<div class="form-group">
<label>Phone</label> 
<input type="text" name="acc_phone" id="phone" class="form-control" value="<?=$this->data->acc_phone?>">
</div>
  
 
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Update Changes</button>
 </div>

 
</form>
  
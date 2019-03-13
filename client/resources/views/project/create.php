 
<form method="post" class="storeProject" role="form">
	
 
<div class="form-group">
<label>Choose a Client</label> 
 
<select name="client_id"  class="form-control">
	<option value="">Select Client</option>
<?php  
foreach ($this->User as $user) {
	# code...
	echo '<option value="'.$user->id.'">'.$user->acc_first_name.' '.$user->acc_last_name.'</option>';
}
 ?>

</select>
</div>
 
 
<div class="form-group">
<label>Choose a Product</label> 
 
<select name="product_id" id="product_id" class="form-control">
	<option value="">Select Product</option>
<?php  
foreach ($this->Product as $product) {
	# code...
	echo '<option value="'.$product->id.'">'.$product->product_name.'</option>';
}
 ?>

</select>
</div>
 
 
<div class="form-group">
 
 <button type="submit" class="btn is-primary"><span class="fa fa-save"></span> Save</button>
 </div>

 
</form>
<span class="alert_message_mod"> 
	 	 
      </span>
  
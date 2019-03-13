 

<div id="alert_message_mod"> 
	 	 
	 </div> 

<form method="post" class="updatePayment" role="form"> 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
	

<div class="form-group">
<label>Amount</label>
<input type="text"  class="form-control" id="amount" name="amount" value="<?=$this->data->amount?>" placeholder="Amount..." />
					
			 				
 </div>

<div class="form-group"> 
<label>Paid By</label>
<input type="text"  class="form-control" id="pay_by" name="pay_by" value="<?=$this->data->pay_by?>" placeholder="Paid by..." />
			 				
 </div>

<div class="form-group"> 
<label>Phone Number</label>
<input type="text"  class="form-control" id="phone" name="phone" value="<?=$this->data->phone?>" placeholder="Phone Number..." />
					
 </div> 
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save Changes</button>
 </div>

 
</form>
  
 

<div id="alert_message_mod"> 
	 	 
	 </div>

<form method="post" action="<?=base_url?>payment/payFund" class="payFunds" role="form">
	
<input type="hidden" name="evt_id" value="<?=$this->id?>">
 

<div class="form-group">
<label>Amount</label>
<input type="text"  class="form-control" id="amount" name="amount" placeholder="Event amount..." />
					
			 				
 </div>

<div class="form-group"> 
<label>Paid By</label>
<input type="text"  class="form-control" id="pay_by" name="pay_by" placeholder="Paid by..." />
			 				
 </div>

<div class="form-group"> 
<label>Phone Number</label>
<input type="text"  class="form-control" id="phone" name="phone" placeholder="Phone Number..." />
					
 </div>

 
<div class="form-group">
 
 <button type="submit" class="btn is-success btn-block btn-large pull-right" title="Click to Save"><span class="fas fa-save"></span> Save</button>
 </div>

 
</form>
  
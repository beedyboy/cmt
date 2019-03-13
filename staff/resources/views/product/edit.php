 

<div id="alert_message_mod"> 
	 	 
	 </div> 

<form method="post" class="updateEvent" role="form">
	
	 <input type="hidden" name="id" value="<?=$this->data->id?>">
	 
 
<div class="form-group">
<label>Product Name</label> 
<input type="text" name="pname" id="pname" class="form-control" value="<?=$this->data->product_name?>">
 </div>
 

<div class="form-group">
<label>Description</label> 
<textarea name="prd_desc" id="prd_desc" class="form-control" ><?=$this->data->product_description?></textarea>
 </div>

<div class="form-group">
<label>Date</label> 
<input type="date" name="evt_date" id="evt_date" class="form-control" value="<?=$this->data->evt_date?>">
 </div>
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Update Changes</button>
 </div>

 
</form>
  
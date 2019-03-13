 

<div id="alert_message_mod"> 
	 	 
	 </div> 

<form method="post" class="updateEvent" role="form">
	
	<input type="hidden" id="part" name="part" value="<?=$this->part?>">
	<input type="hidden" name="id" value="<?=$this->data->id?>">
	 

<div class="form-group">
<label>Choose a Category</label> 
 
<select name="cat_id" id="cat_id" class="form-control">
	<option value="">Select Category</option>
<?php  
foreach ($this->Category as $category) {
 
 ?>
<option value="<?=$category->id?>" <?=($category->id == $this->data->cat_id)? "selected" : ""?> ><?=$category->cat_name?></option>
<?php }

?>
</select>
</div>

<div class="form-group">
<label>Description</label> 
<textarea name="evt_desc" id="evt_desc" class="form-control" ><?=$this->data->evt_desc?></textarea>
 </div>

<div class="form-group">
<label>Date</label> 
<input type="date" name="evt_date" id="evt_date" class="form-control" value="<?=$this->data->evt_date?>">
 </div>
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save Changes</button>
 </div>

 
</form>
  
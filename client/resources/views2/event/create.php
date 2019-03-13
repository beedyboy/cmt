 

<div id="alert_message_mod"> 
	 	 
	 </div>

<form method="post"  class="storeEvent" role="form">
	

<div class="form-group">
<label>Choose a Category</label> 
 
<select name="cat_id" id="cat_id" class="form-control">
	<option value="">Select Category</option>
<?php  
foreach ($this->Category as $category) {
	# code...
	echo '<option value="'.$category->id.'">'.$category->cat_name.'</option>';
}
 ?>

</select>
</div>

<div class="form-group">
<label>Description</label> 
<textarea name="evt_desc" id="evt_desc" class="form-control"></textarea>
 </div>

<div class="form-group">
<label>Date</label> 
<input type="date" name="evt_date" id="evt_date" class="form-control">
 </div>
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save</button>
 </div>

 
</form>
  
 
<form method="post" class="storeProduct" role="form" enctype="multipart/form-data">
	

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
<label>Product Name</label> 
<input type="text" name="pname" id="pname" class="form-control">
 </div>
 
<div class="form-group">
<label>Description</label> 
<textarea name="prd_desc" id="prd_desc" class="form-control"></textarea>
 </div>

<div class="form-group">
<label>Product Price</label> 
<input type="text" name="price" id="price" class="form-control">
 </div>
 
<div class="form-group">
<label>Product Image</label> 
<input type="file" name="photo" id="photo" class="form-control">
 </div>
 
<div class="form-group">
 
 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save</button>
 </div>

 
</form>
  <span class="alert_message_mod"> 
	 	 
	 </span>
  
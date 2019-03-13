 
<div id="alert_message_mod"> 
	 	 
	 </div>
 

<form method="post"  class="updateCategory" role="form">
	<input type="hidden" name="id" id="id" value="<?=$this->data->id; ?>" class="form-control">
<div class="form-group">
<label>Category Name</label> 
<input type="text" name="cat_name" id="name" value="<?=$this->data->cat_name; ?>" class="form-control">
 </div>
 
<div class="form-group">
 
 <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Save Update</button>
 </div>

 
</form>
  
 
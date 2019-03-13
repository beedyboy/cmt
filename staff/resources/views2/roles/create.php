<?php $this->setSiteTitle('New Role'); ?>
 <?php $this->start('body') ?>
 </style>
  <div class="grid mobile ">
<div class="column offset-4 column-4"> 
 
  
<div class="alert ">
	 	<?=$this->displayErrors ?>
	 	<?php  Session::flash('success'); ?>
	 	<?php  Session::flash('error'); ?>
	 </div>

<form action="<?=base_url;?>role/create" method="post" role="form">
  
<div class="form-group">
<label>Role's Name</label> 
<input type="text" name="name" id="name" class="form-control"  value="<?=$this->post['name']?>">
 </div>
 
<div class="form-group">
<label>Description</label> 
<textarea name="description" id="description" class="form-control" value="<?=$this->post['description']?>" > </textarea>  
 </div>
 
<label for="permission">Permissions</label>
<hr/>


 
  <div class="grid mobile ">
<div class="column column-4"> 

<div class="form-group">
<label><input type="checkbox" id="categoryAll" name="categoryAll" value="*" checked />  Category</label> 
 
<label for="categorycreate"  class="beedy-check" >Create
 <input type="checkbox" name="category[]" value="c" class="catCase" id="categorycreate" checked>  
 <span class="checkmark"></span>
 </label>


  <label for="categoryread" class="beedy-check">Read
  <input type="checkbox" name="category[]" value="r" class="catCase" id="categoryread" checked>
  <span class="checkmark"></span>
  </label> 

 <label for="categoryupdate" class="beedy-check">Update
  <input type="checkbox" name="category[]" value="u" class="catCase" id="categoryupdate" checked> 
  <span class="checkmark"></span>
 </label>

 <label for="categorydelete" class="beedy-check">Delete
 <input type="checkbox" name="category[]" value="d" class="catCase" id="categorydelete" checked>
 <span class="checkmark"></span>
 </label> 



 </div>
 </div>
 

<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="eventAll" name="eventAll" value="*" checked />  Event</label> 
 
 <label for="eventcreate" class="beedy-check">Create
 <input type="checkbox" name="event[]" value="c" class="eventCase" id="eventcreate" checked> 
  <span class="checkmark"></span>
 </label>

<label for="eventread" class="beedy-check">Read
 <input type="checkbox" name="event[]" value="r" class="eventCase" id="eventread" checked> 
<span class="checkmark"></span>
  </label> 
 
  <label for="eventupdate" class="beedy-check">Update
 <input type="checkbox" name="event[]" value="u" class="eventCase" id="eventupdate" checked> 
 <span class="checkmark"></span>
 </label>

<label for="eventdelete" class="beedy-check">Delete 
 <input type="checkbox" name="event[]" value="d" class="eventCase" id="eventdelete" checked>
 <span class="checkmark"></span>
  </label> 
 </div>
  
</div>






<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="paymentAll" name="paymentAll" value="*" checked />  Payment</label> 
 
<label for="paymentcreate" class="beedy-check">Create
 <input type="checkbox" name="payment[]" value="c" class="paymentCase" id="paymentcreate" checked>  
 <span class="checkmark"></span>
 </label>

<label for="paymentread" class="beedy-check">Read
 <input type="checkbox" name="payment[]" value="r" class="paymentCase" id="paymentread" checked> 
 <span class="checkmark"></span>
 </label> 

<label for="paymentupdate" class="beedy-check">Update
 <input type="checkbox" name="payment[]" value="u" class="paymentCase" id="paymentupdate" checked>  
 <span class="checkmark"></span>
 </label>

<label for="paymentdelete" class="beedy-check">Delete
 <input type="checkbox" name="payment[]" value="d" class="paymentCase" id="paymentdelete" checked> 
 <span class="checkmark"></span>
 </label> 
 </div>
  
</div> 

</div>




  <div class="grid mobile ">
<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="userAll" name="userAll" value="*" checked />  User</label> 
 
 <label for="usercreate" class="beedy-check">Create
  <input type="checkbox" name="user[]" value="c" class="userCase" id="usercreate" checked> 
 <span class="checkmark"></span>
  </label>
 
<label for="userread" class="beedy-check">Read
 <input type="checkbox" name="user[]" value="r" class="userCase" id="userread" checked> 
 <span class="checkmark"></span>
 </label> 

<label for="userupdate" class="beedy-check">Update
 <input type="checkbox" name="user[]" value="u" class="userCase" id="userupdate" checked>  
 <span class="checkmark"></span>
 </label>
 
<label for="userdelete" class="beedy-check">Delete
 <input type="checkbox" name="user[]" value="d" class="userCase" id="userdelete" checked> 
 <span class="checkmark"></span>
 </label> 
 </div>
  
</div> 


<div class="column column-4"> 

<div class="form-group">
<label><input type="checkbox" id="roleAll" name="roleAll" value="*" checked />  Roles</label> 
 
 <label for="rolecreate" class="beedy-check">Create
  <input type="checkbox" name="role[]" value="c" class="roleCase" id="rolecreate" checked> 
 <span class="checkmark"></span>
 </label>
 
 <label for="roleread" class="beedy-check">Read
  <input type="checkbox" name="role[]" value="r" class="roleCase" id="roleread" checked>
 <span class="checkmark"></span>
 </label>

 <label for="roleupdate" class="beedy-check">Update
 <input type="checkbox" name="role[]" value="u" class="roleCase" id="roleupdate" checked>  
 <span class="checkmark"></span>
 </label> 



 </div>
 </div> 




<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="otherAll" name="otherAll" value="*" checked />  Others</label>  

 <label for="report" class="beedy-check">Report
 <input type="checkbox" name="other[]" value="report" class="otherCase" id="report" checked>
 <span class="checkmark"></span>  
 </label>  
 
 <label for="setting" class="beedy-check">Settings
  <input type="checkbox" name="other[]" value="setting" class="otherCase" id="setting" checked > 
   <span class="checkmark"></span>
  </label>  

 <label for="setting" class="beedy-check">Company Profile
  <input type="checkbox" name="other[]" value="company" class="otherCase" id="setting" checked > 
   <span class="checkmark"></span>
  </label>  


 </div>
  
</div>




</div>






<div class="form-group">
 
 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save</button>
 </div>

 
</form>
  

</div>
       </div>    

 <?php $this->end() ?>
 
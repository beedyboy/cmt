<?php $this->setSiteTitle('Features'); ?>
 <?php $this->start('body') ?>
 
  
 <div class="grid mobile ">

 
 
<div class="column offset-4 column-4">
 

<h1> Feature Details </h1>
<div class="alert ">
	 	<?=$this->displayErrors ?>
	 	<?php  Session::flash('success'); ?>
	 	<?php  Session::flash('error'); ?>
	 </div>


  <form action="<?=base_url.'feature/edit/'.$this->data->id; ?>" method="post"  Feature="form">
	<input type="hidden" name="id" id="id" value="<?=$this->data->id; ?>" class="form-control">
<div class="form-group">
<label>Feature's Name</label> 
<input type="text" name="name" id="name" value="<?=$this->data->name; ?>" class="form-control">
 </div>
 
<div class="form-group">
<label>Description</label> 
<textarea name="description" id="description" class="form-control"> <?=$this->data->description; ?></textarea>  
 </div>

 
 <hr />


<label for="permission">Permissions</label>
<hr/>

<?php 
  $permissions = json_decode($this->data->permissions, true); 
 

?>
 
  <div class="grid mobile ">
<div class="column column-4"> 

<div class="form-group">
<label><input type="checkbox" id="categoryAll" name="categoryAll" value="*" <?php if(!empty($permissions['Category']) && (in_array("*", $permissions['Category']))):  echo "checked"; endif; ?> /> Category</label> 
 
 <label for="categorycreate" class="beedy-check">Create 
 <input type="checkbox" name="category[]" value="c" class="catCase" id="categorycreate"  <?php if(!empty($permissions['Category']) && (in_array("*", $permissions['Category']) || in_array("c",  $permissions['Category']))):  echo "checked"; endif; ?>>  
   <span class="checkmark"></span>
   </label>

<label for="categoryread" class="beedy-check">Read 
 <input type="checkbox" name="category[]" value="r" class="catCase" id="categoryread"  <?php if(!empty($permissions['Category']) && (in_array("*", $permissions['Category']) || in_array("r",  $permissions['Category']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label> 

<label for="categoryupdate" class="beedy-check">Update 
 <input type="checkbox" name="category[]" value="u" class="catCase" id="categoryupdate"  <?php if(!empty($permissions['Category']) && (in_array("*", $permissions['Category']) || in_array("u",  $permissions['Category']))):  echo "checked"; endif; ?>>  
   <span class="checkmark"></span>
   </label>

<label for="categorydelete" class="beedy-check">Delete 
 <input type="checkbox" name="category[]" value="d" class="catCase" id="categorydelete"  <?php if(!empty($permissions['Category']) && (in_array("*", $permissions['Category']) || in_array("d",  $permissions['Category']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label> 



 </div>
 </div>
 

<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="eventAll" name="eventAll" value="*" <?php if(!empty($permissions['Event']) && (in_array("*", $permissions['Event']))):  echo "checked"; endif; ?> /> Event</label> 

  <label for="eventcreate" class="beedy-check">Create 
 <input type="checkbox" name="event[]" value="c" class="eventCase" id="eventcreate"  <?php if(!empty($permissions['Event']) && (in_array("*", $permissions['Event']) || in_array("c",  $permissions['Event']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

<label for="eventread" class="beedy-check">Read 
 <input type="checkbox" name="event[]" value="r" class="eventCase" id="eventread"  <?php if(!empty($permissions['Event']) && (in_array("*", $permissions['Event']) || in_array("r",  $permissions['Event']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label> 

  <label for="eventupdate" class="beedy-check">Update 
 <input type="checkbox" name="event[]" value="u" class="eventCase" id="eventupdate"  <?php if(!empty($permissions['Event']) && (in_array("*", $permissions['Event']) || in_array("u",  $permissions['Event']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label>

 <label for="eventdelete" class="beedy-check">Delete 
 <input type="checkbox" name="event[]" value="d" class="eventCase" id="eventdelete"  <?php if(!empty($permissions['Event']) && (in_array("*", $permissions['Event']) || in_array("d",  $permissions['Event']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label> 
 </div>
  
</div>






<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="paymentAll" name="paymentAll" value="*"  <?php if(!empty($permissions['Payment']) && (in_array("*", $permissions['Payment']))):  echo "checked"; endif; ?>  /> Payment</label> 
 
  <label for="paymentcreate" class="beedy-check">Create 
 <input type="checkbox" name="payment[]" value="c" class="paymentCase" id="paymentcreate"  <?php if(!empty($permissions['Payment']) && (in_array("*", $permissions['Payment']) || in_array("c",  $permissions['Payment']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

  <label for="paymentread" class="beedy-check">Read 
 <input type="checkbox" name="payment[]" value="r" class="paymentCase" id="paymentread"  <?php if(!empty($permissions['Payment']) && (in_array("*", $permissions['Payment']) || in_array("r",  $permissions['Payment']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label> 

 <label for="paymentupdate" class="beedy-check">Update 
 <input type="checkbox" name="payment[]" value="u" class="paymentCase" id="paymentupdate"  <?php if(!empty($permissions['Payment']) && (in_array("*", $permissions['Payment']) || in_array("u",  $permissions['Payment']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

  <label for="paymentdelete" class="beedy-check">Delete 
 <input type="checkbox" name="payment[]" value="d" class="paymentCase" id="paymentdelete"  <?php if(!empty($permissions['Payment']) && (in_array("*", $permissions['Payment']) || in_array("d",  $permissions['Payment']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label> 
 </div>
  
</div> 

</div>




  <div class="grid mobile ">
<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="userAll" name="userAll" value="*"  <?php if(!empty($permissions['User']) && (in_array("*", $permissions['User']))):  echo "checked"; endif; ?>  /> User</label> 
 
   <label for="usercreate" class="beedy-check">Create
 <input type="checkbox" name="user[]" value="c" class="userCase" id="usercreate"  <?php if(!empty($permissions['User']) && (in_array("*", $permissions['User']) || in_array("c",  $permissions['User']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label>

 <label for="userread" class="beedy-check">Read
 <input type="checkbox" name="user[]" value="r" class="userCase" id="userread"  <?php if(!empty($permissions['User']) && (in_array("*", $permissions['User']) || in_array("r",  $permissions['User']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label>

 <label for="userupdate" class="beedy-check">Update
 <input type="checkbox" name="user[]" value="u" class="userCase" id="userupdate"  <?php if(!empty($permissions['User']) && (in_array("*", $permissions['User']) || in_array("u",  $permissions['User']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

 <label for="userdelete" class="beedy-check">Delete
 <input type="checkbox" name="user[]" value="d" class="userCase" id="userdelete"  <?php if(!empty($permissions['User']) && (in_array("*", $permissions['User']) || in_array("d",  $permissions['User']))):  echo "checked"; endif; ?>>
   <span class="checkmark"></span>
   </label>

 </div>
  
</div> 


<div class="column column-4"> 

<div class="form-group">
<label><input type="checkbox" id="FeatureAll" name="FeatureAll" value="*"  <?php if(!empty($permissions['Feature']) && (in_array("*", $permissions['Feature']))):  echo "checked"; endif; ?>  /> Features</label> 
 
  <label for="Featurecreate" class="beedy-check">Create
 <input type="checkbox" name="Feature[]" value="c" class="FeatureCase" id="Featurecreate"  <?php if(!empty($permissions['Feature']) && (in_array("*", $permissions['Feature']) || in_array("c",  $permissions['Feature']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

<label for="Featureread" class="beedy-check">Read
 <input type="checkbox" name="Feature[]" value="r" class="FeatureCase" id="Featureread"  <?php if(!empty($permissions['Feature']) && (in_array("*", $permissions['Feature']) || in_array("r",  $permissions['Feature']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

 <label for="Featureupdate" class="beedy-check">Update
 <input type="checkbox" name="Feature[]" value="u" class="FeatureCase" id="Featureupdate"  <?php if(in_array("*", $permissions['Feature']) || in_array("u",  $permissions['Feature'])):  echo "checked"; endif; ?>> 
 <span class="checkmark"></span>
 </label> 



 </div>
 </div> 




<div class="column column-4"> 
 
<div class="form-group">
<label><input type="checkbox" id="otherAll" name="otherAll" value="*"  <?php if(!empty($permissions['Other']) && (in_array("*", $permissions['Other']))):  echo "checked"; endif; ?>  /> Others</label>  

 <label for="report" class="beedy-check">Report
 <input type="checkbox" name="other[]" value="report" class="otherCase" id="report"   <?php  if(!empty($permissions['Other']) && (in_array("*", $permissions['Other']) || in_array("report",  $permissions['Other']))):  echo "checked"; endif; ?>> 
   <span class="checkmark"></span>
   </label>

  <label for="setting" class="beedy-check">Settings
 <input type="checkbox" name="other[]" value="setting" class="otherCase" id="setting"   <?php if(!empty($permissions['Other']) && (in_array("*", $permissions['Other']) || in_array("setting",  $permissions['Other']))):  echo "checked"; endif; ?> > 
   <span class="checkmark"></span>
   </label>

  <label for="setting" class="beedy-check">Company Profile
 <input type="checkbox" name="other[]" value="company" class="otherCase" id="setting"   <?php if(!empty($permissions['Other']) && (in_array("*", $permissions['Other']) || in_array("company",  $permissions['Other']))):  echo "checked"; endif; ?> > 
   <span class="checkmark"></span>
   </label>



 </div>
  
</div>




</div>
 

</ul>
<div class="form-group">
 
 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save Update</button>
 </div>

 
</form>
  
</div> 
</div>
           

              <?php $this->end() ?>  
<div id="alert_message_mod"> 
	 	 
	 </div>
 


 
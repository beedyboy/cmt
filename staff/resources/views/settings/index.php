<?php $this->setSiteTitle(APP_NAME .' | Settings'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<h1> Debrise Settings  </h1>
         <hr />
         
  
         
     <div class="alert_message_mod"></div>
         
				<form action="<?=base_url;?>settings/update"  method="post" class="updateSettings" role="form"> 
				 				 
				<!-- <div class="form-group">
				<label style="font-size: 20px;">Maintenance Mode?</label> 
				<br />
				<label class="switch">  
				   <input type="checkbox" name="usermode" id="usermode"  <?php if($this->data->usermode=="Maintenance"): echo "Checked"; endif; ?> >
				   <div class="slider round">  
				   </div>
				 </div>
 -->
                 <div class="form-group">
                     <label style="font-size: 20px;">Maintenance Mode?</label> 
			
				<div class="onoffswitch">
    <input type="checkbox" name="bswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($this->data->usermode=="Maintenance"): echo "Checked"; endif; ?>>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
                </div>
                
				<div class="form-group">
				<label>Page Count </label> 
				<input type="text" name="paging" id="paging" class="form-control" value="<?=$this->data->pageLimit?>">
				</div>

				

			<!-- 	<div class="form-group">
				<label>Email</label> 
				<input type="email" name="org_email" id="org_email" class="form-control" value="<?=$this->data->org_email?>">
				</div>

					-->	
				<div class="form-group">
				<span class="span">

                </span>
				 
				 </div> 
				  
				<div class="form-group">
				 
				 <button type="submit" class="btn is-primary"><span class="fas fa-save"></span> Save Changes</button>
				 </div>

				 
				</form>
              <!-- Add Modal -->
 

</div>
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           <script>
                 $(document).on('submit','.supdateSettings', function(evt){
                     evt.preventDefault();
                     
if($("#myonoffswitch").prop("checked"))
{
  alert("Yes");
}
else{
    alert("No");
}
                    var myonoffswitch = $("#usermode").val();
             //        alert(myonoffswitch);
                 });
           </script>
 


      <?php $this->end() ?> 
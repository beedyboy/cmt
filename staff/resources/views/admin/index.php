<?php $this->setSiteTitle(APP_NAME .'| Administrators'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i>Admin</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i>Home</li>
          <li><i class="fa fa-laptop"></i>Admin</li>
        </ol>
             
          </div>
       
  </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
                Administrators' List  
          </header>
          <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div>    
        
         <button class="btn btn-primary addNewAdmin" title="Add New Admin" style="height:35px;"><i class="fa fa-user fa-fw"></i> Add Admin</button>
          <div id="alert_message_mod"></div>       
              
              <table  class="table table-striped table-advance table-hover" id="adminTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="AdminCheckAll" name="AdminCheckAll"  /> </th>
                           <th><i class="icon_profile"></i>First Name </th> 
                           <th><i class="icon_profile"></i>Last Name </th> 
                           <th><i class="icon_mobile"></i>Role </th>   
                           <th><i class="icon_mail_alt"></i> Email </th>   
                           <th><i class="fa fa-male"></i> Gender </th>   
                         <th><i class="icon_calendar"></i> Created at </th> 
                         <th><i class="icon_calendar"></i> Updated at </th>  
                          <th><i class="icon_cog"></i> Edit </th> 
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>


            </section>
          </div>

        </div>
<!-- 
<div id="app" class="columns">
<h1></h1>
         <hr />
     
             
      
   
 
</div> -->
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           
 


      <?php $this->end() ?> 
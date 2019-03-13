<?php $this->setSiteTitle(APP_NAME .'| Roles'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i>Roles</h3>
        <ol class="breadcrumb">
          <li><i class=" icon_house"></i>Home</li>
          <li><i class="icon_toolbox"></i> Roles</li>
        </ol>
             
          </div>
       
  </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
            Roles List
          </header>
          <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div>    
        <div class="btn-row">
          <div class="btn-group">
             <button class="btn btn-primary addNewRoles" title="Add New Roles" style="height:35px;"><i class="icon_plus_alt2"></i> Add Roles</button>
 
   

          </div>
        </div>
         

          <div id="alert_message_mod"></div>       
              
              <table  class="table table-striped table-advance table-hover" id="RolesTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="AdminCheckAll" name="AdminCheckAll"  /> </th>
                           <th><i class="icon_profile"></i>Roles Name </th>  
                           <th><i class="fa fa-male"></i> Description </th>   
                         <th><i class="icon_calendar"></i> Created at </th> 
                         <th><i class="icon_calendar"></i> Updated at </th>  
                          <th><i class="icon_cog"></i> Action </th> 
                     
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
      
       
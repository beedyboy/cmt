<?php $this->setSiteTitle('User Management'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<h1>Users' List</h1>
         <hr />
       <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div>    
        <?php  if(actionAcl('User', 'c')):  ?>
         <button class="btn btn-success addNewUser" title="Add New User" style="height:35px;"><i class="fa fa-user-plus fa-fw"></i> Add User</button>
             <?php endif; ?>
      <?php if(actionAcl('User', 'r')):  ?>
       <button class="btn btn-warning printAllUser" title="Print Preview" style="height:35px;"><i class="fa fa-print fa-fw"></i> Print Preview</button> 

         <a href="<?=base_url?>user/csv"><button class="btn btn-info" title="Export to Excel" style="height:35px;" /><i class="fa fa-file-excel fa-fw"></i> Export as Excel</button></a>

  <button class="split-btn" id="userMore"><i class="fa fa-fw fa-check-circle"></i> More</button>
<div class="split-dropdown">
  <button class="split-btn" style="border-left:1px solid navy">
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="split-content">
    <a href="#" class="printAlSelectedlUser"><i class="fa fa-print fa-fw"></i> Print Selected User</a>
    <a href="#" class="csvAlSelectedlUser"><i class="fa fa-file-excel fa-fw"></i> Export Selected as Excel</a>
    <?php   if(actionAcl('User', 'd')):  ?>  
      <a href="#" class="banSelectedUsers"><i class="fa fa-ban fa-fw"></i>Ban Selected</a>
    <?php endif; ?>
  </div> 
</div>

  <?php endif;  ?>

     <div id="alert_message_mod"></div>       
             <?php if(actionAcl('User', 'r')):  ?>
              <table  class="table  hoverable" id="userTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="userCheckAll" name="userCheckAll"  /> </th>
                           <th>First Name </th> 
                           <th>Last Name </th> 
                           <th>Phone </th>   
                           <th>Email </th>   
                           <th>Role </th>   
                           <th>Status </th>   
                         <th>Created at </th> 
                         <th>Updated at </th>  
                          <th>Edit </th>
                          <th>Ban </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>
                  <?php else: echo "You are not priviledged to read users record"; endif;  ?>
      <!-- Add Modal -->  
</div>
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           
 


      <?php $this->end() ?> 
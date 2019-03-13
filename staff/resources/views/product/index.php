<?php $this->setSiteTitle(APP_NAME .'| Products/Services'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i>Products/Services</h3>
        <ol class="breadcrumb">
          <li><i class=" icon_house"></i>Home</li>
          <li><i class="icon_toolbox"></i>Products/Services</li>
        </ol>
             
          </div>
       
  </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
            Products/Services List  
          </header>
          <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div>    
        <div class="btn-row">
          <div class="btn-group">
             <button class="btn btn-primary addNewproduct" title="Add New Product" style="height:35px;"><i class="icon_plus_alt2"></i> Add Product</button>
 
       <button class="btn btn-warning printAllUser" title="Print Preview" style="height:35px;"><i class="fa fa-print fa-fw"></i> Print Preview</button> 

          <button class="btn btn-info" title="Export to Excel" style="height:35px;" /><i class="fa fa-file-excel fa-fw"></i> Export as Excel</button> 

<div class="btn-group">
  <button class="btn btn-success dropdown-toggle" id="userMore" data-toggle="dropdown"><i class="fa fa-fw fa-check-circle"></i> More<span class="caret"></span></button>
  <ul class="dropdown-menu">
<li>  
  <a href="#" class="printAlSelectedlUser"><i class="fa fa-print fa-fw"></i> Print Selected User</a>
</li>
<li> <a href="#" class="csvAlSelectedlUser"><i class="fa fa-file-excel fa-fw"></i> Export Selected as Excel</a></li>
<li>  <a href="#" class="banSelectedUsers"><i class="fa fa-ban fa-fw"></i>Ban Selected</a>
  </li>
</ul>
</div>

          </div>
        </div>
         

          <div id="alert_message_mod"></div>       
              
              <table  class="table table-striped table-advance table-hover" id="productTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th><input type="checkbox" id="AdminCheckAll" name="AdminCheckAll"  /> </th>
                           <th><i class="icon_profile"></i>Product Name </th> 
                           <th><i class="icon_profile"></i>Product Image</th> 
                           <th><i class="fa fa-male"></i> Description </th>   
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
      
       
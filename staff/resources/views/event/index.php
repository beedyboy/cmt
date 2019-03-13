<?php $this->setSiteTitle(APP_NAME .' | Event'); ?>
 <?php $this->start('body') ?>
 
  <!--overview start-->
  <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Event Management</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="<?=base_url?>">Event</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
          <Button class="btn btn-dark  addNewEvent"  data-toggle="tooltip"  title="Add New Product" style="height:35px;" /><i class="fas fa-plus "></i> Add Product</button>
          <table  class="table  hoverable" id="eventTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th># </th>
                           <th>Header Title </th> 
                           <th>Instruction </th> 
                           <th>Header Image </th> 
                           <th>Date of Event </th> 
                           <th>Total </th> 
                         <th>Status </th>  
                          <th>Edit </th>
                          <th>Delete </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>
               
          </div>
          </div>
    <?php $this->end() ?>
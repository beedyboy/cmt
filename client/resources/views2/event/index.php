<?php $this->setSiteTitle('Events List'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div class="columns">
<h1>Events List</h1>
         <hr />
         <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div>   
   <?php   if(actionAcl('Event', 'c')):  ?>
         <Button class="btn btn-success  addNewEvent"  data-toggle="tooltip"  title="Add New Event" style="height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Event</button>
       <?php endif; ?>
     <div id="alert_message_mod"></div>
         
         <?php   if(actionAcl('Event', 'r')):  ?>
             <table  class="table  hoverable" id="evtTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th># </th>
                           <th>Event Category </th> 
                           <th>Description </th> 
                           <th>Date </th> 
                         <th>Created By </th> 
                         <th>Created at </th> 
                         <th>Updated at </th> 
                         <th>Updated By </th> 
                          <th>Edit </th>
                          <th>View </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>

               <?php else: echo "No access to read Event"; endif; ?>
      <!-- Add Modal -->
 

</div>
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           
 


      <?php $this->end() ?> 
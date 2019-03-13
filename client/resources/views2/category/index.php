<?php $this->setSiteTitle('Event Categories'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
<div id="app" class="columns">
<h1> Category Management </h1>
         <hr />
         
<?php   if(actionAcl('Category', 'c')):  ?>
         <Button class="btn btn-success  addNewCategory"  data-toggle="tooltip"  title="Add New Event" style="height:35px;" /><i class="fas fa-plus "></i> Add Category</button>
         <?php endif;?>
     <div id="alert_message_mod"></div>
         
               <?php 
            if(actionAcl('Category', 'r')): 
           
           ?>
           <table  class="table  hoverable" id="catTable" data-responsive="table">
                 <thead>
                     <tr> 
                          <th># </th>
                           <th>Category Name </th> 
                         <th>Created at </th> 
                         <th>Updated at </th> 
                          <th>Edit </th>
                          <th>Delete </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>
                <?php

                else:
                  echo "You are not allowed to read Category";

                endif;

                 ?> 
      <!-- Add Modal -->
 

</div>
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           
 


      <?php $this->end() ?> 
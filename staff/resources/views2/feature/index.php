<?php $this->setSiteTitle('Software Features'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
 
 <div class="grid mobile ">
 <div class="column column-12 ">
<h1 v-html="title">  </h1>
         <hr />
                <a href="<?=base_url?>feature/create" class="btn btn-success  m-b-1 pull-right"  data-toggle="tooltip"  title="Add New Role" style="height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Feature</a>
        
     <div id="alert_message_mod"></div>
        
             <table  class="table  hoverable" id="featureTable" data-responsive="table">
                 <thead>
                     <tr>
                         <th># </th>
                         <th>Feature Name </th>
                         <th>Description </th>    
                          <th>Action </th>
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                    
                 </tbody>
                 </table>
 

</div>
</div>
              <?php $this->end() ?>

 
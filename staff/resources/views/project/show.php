<?php $this->setSiteTitle(APP_NAME .'| Projects'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      <?php
$Product = new Product('products');
      ?>
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-group"></i>Projects</h3>
        <ol class="breadcrumb">
          <li><i class=" icon_house"></i>projects</li>
          <li><i class="fa fa-group"></i><?=$Product->findById($this->data->productId)->product_name?></li>
        </ol>
             
          </div>
       
  </div>
 
  
        <div class="row">
          <div class="col-lg-12">
   <div class="  ">
    <?=$this->displayErrors ?>
    <?php  Session::flash('success'); ?>
    <?php  Session::flash('error'); ?>
   </div> 
   




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
      
       
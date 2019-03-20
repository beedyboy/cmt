<?php $this->setSiteTitle(APP_NAME .'| Projects'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      <?php
$Product = new Product('products');
$Wallet = new Wallet('wallets');
      ?>
           <input type="hidden" id="wallet"  name="id" value="<?=$this->data->id?>">
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class=" icon-task-l"></i>Projects</h3>
        <ol class="breadcrumb">
          <li><i class=" icon_house"></i>projects</li>
          <li><i class=" icon-task-l"></i><?=$Product->findById($this->data->productId)->product_name?></li>
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


          <div class="row">
          <div class="col-lg-12">
               <!-- do for wallet summary -->
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="walletBalance">
            
               </div>
 <!-- do for wallet summary -->
<!-- last transaction -->
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="paySummary">
              
               </div>
<!-- last transaction -->
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="lastActivity">
<div class="info-box dark-bg">
	<i class=" icon_chat_alt"></i>
	<div class="count">
		    
	</div>
		<div class="title">
		Last Activity

		</div>
 
</div>';
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
      
       
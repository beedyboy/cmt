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
              <i class=" icon_mail_alt"></i>
              <div class="count">
                    
              </div>
              <!-- last activity -->
                <div class="title">
                Last Activity

                </div> 
              <!-- last activity -->
            </div> 
      </div>
 
  </div>
  </div>
 
  <div class="row">
    <div class="col-lg-8"> 
    <section class="panel">
            <header class="panel-heading">
           <i class="icon_chat_alt"></i> Activities
          </header>
          
    
    <table  class="table table-striped table-advance table-hover" id="activityTable" data-responsive="table">
              <thead>
                     <tr> 
                          <th><input type="checkbox" id="AdminCheckAll" name="AdminCheckAll"  /> </th>
                           <th><i class="icon_book_alt" style="font-size:24px;"></i>Subject </th> 
                           <th><i class=" icon_mail"></i> Message </th>    
                           <th><i class=" icon_image" style="font-size:24px;"></i>Media </th>  
                           <th><i class="icon_profile"></i> Sender </th>   
                         <th><i class="icon_calendar"></i> Date </th>  
                          <th><i class="icon_cog"></i> Action </th> 
                     
                     </tr>
                 </thead>
                 
                 
               
                 <tbody>
                  
                 </tbody>
                 </table>
                 </section>
    </div>
    <div class="col-lg-4"> 
    <section class="panel">
            <header class="panel-heading">
          <i class="icon_drawer"></i>
            Other Projects
          </header>
           <!-- <h3>Other Projects</h3> -->
   <ul>
<?php
$Product = new Product('products');
foreach($this->projectList as $List):


if($List->id != $this->data->id):

echo '<li><i class=" icon-task-l"></i> <a href="'.base_url.'project/show/'.$List->id.'">'.$Product->findById($List->productId)->product_name.'</a></li>';


endif;


endforeach;


?>
</ul>
</section>
    </div>
  </div>
           

              <?php $this->end() ?>


 <?php $this->start('scripts') ?>
           
 


      <?php $this->end() ?> 
      
       
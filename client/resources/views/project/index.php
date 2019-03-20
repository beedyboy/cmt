<?php $this->setSiteTitle(APP_NAME .'| Projects'); ?>
 <?php $this->start('body') ?>
<style>
    
</style>
      
<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class=" icon-task-l"></i>Projects</h3>
        <ol class="breadcrumb">
          <li><i class=" icon_house"></i>Home</li>
          <li><i class=" icon-task-l"></i>projects</li>
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
          <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#activeProject">Active Projects</a></li>
  <li><a data-toggle="tab" href="#pendingProject">Pending Projects</a></li>
  <li><a data-toggle="tab" href="#inNegotiationProject">In-Negotiation Projects</a></li>
  <li><a data-toggle="tab" href="#completedProject"> <i class="icon_check"></i> Completed Projects</a></li>
</ul>

<div class="tab-content">
  
<div id="activeProject" class="tab-pane fade in active">
    <h3>Active Projects</h3>
      <?php include_once('activeProject.php');?>
  </div>


  <div id="pendingProject" class="tab-pane fade">
    <h3>Pending Projects</h3>
    <?php include_once('pendingProject.php');?>
  </div>


  <div id="inNegotiationProject" class="tab-pane fade">
    <h3>In-Negotiation Projects</h3>
    <?php include_once('inNegotiationProject.php');?>
  </div>

  <div id="completedProject" class="tab-pane fade">
    <h3>Completed Projects</h3>
    <p>Some content in menu 2.</p>
  </div>
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
      
       
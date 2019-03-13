<?php $this->setSiteTitle(APP_NAME .'| Coming Soon'); ?>
 <?php $this->start('body') ?>
 <style>
body, html {
    height: 100%;
    margin: 0; 
    overflow:hidden;
}

 body{
    /* The image used */
    background-image: url("<?=base_url.'public/images/debrise.png'?>");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */ 
    background-repeat: no-repeat;
    background-size: cover;
}
.main
{   
    width:100%;
    height:100%;
    margin-bottom:-10px;
    margin:0;
}
.main img 
{
    
    width:100%;
    height:100%;
}
</style>
 <div class="main">
 <img src="<?=base_url.'public/images/debrise.png'?>">
 </div>
         
<!-- <img src="<?=base_url.'public/images/coming.jpg'?>" width="100%"  > -->
<!-- <p>This example creates a full page background image. Try to resize the browser window to see how it always will cover the full screen (when scrolled to top), and that it scales nicely on all screen sizes.</p> -->


              <?php $this->end() ?>
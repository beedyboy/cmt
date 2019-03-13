<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=$this->siteTitle(); ?></title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

  <!-- Bootstrap CSS -->
  <link href="<?=base_url.'public/css/bootstrap.min.css'?>" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?=base_url.'public/css/bootstrap-theme.css'?>" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="<?=base_url.'public/css/elegant-icons-style.css'?>" rel="stylesheet" />
  <link href="<?=base_url.'public/css/font-awesome.min.css'?>" rel="stylesheet" />

  <!-- Custom styles -->
  <link href="<?=base_url.'public/css/style.css" rel="stylesheet'?>">
  <link href="<?=base_url.'public/css/style-responsive.css'?>" rel="stylesheet" />
  <?=$this->content('head'); ?>
 
</head>
<body class=" "></body>
<!-- <body class="login-img3-body"> -->
<!-- <div class="login-box">
  <div class="login-logo">
     <a href=""><b>SMART</b> SHOPPER</a>  
  </div> -->

<input type="hidden" id="url" value="<?=base_url?>">

 <div class="container">

  <?=$this->content('body'); ?>

  </div>
  
  <!-- javascripts -->
  <script src="<?=base_url.'public/js/jquery.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery-ui-1.10.4.min.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery-1.8.3.min.js'; ?>"></script>
  <script type="text/javascript" src="<?=base_url.'public/js/jquery-ui-1.9.2.custom.min.js'; ?>"></script>
  <!-- bootstrap -->
  <script src="<?=base_url.'public/js/bootstrap.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/beedy.js'; ?>"></script> 
<?= $this->content('scripts'); ?> 
  
 
</body>
</html>
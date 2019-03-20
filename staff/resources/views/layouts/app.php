<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?=base_url.'public/images/logo.png'?>"> 
  <title><?=$this->siteTitle(); ?></title> 
 
  <!-- Bootstrap CSS -->
  <link href="<?=base_url.'public/css/bootstrap.min.css'?>" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?=base_url.'public/css/bootstrap-theme.css'?>" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="<?=base_url.'public/css/elegant-icons-style.css'?>" rel="stylesheet" />
  <link href="<?=base_url.'public/css/font-awesome.min.css'?>" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="<?=base_url.'public/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css'?>" rel="stylesheet" />
  <link href="<?=base_url.'public/assets/fullcalendar/fullcalendar/fullcalendar.css'?>" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="<?=base_url.'public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'?>" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="<?=base_url.'public/css/owl.carousel.css'?>" type="text/css">
  <link href="<?=base_url.'public/css/jquery-jvectormap-1.2.2.css'?>" rel="stylesheet">
  <!-- Custom styles -->

  <link rel="stylesheet" href="<?=base_url.'public/css/fullcalendar.css'?>">
  <link href="<?=base_url.'public/css/widgets.css'?>" rel="stylesheet">
  <link href="<?=base_url.'public/css/style.css'?>" rel="stylesheet">
  <link href="<?=base_url.'public/css/beedy_kaydee.css'?>" rel="stylesheet">
  <link href="<?=base_url.'public/css/style-responsive.css'?>" rel="stylesheet" />
  <link href="<?=base_url.'public/css/xcharts.min.css'?>" rel=" stylesheet">
  <link href="<?=base_url.'public/css/jquery-ui-1.10.4.min.css'?>" rel="stylesheet">

<?=$this->content('head'); ?>
 
</head>
<body>
<!-- <body class="hold-transition skin-purple sidebar-mini fixed"> -->

<input type="hidden" id="url" value="<?=base_url?>">
 <!-- container section start -->
 <section id="container" class="">

  <!--header start--> 
  <?php  include 'header.php'; ?>
    <!--header end-->

 <!--sidebar start-->
  <?php  include 'sidebar.php'; ?>
    <!--sidebar end-->

 <!--main content start-->
 <section id="main-content">
      <section class="wrapper">
        <!--page start-->
        <?=$this->content('body'); ?>
        <!-- page end-->
     </section> 
 <!--main content start-->
    <div class="text-right">
      <div class="credits">
           
          <!-- Framework by <a href="https://bootstrapmade.com/">Techanow</a> -->
      </div>
    </div>
 
  </section> 
 <!--main content end-->
  </section>
     <!-- container section end -->

  <!-- javascripts -->
  <script src="<?=base_url.'public/js/jquery.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery-ui-1.10.4.min.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery-1.8.3.min.js'; ?>"></script>
  <script type="text/javascript" src="<?=base_url.'public/js/jquery-ui-1.9.2.custom.min.js'; ?>"></script>
  <!-- bootstrap -->
  <script src="<?=base_url.'public/js/bootstrap.min.js'; ?>"></script>
  <!-- nice scroll -->
  <script src="<?=base_url.'public/js/jquery.scrollTo.min.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery.nicescroll.js'; ?>" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="<?=base_url.'public/assets/jquery-knob/js/jquery.knob.js'; ?>"></script>
  <script src="<?=base_url.'public/js/jquery.sparkline.js'; ?>" type="text/javascript"></script>
  <script src="<?=base_url.'public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js'; ?>"></script>
  <script src="<?=base_url.'public/js/owl.carousel.js'; ?>"></script>
  <!-- jQuery full calendar -->
  <<script src="<?=base_url.'public/js/fullcalendar.min.js'; ?>"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="<?=base_url.'public/assets/fullcalendar/fullcalendar/fullcalendar.js'; ?>"></script>
    <!--script for this page only-->
    <script src="<?=base_url.'public/js/calendar-custom.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery.rateit.min.js'; ?>"></script>
    <!-- custom select -->
    <script src="<?=base_url.'public/js/jquery.customSelect.min.js'; ?>"></script>
    <script src="<?=base_url.'public/assets/chart-master/Chart.js'; ?>"></script>

    <!--custome script for all page-->
    <script src="<?=base_url.'public/js/scripts.js'; ?>"></script>
    <!-- custom script for this page-->
    <script src="<?=base_url.'public/js/beedy.js'; ?>"></script>
    <script src="<?=base_url.'public/js/apps.js'; ?>"></script>
    <script src="<?=base_url.'public/js/sparkline-chart.js'; ?>"></script>
    <script src="<?=base_url.'public/js/easy-pie-chart.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery-jvectormap-1.2.2.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery-jvectormap-world-mill-en.js'; ?>"></script>
    <script src="<?=base_url.'public/js/xcharts.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery.autosize.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery.placeholder.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/gdp-data.js'; ?>"></script>
    <script src="<?=base_url.'public/js/morris.min.js'; ?>"></script>
    <script src="<?=base_url.'public/js/sparklines.js'; ?>"></script>
    <script src="<?=base_url.'public/js/charts.js'; ?>"></script>
    <script src="<?=base_url.'public/js/jquery.slimscroll.min.js'; ?>"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

 
<?= $this->content('scripts'); ?> 
  
  
</body>
</html>
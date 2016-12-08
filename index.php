<?php
session_start();
if(empty($_SESSION['login']) && empty($_SESSION['password']) ){
    header('Location: login.php');
}

error_reporting(E_ALL);
require('controller/redmine.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

  </header>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <a href="deconnexion.php" class="btn btn-danger">Deconnexion</a>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo getNbTicket("c232cdf169899c7c6074eecf42f7827ae37be34e"); ?></h3>

              <p>Ticket Opened</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo getNbTicketClosedToday("c232cdf169899c7c6074eecf42f7827ae37be34e"); ?></h3>

              <p>Ticket Closed Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo getNbTicketClosedMonth("c232cdf169899c7c6074eecf42f7827ae37be34e"); ?></h3>

              <p>Ticket Closed this Month</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
          <div class="box-widget widget-user-2 col-md-6 col-sm-12">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-green">
                  <!-- /.widget-user-image -->
                  <h3 class="ticket_title">Ticket Opened
                      <span style="font-weight: bold;float: right;font-size: 50px;margin-top: -15px;">
                          <?php echo getNbTicket("c232cdf169899c7c6074eecf42f7827ae37be34e"); ?>
                      </span>
                  </h3>
              </div>
              <div class="box-footer no-padding" style="height: 286px;">
                  <ul class="nav nav-stacked">
                      <li><a href="#" class="list-ticket">Manager <span class="pull-right badge bg-blue list-ticket-ico"><?php echo getNbTicketByGroup("c232cdf169899c7c6074eecf42f7827ae37be34e",3); ?></span></a></li>
                      <li><a href="#" class="list-ticket">Developer <span class="pull-right badge bg-red list-ticket-ico"><?php echo getNbTicketByGroup("c232cdf169899c7c6074eecf42f7827ae37be34e",4); ?></span></a></li>
                  </ul>
              </div>
          </div>

          <div class="box-widget widget-user-2 col-md-6 col-sm-12">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua">
                  <!-- /.widget-user-image -->
                  <h3 class="ticket_title">Number of Tickets By Status</h3>
              </div>
              <div class="box-footer no-padding" style="height: 286px;">
                  <ul class="nav nav-stacked">
                      <li><a href="#" class="list-ticket">New <span class="pull-right badge bg-orange list-ticket-ico"><?php echo getNbTicketByStatus("c232cdf169899c7c6074eecf42f7827ae37be34e",1); ?></span></a></li>
                      <li><a href="#" class="list-ticket">Assigned <span class="pull-right badge bg-blue list-ticket-ico"><?php echo getNbTicketByStatus("c232cdf169899c7c6074eecf42f7827ae37be34e",2); ?></span></a></li>
                      <li><a href="#" class="list-ticket">In Progress <span class="pull-right badge bg-blue list-ticket-ico"><?php echo getNbTicketByStatus("c232cdf169899c7c6074eecf42f7827ae37be34e",8); ?></span></a></li>
                      <li><a href="#" class="list-ticket">Resolved <span class="pull-right badge bg-green list-ticket-ico"><?php echo getNbTicketByStatus("c232cdf169899c7c6074eecf42f7827ae37be34e",3); ?></span></a></li>
                      <li><a href="#" class="list-ticket">Blocked <span class="pull-right badge bg-red list-ticket-ico"><?php echo getNbTicketByStatus("c232cdf169899c7c6074eecf42f7827ae37be34e",7); ?></span></a></li>
                  </ul>
              </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.7
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script src="dist/js/script_indexphp.js"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


</body>
</html>

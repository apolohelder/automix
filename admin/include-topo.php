<?
session_start();
require("class/classConn.php");
require("class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');
require "classes/Url.php";
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="pt-br"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Automix - Painel administrativo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo URL::getBase() ?>css/bootstrap4.1.3.css">
  <!--<link rel="stylesheet" href="<?php echo URL::getBase() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL::getBase() ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL::getBase() ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- hugo -->
	<link rel="stylesheet" href="<?php echo URL::getBase() ?>css/dataTables.bootstrap4.min.css">
	<!--<link rel="stylesheet" href="<?php echo URL::getBase() ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->
	<link rel="stylesheet" href="<?php echo URL::getBase() ?>bower_components/datatables.net/css/buttons.dataTables.min.css">
	 <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL::getBase() ?>dist/css/AdminLTE.min.css">
	
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo URL::getBase() ?>dist/css/skins/skin-black.min.css">
	<!--<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">-->	
	<link rel="stylesheet" href="<?php echo URL::getBase() ?>css/estilo.css">
	
	<link rel="stylesheet" href="<?php echo URL::getBase() ?>dist/css/jquery.dm-uploader.min.css" >
	<!-- REQUIRED JS SCRIPTS -->
<!--<script src="js/jquery-1.12.4.js"></script>-->
<script src="<?php echo URL::getBase() ?>js/jquery-3.4.1.min.js"></script>
<script src="<?php echo URL::getBase() ?>js/popper1.15.0.min.js"></script>
	<!--<script src="<?php echo URL::getBase() ?>js/jquery-2.2.4.min.js"></script>-->

<!-- jQuery 3 -->
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="<?php echo URL::getBase() ?>js/bootstrap4.1.3.min.js"></script>
<!--<script src="<?php echo URL::getBase() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!-- AdminLTE App -->
<script src="<?php echo URL::getBase() ?>dist/js/adminlte.min.js"></script>
<!-- hugo -->

<script src="<?php echo URL::getBase() ?>js/jquery.dataTables1.10.19.min.js"></script>
<!--<script src="<?php echo URL::getBase() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo URL::getBase() ?>js/dataTables.bootstrap4_1.10.19.min.js"></script>
<!--<script src="<?php echo URL::getBase() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
<script type="application/javascript" src="<?php echo URL::getBase() ?>js/moment-with-locales.min.js"></script>
<script type="application/javascript" src="<?php echo URL::getBase() ?>js/datetime-moment.js"></script>

<!--<script type="text/javascript" src="bower_components/moment/min/moment.min.js" charset="UTF-8"></script>-->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script type="text/javascript" src="<?php echo URL::getBase() ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo URL::getBase() ?>bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>
	
	
	
	<script src="<?php echo URL::getBase() ?>/js/jquery.mask.js"></script>
	 <script type="text/javascript" src="<?php echo URL::getBase() ?>js/jquery.inputmask.bundle.js"></script>
<!--	<script src="<?php echo URL::getBase() ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo URL::getBase() ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo URL::getBase() ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>-->



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    <link rel="stylesheet" href="<?php echo URL::getBase() ?>css/bootstrap-select.min.css">
  <script src="<?php echo URL::getBase() ?>js/bootstrap-select.min.js"></script>
	<script src="<?php echo URL::getBase() ?>js/defaults-pt_BR.min.js"></script>
	

	<link href="<?php echo URL::getBase() ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<script src="<?php echo URL::getBase() ?>js/jquery.maskMoney.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo URL::getBase() ?>plugins/iCheck/all.css">
	<script src="<?php echo URL::getBase() ?>plugins/iCheck/icheck.min.js"></script>
<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>-->
	<script src="<?=URL::getBase(); ?>bootbox/bootbox.min.js"></script>
	<script src="<?=URL::getBase(); ?>bootbox/bootbox.locales.min.js"></script>
	
	
	
<style type="text/css">
@media (max-width: 768px) {
  .btn-responsive {
    padding:2px 4px;
    font-size:80%;
    line-height: 1;
    border-radius:3px;
  }
}

@media (min-width: 769px) and (max-width: 992px) {
  .btn-responsive {
    padding:4px 9px;
    font-size:90%;
    line-height: 1.2;
  }
}


</style>	 

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-black sidebar-mini">
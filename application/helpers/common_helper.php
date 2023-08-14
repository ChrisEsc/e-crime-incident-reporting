<?php 

/*
|--------------------------------------------------------------------------
| e-Crime Incident Reporting System
|--------------------------------------------------------------------------
|
| Christian A. Esclamado
| Meikabi ICT Solutions
|
*/

date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>e-Crime Incident Reporting System</title>
	
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

     <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

	<!-- for extjs -->
	<script type="text/javascript" src="<?php echo base_url(); ?>extjs/extjs-build/ext-all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>extjs/extjs-build/resources/css/ext-all.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>extjs/extjs-build/resources/css/ext-all-neptune.css">

	<!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

	<style>
		 #map{
    		position: relative;
    		width: 100%;
    		height: calc(100% - 60px);
		}
	</style>
</head>
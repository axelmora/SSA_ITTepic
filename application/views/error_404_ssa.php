<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ERROR 404 Not Found</title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/tec.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<meta name="description" content="">
	<meta name="author" content="Fernando Manuel Avila Cataño">
	<meta name="theme-color" content="#FFFFFF">
	<meta name="msapplication-navbutton-color" content="#FFFFFF">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
	<link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url(); ?>css/paginaerror.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/hover.css" type="text/css" rel="stylesheet" />
</head>
<body >
	<div class="error">
		<div class="container-floud">
			<div class="col-xs-12 ground-color text-center">
				<div class="container-error-404">
					<div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
					<div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
					<div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
					<div class="msg">UPs!<span class="triangle"></span></div>
				</div>
				<h2 class="h1">Lo siento, 404 Not Found</h2>
				<center>
					<img  class="img-fluid" src="<?php echo base_url(); ?>images/escudo_itt_grande.png" height="150" width="150"> <br><br>
					<a href="<?php echo base_url(); ?>index.php" class="btn btn-naranja hvr-pulse-grow "><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> VOLVER AL INICIO</a>
				</center>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/error.js"></script>
</html>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA- PANEL SEGUIMIENTO EN EL AULA</title>
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
	<link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menu'); ?>
	<div class="container">
		<div class="row"  >
			<div class="col-lg-12">
				<div class="card sombrapanel">
					<div class="card-body">
						<center><h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Manual de usuario</h4></center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-12">
			<div id="manualdeusuariover2"></div>
			<br>
			<center>
				<a href="<?php echo base_url();?>file/manual/Manual_Usuario_SSA.pdf" class="btn btn-primary" download> <i class="fa fa-download" aria-hidden="true"></i>DESCARGAR MANUAL</a>
			</center>
		</div>
	</div>
	<?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
</html>

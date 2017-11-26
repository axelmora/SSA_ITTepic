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
	<?php
	if($this->session->userdata('tipo')=='2')
	{
		$this->load->view('include/menu');
	}else {
		if($this->session->userdata('tipo')=='3')
		{
			 $this->load->view('include/menuadministrativo');
		}else {
			$this->load->view('include/menuadmin');
		}
	}
	?>
	<div class="container">
		<div class="row"  >
			<div class="col-lg-12">
				<div class="card sombrapanel">
					<div class="card-body" style="padding-bottom: 0px;padding-top: 5px;padding-left: 0px;	padding-right: 0px;">
					<center><h4><a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver al menu principal" href="<?php echo base_url(); ?>index.php" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
						<i class="fa fa-graduation-cap" aria-hidden="true"></i> PROCEDIMIENTO PARA LA GESTIÓN DEL CURSO </h4></center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-12">
			<div class="menus" id="gestion_del_curso"></div>
			<br>
			<center>
				<a href="<?php echo base_url();?>file/manual/GESTION_DEL_CURSO.pdf" class="btn btn-primary animenu " download> <i class="fa fa-download" aria-hidden="true"></i> DESCARGAR DOCUMENTACION</a>
			</center>
			<br>
			<center>
				<a  target="_blank" href="http://sgc.ittepic.edu.mx/sgc/SGC/01%20ACADEMICO/ITTEPIC-AC-PO-004%20GESTION%20DEL%20CURSO/" class="btn btn-naranja animenu" > <i class="fa fa-external-link" aria-hidden="true"></i> Para más información visitar el SGC</a>
			</center>
		</div>
	</div>
	<?php $this->load->view('include/footer'); ?>
	<a href="javascript:" id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
</html>

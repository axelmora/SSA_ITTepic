<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA- PANEL ADMINISTRACIÓN SISTEMA</title>
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
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<!-- OPCION MENU 2 -->
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/lista_usuarios" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-users fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">USUARIOS</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<!-- OPCION MENU 2 -->
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/sistemainfo" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-server fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">INFORMACIÓN SISTEMA</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/mesadeayuda" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-question fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">MESA DE AYUDA</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/db" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-database fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">DATOS</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/manual_tecnico" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-laptop fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">MANUAL TECNICO</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/panel_administracion/manual_usuario" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-book fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">MANUAL DE USUARIOS</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-6">
			<a href="<?php echo base_url(); ?>index.php/C_usuarios/logout" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<i class="fa fa-sign-in fa-5x coloriconosmenu" aria-hidden="true"></i>
									<p class="textotitulo">SALIR</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php $this->load->view('include/manual_usuario'); ?>
	<?php $this->load->view('include/footer'); ?>
	<a href="javascript:" id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
</body>
<!--JS ADMIN -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$(".animenu").mouseenter(function(event) {
		$(this).addClass("animated pulse");
	});
	$(".animenu").on("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd", function(event) {
		$(this).removeClass("animated pulse");
	});
	$(function() {
		$('.caro').matchHeight();
	});
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
});
</script>
<!--JS ADMIN-->
</html>

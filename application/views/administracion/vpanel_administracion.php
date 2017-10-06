<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA</title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/tec.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<meta name="description" content="">
	<meta name="author" content="Fernando Manuel Avila Cataño">
	<meta name="theme-color" content="##FFFFFF">
	<meta name="msapplication-navbutton-color" content="##FFFFFF">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
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
										<p class="textotitulo">INFORMACION SISTEMA</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
			<!-- OPCION MENU 3 -->
			<div class="col-lg-6">
				<br>
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
		<br>
	</div>

	<!-- Modal Manual de usuario -->
	<div class="modal fade" id="modalmanualdeusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
	        <button type="button" class="btn btn-primary"> DESCARGAR MANUAL </button>
	      </div>
	    </div>
	  </div>
	</div>

	<?php $this->load->view('include/footer'); ?>
</body>
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
});
</script>
</html>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA- PANEL ADMINISTRATIVO</title>
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
	<?php $this->load->view('include/menuadministrativo'); ?>
	<div class="container">
	<div class="row"  >
		<div class="col-lg-12">
			<div class="card sombrapanel">
				<div class="card-body">
					<center><h4><i class="fa fa-university" aria-hidden="true"></i> <?php  echo "".$this->session->userdata('departamentonombre');?></h4></center>
				</div>
			</div>
		</div>
	</div>
		</div>
	<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
		<div class="col-lg-12">
			<a href="<?php echo base_url(); ?>index.php/Panel_Administrativo/reportes" class="linkmenu">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div>
									<center>
										<i class="icon-clipboard coloriconosmenu3" aria-hidden="true"></i>
										<p class="textotitulo2"> REPORTES POR DEPARTAMENTO ACADEMICO</p>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
		<!--SEGUNDA ROW -->
		<div class="row" style="margin-right: 0px; margin-left: 0px; margin-top:1%;">
			<div class="col-lg-4">
				<a href="<?php echo base_url(); ?>index.php/Panel_Administrativo/manual_usuario" class="linkmenu">
					<div class="card menus animenu caro">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div>
										<center>
											<i class="fa fa-book coloriconosmenu4" aria-hidden="true"></i>
											<p class="textotitulo2"> MANUAL DE USUARIO</p>
										</center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="<?php echo base_url(); ?>index.php/Panel_Administrativo/gestion_del_curso" class="linkmenu">
					<div class="card menus animenu caro">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div>
										<center>
											<i class="fa fa-file-text coloriconosmenu4" aria-hidden="true"></i>
											<p class="textotitulo2">PROCEDIMIENTO PARA LA GESTIÓN DEL CURSO</p>
										</center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="<?php echo base_url(); ?>index.php/C_usuarios/logout" class="linkmenu">
					<div class="card menus animenu caro">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div>
										<center>
											<i class="fa fa-sign-in coloriconosmenu4" aria-hidden="true"></i>
											<p class="textotitulo2">SALIR</p>
										</center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
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

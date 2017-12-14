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
	<meta name="theme-color" content="#FFFFFF">
	<meta name="msapplication-navbutton-color" content="#FFFFFF">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/bootstrap-toggle.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<div class="col-lg-6">
			<div class="card menus caro">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<h3><i class="fa fa-server" aria-hidden="true"></i> Configuracion Sistema</h3> 							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
							<p>
								<p><b>VERSION ACTUAL:</b> 1.0.0 <p>
									<form>
										<label><b>ESTADO ACTUAL DEL SITEMA </b> </label>
										<?php
										$valorproduccion="checked";
										foreach ($produccion as $key => $value) {
											if ($value->produccion==1) {
												$valorproduccion="checked";
											}else {
												$valorproduccion="";
											}
										}
										?>
										<input type="checkbox" id="botonproduccion" data-toggle="toggle" data-on="<i class='fa fa-check-circle' aria-hidden='true'></i> EN PRODUCCION" <?php echo "$valorproduccion";?> data-off="<i class='fa fa-wrench' aria-hidden='true'></i> EN MANTENIMIENTO">
										<br>
										<br>
									</form>
									<form action="<?php echo base_url(); ?>index.php/panel_administracion/agregarCorreoElectronico" method="post">
										<div class="row">
											<div class="col-md-3">
												<label><b>CORREO DEL SISTEMA: </b> </label>
											</div>
											<div class="col-md-5">
												<?php
												$valorproduccion="checked";
												foreach ($produccion as $key => $value) {
													?>
													<input name="correo"  id="correo"  class="form-control"   value="<?php echo "$value->correo_sistema"; ?>" type="email"  >
													<?php
												}
												?>
											</div>
											<div class="col-md-1">
											 <button type="submit" class="btn btn-naranja "><i class="fa fa-sign-in" aria-hidden="true"></i> GUARDAR CORREO</button>
											</div>
										</div>
									</form>
								</p>
								<p>Información php  <a href="<?php echo base_url();?>panel_administracion/info_servidor" class="btn btn-naranja "><i class="fa fa-server" aria-hidden="true"></i>  PHP</a>
</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card menus animenu caro">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<center>
									<h4>Framework CORE</h4>
									<p>
										<object data="<?php echo base_url(); ?>/images/codeigniter.svg"  height="150" width="150" type="image/svg+xml">
											<img src="<?php echo base_url(); ?>/images/codeigniter.png" height="150" width="150" />
										</object>
									</p>
									<p>
										Version: <b><?php echo CI_VERSION;?></b>
									</p>
									<p>
										<?php echo  $_SERVER['SERVER_SIGNATURE'];?>
									</p>
									<h4>Framework CSS</h4>
									<object data="<?php echo base_url(); ?>/images/bootstrap-solid.svg"  height="150" width="150" type="image/svg+xml">
										<img src="<?php echo base_url(); ?>/images/bootstrap-stack.png" height="150" width="150" />
									</object>
									<p id="bootstrapversion"></p>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('include/manual_usuario'); ?>
		<?php $this->load->view('include/footer'); ?>
	</body>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-toggle.min.js"></script>
	<script>
	$(document).ready(function(){
		$(function() {
			$('.caro').matchHeight();
		});
		$(function () {
			$.get("<?php echo base_url(); ?>/css/bootstrap.min.css", function (data) {
				var version = data.match(/v[.\d]+[.\d]/);
				$('#bootstrapversion').text("Version: "+version+"");
			});
		});
		$('#botonproduccion').change(function() {
			if($(this).is(":checked")) {
				$.ajax({
					url: "sistemainfoactualizarpro/1",
					success: function(data) {
					}
				});
			}else{
				$.ajax({
					url: "sistemainfoactualizarpro/0",
					success: function(data) {
					}
				});
			}
		});
	});
	$(document).ready(function(){
		var opciones = {
			fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
		};
		PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
	});
	</script>
	</html>

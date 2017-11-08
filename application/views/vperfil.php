<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA- PERFIL DE USUARIO</title>
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
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
			<div class="col-lg-12">
				<div class="card sombrapaneles">
					<div class="card-body">
						<h3><i class="fa fa-user" aria-hidden="true"></i> Perfil del usuario</h3>
						<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver al menu" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/" role="button">
							<i class="fa fa-undo" aria-hidden="true"></i>
						</a>
						<button id="botonEditar" type="button" class="btn btn-secondary" >
							<i class="fa fa-key" aria-hidden="true"></i> EDITAR INFORMACION
						</button>
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-key" aria-hidden="true"></i> MODIFICAR CONTRASEÑA
						</button>
						<br>
						<br>
						<form>
							<div class="form-group row">
								<label for="nombre_usuario" class="col-sm-3 col-form-label">Nombre del usuario:</label>
								<div class="col-sm-9">
									<input type="text"disabled class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese su nombre completo." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="departamento" class="col-sm-3 col-form-label">Departamento academico:</label>
								<div class="col-sm-9">
									<input type="text" readonly class="form-control-plaintext" id="departamento" value="email@example.com">
								</div>
							</div>
							<div id="botonSubmit" style="display:none;">
								<center>
									<button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
										<i class="fa fa-pencil" aria-hidden="true"></i>  ACTUALIZAR INFORMACION
									</button>
								</center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal contraseña -->
		<form action="" method="post" id="formularioContrasena">
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar contraseña.</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="nombre_usuario" class="col-sm-4 col-form-label">Contraseña actual:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" value="" name="contraactual" id="contraactual" placeholder="Ingrese la contraseña actual." required />
							</div>
						</div>
						<div class="form-group row">
							<label for="nombre_usuario" class="col-sm-4 col-form-label">Nueva contraseña:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" value="" name="contra_nueva1" id="contra_nueva1" placeholder="Ingrese la nueva contraseña" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="nombre_usuario" class="col-sm-4 col-form-label">Confirmar nueva contraseña:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" value="" name="contra_nueva2" id="contra_nueva12" placeholder="Ingrese la nueva contraseña" required />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
						<button type="submit" class="btn btn-success">ACTUALIZAR CONTRASEÑA</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
	<?php $this->load->view('include/manual_usuario'); ?>
	<?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
	var estado=true;
	$("#botonEditar").click(function(){
		if(estado)
		{
			$("#nombre_usuario").prop('disabled', false);
			$( "#botonSubmit" ).slideDown( "fast", function() {
				estado=false;
			});
		}else {
			$("#nombre_usuario").prop('disabled', true);
			$( "#botonSubmit" ).slideUp( "fast", function() {
				estado=true;
			});
		}
		//$("input").prop('disabled', true);
	});
	$( "#formularioContrasena" ).validate({
		rules: {
			contraactual: {
				required: true,
				minlength: 6,
			  maxlength: 15
			},
			contra_nueva1: {
				required: true,
				minlength: 6,
			  maxlength: 15
			},
			contra_nueva2: {
				required: true,
				minlength: 6,
				maxlength: 15,
				equalTo: "#contra_nueva1"
			}
		},
		messages :{
			contraactual: {
				required: "<div class='alert alert-danger' role='alert'> Se requiere la contraseña actual </div>",
				minlength: "<div class='alert alert-danger' role='alert'> Se requiere al menos 6 caracteres. </div>",
				maxlength: "<div class='alert alert-danger' role='alert'> Se requiere un maximo de 15 caracteres. </div>"
			},
			contra_nueva1: {
				required: "<div class='alert alert-danger' role='alert'> Se requiere la nueva contraseña. </div>",
				minlength: "<div class='alert alert-danger' role='alert'> Se requiere al menos 6 caracteres. </div>",
				maxlength: "<div class='alert alert-danger' role='alert'> Se requiere un maximo de 15 caracteres. </div>"
			},
			contra_nueva2: {
				required: "<div class='alert alert-danger' role='alert'> Se requiere la confirmacion de la nueva contraseña. </div>",
				minlength: "<div class='alert alert-danger' role='alert'> Se requiere al menos 6 caracteres. </div>",
				maxlength: "<div class='alert alert-danger' role='alert'> Se requiere un maximo de 15 caracteres. </div>",
				equalTo: "<div class='alert alert-danger' role='alert'> Las contraseñas no son iguales.</div>"
			}
		}
	});
});
</script>
</html>

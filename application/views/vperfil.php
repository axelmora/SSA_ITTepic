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
<body  >
	<?php $this->load->view('include/menu'); ?>
	<div class="container"  >
		<div class="row" style="margin-right: 0px; margin-left: 0px;"   >
			<div class="col-lg-12">
				<div class="card sombrapaneles    ">
					<div class="card-body cuerpo "   >
						<h3><i class="fa fa-user" aria-hidden="true"></i> Perfil del usuario</h3>
						<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver al menu" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/" role="button">
							<i class="fa fa-undo" aria-hidden="true"></i>
						</a>
						<button id="botonEditar" type="button" data-toggle="tooltip" data-placement="top" title="Modificar la informacion del usuario."  class="btn btn-secondary" >
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDITAR INFORMACION
						</button>
						<button type="button"  class="btn btn-secondary" data-toggle="modal" data-target="#modalContraseña">
							<i class="fa fa-key" aria-hidden="true"></i> MODIFICAR CONTRASEÑA
						</button>
						<a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Salir de la sesión." href="<?php echo base_url(); ?>index.php/C_usuarios/logout" role="button">
							<i class="fa fa-undo" aria-hidden="true"></i> CERRAR SESIÓN
						</a>
						<br>
						<br>
						<form id="formularioDatosUsuarioModificar"  method="post" action="<?php echo base_url(); ?>index.php/C_usuarios/actualizarInformacion">
							<div class="form-group row">
								<label for="nombre_usuario" class="col-sm-3 col-form-label"><b>Nombre del usuario:</b></label>
								<div class="col-sm-9">
									<input type="text"disabled  value="<?php echo $this->session->userdata('username'); ?>" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese su nombre completo." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="departamento" class="col-sm-3 col-form-label"><b>Departamento academico:</b></label>
								<div class="col-sm-9">
									<input type="text" readonly class="form-control-plaintext" name="departamento" id="departamento" value="<?php echo $this->session->userdata('departamentonombre'); ?>">
								</div>
							</div>
							<div id="botonSubmit" style="display:none;">
								<center>
									<button type="submit" class="btn btn-success" >
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
		<form  method="post" id="formularioContrasena" action="<?php echo base_url(); ?>index.php/C_usuarios/actualizarContrasena">
			<div class="modal fade" id="modalContraseña" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Editar contraseña.</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?php
								if(isset($errorSubmit))
								{
									echo "$errorSubmit";
								}
							 ?>
							<div class="form-group row">
								<label for="nombre_usuario" class="col-sm-4 col-form-label"><b>Contraseña actual:</b></label>
								<div class="col-sm-8">
									<input type="password" class="form-control" value="" name="contraactual" id="contraactual" placeholder="Ingrese la contraseña actual." required />
								</div>
							</div>
							<div class="form-group row">
								<label for="nombre_usuario" class="col-sm-4 col-form-label"><b>Nueva contraseña:</b></label>
								<div class="col-sm-8">
									<input type="password" class="form-control" value="" name="contra_nueva1" id="contra_nueva1" placeholder="Ingrese la nueva contraseña" required />
								</div>
							</div>
							<div class="form-group row">
								<label for="nombre_usuario" class="col-sm-4 col-form-label"><b>Confirmar nueva contraseña:</b></label>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
<script>
$(document).ready(function(){
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
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
});
</script>
<?php
	if(isset($errorSubmit))
	{
		 ?>
		 <script>
		 	$('#modalContraseña').modal('show');
			</script>
		 <?php
	}
 ?>
</html>

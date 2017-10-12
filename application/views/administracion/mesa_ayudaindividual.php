<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA SOPORTE </title>
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
	<link href="<?php echo base_url(); ?>css/dataTables.bootstrap4.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
			<div class="col-lg-12">
				<div class="card menus">
					<div class="card-body">
						<h3><i class="fa fa-question-circle" aria-hidden="true"></i> Mesa de ayuda- Soporte</h3>
						<div class="container">
							<?php
							$idmensaje="";
							if ($asuntos) {
								foreach ($asuntos as $filas => $valores) {
									$idmensaje=$valores->idmesa_ayuda;
									?>
									<div class="card  mb-3">
										<div class="card-body">
											<h5> Problema</h5>
											<p class="card-text"> <b>Usuario:</b> <?php echo $valores->nombre_usuario; ?></p>
											<p class="card-text"><i class="fa fa-exclamation-circle" aria-hidden="true"><b>Asunto:</b> </i> <?php echo $valores->asunto; ?></p>
											<p class="card-text"><b>Descripcion:</b> <p><i> <?php echo $valores->mensaje; ?></i></p></p>
											<p class="card-text"> <b>Ventana Error:</b> <a href="<?php echo $valores->url_mensaje; ?>"> <?php echo $valores->url_mensaje; ?></a></p>
										</div>
									</div>
									<?php
								}
							}else {
								?>
								<br>
								<div class="card">
									<div class="card-body">
										<center>
											<i  style="font-size:500%;  " class="colorError fa fa-exclamation-circle" aria-hidden="true"></i>
											<br>
											<b>Actualmente no existen registros de soporte.</b>
										</center>
									</div>
								</div>
								<?php
							}

							?>
							<div class="card">
								<div class="card-body">
									<h5><i class="fa fa-comments-o" aria-hidden="true"></i>Respuestas</h5>
									<?php
									if (($respuestas)) {
										foreach ($respuestas as $filas => $valores2) {  ?>
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-lg-11">
															<p><b>Administrador:</b> <?php echo $valores2->nombre_usuario; ?> </p>
														</div>
														<div class="col-lg-1">
															 <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
														</div>
													</div>
													<p><b>Respuesta:</b>  <?php echo $valores2->respuesta; ?> </p>
												</div>
											</div>
											<?php
										}
									}
									else {
										echo '<center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <br><p>No existen respuestas a este solicitud de soporte.</p></center>';
									}
									?>
								</div>
							</div>
							<br>
							<div class="card">
								<div class="card-body">
									<form method="post" action="<?php echo base_url(); ?>index.php/mesa_ayuda/respuesta/<?php echo $idmensaje; ?>">
										<div class="form-group">
											<label for="passwordid"><i class="fa fa-wrench" aria-hidden="true"></i> RESPUESTA:</label>
											<textarea class="form-control" maxlength="500" name="respuestamesaje" id="respuestamesaje"></textarea>
										</div>
										<center>
											<button type="submit" class="btn btn-success">RESPONDER</button>
										</center>
									</form>
								</div>
							</div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/responsive.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){

	$(document).ready(function() {
		$('#tablausuarios').DataTable({
			"language": {
				"url": "<?php echo base_url(); ?>js/datatables/usuarios.json"
			},
			"order": [[ 3, "desc" ]]
		});
	} );

	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
});
</script>
</html>

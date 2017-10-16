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
	<link href="<?php echo base_url(); ?>css/bootstrap-toggle.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
			<div class="col-lg-12">
				<div class="card menus">
					<div class="card-body">
						<h3><i class="fa fa-question-circle" aria-hidden="true"></i>Mesa de ayuda- Soporte</h3>
						<div class="container">
							<?php
							$idmensaje="";
							if ($asuntos) {
								$valorestado="checked";
								foreach ($asuntos as $filas => $valores) {
									$idmensaje=$valores->idmesa_ayuda;
									if ($valores->estado==1) {
										$valorestado="checked";
									}else {
										$valorestado="";
									}
									?>
									<div class="card  mb-3">
										<div class="card-body">
											<div class="row">
												<input id="idmensaje" name="idmensaje" value="<?php echo $valores->idmesa_ayuda; ?>" required type="hidden"/>
												<div class="col-lg-10">
													<p class="card-text"><b>Usuario:</b> <?php echo $valores->nombre_usuario; ?></p>
												</div>
												<div class="col-lg-2">
													<center>
														<input type="checkbox" id="swtmensaje" <?php echo "$valorestado";?> value="<?php echo $valores->estado; ?>"  data-toggle="toggle" data-on="<i class='fa fa-check-circle' aria-hidden='true'></i> RESUELTO" data-off="<i class='fa fa-exclamation-circle' aria-hidden='true'></i> SIN RESOLVER">
													</center>
												</div>
											</div>
											<p class="card-text"><b>Asunto:</b> </i> <?php echo $valores->asunto; ?></p>
											<p class="card-text"><b>Descripcion:</b></p>
											<div class="card">
												<div class="card-body">
													<i> <?php echo $valores->mensaje; ?></i>
												</div>
											</div>
											<p class="card-text"><b>Ventana Error:</b> <a href="<?php echo $valores->url_mensaje; ?>"> <?php echo $valores->url_mensaje; ?></a></p>
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
									if ($respuestas) {
										$posmodal=0;
										foreach ($respuestas as $filas => $valores2) {  ?>
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-lg-8">
															<p><b>Administrador:</b> <?php echo $valores2->nombre_usuario; ?> </p>
														</div>
														<div class="col-lg-3">
															<center>
																<p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $valores2->fecha_respuesta; ?> </p>
															</center>
														</div>
														<div class="col-lg-1">
															<?php
															if ($valores2->usuarios_idusuarios==$this->session->userdata('idusuarios')) {
																?>
																<center>
																	<button  style="color:white;" class="btn btn-danger" data-toggle="modal" data-target="#modalborrar<?php echo $posmodal;?>" >
																		<i class="fa fa-trash" aria-hidden="true"></i>
																	</button >
																</center>
																<?php
															}
															?>
														</div>
													</div>

													<p><b>Respuesta:</b>  <?php echo $valores2->respuesta; ?> </p>
												</div>
											</div>
											<?php
											$posmodal++;
										}
									}
									else {
										echo '<center><i class="fa fa-exclamation-triangle colorAdvertencia" aria-hidden="true"></i> <br><p>No existen respuestas a este solicitud de soporte.</p></center>';
									}
									?>
								</div>
							</div>
							<br>
							<div class="card" id="panelrespuesta">
								<div class="card-body">
									<form method="post" action="<?php echo base_url(); ?>index.php/mesa_ayuda/respuesta/<?php echo $idmensaje; ?>">
										<div class="form-group">
											<label for="passwordid"><i class="fa fa-wrench" aria-hidden="true"></i> RESPUESTA:</label>
											<textarea required class="form-control" maxlength="500" name="respuestamesaje" id="respuestamesaje"></textarea>
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
	<?php
	if ($respuestas) {
		$pos=0;
		foreach ($respuestas as $filas => $valores2) {  ?>
			<form method="post" action="<?php echo base_url(); ?>index.php/Mesa_ayuda/borrarRespuesta/<?php echo $valores2->idrespuestas_mesa?>">
				<!-- Modal borrar -->
				<div class="modal fade" id="modalborrar<?php echo $pos; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="">¿Estás seguro de eliminar esta respuesta?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p><b>Administrador:</b> <?php echo $valores2->nombre_usuario; ?> </p>
								<p><b>Respuesta:</b>  <?php echo $valores2->respuesta; ?> </p>
								<input type="hidden" required name="idmensajeprincipal_b" id="idmensajeprincipal_b" value="<?php echo $valores2->mesa_ayuda_idmesa_ayuda; ?>" />
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
								<input type="submit" class="btn btn-danger" value="SI" >
							</div>
						</div>
					</div>
				</div>
			</form>
			<?php
			$pos++;
		}
	}
	?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	/*--------------SOPORTE--------------*/
	/* Cambiar Estado  */
	$('#swtmensaje').change(function() {
		if($(this).is(":checked")) {
			var datos = {
				"idmensaje": $("#idmensaje").val(),
				"estado": 1
			};
			$.ajax({
				url: "../cambiarEstadoMensaje",
				data: datos,
				type: "post",
				success: function(data) {
						$("#panelrespuesta").slideUp();
				}
			});
		}else{
			var datos = {
				"idmensaje": $("#idmensaje").val(),
				"estado": 0
			};
			$.ajax({
				url: "../cambiarEstadoMensaje",
				data: datos,
				type: "post",
				success: function(data) {
						$("#panelrespuesta").slideDown();
				}
			});
		}
	});

	/*Estado mensaje */
	if ($("#swtmensaje").val()==1) {
		$("#panelrespuesta").hide();
	}
	/*--------------SOPORTE FIN--------------*/
	/*--------------MANUAL --------------*/
	/*Manual Ayuda*/
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
	/*--------------MANUAL FIN --------------*/
});
</script>
</html>

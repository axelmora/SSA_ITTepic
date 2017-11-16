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
	<link href="<?php echo base_url(); ?>css/dataTables.bootstrap4.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<div class="col-lg-12">
			<div class="card menus">
				<div class="card-body">
					<h3><i class="fa fa-question-circle" aria-hidden="true"></i> Mesa de ayuda</h3>	<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>

					<?php
					if ($asuntos) { ?>
						<table id="tablausuarios" class="table table-striped table-bordered table-sm dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>USUARIO</th>
									<th>ASUNTO</th>
									<th>FECHA</th>
									<th>ESTADO</th>
									<th>OPCIONES</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$posmodal=0;
								foreach ($asuntos as $filas => $valores) {
									?>
									<tr>
										<td colspan=""><?php echo $valores->nombre_usuario; ?> </td>
										<td colspan=""><?php echo $valores->asunto; ?> </td>
										<td colspan=""><?php echo $valores->fecha_mensaje; ?></td>
										<?php
										if ($valores->estado==0) {
											$estadovalor="<i class='fa fa-question' aria-hidden='true'></i> RESOLVIENDO";
										}else {
											$estadovalor="<i class='fa fa-check-square-o' aria-hidden='true'></i> RESUELTO";
										}
										?>
										<td colspan=""><?php echo $estadovalor; ?></td>
										<td colspan="">
											<div class="btn-group btn-block">
												<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/mesa_ayuda/soporte/<?php echo $valores->idmesa_ayuda; ?>"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> ATENDER </a>
													<button class="dropdown-item" data-toggle="modal"  data-target="#modalborrar<?php echo $posmodal;?>"><i class="fa fa-trash" aria-hidden="true"></i> ELIMINAR</button>
												</div>
											</div>
										</td>
									</tr>
									<?php
									$posmodal++;
								}
								$posmodal=0;
								?>
							</tbody>
						</table>
						<?php
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
				</div>
			</div>
		</div>
	</div>
	<?php
	/*Ventanas modales respuestas */
	if ($asuntos) {
		$pos=0;
		foreach ($asuntos as $filas => $valores2) {  ?>
			<form method="post" action="<?php echo base_url(); ?>index.php/Mesa_ayuda/borarMensajeSoporte/<?php echo $valores2->idmesa_ayuda?>">
				<!-- Modal borrar -->
				<div class="modal fade" id="modalborrar<?php echo $pos; ?>" tabindex="-1" role="dialog" aria-labelledby="modalborrar" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="">¿Estás seguro de eliminar esta petición de soporte? </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p><b>Usuario:</b> <?php echo $valores2->nombre_usuario; ?></p>
								<p><b>Asunto:</b>  <?php echo $valores2->asunto; ?></p>
								<p><b>Fecha:</b>  <?php echo $valores2->fecha_mensaje; ?></p>
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
		/*FIN Ventanas modales respuestas */
	}
	$pos=0;
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
<script>
$(document).ready(function(){
	$('#tablausuarios').DataTable({
		"language": {
			"url": "<?php echo base_url(); ?>js/datatables/usuarios.json"
		},
		"order": [[ 3, "desc" ]]
	});
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
});
</script>
</html>

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
	<link href="<?php echo base_url(); ?>css/dataTables.bootstrap4.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php $this->load->view('include/menuadmin'); ?>
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<div class="col-lg-12">
			<div class="card menus">
				<div class="card-body">
					<h3><i class="fa fa-question-circle" aria-hidden="true"></i> Mesa de ayuda</h3>
					<?php
					if ($asuntos) { ?>
						<table id="tablausuarios" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
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
								foreach ($asuntos as $filas => $valores) {
									?>
									<tr>
										<td colspan=""><?php echo $valores->nombre_usuario; ?> </td>
										<td colspan=""><?php echo $valores->asunto; ?> </td>
										<td colspan=""><?php echo $valores->fecha_mensaje; ?></td>
										<?php
										if ($valores->estado==1) {
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
													<a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDITAR</a>
													<a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> ELIMINAR</a>
												</div>
											</div>
										</td>
									</tr>
									<?php
								}
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

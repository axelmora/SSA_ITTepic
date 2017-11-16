<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA - Departamentos</title>
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
					<div class="row" >
						<div class="col-lg-4">
							<h3><i class="fa fa-users" aria-hidden="true"></i> Lista de departamentos académicos</h3>
							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/lista_usuarios" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>

						</div>
						<div class="col-lg-6">
							<a href="<?php echo base_url(); ?>index.php/panel_administracion/nuevo_departamento" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i> AGREGAR NUEVO DEPARTAMENTO</a>
						</div>
					</div>
					<table id="tablausuarios" class="table table-striped table-bordered dt-responsive table-sm " cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>NOMBRE DEPARTAMENTO ACADEMICO</th>
								<th>OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($DEPARTAMENTOS) {
								foreach ($DEPARTAMENTOS as $filas => $valores) {
									?>
									<tr>
										<td colspan=""><?php echo $valores->nombre_departamento; ?> </td>
										<td colspan="">
											<center>
												<div class="btn-group ">
													<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/panel_administracion/editar_departamento/<?php echo $valores->iddepartamento_academico; ?>"><i class="fa fa-pencil-square-o colorEditar" aria-hidden="true"></i> EDITAR</a>
														<a class="dropdown-item" href="#"><i class="fa fa-trash colorBorrar" aria-hidden="true"></i> ELIMINAR</a>
													</div>
												</div>
											</center>
										</td>
									</tr>
									<?php
								}
							}else {
							}
							?>
						</tbody>
					</table>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/responsive.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
	$('#tablausuarios').DataTable({
		"language": {
			"url": "<?php echo base_url(); ?>js/datatables/departamentos.json"
		},
		"order": [[ 0, "asc" ]]
	});
} );
$(document).ready(function(){
	var opciones = {
		fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
	};
	PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
});
</script>
</html>

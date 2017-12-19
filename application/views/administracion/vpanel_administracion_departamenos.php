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
						<div class="col-lg-6">
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
									if($valores->iddepartamento_academico !=1 ){
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
															<?php
															if($valores->iddepartamento_academico ==1 ){
															}else {
																?>
																<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/panel_administracion/editar_departamento/<?php echo $valores->iddepartamento_academico; ?>"><i class="fa fa-pencil-square-o colorEditar" aria-hidden="true"></i> EDITAR</a>
																<?php
															}
															?>
															<?php
															if($valores->iddepartamento_academico >=1 && $valores->iddepartamento_academico <=11){
																?>
																<button type="button" class="dropdown-item" name="button"><i class="fa fa-trash colorBorrar" aria-hidden="true"></i> NO ES POSIBLE ELIMINAR</button>
																<?php
															}else {
																?>
																<a onclick="eliminarDepartamento(<?php echo $valores->iddepartamento_academico;?>,'<?php echo$valores->nombre_departamento ?>');" href="#" class="dropdown-item" class="btn btn-primary" >
																	<i class="fa fa-trash colorBorrar" aria-hidden="true"></i> ELIMINAR
																</a>
																<?php
															}
															?>
														</div>
													</div>
												</center>
											</td>
										</tr>
										<?php
									}
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
	<form class="" action="<?php echo base_url(); ?>index.php/panel_administracion/eliminarDepartamento" method="post">
		<div class="modal fade" id="modalBorrarDepartamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id=""><div id="depatex"></div> ?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="number" id="iddepartamento_academico" name="iddepartamento_academico" value="" hidden required />
						<div class="card text-white bg-danger ">
							<div class="card-body">
								<h4 class="card-title"><i class="fa fa-exclamation-triangle animated tada infinite" aria-hidden="true"></i> Atención</h4>
								<p class="card-text"><b>Al borrar este departamento  se perderán la siguiente información.</b></p>
								<ul>
									<li>Resultados de todas la encuesta seguimiento en el aula.</li>
									<li>Todos los grupos de alumnos para esta aplicación.</li>
									<li>Todos los reportes de avance.</li>
								</ul>
								<p class="card-text"><center><b>Una vez eliminada <i class="fa fa-eraser" aria-hidden="true"></i> la informacion del departamento  es imposible recuperar <i class="fa fa-undo" aria-hidden="true"></i> las encuestas.</b></center></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> NO</button>
						<button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> SI </button>
					</div>
				</div>
			</div>
		</div>
	</form>
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
function eliminarDepartamento(id,nombre) {
	$('#iddepartamento_academico').val(''+id);
	$('#depatex').html('¿Desea eliminar el departamento de '+nombre);
	$('#modalBorrarDepartamento').modal('show');
}
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

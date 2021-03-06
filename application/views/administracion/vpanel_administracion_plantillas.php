<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA - Lista de plantillas de seguimiento en el aula</title>
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
						<div class="col-lg-3">
							<h3><i class="fa fa-users" aria-hidden="true"></i> Lista de plantillas de seguimiento en el aula</h3>
							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
						</div>
						<div class="col-lg-6">
							<a href="<?php echo base_url(); ?>index.php/panel_administracion/nueva_plantilla" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>  AGREGAR NUEVA PLANTILLA</a>
						</div>
					</div>
					<table id="tabla_plantillas" class="table table-striped table-bordered  table-sm dt-responsive " cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>NOMBRE PLANTILLA</th>
								<th>CREADO</th>
								<th>MODIFICADO</th>
								<th>VISUALIZAR</th>
								<th>OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($PLANTILLAS) {
								foreach ($PLANTILLAS as $filas => $valores) {
									?>
									<tr>
										<td colspan=""><?php echo $valores->nombre; ?> </td>
										<td colspan=""><?php echo $valores->fecha_creacion; ?> </td>
										<td colspan=""><?php echo $valores->fecha_modificacion; ?> </td>
										<td colspan="">	<a href="<?php echo base_url(); ?>index.php/panel_administracion/visualizar_encuesta/<?php echo $valores->idplantilla_encuestas; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i>  VISUALIZAR ENCUESTA</a>							 </td>
										<td colspan="">
											<div class="btn-group btn-block">
												<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/panel_administracion/editor_encuesta/<?php  echo $valores->idplantilla_encuestas;?>"><i class="fa fa-pencil-square-o colorEditar" aria-hidden="true"></i> EDITAR</a>
													<?php
													if($valores->idplantilla_encuestas==1)
													{
														?>
														<?php
													}else {
														?>
														<button  onclick="eliminarusuario(<?php  echo $valores->idplantilla_encuestas;?>);" type="button" class="dropdown-item" data-toggle="modal" data-target="#modalEliminar">
															<i class="fa fa-trash colorBorrar" aria-hidden="true"></i> ELIMINAR
														</button>
														<?php
													}
													?>
												</div>
											</div>
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
	<!-- modal eliminar -->
	<form class="" action="<?php echo base_url(); ?>index.php/Panel_administracion/eliminar_plantilla/" method="post">
		<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							<center><i class="fa fa-trash text-danger" aria-hidden="true"></i>¿Desea  eliminar esta plantilla?   </center> </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="number" id="idplantilla" name="idplantilla" value="" required hidden>
							<input type="text" id="ruta" name="ruta" value="" required hidden>
							<table class="table table-bordered table-sm">
								<caption>Datos de la estructura a eliminar.</caption>
								<thead>
									<tr>
										<th scope="col">NOMBRE PLANTILLA</th>
										<th scope="col">FECHA DE CREACION</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><div id="A1"></div></td>
										<td><div id="A2"></div></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> CANCELAR</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-trash " aria-hidden="true"></i> ELIMINAR </button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- modal eliminar  fin -->
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
	function eliminarusuario(id)
	{
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url(); ?>index.php/panel_administracion/datosPlantilla/'+id,
			data: { get_param: 'value' },
			dataType: 'json',
			success: function (data) {
				$.each(data, function(index, elemento) {
					$("#A1").html(elemento.nombre);
					$("#A2").html(elemento.fecha_creacion);
					$("#idplantilla").val(elemento.idplantilla_encuestas);
					$("#ruta").val(elemento.estructura);
				});
			}
		});
	}
	$('#tabla_plantillas').DataTable({
		responsive: true,
		"language": {
			"url": "<?php echo base_url(); ?>js/datatables/plantillas.json"
		},
		"order": [[2, "desc" ]]
	});
	$(document).ready(function(){
		var opciones = {
			fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
		};
		PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
	});
</script>
</html>

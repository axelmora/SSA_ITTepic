<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA - Usuarios</title>
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
							<h3><i class="fa fa-users" aria-hidden="true"></i> Lista de usuarios</h3>
							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
						</div>
						<div class="col-lg-6">
							<a href="<?php echo base_url(); ?>index.php/panel_administracion/adduser" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i> AGREGAR USUARIO</a>
							<a href="<?php echo base_url(); ?>index.php/panel_administracion/departamentos" class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i> GESTIONAR DEPARTAMENTOS</a>
						</div>
					</div>
					<table id="tablausuarios" class="table table-striped table-bordered  table-sm dt-responsive " cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>USUARIO</th>
								<th>NOMBRE DE USUARIO</th>
								<th>DEPARTAMENTO</th>
								<th>ULTIMA CONEXION</th>
								<th>ESTADO</th>
								<th>OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($usuarios) {
								foreach ($usuarios as $filas => $valores) {
									?>
									<tr>
										<td colspan=""><?php echo $valores->usuario; ?> </td>
										<td colspan=""><?php echo $valores->nombre_usuario; ?> </td>
										<?php if($valores->nombre_departamento =="Administrador"){ ?>
											<td colspan=""><b><i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $valores->nombre_departamento; ?><b></td>
												<?php
											}
											else { ?>
												<td colspan=""><i class="fa fa-user" aria-hidden="true"></i> <?php echo $valores->nombre_departamento; ?></td>
												<?php
											} ?>


											<td colspan=""><?php if($valores->ult_conexion!=""){echo $valores->ult_conexion;}else{echo "-";} ?></td>
											<?php if($valores->estado =="1"){ ?>
												<td>
													<label class="switch">
														<input type="checkbox"  onclick="cambiarEstado(<?php  echo $valores->idusuarios;?>,0)" checked>
														<span class="slider round"></span>
													</label>
												</td>
												<?php
											}
											else { ?>
												<td>
													<label class="switch">
														<input type="checkbox" onclick="cambiarEstado(<?php  echo $valores->idusuarios;?>,1)">
														<span class="slider round"></span>
													</label>
												</td>
												<?php
											} ?>
											<td colspan="">
												<div class="btn-group btn-block">
													<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/panel_administracion/editarUsuario/<?php  echo $valores->idusuarios;?>"><i class="fa fa-pencil-square-o colorEditar" aria-hidden="true"></i> EDITAR</a>
														<?php
														if($valores->idusuarios >=1 && $valores->idusuarios<=11)
														{
															?>
															<?php
														}else {
															?>
															<button  onclick="eliminarusuario(<?php  echo $valores->idusuarios;?>);" type="button" class="dropdown-item" data-toggle="modal" data-target="#modalEliminar">
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
		<!--
		<form method="post" action="<?php echo base_url(); ?>index.php/c_inicio/test">
		<input type="text" value="" name="1" id="1" />
		<input type="text" value="" name="2" id="2" />
		<input type="text" value="3" name="3" id="3" />
		<input type="submit" value="PROBAr"   />
	</form> -->
	<!-- modal eliminar -->
	<form class="" action="<?php echo base_url(); ?>index.php/Panel_administracion/deleteUsuario/" method="post">
		<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							<center><i class="fa fa-trash text-danger" aria-hidden="true"></i>¿Desea  eliminar a este usuario?    </center> </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="number" id="idusuarios" name="idusuarios" value="" required hidden>
							<table class="table table-bordered table-sm">
								<caption>Datos de la cuenta a eliminar.</caption>
								<thead>
									<tr>
										<th scope="col">NOMBRE COMPLETO</th>
										<th scope="col">NOMBRE DE USUARIO</th>
										<th scope="col">ULTIMA CONEXION</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><div id="A1"></div></td>
										<td><div id="A2"></div></td>
										<td><div id="A3"></div></td>
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
	function cambiarEstado(id,estado)
	{
		var parametros2 = {
			"idusuarios" :id,
			"estado" :estado
		};
		$(document).ready(function() {
			$.ajax({
				data:  parametros2,
				url:   '<?php echo base_url(); ?>index.php/C_usuarios/cambiarEstado',
				type:  'post',
				success:  function (response) {
				}
			});
		});
	}
	function eliminarusuario(id)
	{
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url(); ?>index.php/C_usuarios/datosUsuario/'+id,
			data: { get_param: 'value' },
			dataType: 'json',
			success: function (data) {
				$.each(data, function(index, elemento) {
					$("#A1").html(elemento.nombre_usuario);
					$("#A2").html(elemento.usuario);
					if (!elemento.ult_conexion) {
						$("#A3").html("SIN CONEXION");
					}else {
							$("#A3").html(elemento.ult_conexion);
					}
					$("#idusuarios").val(elemento.idusuarios);

				});
			}
		});
	}
	$(document).ready(function() {
		$('#tablausuarios').DataTable({
			"language": {
				"url": "<?php echo base_url(); ?>js/datatables/usuarios.json"
			},
			"order": [[ 3, "desc" ]]
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

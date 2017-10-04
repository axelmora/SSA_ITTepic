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
					<h3><i class="fa fa-users" aria-hidden="true"></i> Lista de usuarios</h3>
					<table id="tablausuarios" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Nombre usuario</th>
								<th>Departamento</th>
								<th>Ultima Conexion</th>
								<th>Acciones</th>
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
										<td colspan=""></td>
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
			"url": "<?php echo base_url(); ?>js/datatables/usuarios.json"
		},
		"order": [[ 3, "desc" ]]
	});
} );
</script>
</html>

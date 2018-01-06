<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA - Editar Departamentos</title>
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
						<div class="col-lg-10">
							<h3><i class="fa fa-users" aria-hidden="true"></i> Editar el departamento academico de <?php   echo $DEPARTAMENTOS[0]->nombre_departamento; ?></h3>
							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/departamentos" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
						</div>
						<div class="col-lg-2">
						</div>
					</div>
					<div class="container">
						<form id="formularioDepartamento" method="post" action="<?php echo base_url(); ?>index.php/panel_administracion/editar_departamento_formulario/<?php   echo $DEPARTAMENTOS[0]->iddepartamento_academico; ?>">
							<?php
							if ($DEPARTAMENTOS) {
								foreach ($DEPARTAMENTOS as $filas => $valores) {
									?>
									<div class="form-group">
										<label for="nombre_departamento">Nombre del departamento academico:</label>
										<input value="<?php echo $valores->nombre_departamento;?>" required type="text" class="form-control" id="nombre_departamento" name="nombre_departamento" aria-describedby="emailHelp" placeholder="Ingresar el nombre del departamento academico.">
									</div>
									<div class="row" >
										<div class="col-lg-3">
											<label for="carreras">Selecionar carrera/s:</label> <br>
											<small class="text-muted"><i class="fa fa-list" aria-hidden="true"></i> Se pueden selecionar varias carreras en la misma lista. <kbd><kbd>ctrl</kbd> + <kbd><i class="fa fa-mouse-pointer" aria-hidden="true"></i></kbd></kbd></small>
										</div>
										<div class="col-lg-9">
											<div id="dynamicInput"></div>
											<?php
											$idcarreras="";
											$poscosa=0;
											if($DEPARTAMENTOS_CARRERAS){
												foreach ($DEPARTAMENTOS_CARRERAS as $key => $value2) {
													if($poscosa<count($DEPARTAMENTOS_CARRERAS)-1){
														$idcarreras.=$value2->id_carrera.",";
													}else {
														$idcarreras.=$value2->id_carrera;
													}
													$poscosa++;
												}
											}
											?>
											<input hidden type="text" name="" id="tempcarreras" value="<?php echo $idcarreras ?>">
											<div class="form-group">
												<select multiple class="form-control" id="carrerasselecionar" required name="carreras[]">
													<?php
													if(isset($CARRERAS))
													{
														foreach ($CARRERAS as $key => $value) {
															?>
															<option value="<?php echo $value->id_carrera; ?>" ><?php echo $value->id_carrera."-".$value->carrera ; ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<center>
										<button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ACTUALIZAR DATOS DEL DEPARTAMENTO</button>
									</center>
									<?php

								}

							}

							?>
						</form>
					</div>
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
	if($("#tempcarreras").val()!=""){
		var data=$("#tempcarreras").val();
		var dataarray=data.split(",");
		$("#carrerasselecionar").val(dataarray);
		$("#carrerasselecionar").multiselect("refresh");
	}
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

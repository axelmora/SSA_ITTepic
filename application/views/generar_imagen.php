<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA- GENERAR CARTEL PROMOCIONAL</title>
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
	<link href="<?php echo base_url(); ?>css/hover.css" type="text/css" rel="stylesheet" />
</head>
<body  >
	<?php
	if($this->session->userdata('tipo')=='2')
	{
		$this->load->view('include/menu');
	}else {
		if($this->session->userdata('tipo')=='3')
		{
			$this->load->view('include/menuadministrativo');
		}else {
			$this->load->view('include/menuadmin');
		}
	}
	?>
	<div class="container"  >
		<div class="row" style="margin-right: 0px; margin-left: 0px;"   >
			<div class="col-lg-12">
				<div class="card sombrapaneles">
					<div class="card-body cuerpo"   >
						<h3>
							<a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/aplicaciones" role="button">
								<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
							</a>
							<i class="fa fa-picture-o" aria-hidden="true"></i> Cartel promocion</h3>
							<center>
								<img class="img-fluid" src="<?php echo base_url(); ?><?php echo $cartel;?>" width="1920" height="1080"/>
								<a  download="cartel_promocional" class="btn btn-naranja hvr-pulse-grow" data-toggle="tooltip" data-placement="top" title="Descargar cartel promocional" href="<?php echo base_url(); ?><?php echo $cartel;?>" role="button"><i class="fa fa-download" aria-hidden="true"></i> Descargar cartel promocional</a>
							</center>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
	<script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
	<script>
	$(document).ready(function(){
		var opciones = {
			fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
		};
		PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		var estado=true;
		$("#botonEditar").click(function(){
			if(estado)
			{
				$("#nombre_usuario").prop('disabled', false);
				$( "#botonSubmit" ).slideDown( "fast", function() {
					estado=false;
				});
			}else {
				$("#nombre_usuario").prop('disabled', true);
				$( "#botonSubmit" ).slideUp( "fast", function() {
					estado=true;
				});
			}
		});
	});
</script>
<?php
if(isset($errorSubmit))
{
	?>
	<script>
	$('#modalContraseña').modal('show');
	</script>
	<?php
}
?>
</html>

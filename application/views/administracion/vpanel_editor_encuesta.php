<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - ESTRUCTURA ENCUESTA</title>
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
              <h3><i class="fa fa-users" aria-hidden="true"></i> ESTRUCTURA ENCUESTA</h3>
              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/plantillas_seguimiento" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
              <a class="btn btn-primary" href="<?php echo base_url(); ?>panel_administracion/visualizar_encuesta_edicion/<?php echo $IDPLANTILLA ?>" role="button"><i class="fa fa-eye" aria-hidden="true"></i> VISUALIZAR ENCUESTA</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row" >
                <div class="col-lg-12">
                  <form id="formularioEditar" method="post" action="<?php echo base_url(); ?>index.php/panel_administracion/act_estructura_encuesta" >
                    <textarea style="width:100%;"  name="data1" id="data1" rows="12" cols="80"><?php echo "".$FORMATO_ENCUESTA; ?></textarea>
                    <textarea  hidden id="encuesta" name="encuesta" rows="8" cols="80"></textarea>
                  <center>  <button type="submit" class="btn btn-primary"> ACTULIZAR ESTRUCTURA</button></center>
                  </form>
                </div>
              </div>
            </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
<script>

$(document).ready(function(){
  var opciones = {
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
  $('#departamento_academico').change(function(){
    if($(this).find("option:selected").attr('value')==1)
    {
      $("#esAdmin").fadeIn();
    }else {
      $("#esAdmin").fadeOut();

    }
  });
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script>

var jsonStr = $("#data1").val();
var jsonObj = JSON.parse(jsonStr);
var jsonPretty = JSON.stringify(jsonObj, null, '\t');
//$("#encuesta").val(jsonPretty);

</script>
</html>

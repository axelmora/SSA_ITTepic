<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $TOTALAlumnosEncuestados=0;
  $EvaluacionesContestadas=0;
  $PorcentajeActual=0;
  if(isset($APLICADOS))
  {
    for ($i=0; $i < count($APLICADOS) ; $i++) {
      if( $APLICADOS[$i]){
        $EvaluacionesContestadas++;
      }
      $TOTALAlumnosEncuestados++;
    }
    $PorcentajeActual=($EvaluacionesContestadas*100)/$TOTALAlumnosEncuestados;
  }else {
    $TOTALAlumnosEncuestados=0;
    $EvaluacionesContestadas=0;
  }
  $DOCENTE="";
  $MATERIA="";
  if(isset($DATOSMATERIA)){
    foreach ($DATOSMATERIA as $key => $value) {
      $DOCENTE="".$value->nombres." ".$value->apellidos;
      $MATERIA="".$value->nombre_materia ;
    }
  }else {
    $DOCENTE="ERROR";
    $MATERIA="ERROR";
  }
  ?>
  <meta charset="utf-8">
  <title>SSA-GRUPO <?php echo "$MATERIA $DOCENTE"; ?></title>
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
  <?php $this->load->view('include/menu'); ?>
  <div class="">
    <div class="row" style="margin-right: 0px; margin-left: 0px;">
      <div class="col-lg-12">
        <div class="card caro">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-2">
                    <h3><i class="icon-clipboard" aria-hidden="true"></i>DATOS GRUPO
                    </h3>
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo $idEncuesta; ?>" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>

                    <button type="button" id="botonCopiar"  class="btn btn-success btncopiar"  data-toggle="tooltip" data-placement="top" title="ENLACE COPIADO" data-clipboard-text="<?php echo base_url(); ?>index.php/Seguimiento/"  role="button">
                      <div style="font-size:75%;"><i class="fa  fa-share-square-o" aria-hidden="true" ></i> OBTENER ENCUESTA</div></button>
                    </div>
                    <div class="col-lg-10">
                      <center>

                        </center>
                      </div>
                    </div>
                    <br>
                    <br>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
    <script type="text/javascript" src="<?php echo base_url(); ?>js/clipboard.js"></script>
    <script type="text/javascript">
    var botonCopiar = new Clipboard('.btncopiar');
    botonCopiar.on('success', function(e) {
      $('#botonCopiar').tooltip('show');
    });
    </script>
    <script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
    </html>

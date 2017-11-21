<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
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
  <title>SSA-GRUPO <?php /* echo "$MATERIA $DOCENTE"; */ ?></title>
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

  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="card caro">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-4">
                  <h3><i class="icon-clipboard" aria-hidden="true"></i>RESULTADOS ENCUESTA INDIVIDUAL
                  </h3>
                  <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo $idEncuesta; ?>" role="button">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                  </a>
                </div>
                <div class="col-lg-8">
                  <center>
                    <table  class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" >
                      <thead>
                        <tr>
                          <th><i class="fa fa-book" aria-hidden="true"></i> MATERIA</th>
                          <th><i class="fa fa-user" aria-hidden="true"></i> DOCENTE</th>
                          <th><i class="fa fa-bar-chart" aria-hidden="true"></i> PROGRESO EVALUACION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo "$MATERIA" ; ?></td>
                          <td><?php echo "$DOCENTE" ; ?></td>
                          <td>
                            <?php
                            if ($PorcentajeActual!=0) {
                              ?>
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $PorcentajeActual; ?>%;" aria-valuenow="<?php echo $PorcentajeActual; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $PorcentajeActual; ?>%</div>
                              </div>
                              <?php
                            }else {?>
                              <div class="card text-white bg-danger" >
                                <div class="card-body">

                                  <p class="card-text"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    Sin progreso en la evaluación.</p>
                                  </div>
                                </div>
                                <?php
                              }
                              ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </center>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <?php echo "".$EncuestasResultados; ?>
                    </div>
                  </div>
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

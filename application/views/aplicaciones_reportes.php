<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- REPORTES </title>
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
                  <div class="col-lg-10">
                    <?php
                    $peridotlista="";
                    foreach ($AplicacionesPeriodo as $key => $valorPeriodo) {
                      $peridotlista= ($valorPeriodo->periodo_texto);
                    }
                    ?>
                    <h3><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Reportes de la aplicación de <?php echo "$peridotlista"; ?>
                    </h3>
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/aplicaciones" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                  </div>
                  <div class="col-lg-2">
                    <center>
                    </center>
                  </div>
                </div>
                <br>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> <i class="fa fa-university" aria-hidden="true"></i> INDIVIDUALES</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> DOCENTES</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="profile" aria-selected="false"><i class="icon-clipboard" aria-hidden="true"></i> APLICACIÓN</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card menus">
                      <div class="card-body">
                        <h5>Reportes por materia</h5>
                        <?php
                        if ($Aplicaciones) {
                          ?>
                          <table id="tablaaplicacionesreportes" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th><i class="fa fa-book " aria-hidden="true"></i> </th>
                                <th><i class="fa fa-book " aria-hidden="true"></i> MATERIA</th>
                                <th><i class="fa fa-user-circle-o" aria-hidden="true"></i> DOCENTE</th>
                                <th><i class="fa fa-graduation-cap" aria-hidden="true"></i> ALUMNOS</th>
                                <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $pos=0;
                              foreach ($Aplicaciones as $key => $valor) {
                                ?>
                                <tr>
                                  <td><?php echo "".$valor->idmateria; ?></td>
                                  <td><?php echo "".$valor->nombre_materia; ?></td>
                                  <td><?php echo "".utf8_decode($valor->nombre_docente); ?></td>
                                  <td><?php echo "".$totalContestados[$pos]."/".$totalAlumnos[$pos]; ?></td>
                                  <td>
                                    <center>
                                      <a class="btn btn-primary" target="_blank" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/reporteIndividual/<?php echo $valor->idencuesta_seguimiento; ?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR REPORTE</a>
                                    </center>
                                  </td>
                                </tr>
                                <?php
                                $pos++;
                              }
                              ?>
                            </tbody>
                          </table>
                          <?php
                        }
                        else {
                          ?>
                          <div class="card bg-danger text-white animated fadeInUp">
                            <div class="card-body">
                              <center>
                                <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i> <br> <br>
                                Actualmente no existen grupos para esta aplicacion de seguimiento en el aula generada.
                              </center>
                            </div>
                          </div>
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card menus">
                      <div class="card-body">
                        <h5>Reportes por docentes</h5>
                        <?php
                        if ($DOCENTES) {
                          ?>
                          <table id="tablaDocentes" class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th><i class="fa fa-hashtag" aria-hidden="true"></i> NOMBRE DOCENTE</th>
                                <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              foreach ($DOCENTES as $key => $valor) {
                                ?>
                                <tr>
                                  <td><?php echo "".utf8_decode($valor->nombre_docente); ?></td>
                                  <td>
                                    <center>
                                      <center>
                                        <a class="btn btn-primary" target="_blank" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/reporteDocenteGenerador/<?php echo "".$valor->rfc; echo "/".$valor->aplicaciones_idaplicaciones; ?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR REPORTE</a>
                                      </center>
                                    </center>
                                  </td>
                                </tr>
                                <?php
                              }
                              ?>
                            </tbody>
                          </table>
                          <?php
                        }
                        else {
                          ?>
                          <div class="card bg-danger text-white animated fadeInUp">
                            <div class="card-body">
                              <center>
                                <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i> <br> <br>
                                Actualmente no se cuentan con docentes registrados en este departamento.
                              </center>
                            </div>
                          </div>
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="container">
                      <div class="card menus" style="margin-top:50px;margin-bottom:100px;">
                        <div class="card-body">
                          <h5>Resultados generales para esta aplicación del periodo comprendido de <?php echo "$peridotlista"; ?> </h5> <br>
                          <center>
                            <a  class="btn btn-primary btn-lg" target="_blank" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/reporteGeneradorAplicacion/<?php echo $AplicacionData; ?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR REPORTE</a>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  function genePerido($periodo)
  {
    $anioac = substr($periodo, 0,strlen($periodo)-1);
    $peridotTexto="";
    if($periodo==$anioac."1")
    {
      $peridotTexto="Enero-Junio ".$anioac;
    }
    else {
      if($periodo==$anioac."2")
      {
        $peridotTexto="Verano ".$anioac;
      }
      else {
        if($periodo==$anioac."3")
        {
          $peridotTexto="Agosto-Diciembre ".$anioac;
        }
      }
    }
    return $peridotTexto;
  }
  ?>

  <?php $this->load->view('include/MeliminarEncuesta'); ?>
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
<script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
<script type="text/javascript">
var botonCopiar = new Clipboard('.btncopiar');
botonCopiar.on('success', function(e) {
  $('#botonCopiar').tooltip('show');
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  $($.fn.dataTable.tables(true)).DataTable()
  .columns.adjust()
  .responsive.recalc();
})
</script>
</html>

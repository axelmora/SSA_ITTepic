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
  $TXTGRUPO="";
  $TXTIDMATERIA="" ;
  if(isset($DATOSMATERIA)){
    foreach ($DATOSMATERIA as $key => $value) {
      $DOCENTE="".mb_convert_encoding($value->nombre_docente, 'Windows-1252');
      $MATERIA="".mb_convert_encoding($value->nombre_materia, 'Windows-1252') ;
      $TXTGRUPO="".$value->grupos_idgrupos ;
      $TXTIDMATERIA="".$value->idmateria ;
    }
  }else {
    $DOCENTE="ERROR";
    $MATERIA="ERROR";
    $TXTGRUPO="ERROR";
    $TXTIDMATERIA="ERROR" ;
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
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo $idEncuesta; ?>" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                    <button type="button" id="botonCopiar"  class="btn btn-success btncopiar"  data-toggle="tooltip" data-placement="top" title="ENLACE COPIADO" data-clipboard-text="<?php echo base_url(); ?>index.php/Seguimiento/"  role="button">
                      <div style="font-size:75%;"><i class="fa  fa-share-square-o" aria-hidden="true" ></i> OBTENER ENCUESTA</div></button>
                    </div>

                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-10">
                          <center>
                            <table  class="table table-sm table-striped table-responsive table-bordered  " style="/*display:inline"*/   >
                              <thead>
                                <tr>
                                  <th><i class="fa fa-book" aria-hidden="true"></i> MATERIA </th>
                                  <th><i class="fa fa-book" aria-hidden="true"></i> NOMBRE MATERIA</th>
                                  <th><i class="fa fa-user" aria-hidden="true"></i> GRUPO</th>
                                  <th><i class="fa fa-user" aria-hidden="true"></i> DOCENTE</th>
                                  <th><i class="fa fa-bar-chart" aria-hidden="true"></i> PROGRESO EVALUACION</th>

                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><?php echo "$TXTGRUPO" ; ?></td>
                                  <td><?php echo "$MATERIA" ; ?></td>
                                  <td><?php echo "$TXTIDMATERIA" ; ?></td>
                                  <td><?php echo "$DOCENTE" ; ?></td>
                                  <td>
                                    <?php
                                    if ($PorcentajeActual!=0) {
                                      ?>
                                      <div class="progress" style=" height: 50px;">
                                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $PorcentajeActual; ?>%;" aria-valuenow="<?php echo $PorcentajeActual; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($PorcentajeActual,2); ?>%</div>
                                      </div>
                                      <?php
                                    }else {?>
                                      <div class="card text-white bg-danger" >
                                        <div class="card-body" style="    padding: 0px;">

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
                          <div class="col-lg-1">
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
                              </button>
                              <div class="dropdown-menu" style="">
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" target="_blank" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/reporteIndividual/<?php echo  $idseguimiento_encuesta."/".$IDGRUPO; ?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> REPORTE INDIVIDUAL</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/resultados/<?php echo $IDGRUPO; ?>"><i class="fa fa-area-chart" aria-hidden="true"></i> RESULTADOS</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/resultadosGraficos/<?php echo $IDGRUPO; ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> RESULTADOS GRAFICOS</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionseguimiento/<?php echo $idseguimiento_encuesta."/".$IDGRUPO; ?>"><i class="fa fa-commenting" aria-hidden="true"></i> RETROALIMENTACION</a>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                    <?php
                    if ($ALUMNOSGRUPO) {
                      ?>
                      <h6>ALUMNOS EN EVALUACION</h6>
                      <table id="tablaGrupoAlumnosGP" class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th><i class="fa fa-hashtag" aria-hidden="true"></i> NUMERO DE CONTROL</th>
                            <th><i class="fa fa-graduation-cap" aria-hidden="true"></i> NOMBRE</th>
                            <!-- <th><i class="fa fa-users" aria-hidden="true"></i> CARRERA</th> -->
                            <th><i class="fa fa-check-circle-o" aria-hidden="true"></i> CONTESTADO</th>
                            <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $pos=0;
                          foreach ($ALUMNOSGRUPO as $key => $valor) {
                            if($APLICADOS[$pos])
                            {
                              $contestado='<center><span class="badge badge-success medalla"> <i class="fa fa-check-circle" aria-hidden="true"></i> CONTESTADO</span></center>';

                            }else {
                              $contestado='<center><span class="badge badge-danger medalla"><i class="fa fa-times-circle " aria-hidden="true"></i> SIN CONTESTAR</span></center>';
                            }
                            ?>
                            <tr>
                              <td><?php echo "".$valor->no_de_control; ?></td>
                              <td><?php echo "".$valor->nombre_alumno ?></td>
                              <!--  <td><?php echo "".$valor->nombre_alumno; ?></td>-->
                              <td><?php echo "".$contestado; ?> </td>
                              <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>  OPCIONES
                                  </button>
                                  <div class="dropdown-menu">
                                    <button type="button" data-toggle="modal" onclick="reactivarEncuesta('<?php echo $valor->no_de_control ?>','<?php echo $IDGRUPO ?>')" data-target="#modalReActivarAlumno"  class="dropdown-item"><i class="fa fa-check-square-o text-warning" aria-hidden="true"></i> REACTIVAR ENCUESTA</button>
                                    <div class="dropdown-divider"></div>
                                  </div>
                                </div>
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
                            Actualmente no se cuentan con alumnos en este grupo.
                          </center>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
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

      <!-- Modal eliminar alumno-->
      <form action="<?php echo base_url(); ?>index.php/Panel_seguimiento/borrarAlumnosNumeroControl" method="post">
        <div class="modal fade" id="modalEliminarAlumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-ban" aria-hidden="true"></i> ¿Eliminar alumno de esta encuesta?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="text" hidden name="idGrupoEnviar" value="<?php echo $IDGRUPO; ?>">
                <input type="text" hidden name="numero_Control_eliminar" id="numero_Control_eliminar" value="">
                <table class="table table-bordered table-sm">
                  <caption>Datos del alumno a eliminar.</caption>
                  <thead>
                    <tr>
                      <th scope="col">NOMBRE ALUMNO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div id="nombreAlumnoEliminr"> </div></td>
                    </tr>
                  </tbody>
                </table>
                <div class="card text-white bg-danger">
                  <center>
                    <div class="card-body">
                      <h4 class="card-title"><i class="fa fa-exclamation-circle animated tada infinite" aria-hidden="true"></i> Alerta</h4>
                      <p class="card-text">Al momento de borrar al alumno no se podrá recuperar su respuesta, pero podrá volver a ser agregado a esta  encuesta.</p>
                    </div>
                  </center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> CANCELAR</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> ELIMINAR ALUMNO</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Modal reacticar-->
      <form action="<?php echo base_url(); ?>index.php/Panel_seguimiento/reactivaralumno" method="post">
        <div class="modal fade" id="modalReActivarAlumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reactivar encuesta para el alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="text" hidden name="idapliacion" value="<?php echo $idEncuesta; ?>">
                <input type="text" hidden name="idGrupoEnviar" value="<?php echo $IDGRUPO; ?>">
                <input type="text" hidden name="numero_Control_reactivar" id="tablaReactivarAlumnos" value="">
                <table class="table table-bordered table-sm">
                  <caption>Datos de la encuesta a reactivar.</caption>
                  <thead>
                    <tr>
                      <th scope="col">NOMBRE ALUMNO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div id="nombreAlumno"> </div></td>
                    </tr>
                  </tbody>
                </table>
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <h4 class="card-title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Alerta</h4>
                    <p class="card-text">Al momento de reactivar la encuesta se perderá toda la información sobre este alumno.</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> CANCELAR</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> REACTIVAR ALUMNO</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- Modal Agregar Aplicacion -->
      <form method="post" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/generarAplicacion" >
        <div class="modal fade" id="modalAplicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva aplicacion  <b><?php echo "$peridotTexto  $anioac"; ?></b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php
              if ($AplicacionesPerido) {
                ?>
                <div class="container">
                  <div class="card bg-danger text-white">
                    <div class="card-body">
                      <center>   <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite ' aria-hidden='true'></i></center> <br>
                      <center>  <?php  echo " Ya existen aplicaciones en el semestre actual"; ?> </center>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
              <div class="modal-body">
                <div class="form-group">
                  <label for="contrasenaapp">Contraseña aplicacion</label>
                  <input type="text" class="form-control" id="contrasenaapp" name="contrasenaapp" aria-describedby="contrasenaapp" placeholder="Ingresa una contraseña para la aplicacion " required>
                </div>
                <div class="form-group">
                  <label for="plantilla">Seleccionar plantilla</label>
                  <select  class="form-control" id="plantilla" name="plantilla" required >
                    <option selected value="1">ITTEPIC-AC-PO-004-07</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> CANCELAR</button>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR NUEVA APLICACION</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Modal Agregar Aplicacion -->
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

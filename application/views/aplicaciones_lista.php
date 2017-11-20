<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- PANEL SEGUIMIENTO EN EL AULA</title>
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
                      $peridotlista= genePerido($valorPeriodo->periodo);
                    }
                    ?>
                    <h3><i class="icon-clipboard" aria-hidden="true"></i>Grupos de aplicación  del periodo <?php echo "$peridotlista";  ?>
                    </h3>
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/aplicaciones" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
                    <button type="button" id="botonCopiar" class="btn btn-success btncopiar"  data-toggle="tooltip" data-placement="top" title="ENLACE COPIADO" data-clipboard-text="<?php echo base_url(); ?>index.php/Seguimiento/"  role="button">
                      <i class="fa  fa-share-square-o" aria-hidden="true" ></i>
                      OBTENER ENLACE ENCUESTA</button>

                    </div>
                    <div class="col-lg-2">
                      <center>
                        <a href="<?php echo base_url(); ?>index.php/Panel_seguimiento/nuevo_grupo/<?php echo $AplicacionData;?>"  class="btn btn-success" ><i class="fa fa-plus-circle" aria-hidden="true" ></i> AGREGAR GRUPO</a>
                      </center>
                    </div>
                  </div>
                  <br>
                  <br>
                  <?php
                  if ($Aplicaciones) {
                    ?>
                    <table id="tablaaplicaciones" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th><i class="fa fa-book " aria-hidden="true"></i> MATERIA</th>
                          <th><i class="fa fa-user-circle-o" aria-hidden="true"></i> DOCENTE</th>
                          <th><i class="fa fa-graduation-cap" aria-hidden="true"></i> ALUMNOS</th>
                          <th><i class="fa fa-calendar-check-o" aria-hidden="true"></i> FECHA CREACION</th>
                          <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $pos=0;
                        foreach ($Aplicaciones as $key => $valor) {
                          ?>
                          <tr>
                            <td><?php echo "".$valor->nombre_materia; ?></td>
                            <td><?php echo "".utf8_decode($valor->nombres)." ".utf8_decode($valor->apellidos); ?></td>
                            <td><?php echo "".$totalContestados[$pos]."/".$totalAlumnos[$pos]; ?></td>
                            <td><?php echo "".$valor->fecha_creacion; ?></td>
                            <td>
                              <center>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i> OPCIONES
                                  </button>
                                  <div class="dropdown-menu">
                                    <a href="<?php echo base_url(); ?>index.php/Panel_seguimiento/gestionarGrupo/<?php echo "".$valor->idgrupos; ?>"  class="dropdown-item" ><i class="fa fa-object-group" aria-hidden="true"></i> GESTIONAR</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionseguimiento/<?php echo "".$valor->idgrupos; ?>"><i class="fa fa-area-chart" aria-hidden="true"></i> RESULTADOS</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionseguimiento/<?php echo "".$valor->idgrupos; ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> RESULTADOS GRAFICOS</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionseguimiento/<?php echo "".$valor->idgrupos; ?>"><i class="fa fa-commenting" aria-hidden="true"></i> RETROALIMENTACION</a>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item " data-toggle="modal" data-target="#modalEliminar" onclick="eliminarEncuestaSeguimiento(<?php echo "".$valor->idgrupos; ?>)" ><i class="fa fa-trash text-danger" aria-hidden="true"></i> BORRAR ENCUESTA</button>
                                  </div>
                                </div>
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
    <!-- modal eliminar -->
    <form class="" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/eliminarEncuestaGrupo/" method="post">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash text-danger" aria-hidden="true"></i>¿Desea  eliminar esta encuesta de seguimiento en el aula? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="number" id="idEliminarEncu" name="idEliminarEncu" value="" required hidden>
                <input type="number" id="idAplicacionPostEliminar" name="idAplicacionPostEliminar" value="" required hidden>
              <table class="table table-bordered table-sm">
                 <caption>Datos de la encuesta a eliminar.</caption>
                <thead>
                  <tr>
                    <th scope="col">MATERIA</th>
                    <th scope="col">DOCENTE</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><div id="idEliminarMateriaNombre"></div></td>
                    <td><div id="idEliminarDocenteNombre"></div></td>
                  </tr>
                </tbody>
              </table>
              <div class="card text-white bg-danger ">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa fa-exclamation-triangle animated tada infinite" aria-hidden="true"></i> Atención</h4>
                  <p class="card-text">Al borrar esta encuesta de seguimiento se perderán todas las respuestas. </p>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> CANCELAR</button>
              <button type="submit" class="btn btn-danger"><i class="fa fa-trash " aria-hidden="true"></i> ELIMINAR </button>
            </div>
          </div>
        </div>
      </div>
    </form>
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

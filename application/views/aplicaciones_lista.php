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
                    <h3><i class="icon-clipboard" aria-hidden="true"></i>Grupos de aplicacion del periodo <?php echo "$peridotlista";  ?>
                      <button type="button" id="botonCopiar" class="btn btn-success btncopiar"  data-toggle="tooltip" data-placement="top" title="ENLACE COPIADO" data-clipboard-text="<?php echo base_url(); ?>index.php/Seguimiento/"  role="button">
                        <i class="fa  fa-share-square-o" aria-hidden="true" ></i>
                        OBTENER ENLACE ENCUESTA</button>
                      </h3>
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
                          <th><i class="fa fa-calendar" aria-hidden="true"></i> MATERIA</th>
                          <th><i class="fa fa-lock" aria-hidden="true"></i> DOCENTE</th>
                          <th>ALUMNOS</th>
                          <th><i class="fa fa-calendar-check-o" aria-hidden="true"></i> FECHA CREACION</th>
                          <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($Aplicaciones as $key => $valor) {
                          ?>
                          <tr>
                            <td><?php echo "".$valor->nombre_materia; ?></td>
                            <td><?php echo "".utf8_decode($valor->nombres)." ".utf8_decode($valor->apellidos); ?></td>
                            <td><?php echo "".$valor->nombre_materia; ?></td>
                            <td><?php echo "".$valor->fecha_creacion; ?></td>
                            <td>
                              <div class="btn-group btn-block">
                                <a href="<?php echo base_url(); ?>index.php/Panel_seguimiento/gestionarGrupo/<?php echo "".$valor->idgrupos; ?>"  class="btn btn-primary btn-block text-white"   >
                                  <i class="fa fa-bars" aria-hidden="true"></i> GESTIONAR
                                </a>
                              </div>
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
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> CANCELAR</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR NUEVA APLICACION</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- Modal Agregar Aplicacion -->
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

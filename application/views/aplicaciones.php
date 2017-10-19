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
                  <div class="col-lg-9">
                    <h3><i class="icon-clipboard" aria-hidden="true"></i>Aplicaciones</h3>
                  </div>
                  <div class="col-lg-3">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAplicacion"  role="button"><i class="fa fa-plus-circle" aria-hidden="true" ></i> GENERAR NUEVA APLICACION</button>
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
                        <th>PERIODO</th>
                        <th>CONTRASEÑA</th>
                        <th>NUMERO DE ENCUESTAS</th>
                        <th>FECHA CREACION</th>
                        <th>OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($Aplicaciones as $key => $valor) {
                        ?>
                        <td><?php echo "".genePerido($valor->periodo); ?></td>
                        <td><?php echo "".$valor->contrasena; ?></td>
                        <td></td>
                        <td><?php echo "".$valor->fecha_creacion; ?></td>
                        <td>
                          <div class="btn-group btn-block">
                            <button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-bars" aria-hidden="true"></i> GESTIONAR
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> AGREGAR GRUPOS</a>
                              <!--  <a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> ELIMINAR</a> -->
                            </div>
                          </div>
                        </td>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <?php
                }
                else {
                  echo "error";
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
    $anioac=date("Y");
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
  $peridot=$this->session->userdata('periodosemestre');
  $anioac=date("Y");
  $peridotTexto="";
  if($peridot==$anioac."1")
  {
    $peridotTexto="Enero-Junio";
  }
  else {
    if($peridot==$anioac."2")
    {
      $peridotTexto="Verano";
    }
    else {
      if($peridot==$anioac."3")
      {
        $peridotTexto="Agosto-Diciembre";
      }
    }
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
              <div class="card">
                <div class="card-body">
                <center>   <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite ' aria-hidden='true'></i></center> <br>
                <center>  <?php  echo " Ya existen aplicaciones en este semetre "; ?> </center>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-primary">CREAR NUEVA APLICACION</button>
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
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
</html>

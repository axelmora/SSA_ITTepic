<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- AGREGAR GRUPO</title>
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
                <h3><i class="icon-clipboard" aria-hidden="true"></i>Crear nuevo grupo de aplicacion <?php// echo "$peridotlista";  ?> </h3>
              </div>
            </div>
            <br>
            <form method="post"  action="">
              <div class="row">
                <div class="col-lg-2">
                  <label class="formulariolabel"><i class="fa fa-book" aria-hidden="true"></i> Materia:</label>
                </div>
                <div class="col-lg-4">
                  <input value="" name="idmateria" id="idmateria" placeholder="Seleccionar materia" class="form-control"  hidden required/>
                  <input value="" name="nombre_materiaenviar" id="nombre_materiaenviar" placeholder="Seleccionar materia" class="form-control"  readonly required/>
                </div>
                <div class="col-lg-3">
                  <button type="button"  data-toggle="modal" data-target="#modalAgregarMateria" class="btn btn-primary btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> AGREGAR MATERIA</button>
                </div>
                <div class="col-lg-3">
                  <?php
                  if(isset($MateriasExistentes))
                  {
                    ?>
                    <div class="animated bounceInRight">
                      <button type="button" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECCIONAR  MATERIAS EXISTENTES</button>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-2">
                  <label class="formulariolabel"><i class="fa fa-user-circle" aria-hidden="true"></i> Docente:</label>
                </div>
                <div class="col-lg-4">
                  <input value="" placeholder="Seleccionar docente" class="form-control"  readonly required/>
                </div>
                <div class="col-lg-3">
                  <button type="button"  data-toggle="modal" data-target="#modalDocentes" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECCIONAR DOCENTE</button>
                </div>
                <div class="col-lg-3">
                  <!--  <button type="button" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECCIONAR  MATERIA EXISTENTE</button> -->
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <label class="formulariolabel"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alumnos:</label>
                </div>
                <div class="col-lg-8">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-success btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR GRUPO</button>
                </div>
              </div>
            </form>
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

  <!-- MODAL DOCENTES  -->
  <div class="modal fade" id="modalDocentes" tabindex="-1" role="dialog" aria-labelledby="modalDocentes" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Seleccionar docente.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
          <button type="button" class="btn btn-success">SELECCIONAR</button>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL DOCENTES FIN  -->
  <!-- MODAL AGREGAR MATERIA  -->
  <form method="post" id="formularioAgregarMateria">
    <div class="modal fade" id="modalAgregarMateria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarMateria" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAgregarMateria">Agregar nueva materia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-3">
                <label class="formulariolabel">Nombre de la materia:</label>
              </div>
              <div class="col-lg-9">
                <input value="" name="nombre_materia" id="nombre_materia" placeholder="Nombre de la materia" class="form-control"  required/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
            <button  type="submit" class="btn btn-success">AGREGAR MATERIA</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- MODAL AGREGAR MATERIA  -->
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
</html>

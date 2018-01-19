<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA-MATERIAS</title>
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
  <link href="<?php echo base_url(); ?>css/dataTables.checkboxes.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/awesome-bootstrap-checkbox2.css" type="text/css" rel="stylesheet" />
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
                    <h4><i class="icon-clipboard" aria-hidden="true"></i>Seleccionar materias a excluir para el departamento de <?php echo "".$this->session->userdata('departamentonombre'); ?> </h4>
                  </div>
                  <div class="col-lg-2">
                    <center>
                    </center>
                  </div>
                </div>
                <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/materias_excluidas" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
                <br>
                <br>
                <form id="formulariomaterias_exlusivas" class="" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/asignar_materias" method="post">
                  <?php
                  if ($MATERIAS) {
                    ?>
                    <input type="text" hidden  value="" id="numero_control_alumnos" name="numero_control_alumnos" />
                    <center> <button type="submit" class="btn btn-danger" name="button"> <i class="fa fa-plus-circle" aria-hidden="true"></i> AGREGAR MATERIAS ELEGIDAS </button> </center>
                    <?php
                  }
                  if ($MATERIAS) {
                    ?>
                    <table id="materias_sii" class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th><i class="fa fa-hashtag" aria-hidden="true"></i>  ELEGIR </th>
                          <th><i class="fa fa-hashtag" aria-hidden="true"></i>  CODGIO </th>
                          <th><i class="fa fa-bars" aria-hidden="true"></i>  NOMBRE MATERIA</th>
                          <th><i class="fa fa-bars" aria-hidden="true"></i>  CARRERA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($MATERIAS as $key => $valor) {
                          ?>
                          <tr>
                            <td><?php echo "".$valor->idmaterias; ?></td>
                            <td><?php echo "".$valor->idmaterias; ?></td>
                            <td><?php echo "".mb_convert_encoding($valor->nombre_materia, 'Windows-1252'); ?></td>
                            <td><?php echo "".mb_convert_encoding($valor->carrera, 'Windows-1252') ?></td>
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
                          Actualmente no se cuentan con materias registradas en este departamento.
                        </center>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?><a href="javascript:" id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
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
<script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
</html>

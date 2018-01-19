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
                    <h4><i class="icon-clipboard" aria-hidden="true"></i>Materias excluidas del departamento de <?php echo "".$this->session->userdata('departamentonombre'); ?> </h4>
                  </div>
                  <div class="col-lg-2">
                    <center>
                    </center>
                  </div>
                </div>
                <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/materias" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
                <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Elegir materias para ignorar." href="<?php echo base_url(); ?>index.php/Panel_seguimiento/materias_elegir" role="button"><i class="fa fa-ban" aria-hidden="true"></i> ELEGIR MATERIAS A EXCLUIR.</a>
                <br>
                <br>
                <?php
                if ($MATERIAS) {
                  ?>
                  <table id="tablaMaterias" class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th><i class="fa fa-hashtag" aria-hidden="true"></i>  CODGIO </th>
                        <th><i class="fa fa-bars" aria-hidden="true"></i>  NOMBRE MATERIA</th>
                        <th><i class="fa fa-bars" aria-hidden="true"></i>  CARRERA</th>
                        <th><i class="fa fa-bars" aria-hidden="true"></i>  OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($MATERIAS as $key => $valor) {
                        ?>
                        <tr>
                          <td><?php echo "".$valor->idmaterias; ?></td>
                          <td><?php echo "".mb_convert_encoding($valor->nombre_materia, 'Windows-1252'); ?></td>
                          <td><?php echo "".mb_convert_encoding($valor->carrera, 'Windows-1252') ?></td>
                           <td><center><a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="REMOVER MATERIA" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/materias_remover/<?php echo $valor->idmaterias; ?>" role="button"><i class="fa fa-trash" aria-hidden="true"></i> DEJAR DE EXCLUIR </a></center></td>
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
                        <h3>Sin materias excluidas.</h3>
                        <!-- <p>Actualmente no se cuentan con materias registradas en este departamento.</p>
                        <p> <h3>Por lo tanto la creación de encuestas de seguimiento en el aula serán automáticas.</h3> </p>
                        <p>Si elige materias para el departamento solo se crearan encuestas de seguimiento en el aula de las materias elegidas.</p> -->
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
</html>

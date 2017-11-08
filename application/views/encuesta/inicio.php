<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - ALUMNO</title>
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
</head>
<body>
  <?php $this->load->view('include/banner'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-4 col-xl-3"> </div>
    <div class="col-lg-4 col-xl-6">
      <h3 class="titulosistema"><center>Sistema para el Seguimiento en el Aula</center></h3>
      <?php
      if (isset($mensajesistema)) { ?>
        <br>

        <div class="row">
          <div class="col-lg-12 col-xl-12">
            <?php
            echo "<br><br> $mensajesistema";
            ?>
          </div>
        </div>
        <?php
      }
      else {
        ?>
        <div class="card login-card">
          <div class="card-header">
            <center><b>Autentificación para acceso al sistema </b><br>
              <small>Introduce los datos correspondientes:</small>
            </center>
          </div>
          <div class="card-body">
            <form id="formularioAlumnoSeguimiento" method="post" action="<?php echo base_url(); ?>index.php/Seguimiento/verificarAlumnoEncuesta" >
              <?php
              if(isset($ErrorInicio)){
                echo "$ErrorInicio";
              }
              ?>
              <div class="form-group">
                <label for="userid"><i class="fa fa-user" aria-hidden="true"></i> NUMERO DE CONTROL:</label>
                <input type="text" class="form-control" name="numero_control" id="numero_control"   placeholder="Ingresar usuario" required>
              </div>
              <div class="form-group">
                <label for="passwordid"><i class="fa fa-unlock" aria-hidden="true"></i> CONTRASEÑA PARA LA APLICACION</label>
                <input type="password" class="form-control" name="contra_aplicacion" id="contra_aplicacion" placeholder="Contraseña proporcionada por su departamento academico." required>
              </div>
              <center><button type="submit" class="btn btn-naranja "><i class="fa fa-sign-in" aria-hidden="true"></i> ACCESO</button></center>
              <div class="red-text"><center><?php echo validation_errors(); ?></center></div>
            </div>
          </form>
          <?php
        }
        ?>
      </div>
      <div class="col-lg-4 col-xl-3"> </div>
    </div>
  </div>
  <canvas id="canvas" width="1147" height="487"></canvas>
  <?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/canvasfondo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
</html>

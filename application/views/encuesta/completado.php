<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - COMPLETADO</title>
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
</head>
<body>
  <?php $this->load->view('include/banner'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-4 col-xl-3"> </div>
    <div class="col-lg-4 col-xl-6">
      <div class="card panelCompletado animated bounceInDown menus">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-xl-6">
              <center>
                <img class="img-fluid"  src="http://www.ittepic.edu.mx/images/escudo_itt_200x200.png" alt="Instituto Tecnológico de Tepic" />
              </center>
            </div>
            <div class="col-lg-4 col-xl-6">
              <center>
                <i class="fa fa-check-circle colorCompletado animated tada infinite " aria-hidden="true"></i> <br>
                <h2>Seguimiento en el  aula </h2>  <br> <h3><i>Completado</i></h3>  <br> <h6>Gracias por participar.</h6>
              </center>
            </div>
          </div>
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
  </html>

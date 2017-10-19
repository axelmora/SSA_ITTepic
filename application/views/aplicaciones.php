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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"  role="button"><i class="fa fa-plus-circle" aria-hidden="true" ></i> GENERAR NUEVA APLICACION</button>
                  </div>
                </div>
                <br>
                <br>
                <table id="tablaaplicaciones" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>NOMBRE</th>
                      <th>PERIODO</th>
                      <th>NUMERO ENCUESTAS</th>
                      <th>FECHA CREACION</th>
                      <th>OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php

$peridot=$this->session->userdata('periodosemestre');
$anioac=date("Y");
if($peridot==$mesac=date("m")."1")
{

}

 ?>
  <!-- Modal Agregar Aplicacion -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear nueva Aplicacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
          <button type="button" class="btn btn-primary">CREAR NUEVA APLICACION</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal Agregar Aplicacion -->
  <?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
</html>

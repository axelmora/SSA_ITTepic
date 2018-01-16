<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Seguimiento en el Aula</title>
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
  <link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/awesome-bootstrap-checkbox.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
  <!--
  Autor: Fernando Manuel Avila Cataño
  Correo:feranimaciones@gmail.com
  DEDICADO A MI NOVIA
  ANA CAROLINA MONDRAGON RANGEL :) POR TODO SU APOYO EN LA REALIZACION DE ESTE PROYECTO-->
</head>
<body style="padding-bottom: 4%;">
  <div class="container">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div class="card">
          <div class="card-body" style="padding: 0;">
            <div class="progreso animated pulse">
              <!-- ICONOS PROGRESO EN LA ENCUESTA -->
              <?php
              $limite= $this->session->userdata('progresolimite');
              $progreso=$this->session->userdata('progresoactual');
              for($i=0;$i<$limite; $i++){
                if($i<($progreso+1)){
                  ?>
                  <span class="is-active menus"></span>
                  <?php
                }else {
                  ?>
                  <span class="menus"></span>
                  <?php
                }
              }
              echo " ".($progreso+1)." de  $limite";
              $DOCENTE="";
              $MATERIA="";
              $IDM="";
              $IDGRUPO="";
              $idencuesta_seguimiento="";
              if($DATOSMATERIA){
                foreach ($DATOSMATERIA as $key => $value) {
                  $DOCENTE="".utf8_decode($value->nombre_docente);
                  $MATERIA="".$value->nombre_materia ;
                  $idencuesta_seguimiento="".$value->idencuesta_seguimiento;
                  $IDM="".$value->idmateria;
                  $IDGRUPO="".$value->grupos_idgrupos;
                }
              }else {
                $DOCENTE="ERROR";
                $MATERIA="ERROR";
                $idencuesta_seguimiento="ERROR";
              }
              ?>
            </div>
          </div>
        </div>
        <div class="card menus">
          <div class="card-header">
            <div class="row">
              <div class="col-md-2">
                <center>
                  <!--  <img  class="img-fluid" src="<?php echo base_url(); ?>images/escudo_itt_grande.png" height="150" width="150"> -->
                </center>
              </div>
              <div class="col-md-8" >
                <?php echo ''.$encabezado[0]->encabezado; ?>
                <hr class="separador">
              </center>
            </div>
            <div class="col-md-2">
              <center>
                <img  class="img-fluid" src="<?php echo base_url(); ?>images/escudo_itt_grande.png" height="150" width="150">
              </center>
            </div>
          </div>
        </div>
        <form role="form"  method="post" id="formularioencuestaprincipal" action="<?php echo base_url(); ?>index.php/Seguimiento/enviarEncuesta/<?php echo "".$idencuesta_seguimiento; ?>" >
          <div class="card-body menus ">
            <?php echo "$EncuestaRetro"; ?>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
</div>
<a href="javascript:" id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-alumno.js"></script>
</body>
</html>

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
      <div class="col-md-1"> <br><br><br>
        <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver al menu" href="<?php echo base_url(); ?>panel_administracion/editor_encuesta" role="button">
          <i class="fa fa-undo" aria-hidden="true"></i>
        </a>
      </div>
      <div class="col-md-10">
        <div class="card">
          <div class="card-body" style="padding: 0;">
            <div class="progreso animated pulse">
              <!-- ICONOS PROGRESO EN LA ENCUESTA -->
              <?php
              $limite= 5;
              $progreso=0;
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
              $DOCENTE="NOMBRE DEL DOCENTE";
              $MATERIA="NOMBRE DE LA MATERIA" ;
              $idencuesta_seguimiento="0";
              $IDM="DAM007";
              $IDGRUPO="13A";
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
        <form role="form"  method="post" id="formularioencuestaprincipal" action="" >
          <div class="card-body menus ">
            <!-- DATOS DEL ALUMNO -->
            <div class="table-responsive">
              <table class="table table-striped table-hover menus table-sm">
                <tbody>
                  <tr>
                    <td class="textoNegritas" colspan="4" ><center> <i class="fa fa-info" aria-hidden="true"></i> DATOS GENERALES </center></td>
                  </tr>
                  <tr>
                    <td class="textoNegritas" >Alumno:</td>
                    <td><?php echo "ANA CAROLINA MONDRAGON RANGEL" ?></td>
                    <td class="textoNegritas" >Numero de Control:</td>
                    <td><?php echo "14401038" ?></td>
                  </tr>
                  <tr>
                    <td  class="textoNegritas"  colspan="1">Profesor:</td>
                    <td  colspan="1"><?php echo "".$DOCENTE; ?> </td>
                    <td  > <b>Grupo:</b> </td>
                    <td  ><?php echo "".$IDGRUPO; ?> </td>
                  </tr>
                  <tr>
                    <td class="textoNegritas" colspan="1" >Materia:</td>
                    <td  colspan="2"><?php echo "".$MATERIA; ?> </td>
                    <td  ><?php echo "".$IDM; ?> </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- DATOS DEL ALUMNO  FIN-->
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

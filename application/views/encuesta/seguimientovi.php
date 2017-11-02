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
  <meta name="theme-color" content="##FFFFFF">
  <meta name="msapplication-navbutton-color" content="##FFFFFF">
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
<body>
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
              ?>
            </div>
          </div>
        </div>
        <div class="card menus">
          <div class="card-header">
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-8" >
                <center><h4 class="textoNegritas">Instituto Tecnológico de Tepic</h4>
                  <p class="subtitulo">Seguimiento en aula</p>
                  <p class="subtitulo2">Código: ITTEPIC-AC-PO-004-07   Revisión: 1</p>
                  <p  class="subtitulo2">Referencia a la norma ISO9001:2008  7.1, 7.2.1, 7.5.1, 8.1, 8.2.4</p>
                  <hr class="separador">
                </center>
              </div>
              <div class="col-md-2">
                <center>
                  <img  class="img-fluid" src="<?php echo base_url(); ?>/images/escudo_itt_grande.png" height="150" width="150">
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
                      <td><?php echo "".$this->session->userdata('nombre_alumno'); ?></td>
                      <td class="textoNegritas" >Numero de Control:</td>
                      <td><?php echo "".$this->session->userdata('numero_control'); ?></td>
                    </tr>
                    <tr>
                      <td  class="textoNegritas"  colspan="1">Profesor:</td>
                      <td  colspan="3"> </td>
                    </tr>
                    <tr>
                      <td class="textoNegritas" colspan="1" >Materia:</td>
                      <td  colspan="3"> </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- DATOS DEL ALUMNO  FIN-->
              <!-- PREGUNTA 1 -->
              <p class="textopreguntas">1.- El profesor dio a conocer la Planeación del curso, indicando:</p>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                  <table class="table table-striped table-hover table-sm menus">
                    <tbody>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="textoNegritas" >Si</td>
                        <td class="textoNegritas">No</td>
                      </tr>
                      <!-- 1 -->
                      <tr>
                        <td>
                          <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                          El Programa de la Materia y el No. de Unidades a evaluar
                        </td>
                        <td>
                          <div class="form-check abc-radio">
                            <input class="form-check-input" type="radio" name="radio1" id="radio1" value="SI" checked>
                            <label class="form-check-label" for="radio1">
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-check abc-radio">
                              <input class="form-check-input" type="radio" name="radio1" id="radio2" value="NO">
                              <label class="form-check-label" for="radio2">

                              </label>
                            </div>
                        </td>
                      </tr>
                      <!-- 2 -->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- PREGUNTA 1 FIN -->

              <!-- PREGUNTA 2 -->
              <br>
              <div class="form-row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                  <p class="textopreguntas">2.- ¿Qué unidad estas cursando actualmente? </p>
                </div>
                <div class="col-md-4">
                  <select class="form-control"  name="unidadcursando" id="unidadcursando" title="Elige una unidad." required>
                    <option value="1">Unidad 1</option>
                    <option value="2">Unidad 2</option>
                    <option value="3">Unidad 3</option>
                    <option value="4">Unidad 4</option>
                    <option value="5">Unidad 5</option>
                    <option value="6">Unidad 6</option>
                    <option value="7">Unidad 7</option>
                    <option value="8">Unidad 8</option>
                    <option value="0">No recuerdo...</option>
                  </select>
                </div>
                <div class="col-md-2">
                </div>
              </div>
              <br>
              <!-- PREGUNTA 2 FIN -->
              <!-- PREGUNTA 3 -->
              <div class="form-row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                  <p class="textopreguntas">3.- ¿Cuál fue la última unidad evaluada? </p>
                </div>
                <div class="col-md-4">
                  <select class="form-control" name="unidadevaluada" id="unidadevaluada" title="Elige una unidad."  required>
                    <option value="1">Unidad 1</option>
                    <option value="2">Unidad 2</option>
                    <option value="3">Unidad 3</option>
                    <option value="4">Unidad 4</option>
                    <option value="5">Unidad 5</option>
                    <option value="6">Unidad 6</option>
                    <option value="7">Unidad 7</option>
                    <option value="8">Unidad 8</option>
                    <option value="0">No recuerdo...</option>
                  </select>
                </div>
                <div class="col-md-2">
                </div>
              </div>
              <!-- PREGUNTA 3 FIN -->
              <!-- SUBMIT-->
              <div class="botonEnviar">
                <br>
                <center>
                  <button type="submit" class="btn btn-success btn-lg btn-block " > ENVIAR </button>
                </center>
              </div>
              <!-- SUBMIT-->
            </div>
          </form>
        </div>
        <div class="card-footer text-muted">

        </div>
      </div>

    </div>
  </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
</body>
</html>

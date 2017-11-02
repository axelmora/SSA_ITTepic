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
  <link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
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
          <div class="card-body">
            <div class="progreso animated pulse">
              <!-- ICONOS PROGRESO EN LA ENCUESTA -->
              <span class="is-active"></span>
                <span class="is-active"></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
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
                      <td> </td>
                      <td class="textoNegritas" >Numero de Control:</td>
                      <td> </td>
                    </tr>
                    <tr>
                      <td  class="textoNegritas"  colspan="1">Profesor:</td>
                      <td  colspan="3"> </td>
                    </tr>
                    <tr>
                      <td class="textoNegritas" colspan="1" >Materia:</td>
                      <td  colspan="3"> </td>
                    </tr>
                    <tr>
                      <td class="textoNegritas"   colspan="1">Grupo:</td>
                      <td  colspan="3">  </td>
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
                  <table class="table table-striped table-hover menus">
                    <tbody>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="textoNegritas" >Si</td>
                        <td class="textoNegritas">No</td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                          El Programa de la Materia y el No. de Unidades a evaluar
                        </td>
                        <td>
                          <div class="form-group">
                            <div class="grupos">
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino1_1">
                                <input type="radio" id="sino1_1" class="mdl-radio__button" name="sino1" value="Si"  required  />
                              </label>
                            </div>
                          </td>
                          <td>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino1_2">
                              <input type="radio" id="sino1_2" class="mdl-radio__button" name="sino1" value="No" required  />
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                            las Competencias a alcanzar</td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino2_1">
                                <input type="radio" id="sino2_1" class="mdl-radio__button" name="sino2" value="Si" required  />
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino2_2">
                                <input type="radio" id="sino2_2" class="mdl-radio__button" name="sino2" value="No" required  />
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              los Criterios de Acreditación en % (exámenes, investigaciones, exposiciones, asistencia, proyectos, portafolio, etc.)
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino3_1">
                                <input type="radio" id="sino3_1" class="mdl-radio__button" name="sino3" value="Si" required  />
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino3_2">
                                <input type="radio" id="sino3_2" class="mdl-radio__button" name="sino3" value="No" required  />
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              Las oportunidades para acreditar las unidades
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino4_1">
                                <input type="radio" id="sino4_1" class="mdl-radio__button" name="sino4" value="Si" required  />
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino4_2">
                                <input type="radio" id="sino4_2" class="mdl-radio__button" name="sino4" value="No" required />
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              Fechas de evaluación
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino5_1">
                                <input type="radio" id="sino5_1" class="mdl-radio__button" name="sino5" value="Si" required  />
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino5_2">
                                <input type="radio" id="sino5_2" class="mdl-radio__button" name="sino5" value="No" required  />
                              </label>
                            </td>
                          </tr>
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




              </div>
            </form>
            <div class="card-footer text-muted">

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>
</html>

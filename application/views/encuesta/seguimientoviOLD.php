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
        <div class="card menus ">
          <div class="card-header">
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-8" >
                <center><h4 class="titulotec">Instituto Tecnológico de Tepic</h4>
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
          <div class="card-body menus ">
            <form role="form"  method="post" id="formularioencuestaprincipal" action="" >
              <!-- DATOS DEL ALUMNO -->
              <div class="table-responsive">
                <table class="table table-striped table-hover menus table-sm">
                  <tbody>
                    <tr>
                      <td class="Si_No" colspan="4" ><center> <i class="fa fa-info" aria-hidden="true"></i> DATOS GENERALES </center></td>
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
                                <input type="radio" id="sino1_1" class="mdl-radio__button" name="sino1" value="Si"  required>
                              </label>
                            </div>
                          </td>
                          <td>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino1_2">
                              <input type="radio" id="sino1_2" class="mdl-radio__button" name="sino1" value="No" required>
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                            las Competencias a alcanzar</td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino2_1">
                                <input type="radio" id="sino2_1" class="mdl-radio__button" name="sino2" value="Si" required>
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino2_2">
                                <input type="radio" id="sino2_2" class="mdl-radio__button" name="sino2" value="No" required>
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              los Criterios de Acreditación en % (exámenes, investigaciones, exposiciones, asistencia, proyectos, portafolio, etc.)
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino3_1">
                                <input type="radio" id="sino3_1" class="mdl-radio__button" name="sino3" value="Si" required>
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino3_2">
                                <input type="radio" id="sino3_2" class="mdl-radio__button" name="sino3" value="No" required>
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              Las oportunidades para acreditar las unidades
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino4_1">
                                <input type="radio" id="sino4_1" class="mdl-radio__button" name="sino4" value="Si" required>
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino4_2">
                                <input type="radio" id="sino4_2" class="mdl-radio__button" name="sino4" value="No" required>
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                              Fechas de evaluación
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino5_1">
                                <input type="radio" id="sino5_1" class="mdl-radio__button" name="sino5" value="Si" required>
                              </label>
                            </td>
                            <td>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sino5_2">
                                <input type="radio" id="sino5_2" class="mdl-radio__button" name="sino5" value="No" required>
                              </label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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
              </form>
            </div>
            <div class="card-footer text-muted">

            </div>
          </div>

          <!--  BORRAR :v -->
          <div class="panel panel-default Sombra">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- Cuestionario -->
                  <form role="form"  method="post" id="formularioencuestaprincipal" action="" >
                    <!-- DATOS  -->
                    <div>

                    </div>
                    <!--Fin DATOS 1 -->
                    <!-- Pregunta 1 -->
                    <div>

                      <!--Fin Pregunta 1 -->
                      <!--Pregunta 2 -->
                      <div>

                      </div>
                      <!--Fin Pregunta 2 -->
                      <!--Pregunta 3 -->
                      <div>
                        <br>

                      </div>
                      <!--Fin Pregunta 3 -->
                      <!--Pregunta 4 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">4.-¿Entregó los resultados de las evaluaciones? </p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta4_1">
                              <input type="radio" id="pregunta4_1" class="mdl-radio__button" name="pregunta4" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta4_2">
                              <input type="radio" id="pregunta4_2" class="mdl-radio__button" name="pregunta4" value="No" required>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  4 -->
                      <!--Pregunta 5 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-6">
                            <p class="textopreguntas">5.-¿Te entrega los resultados de la unidad evaluada, dentro de los primeros 5 días hábiles después de aplicada la evaluación? </p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta5_1">
                              <input type="radio" id="pregunta5_1" class="mdl-radio__button" name="pregunta5" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta5_2">
                              <input type="radio" id="pregunta5_2" class="mdl-radio__button" name="pregunta5" value="No" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No recuerdo</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta5_3">
                              <input type="radio" id="pregunta5_3" class="mdl-radio__button" name="pregunta5" value="No recuerdo" required >
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  5-->
                      <!--Pregunta 6 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">6.-Si no apruebas alguna unidad, ¿Te explica porqué?</p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta6_1">
                              <input type="radio" id="pregunta6_1" class="mdl-radio__button" name="pregunta6" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta6_2">
                              <input type="radio" id="pregunta6_2" class="mdl-radio__button" name="pregunta6" value="No"  required>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  6 -->
                      <!--Pregunta 7 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">7.-¿El profesor asiste regularmente?</p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta7_1">
                              <input type="radio" id="pregunta7_1" class="mdl-radio__button" name="pregunta7" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta7_2">
                              <input type="radio" id="pregunta7_2" class="mdl-radio__button" name="pregunta7" value="No" required>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  7 -->
                      <!--Pregunta 8 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">8.- ¿Utiliza medios electrónicos (Software, Siveduc, biblioteca digital, etc.) para impartir sus clases?</p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta8_1">
                              <input type="radio" id="pregunta8_1" class="mdl-radio__button" name="pregunta8" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta8_2">
                              <input type="radio" id="pregunta8_2" class="mdl-radio__button" name="pregunta8" value="No" required>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  8 -->
                      <!--Pregunta 9 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">9.-Utiliza medios audiovisuales (video proyector, pintarrón, pantalla de TV, etc.) para impartir sus clases?</p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta9_1">
                              <input type="radio" id="pregunta9_1" class="mdl-radio__button" name="pregunta9" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">No</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta9_2">
                              <input type="radio" id="pregunta9_2" class="mdl-radio__button" name="pregunta9" value="No" required>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  9 -->
                      <!-- Pregunta 10 -->
                      <div>
                        <p class="textopreguntas">10.- De la siguiente lista seleccione y cuantifique las prácticas que ha realizado</p>
                        <div class="row">
                          <div class="col-md-10 col-md-offset-1">

                            <table class="table table-striped table-hover Sombra">
                              <tbody>
                                <tr>
                                  <td>Lista:</td>
                                  <td class="Si_No" colspan="2">Cantidad #</td>
                                </tr>
                                <tr>
                                  <td>a) Visitas a empresas, de obra o de campo
                                  </td>
                                  <td colspan="2">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label  class="control-label col-sm-2">(No)</label>
                                      </div>
                                      <div class="col-md-10">
                                        <span class="input-group col-md-12 ">
                                          <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000"  value="0"  required name="pregunta10_1" />
                                        </span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>b) Laboratorio </td>
                                  <td colspan="2">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label  class="control-label col-sm-2">(No)</label>
                                      </div>
                                      <div class="col-md-10">
                                        <span class="input-group col-md-12">
                                          <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000"  value="0" required name="pregunta10_2" />
                                        </span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>c) Resolución de problemas o ejercicios en el aula
                                  </td>
                                  <td colspan="2">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label  class="control-label col-sm-2">(No)</label>
                                      </div>
                                      <div class="col-md-10">
                                        <span class="input-group  col-md-12">
                                          <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000"  value="0" required name="pregunta10_3"/>
                                        </span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>d) Formulación de proyectos
                                  </td>
                                  <td colspan="2">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label  class="control-label col-sm-2">(No)</label>
                                      </div>
                                      <div class="col-md-10">
                                        <span class="input-group col-md-12">
                                          <input type="number" class="form-control" placeholder="Cantidad" min="0" value="0"  required name="pregunta10_4"/>
                                        </span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>e) Elaboración de un producto
                                  </td>
                                  <td colspan="2">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label  class="control-label col-sm-2">(No)</label>
                                      </div>
                                      <div class="col-md-10">
                                        <span class="input-group col-md-12">
                                          <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000" value="0" required name="pregunta10_5"/>
                                        </span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>f)otro: Especifique
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" placeholder="Especifique..." value=" " name="pregunta10_6" />
                                  </td>
                                  <td>
                                    <label  class="control-label col-sm-3">(No)</label>
                                    <span class="input-group ">
                                      <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000"  value="0"  required name="pregunta10_7"/>
                                    </span>
                                  </td>
                                </tr>
                              </tbody>
                            </table>

                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta 10 -->
                      <!--Pregunta 11 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-8">
                            <p class="textopreguntas">11.-¿El docente se comporta de manera ética en el aula?</p>
                          </div>
                          <div class="col-md-2">
                            <label class="Si_No">Si</label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta11_1">
                              <input type="radio" id="pregunta11_1" class="mdl-radio__button" name="pregunta11" value="Si" required>
                            </label>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="Si_No">No</label>
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="pregunta11_2">
                                <input type="radio" id="pregunta11_2" class="mdl-radio__button" name="pregunta11" value="No" required>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--Fin Pregunta  11 -->
                      <!--Pregunta 12 -->
                      <div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <p class="textopreguntas">12.-Si lo deseas puedes expresar algún comentario relativo al tema</p>
                            <textarea class="form-control" name="pregunta12" rows="3" placeholder="Si lo deseas puedes expresar algún comentario relativo al tema" ></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--Fin Pregunta  12 -->
                    <div>
                      <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                          <br>
                          <input type="submit" name=""  class="btn btn-block btn-lg btn-success" value="ENVIAR">
                        </div>
                        <!-- <i class="glyphicon glyphicon-eject"></i>      -->
                      </div>
                    </div>
                  </form>
                  <!--Fin  Cuestionario -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

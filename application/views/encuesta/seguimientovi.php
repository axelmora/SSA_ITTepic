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
                      <td class="textoNegritas2">Si</td>
                      <td class="textoNegritas2">No</td>
                    </tr>
                    <!-- 1 -->
                    <tr>
                      <td>
                        <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                        El Programa de la Materia y el No. de Unidades a evaluar
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_1" id="r1_1" value="SI"  required>
                          <label class="form-check-label radioTabla" for="r1_1">
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_1" id="r1_2" value="NO" required>
                          <label class="form-check-label radioTabla" for="r1_2">
                          </label>
                        </div>
                      </td>

                    </tr>
                    <!-- 2 -->
                    <tr>
                      <td>
                        <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                        las Competencias a alcanzar
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_2" id="r2_1" value="SI" required />
                          <label class="form-check-label" for="r2_1">
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_2" id="r2_2" value="NO" required  />
                          <label class="form-check-label" for="r2_2">
                          </label>
                        </div>
                      </td>

                    </tr>
                    <!-- 3 -->
                    <tr>
                      <td>
                        <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>los Criterios de Acreditación en % <br><small class="text-muted">(exámenes, investigaciones, exposiciones, asistencia, proyectos, portafolio, etc.)</small>
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_3" id="r3_1" value="SI" required>
                          <label class="form-check-label" for="r3_1">
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_3" id="r3_2" value="NO" required>
                          <label class="form-check-label" for="r3_2">
                          </label>
                        </div>
                      </td>
                    </tr>
                    <!-- 4 -->
                    <tr>
                      <td>
                        <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                        Las oportunidades para acreditar las unidades
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_4" id="r4_1" value="SI" required>
                          <label class="form-check-label" for="r4_1">
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check abc-radio">
                          <input class="form-check-input" type="radio" name="pregunta1_4" id="r4_2" value="NO" required>
                          <label class="form-check-label" for="r4_2">
                          </label>
                        </div>
                      </td>
                    </tr>
                    <!-- 5 -->
                    <tr>
                      <td>
                        <i class="fa fa-circle CirculoPregunta" aria-hidden="true"></i>
                        Fechas de evaluación
                      </td>
                      <td>
                        <div class="form-check abc-radio  ">
                          <input class="form-check-input" type="radio" name="pregunta1_5" id="r5_1" value="SI" required>
                          <label class="form-check-label radiosTablas " for="r5_1">
                          </label>
                        </div>
                      </td>
                      <td>

                        <div class="form-check abc-radio  ">
                          <input class="form-check-input" type="radio" name="pregunta1_5" id="r5_2" value="NO" required>
                          <label class="form-check-label radiosTablas " for="r5_2">
                          </label>
                        </div>
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
              <div class="col-md-5">
                <p class="textopreguntas">2.- ¿Qué unidad estas cursando actualmente? </p>
              </div>
              <div class="col-md-4">
                <select class="form-control"  name="pregunta2" id="pregunta2" title="Elige una unidad." required>
                  <option value="1">Unidad 1</option>
                  <option value="2">Unidad 2</option>
                  <option value="3">Unidad 3</option>
                  <option value="4">Unidad 4</option>
                  <option value="5">Unidad 5</option>
                  <option value="6">Unidad 6</option>
                  <option value="7">Unidad 7</option>
                  <option value="8">Unidad 8</option>
                  <option value="0">No recuerdo</option>
                  <option value="0">Sin respuesta</option>
                </select>
              </div>
              <div class="col-md-3">
              </div>
            </div>
            <br>
            <!-- PREGUNTA 2 FIN -->
            <!-- PREGUNTA 3 -->
            <div class="form-row">
              <div class="col-md-5">
                <p class="textopreguntas">3.- ¿Cuál fue la última unidad evaluada? </p>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="pregunta3" id="pregunta3" title="Elige una unidad."  required>
                  <option value="1">Unidad 1</option>
                  <option value="2">Unidad 2</option>
                  <option value="3">Unidad 3</option>
                  <option value="4">Unidad 4</option>
                  <option value="5">Unidad 5</option>
                  <option value="6">Unidad 6</option>
                  <option value="7">Unidad 7</option>
                  <option value="8">Unidad 8</option>
                  <option value="0">No recuerdo</option>
                  <option value="0">Sin respuesta</option>
                </select>
              </div>
              <div class="col-md-3">
              </div>
            </div>
            <!-- PREGUNTA 3 FIN -->
            <!--PREGUNTA 4 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">4.-¿Entregó los resultados de las evaluaciones?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta4" id="pregunta4_1" value="SI" required>
                  <label class="form-check-label" for="pregunta4_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta4" id="pregunta4_2" value="NO" required>
                  <label class="form-check-label" for="pregunta4_2">No
                  </label>
                </div>
              </div>
            </div>
            <!-- PREGUNTA 4 FIN -->
            <!--PREGUNTA 5 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">5.-¿Te entrega los resultados de la unidad evaluada, dentro de los primeros 5 días hábiles después de aplicada la evaluación? </p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5_1" value="SI" required>
                  <label class="form-check-label" for="pregunta5_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5_2" value="NO" required>
                  <label class="form-check-label" for="pregunta5_2">No
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5_3" value="No recuerdo" required>
                  <label class="form-check-label" for="pregunta5_3">No recuerdo
                  </label>
                </div>
              </div>
            </div>
            <!-- PREGUNTA 5 FIN -->
            <!--PREGUNTA 6 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">6.-Si no apruebas alguna unidad, ¿Te explica porqué?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6_1" value="SI" required>
                  <label class="form-check-label" for="pregunta6_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6_2" value="NO" required>
                  <label class="form-check-label" for="pregunta6_2">No
                  </label>
                </div>
              </div>
            </div>
            <!-- PREGUNTA  6  FIN -->
            <!--PREGUNTA 7 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">7.-¿El profesor asiste regularmente?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7_1" value="SI" required>
                  <label class="form-check-label" for="pregunta7_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7_2" value="NO" required>
                  <label class="form-check-label" for="pregunta7_2">No
                  </label>
                </div>
              </div>
            </div>
            <!-- PREGUNTA  7 Fin -->
            <!--PREGUNTA 8 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">8.- ¿Utiliza medios electrónicos (Software, Siveduc, biblioteca digital, etc.) para impartir sus clases?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8_1" value="SI" required>
                  <label class="form-check-label" for="pregunta8_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8_2" value="NO" required>
                  <label class="form-check-label" for="pregunta8_2">No
                  </label>
                </div>
              </div>
            </div>
            <!--PREGUNTA  8  FIN-->
            <!--PREGUNTA 9 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">9.-Utiliza medios audiovisuales (video proyector, pintarrón, pantalla de TV, etc.) para impartir sus clases?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta9" id="pregunta9_1" value="SI" required>
                  <label class="form-check-label" for="pregunta9_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta9" id="pregunta9_2" value="NO" required>
                  <label class="form-check-label" for="pregunta9_2">No
                  </label>
                </div>
              </div>
            </div>
            <!-- PREGUNTA  9 FIN -->
            <!-- PREGUNTA 10 -->
            <p class="textopreguntas" style="margin-left:10px;">10.- De la siguiente lista seleccione y cuantifique las prácticas que ha realizado</p>
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10 ">
                <table class="table table-striped table-hover   table-sm menus">
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
                            <label class="col-form-label">(No)</label>
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
                            <label  class="col-form-label">(No)</label>
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
                            <label  class="col-form-label">(No)</label>
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
                            <label  class="col-form-label ">(No)</label>
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
                            <label  class="col-form-label ">(No)</label>
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
                        <div class="row">
                          <div class="col-md-2">
                            <label  class="col-form-label">(No) </label>
                          </div>
                          <div class="col-md-10">
                            <span class="input-group ">
                              <input type="number" class="form-control" placeholder="Cantidad" min="0" max="1000"  value="0"  required name="pregunta10_7"/>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

            <!--PREGUNTA 10 FIN-->
            <!--PREGUNTA 11 -->
            <br>
            <div class="row">
              <div class="col-md-6">
                <p class="textopreguntas">11.-¿El docente se comporta de manera ética en el aula?</p>
              </div>
              <div class="col-md-2">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta11" id="pregunta11_1" value="SI" required>
                  <label class="form-check-label" for="pregunta11_1">Si
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check abc-radio">
                  <input class="form-check-input" type="radio" name="pregunta11" id="pregunta11_2" value="NO" required>
                  <label class="form-check-label" for="pregunta11_2">No
                  </label>
                </div>
              </div>
            </div>
            <!--PREGUNTA  11 FIN -->
            <!--PREGUNTA 12 -->
            <br>
            <div class="row">
              <div class="col-md-12">
                <p class="textopreguntas"  style="margin-left:10px;">12.-Si lo deseas puedes expresar algún comentario relativo al tema</p>
                <textarea class="form-control" name="pregunta12" rows="3" placeholder="Si lo deseas puedes expresar algún comentario relativo al tema" ></textarea>
              </div>
            </div>
            <!--PREGUNTA 12 FIN-->
            <!-- SUBMIT-->
            <div class="botonEnviar">
              <br>
              <center>
                <button type="submit" class="btn btn-success btn-lg btn-block " ><i class="fa fa-floppy-o" aria-hidden="true"></i> CONTESTAR </button>
              </center>
            </div>
            <!-- SUBMIT-->
          </div>
        </form>
      </div>
      <!--  <div class="card-footer text-muted">
    </div> -->
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

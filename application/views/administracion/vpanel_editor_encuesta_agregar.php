<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<?php

$FORMATO_ENCUESTA='
{
  "preguntas" :
  [
    {
      "tipo": "tabla",
      "pregunta": "1.- El profesor dio a conocer la Planeación del curso, indicando:",
      "encabezado": {
        "1": {
          "titulo": " "
        },
        "2": {
          "titulo": "Si"
        },
        "3": {
          "titulo": "No"
        }
      },
      "subpreguntas": {
        "1": {
          "name": "pregunta1_1",
          "tipo": "radio",
          "pregunta": "El Programa de la Materia y el No. de Unidades a evaluar",
          "respuesta": [
            {
              "texto": "Si",
              "valor": "SI"
            },
            {
              "texto": "No",
              "valor": "NO"
            }
          ]
        },
        "2":  {
          "tipo": "radio",
          "name": "pregunta1_2",
          "pregunta": "las Competencias a alcanzar",
          "respuesta": [
            {
              "texto": "Si",
              "valor": "SI"
            },
            {
              "texto": "No",
              "valor": "NO"
            }
          ]
        },
        "3":  {
          "tipo": "radio",
          "name": "pregunta1_3",
          "pregunta": "los Criterios de Acreditación en % (exámenes, investigaciones, exposiciones, asistencia, proyectos, portafolio, etc.)",
          "respuesta": [
            {
              "texto": "Si",
              "valor": "SI"
            },
            {
              "texto": "No",
              "valor": "NO"
            }
          ]
        },
        "4":  {
          "tipo": "radio",
          "name": "pregunta1_4",
          "pregunta": "Las oportunidades para acreditar las unidades",
          "respuesta": [
            {
              "texto": "Si",
              "valor": "SI"
            },
            {
              "texto": "No",
              "valor": "NO"
            }
          ]
        },
        "5":{
          "tipo": "radio",
          "name": "pregunta1_5",
          "pregunta": "Fechas de evaluación",
          "respuesta": [
            {
              "texto": "Si",
              "valor": "SI"
            },
            {
              "texto": "No",
              "valor": "NO"
            }
          ]
        }
      }
    },
    {
      "name": "pregunta2",
      "pregunta": "2.- ¿Qué unidad estas cursando actualmente?",
      "titulo":"Elige una unidad",
      "tipo": "seleccion",
      "datos":[
        {
          "nombre":"Unidad 1",
          "valor":1
        },
        {
          "nombre":"Unidad 2",
          "valor":2
        },
        {
          "nombre":"Unidad 3",
          "valor":3
        },
        {
          "nombre":"Unidad 4",
          "valor":4
        },
        {
          "nombre":"Unidad 5",
          "valor":5
        },
        {
          "nombre":"Unidad 6",
          "valor":6
        },
        {
          "nombre":"Unidad 7",
          "valor":7
        },
        {
          "nombre":"Unidad 8",
          "valor":8
        },
        {
          "nombre":"Unidad 9",
          "valor":9
        },
        {
          "nombre":"No recuerdo",
          "valor":0
        },
        {
          "nombre":"No se específico",
          "valor":0
        }
      ]
    },
    {
      "name": "pregunta3",
      "pregunta": "3.- ¿Cuál fue la última unidad evaluada?",
      "titulo":"Elige una unidad",
      "tipo": "seleccion",
      "datos":[
        {
          "nombre":"Unidad 1",
          "valor":1
        },
        {
          "nombre":"Unidad 2",
          "valor":2
        },
        {
          "nombre":"Unidad 3",
          "valor":3
        },
        {
          "nombre":"Unidad 4",
          "valor":4
        },
        {
          "nombre":"Unidad 5",
          "valor":5
        },
        {
          "nombre":"Unidad 6",
          "valor":6
        },
        {
          "nombre":"Unidad 7",
          "valor":7
        },
        {
          "nombre":"Unidad 8",
          "valor":8
        },
        {
          "nombre":"Unidad 9",
          "valor":9
        },
        {
          "nombre":"No recuerdo",
          "valor":0
        },
        {
          "nombre":"No se específico",
          "valor":0
        }
      ]
    },
    {
      "name": "pregunta4",
      "pregunta": "4.-¿Entregó los resultados de las evaluaciones?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta5",
      "pregunta": "5.-¿Te entrega los resultados de la unidad evaluada, dentro de los primeros 5 días hábiles después de aplicada la evaluación?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
        ,
        {
          "texto": "No recuerdo",
          "valor": "NO RECUERDO"
        }
      ]
    },
    {
      "name": "pregunta6",
      "pregunta": "6.-Si no apruebas alguna unidad, ¿Te explica porqué?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta7",
      "pregunta": "7.-¿El profesor asiste regularmente?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta8",
      "pregunta": "8.- ¿Utiliza medios electrónicos (Software, Siveduc, biblioteca digital, etc.) para impartir sus clases?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta9",
      "pregunta": "9.-Utiliza medios audiovisuales (video proyector, pintarrón, pantalla de TV, etc.) para impartir sus clases?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta10",
      "pregunta": "10.- De la siguiente lista seleccione y cuantifique las prácticas que ha realizado",
      "tipo": "tabla",
      "encabezado": {
        "1": {
          "titulo": "Lista"
        },
        "2": {
          "titulo": "Cantidad"
        }
      },
      "subpreguntas":[
        {
          "name": "pregunta10_1",
          "pregunta": "a) Visitas a empresas, de obra o de campo",
          "tipo": "numero"
        },
        {
          "name": "pregunta10_2",
          "pregunta": "b) Laboratorio",
          "tipo": "numero"
        },
        {
          "name": "pregunta10_3",
          "pregunta": "c) Resolución de problemas o ejercicios en el aula",
          "tipo": "numero"
        },
        {
          "name": "pregunta10_4",
          "pregunta": "d) Formulación de proyectos",
          "tipo": "numero"
        },
        {
          "name": "pregunta10_5",
          "pregunta": "e) Elaboración de un producto",
          "tipo": "numero"
        },
        {
          "name": "pregunta10_6",
          "pregunta": "f)otro: Especifique",
          "tipo": "numeroespsificar",
          "campos": [
            {
              "tipo": "texto",
              "name": "pregunta10_6"
            },
            {
              "tipo": "numero",
              "name": "pregunta10_7"
            }
          ]
        }
      ]
    },
    {
      "name": "pregunta11",
      "pregunta": "11.-¿El docente se comporta de manera ética en el aula?",
      "tipo": "radio",
      "respuesta": [
        {
          "texto": "Si",
          "valor": "SI"
        },
        {
          "texto": "No",
          "valor": "NO"
        }
      ]
    },
    {
      "name": "pregunta12",
      "pregunta": "12.-Si lo deseas puedes expresar algún comentario relativo al tema",
      "tipo": "texto",
      "placeholder":"Si lo deseas puedes expresar algún comentario relativo al tema"
    }
  ]
}


';

?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - ESTRUCTURA ENCUESTA</title>
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
  <?php $this->load->view('include/menuadmin'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="card menus">
        <div class="card-body">
          <div class="row" >
            <div class="col-lg-4">
              <h3><i class="fa fa-users" aria-hidden="true"></i> ESTRUCTURA ENCUESTA</h3>
              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/plantillas_seguimiento" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row" >
                <div class="col-lg-12">
                  <form id="formularioEditar" method="post" action="<?php echo base_url(); ?>index.php/panel_administracion/act_estructura_encuesta" >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre de la plantilla:</label>
                      <input type="text" class="form-control" name="nplantilla" id="nplantilla" aria-describedby="nplantilla" placeholder="Nombre de la plantilla">

                    </div>
                    <label for="exampleInputEmail1">Estructura plantilla:</label>
                    <textarea style="width:100%;"  name="data1" id="data1" rows="12" cols="80"><?php echo "".$FORMATO_ENCUESTA; ?></textarea>
                    <textarea  hidden id="encuesta" name="encuesta" rows="8" cols="80"></textarea>
                    <center>  <button type="submit" class="btn btn-primary"> AGREGAR PLANTILLA</button></center>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/manual_usuario'); ?>
  <?php $this->load->view('include/footer'); ?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
<script>

$(document).ready(function(){
  var opciones = {
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
  $('#departamento_academico').change(function(){
    if($(this).find("option:selected").attr('value')==1)
    {
      $("#esAdmin").fadeIn();
    }else {
      $("#esAdmin").fadeOut();

    }
  });
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script>

var jsonStr = $("#data1").val();
var jsonObj = JSON.parse(jsonStr);
var jsonPretty = JSON.stringify(jsonObj, null, '\t');
//$("#encuesta").val(jsonPretty);

</script>
</html>

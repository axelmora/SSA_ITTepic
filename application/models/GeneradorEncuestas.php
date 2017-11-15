<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneradorEncuestas extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  public function generarEncu($json)
  {
    $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
    foreach ($json as $key => $value) {
      foreach ($value as $key => $value2) {
        echo "TIPO:   ".$value2->tipo." <br> ".$value2->pregunta." <br>";
        if($value2->tipo=="tabla")
        {
          foreach ($value2->subpreguntas as $key => $value3) {
            echo "__".$value3->pregunta."   ".$value3->name."  <br>  ";
            if($value3->tipo=="radio")
            {
              foreach ($value3->respuesta as $key => $value4) {
                echo "R:".$value4->texto." ";
              }
            }
            echo "<br>";
          }
        }else {
          if($value2->tipo=="radio"){
            foreach ($value2->respuesta as $key => $value3) {
              echo "R____:".$value3->texto."                  _";
            }
          }
        }
      }
    }
  }
  public function generarEncuRetro($json,$resultados)
  {
    if ($resultados) {
      $responses;
      foreach ($resultados as $key => $value) {
        //echo "$value->respuestas";
        $responses[] = json_decode(html_entity_decode($value->respuestas), TRUE);
      }
      foreach ($responses[0] as $key => $value) {
       echo $value->pregunta1_1;
     }
     $encuestaRetro="";
      $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
      foreach ($json as $key => $value) {
        foreach ($value as $key => $value2) {
          if($value2->tipo=="tabla")
          {
            $temp="";
            $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
            $tabla_pregunta;
            foreach ($value2->subpreguntas as $key => $value3) {
              if($value3->tipo=="radio")
              {
                $tabla_opciones;
                foreach ($value3->respuesta as $key => $value4) {
                  $tabla_opciones[]=$value4->texto;
                }

                $temp.=$this->GeneradorEncuestas->preguntaradioR($value3->pregunta,$tabla_opciones);
                unset($tabla_opciones) ;
              }
            }
            $encuestaRetro.=$this->GeneradorEncuestas->card($temp);
          }else {
            if($value2->tipo=="radio"){
              $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
              foreach ($value2->respuesta as $key => $value3) {
              }
            }
          }
          /**************************/
        }
      }
    }else {
      $encuestaRetro='
      <center>
      <div class="card text-white bg-danger ">
        <div class="card-body">
          <h4 class="card-title"><i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i></h4>
          <p class="card-text">Aun no se cuentan con resultados en esta encuesta. </p>
        </div>
      </div>
        </center>
      ';
    }
      return $encuestaRetro;
  }
  public function preguntatitulo($nombre)
  {
    $datos='
    <p class="textopreguntas">'.$nombre.'</p>
    ';
    return $datos;
  }
  public function preguntaradioR($preguntas,$respuestas)
  {
    $datos='
    <div class="textopreguntas">'.$preguntas.'</div>
    ';
    for($i=0;$i<count($respuestas);$i++)
    {
      $datos.='<div class="textoopciones" >'.$respuestas[$i].'</div>';
    }
    $datos.="<br>";
    return $datos;
  }
  public function card($pregunta)
  {
    $datos='
    <div class="card">
    <div class="card-body">
    '.$pregunta.'
    </div>
    </div>
    ';
    return $datos;
  }
}

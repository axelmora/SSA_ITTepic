<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneradorEncuestas extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  public function index()
  {
    echo "string";
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
  public function generarEncuRetro($json)
  {
    $encuestaRetro="";
    $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
    foreach ($json as $key => $value) {
      foreach ($value as $key => $value2) {
        //    echo "TIPO:   ".$value2->tipo." <br> ".$value2->pregunta." <br>";
        if($value2->tipo=="tabla")
        {
          $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
          $tabla_pregunta;
          foreach ($value2->subpreguntas as $key => $value3) {
            //  echo "__".$value3->pregunta."   ".$value3->name."  <br>  ";
            //$tabla_pregunta[]=$value3->pregunta;
            if($value3->tipo=="radio")
            {
              $tabla_opciones;
              foreach ($value3->respuesta as $key => $value4) {
                $tabla_opciones[]=$value4->texto;
              }
              $encuestaRetro.=$this->GeneradorEncuestas->preguntaradio($value3->pregunta,$tabla_opciones);
              unset($tabla_opciones) ;
            }
          }
        }else {
          if($value2->tipo=="radio"){
            $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
            foreach ($value2->respuesta as $key => $value3) {
              //  echo "R____:".$value3->texto."                  _";
            }
          }
        }
        /**************************/
      }
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
  public function preguntaradio($preguntas,$respuestas)
  {
    $datos='
    <p class="textopreguntas">'.$preguntas.'</p>
    ';
    for($i=0;$i<count($respuestas);$i++)
    {
      $datos.='<p class="textoopciones"   >'.$respuestas[$i].'</p>';
    }
    return $datos;
  }

}

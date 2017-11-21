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
      $init=0;
      foreach ($responses[0] as $value)
      {
        //  echo "$init $value <br>";
        $init++;
      }

      $encuestaRetro="";
      $posGraficos=0;
      $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
      foreach ($json as $key => $value) {
        $pos=0;
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
                $tabla_opciones_valor;
                foreach ($value3->respuesta as $key => $value4) {
                  $tabla_opciones[]=$value4->texto;
                  $tabla_opciones_valor[]=$value4->valor;

                }
                $temp.=$this->GeneradorEncuestas->preguntaradioR($value3->pregunta,$tabla_opciones,$tabla_opciones_valor,$responses,$pos);
                unset($tabla_opciones) ;

                // echo "POS  $pos TABLA $value2->pregunta<BR>";
                $pos++;
              }
              else {
                if ($value3->tipo=="numero") {
                  // echo "POS  $pos TABLA NUMERO $value2->pregunta<BR>";
                  $pos++;
                  // $pos++;
                }else {
                  if($value3->tipo=="numeroespsificar")
                  {
                    foreach ($value3->campos as $key => $value4) {
                      //  echo "".$value4->tipo;
                      $pos++;
                    }
                    // echo "POS  $pos TABLA ESESIFICAR $value2->pregunta<BR>";
                  }
                }
              }

              //  $pos++;
            }
            $encuestaRetro.=$this->GeneradorEncuestas->card($temp);
            $encuestaRetro.=$this->GeneradorEncuestas->generadorGraficos($posGraficos);
          }else {
            if($value2->tipo=="radio"){
              /* $tabla_opciones;
              $tabla_opciones_valor;
              foreach ($value2->respuesta as $key => $value3) {
              $tabla_opciones[]=$value3->texto;
              $tabla_opciones_valor[]=$value3->valor;
            }
            $encuestaRetro.=$this->GeneradorEncuestas->preguntaradioR($value2->pregunta,$tabla_opciones,$tabla_opciones_valor,$responses,$pos);
            unset($tabla_opciones) ; */
            $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
            $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
            $datos_tabla;
            foreach ($value2->respuesta as $key => $value3) {
              $datos_tabla[]="".$value3->valor;
              $encuestaRetro.="<th>".$value3->texto."</th>";
            }
            $encuestaRetro.='</thead></tr>';
            $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
            $encuestaRetro.='';
            $encuestaRetro.="</table>";
            $encuestaRetro.=$this->GeneradorEncuestas->generadorGraficos($posGraficos);
            unset($datos_tabla) ;
            $pos++;
          }else {
            if($value2->tipo=="seleccion"){
              // echo "POS $pos SELECION $value2->pregunta<BR>";
              $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
              $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
              $datos_tabla;
              foreach ($value2->datos as $key => $value3) {
                $datos_tabla[]="".$value3->valor;
                $encuestaRetro.="<th>".$value3->nombre."</th>";
              }
              $encuestaRetro.='</thead></tr>';
              $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
              $encuestaRetro.='';
              $encuestaRetro.="</table>";
              unset($datos_tabla) ;
              $encuestaRetro.=$this->GeneradorEncuestas->generadorGraficos($posGraficos);
              $pos++;
            }else {
              if($value2->tipo=="texto"){
                $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
                $encuestaRetro.="<div class='row'>";
                $encuestaRetro.=$this->GeneradorEncuestas->obtenerTexto($responses,$pos);
                $encuestaRetro.="</div'>";
                // echo "POS $pos TEXTO $value2->pregunta<BR>";
                $pos++;
              }
            }
          }
        }
          $posGraficos++;
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
public function preguntaradioR($preguntas,$respuestas,$tabla_opciones_valor,$responses,$pos)
{
  $datos='
  <div class="textopreguntas">'.$preguntas.'</div>
  ';
  for($i=0;$i<count($respuestas);$i++)
  {
    $datos.='
    <div class="textoopciones" >
    <div class="row">
    <div class="col-md-2">
    <i>'.$respuestas[$i].':</i>
    </div>
    <div class="col-md-2">
    '.$this->GeneradorEncuestas->contarResultado($responses,$pos,$tabla_opciones_valor[$i]).'
    </div>
    </div>
    </div>';
  }
  $datos.=" ";
  return $datos;
}

public function contarResultado($responses,$pos,$tabla_opciones_valor)
{
  $enviar=0;
  for ($i=0; $i < count($responses); $i++) {
    $pospregunta=0;
    foreach ($responses[$i] as $value)
    {
      if($pos==$pospregunta)
      {
        if($tabla_opciones_valor==$value)
        {
          $enviar++;
        }
      }
      $pospregunta++;
    }
    $pospregunta=0;
  }
  $textoenviar="";
  if($tabla_opciones_valor=="SI")
  {
    $textoenviar='<span class="badge badge-pill badge-success">'.$enviar.'</span>';
  }else {
    if($tabla_opciones_valor=="NO")
    {
      $textoenviar='<span class="badge badge-pill badge-danger">'.$enviar.'</span>';
    }else {
      if($tabla_opciones_valor=="NO RECUERDO")
      {
        $textoenviar='<span class="badge badge-pill badge-warning">'.$enviar.'</span>';
      }else {
        $textoenviar='<span class="badge badge-pill badge-secondary">'.$enviar.'</span>';
      }
    }
  }
  return $textoenviar;
}
public function obtenerTexto($responses,$pos1)
{
  $textos="";
  for ($i=0; $i < count($responses); $i++) {
    $pospregunta=0;
    foreach ($responses[$i] as $value)
    {
      if($pos1==$pospregunta)
      {
        if($value!="")
        {
          $textos.='
          <div class="col-md-4" style="margin-top:0.5%;">
          <div class="card border-dark cardMensajes">
          <div class="card-body">
          '.$value.'
          </div>
          </div>
          </div>
          ';
        }

      }
      $pospregunta++;
    }
    $pospregunta=0;
  }
  return $textos;
}
public function generarFilas($responses,$pos,$datos_tabla)
{
  $textos="";
  $enviar=0;
  $datoscontables = array_fill(0, count($datos_tabla), NULL);
  for ($i=0; $i < count($responses); $i++) {
    $pospregunta=0;
    foreach ($responses[$i] as $value)
    {
      if($pos==$pospregunta)
      {
        for($e=0;$e<count($datos_tabla);$e++)
        {
          if($datos_tabla[$e]==$value)
          {
            $datoscontables[$e]+=1;
            //    echo "$e $value <br>";
          }else {
            $datoscontables[$e]+=0;
          }
        }
      }
      $pospregunta++;
    }
    $pospregunta=0;
  }
  $textos.='<tr>';
  for ($i=0; $i < count($datos_tabla); $i++) {
    $textos.='<td>'.$datoscontables[$i].' </td>';
  }
  $textos.='</tr>';
  return $textos;
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
public function generadorGraficos($posGrafico)
{
   return '<canvas id="grafico'.$posGrafico.'"></canvas>';
}
}

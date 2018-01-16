<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneradorEncuestas2 extends CI_Model {
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
        $responses[] = json_decode(html_entity_decode($value->respuestas), TRUE);
      }
      $init=0;
      foreach ($responses[0] as $value)
      {
        $init++;
      }
      $encuestaRetro="";
      $posGraficos=0;
      $totalAlumnosContestados=count($responses);
      $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
      foreach ($json as $key => $value) {
        $pos=0;
        foreach ($value as $key => $value2) {
          if($value2->tipo=="tabla")
          {
            $temp="";
            $encuestaRetro.=$this->GeneradorEncuestas2->preguntatitulo($value2->pregunta);
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
                //preguntaradioR
                $temp.=$this->GeneradorEncuestas2->preguntaradioRTABLA($value3->pregunta,$tabla_opciones,$tabla_opciones_valor,$responses,$pos,$posGraficos,$value2->pregunta);
                unset($tabla_opciones);
                $temp.=$this->GeneradorEncuestas2->generadorGraficos($posGraficos);
                $posGraficos++;
                $pos++;
              }
              else {
                if ($value3->tipo=="numero") {
                  $datos_tabla;
                  $temp.=$this->GeneradorEncuestas2->preguntatitulo($value3->pregunta);
                  $datos_tabla[0]="CANTIDAD";
                  $temp.='<table hidden id="tabla'.$posGraficos.'"  style="margin-bottom:0px;" align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
                  $temp.="<th></th><th>".$datos_tabla[0]."</th></tr></thead><tbody>";
                  $temp.=$this->GeneradorEncuestas2->generarFilas2($responses,$pos,$datos_tabla,$totalAlumnosContestados,$value3->pregunta);
                  $temp.="</tbody></table>";
                  unset($datos_tabla) ;
                  $temp.=$this->GeneradorEncuestas2->generadorGraficos($posGraficos);
                  $posGraficos++;
                  $pos++;
                }else {
                  if($value3->tipo=="numeroespsificar")
                  {
                    $temp.=$this->GeneradorEncuestas2->preguntatitulo($value3->pregunta);
                    $datos_tabla[0]="DESCRIPCION";
                    $datos_tabla[1]="CANTIDAD";
                    $Temppos=0;
                    for ($i=0; $i < $totalAlumnosContestados; $i++) {
                      $Temppos=$pos;
                      $a=$this->GeneradorEncuestas2->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
                      $Temppos++;
                      $b=$this->GeneradorEncuestas2->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
                      if($a!="" && $b!=0){
                        $temp.='<table id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
                        $temp.="<th>".$datos_tabla[0]."</th><th>".$datos_tabla[1]."</th></tr><tr>";
                        $temp.="<td>".$a."</td>";
                        $temp.="<td>".$b."</td></tr>";
                        $temp.="</table>";
                      }else {
                        if($a!="" && $b>0){
                          $temp.='<table id="tabla'.$posGraficos.'"   align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
                          $temp.="<th>".$datos_tabla[0]."</th><th>".$datos_tabla[1]."</th></tr><tr>";
                          $temp.="<td>NO SE ESPECIFICO</td>";
                          $temp.="<td>".$b."</td></tr>";
                          $temp.="</table>";

                        }
                      }
                    }
                    $pos=$Temppos+1;
                    unset($datos_tabla);
                  }
                }
              }
              //  $pos++;
            }
            $encuestaRetro.=$this->GeneradorEncuestas2->card($temp);

            //      $encuestaRetro.=$this->GeneradorEncuestas2->generadorGraficos($posGraficos);
          }else {
            if($value2->tipo=="radio"){
              /* $tabla_opciones;
              $tabla_opciones_valor;
              foreach ($value2->respuesta as $key => $value3) {
              $tabla_opciones[]=$value3->texto;
              $tabla_opciones_valor[]=$value3->valor;
            }
            $encuestaRetro.=$this->GeneradorEncuestas2->preguntaradioR($value2->pregunta,$tabla_opciones,$tabla_opciones_valor,$responses,$pos);
            unset($tabla_opciones) ; */
            $encuestaRetro.="<hr>".$this->GeneradorEncuestas2->preguntatitulo($value2->pregunta);
            $encuestaRetro.='<table style="display:none" id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr><th></th>';
            $datos_tabla;
            foreach ($value2->respuesta as $key => $value3) {
              $datos_tabla[]="".$value3->valor;
              $encuestaRetro.="<th>".$value3->texto."</th>";
            }
            $encuestaRetro.='</tr></thead>';
            $encuestaRetro.=$this->GeneradorEncuestas2->generarFilas($responses,$pos,$datos_tabla,$value2->pregunta);
            $encuestaRetro.="</table>";
            $encuestaRetro.=$this->GeneradorEncuestas2->generadorGraficos($posGraficos);
            unset($datos_tabla) ;
            $pos++;
          }else {
            if($value2->tipo=="seleccion"){
              // echo "POS $pos SELECION $value2->pregunta<BR>";
              $encuestaRetro.=$this->GeneradorEncuestas2->preguntatitulo($value2->pregunta);
              $encuestaRetro.='<table id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr><th></th>';
              $datos_tabla;
              foreach ($value2->datos as $key => $value3) {
                $datos_tabla[]="".$value3->valor;
                $encuestaRetro.="<th>".$value3->nombre."</th>";
              }
              $encuestaRetro.='</thead></tr>';
              $encuestaRetro.=$this->GeneradorEncuestas2->generarFilas($responses,$pos,$datos_tabla,$value3->nombre);
              $encuestaRetro.='';
              $encuestaRetro.="</table>";
              unset($datos_tabla) ;
              $encuestaRetro.=$this->GeneradorEncuestas2->generadorGraficos($posGraficos);
              $pos++;
            }else {
              if($value2->tipo=="texto"){
                //   $encuestaRetro.=$this->GeneradorEncuestas2->preguntatitulo($value2->pregunta);
                //   $encuestaRetro.="<div class='row'>";
                // //  $encuestaRetro.=$this->GeneradorEncuestas2->obtenerTexto($responses,$pos);
                //   $encuestaRetro.="</div'>";
                //   // echo "POS $pos TEXTO $value2->pregunta<BR>";
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
    <h4 class="card-title"><i class="fa fa-exclamation-triangle  fa-5x animated tada infinite" aria-hidden="true"></i></h4>
    <p class="card-text"><b>Aun no se cuentan con resultados en esta encuesta.</b></p>
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
    '.$this->GeneradorEncuestas2->contarResultado($responses,$pos,$tabla_opciones_valor[$i]).'
    </div>
    </div>
    </div>';
  }
  $datos.=" ";
  return $datos;
}
public function preguntaradioRTABLA($preguntas,$respuestas,$tabla_opciones_valor,$responses,$pos,$posGraficos,$pregunta)
{
/*
  $temp.='';
  $temp.="<th>".$datos_tabla[0]."</th><th>".$datos_tabla[1]."</th></tr><tr>";
  $temp.="<td>".$a."</td>";
  $temp.="<td>".$b."</td></tr>";
  $temp.="</table>";
*/
  $datos='
  <div class="textopreguntas">'.$preguntas.'</div>
  <table id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>
  <th></th>
  ';
  for($i=0;$i<count($respuestas);$i++)
  {
    $datos.='
  <th><i>'.$respuestas[$i].'</i></th>
    ';
  }
  $datos.=' </tr></thead>  <tbody><tr>  <td>'.$pregunta.'</td>';
  for($i=0;$i<count($respuestas);$i++)
  {
    $datos.='

    <td>'.$this->GeneradorEncuestas2->contarResultado2($responses,$pos,$tabla_opciones_valor[$i]).'</td>
    ';
  }
  $datos.="</tr></tbody></table>";
  return $datos;
}
public function contarResultado2($responses,$pos,$tabla_opciones_valor)
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
    $textoenviar=''.$enviar.'';
  }else {
    if($tabla_opciones_valor=="NO")
    {
      $textoenviar=''.$enviar.'';
    }else {
      if($tabla_opciones_valor=="NO RECUERDO")
      {
        $textoenviar=''.$enviar.'';
      }else {
        $textoenviar=''.$enviar.'';
      }
    }
  }
  return $textoenviar;
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
public function generarFilas($responses,$pos,$datos_tabla,$pregunta_texto)
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
  $textos.='<tr><td>'.$pregunta_texto.'</td>';
  for ($i=0; $i < count($datos_tabla); $i++) {
    $textos.='<td>'.$datoscontables[$i].' </td>';
  }
  $textos.='</tr>';
  return $textos;
}
public function generarFilas2($responses,$pos,$datos_tabla,$total,$Pregunta)
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

          $datoscontables[$e]+=$value;
        }
      }
      $pospregunta++;
    }
    $pospregunta=0;
  }
  $textos.='<tr><td>'.$Pregunta.'</td>';
  for ($i=0; $i < count($datos_tabla); $i++) {
    $textos.='<td>'.$datoscontables[$i].' </td>';
  }
  $textos.='</tr>';
  return $textos;
}
public function generarFilas3($responses,$pos,$datos_tabla,$total,$i)
{
  $textos="";
  $enviar=0;
  $datoscontables = array_fill(0, count($datos_tabla), NULL);
  $t="";
  $pospregunta=0;
  foreach ($responses[$i] as $value)
  {
    if($pos==$pospregunta)
    {
      $t=$value;
    }
    $pospregunta++;
  }
  $textos.=$t;
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
  return '<div id="grafico'.$posGrafico.'"></div>';
}
}

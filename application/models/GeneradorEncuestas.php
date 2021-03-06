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
      $json=json_decode(file_get_contents($json));
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
                unset($tabla_opciones);
                $pos++;
              }
              else {
                if ($value3->tipo=="numero") {
                  $datos_tabla;
                  $temp.=$this->GeneradorEncuestas->preguntatitulo($value3->pregunta);
                  $datos_tabla[0]="CANTIDAD";
                  $temp.='<table id="tabla'.$posGraficos.'"  style="margin-bottom:0px;" align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
                  $temp.="<th>".$datos_tabla[0]."</th></tr></thead><tbody>";
                  $temp.=$this->GeneradorEncuestas->generarFilas2($responses,$pos,$datos_tabla,$totalAlumnosContestados);
                  $temp.="</tbody></table>";
                  unset($datos_tabla) ;
                  $pos++;
                }else {
                  if($value3->tipo=="numeroespsificar")
                  {
                    $temp.=$this->GeneradorEncuestas->preguntatitulo($value3->pregunta);
                    $datos_tabla[0]="DESCRIPCION";
                    $datos_tabla[1]="CANTIDAD";
                    $Temppos=0;
                    for ($i=0; $i < $totalAlumnosContestados; $i++) {
                      $Temppos=$pos;
                      $a=$this->GeneradorEncuestas->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
                      $Temppos++;
                      $b=$this->GeneradorEncuestas->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
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
                    //echo "$Temppos";
                    $pos=$Temppos+1;
                    unset($datos_tabla);
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
            $encuestaRetro.='<table id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
            $datos_tabla;
            foreach ($value2->respuesta as $key => $value3) {
              $datos_tabla[]="".$value3->valor;
              $encuestaRetro.="<th>".$value3->texto."</th>";
            }
            $encuestaRetro.='</tr></thead>';
            $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
            $encuestaRetro.="</table>";
            $encuestaRetro.=$this->GeneradorEncuestas->generadorGraficos($posGraficos);
            unset($datos_tabla) ;
            $pos++;
          }else {
            if($value2->tipo=="seleccion"){
              // echo "POS $pos SELECION $value2->pregunta<BR>";
              $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
              $encuestaRetro.='<table id="tabla'.$posGraficos.'"  align="center" class="table table-responsive table-sm table-hover table-bordered  "><thead><tr>';
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
                $encuestaRetro.="</div> <br>";
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
public function generarFilas2($responses,$pos,$datos_tabla,$total)
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
  $textos.='<tr>';
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
public function generarEncuPDF($json,$resultados,$ruta)
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
    $totalAlumnosContestados=count($responses);
    $encuestaRetro="";
    $posGraficos=0;
    $json=json_decode(file_get_contents($ruta));
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
              $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value3->pregunta);
              $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
              $datos_tabla;
              foreach ($value3->respuesta as $key => $value4) {
                $datos_tabla[]="".$value4->valor;
                $encuestaRetro.="<th>".$value4->texto."</th>";
              }
              $encuestaRetro.='</thead></tr>';
              $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
              $encuestaRetro.="</table>";
              unset($datos_tabla) ;
              $pos++;
            }
            else {
              if ($value3->tipo=="numero") {
                $datos_tabla;
                $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value3->pregunta);
                $datos_tabla[0]="CANTIDAD";
                $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
                $encuestaRetro.="<th>".$datos_tabla[0]."</th></tr></thead><tbody>";
                $encuestaRetro.=$this->GeneradorEncuestas->generarFilas2($responses,$pos,$datos_tabla,$totalAlumnosContestados);
                $encuestaRetro.="</tbody></table>";
                //  $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
                /*  $datos_tabla;
                foreach ($value3->subpreguntas as $key => $value4) {
                $datos_tabla[]="".$value4->valor;
                $encuestaRetro.="<th>".$value4->texto."</th>";
              }
              $encuestaRetro.='</thead></tr>';
              $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
              $encuestaRetro.='';
              $encuestaRetro.="</table>";*/
              unset($datos_tabla) ;
              // echo "POS  $pos TABLA NUMERO $value2->pregunta<BR>";
              $pos++;
              // $pos++;
            }else {
              if($value3->tipo=="numeroespsificar")
              {
                $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value3->pregunta);
                $datos_tabla[0]="DESCRIPCION";
                $datos_tabla[1]="CANTIDAD";
                $Temppos=0;
                for ($i=0; $i < $totalAlumnosContestados; $i++) {
                  $Temppos=$pos;
                  $a=$this->GeneradorEncuestas->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
                  $Temppos++;
                  $b=$this->GeneradorEncuestas->generarFilas3($responses,$Temppos,$datos_tabla,$totalAlumnosContestados,$i);
                  if($a!="" && $b!=0){
                    $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover   tablaRetro"><thead><tr>';
                    $encuestaRetro.="<th>".$datos_tabla[0]."</th><th>".$datos_tabla[1]."</th></tr><tr>";
                    $encuestaRetro.="<td>".$a."</td>";
                    $encuestaRetro.="<td>".$b."</td></tr>";
                    $encuestaRetro.="</table>";
                  }else {
                    if($a!="" && $b>0){
                      $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover   tablaRetro"><thead><tr>';
                      $encuestaRetro.="<th>".$datos_tabla[0]."</th><th>".$datos_tabla[1]."</th></tr><tr>";
                      $encuestaRetro.="<td>NO SE ESPECIFICO</td>";
                      $encuestaRetro.="<td>".$b."</td></tr>";
                      $encuestaRetro.="</table>";
                    }
                  }
                }
                $pos=$Temppos+1;
                unset($datos_tabla);
              }
            }
          }
        }
      }else {
        if($value2->tipo=="radio"){
          $encuestaRetro.=$this->GeneradorEncuestas->preguntatitulo($value2->pregunta);
          $encuestaRetro.='<table  align="center" class="table table-responsive table-sm table-hover table-bordered  tablaRetro"><thead><tr>';
          $datos_tabla;
          foreach ($value2->respuesta as $key => $value3) {
            $datos_tabla[]="".$value3->valor;
            $encuestaRetro.="<th>".$value3->texto."</th>";
          }
          $encuestaRetro.='</thead></tr>';
          $encuestaRetro.=$this->GeneradorEncuestas->generarFilas($responses,$pos,$datos_tabla);
          $encuestaRetro.="</table>";
          unset($datos_tabla) ;
          $pos++;
        }else {
          if($value2->tipo=="seleccion"){
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
  <p></p>
  <p style="text-align:center;font-size: 200%;">Aun no se cuentan con resultados en esta encuesta. </p>
  ';
}
return $encuestaRetro;
}
}

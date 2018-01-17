<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneradorEncuestas3 extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  public function generarEncu($jsonr)
  {
    $datos="";
    $json=json_decode(file_get_contents($jsonr));
    foreach ($json as $key => $value) {
      foreach ($value as $key => $value2) {
        //  echo "TIPO:   ".$value2->tipo." <br> ".$value2->pregunta." <br>";
        if($value2->tipo=="tabla")
        {
          $datos.='  <p class="textopreguntas">'.$value2->pregunta.'</p>';
          $datos.='<table class="table table-striped table-hover menus table-sm">';
          $tamanocolumans=0;
          $tempfila;
          $filas;
          $filatemp=false;
          foreach ($value2->subpreguntas as $key => $value3) {
            //echo "__".$value3->pregunta."   ".$value3->name."  <br>  ";
            if($value3->tipo=="radio")
            {
              $radiotemptabla;

              //echo "RADIO ___".count($value3->respuesta)."<br>";
              if($tamanocolumans<count($value3->respuesta)){
                $tamanocolumans=count($value3->respuesta);
              }
              foreach ($value3->respuesta as $key => $value4) {
                $radiotemptabla[]= array(
                  'texto' => $value4->texto,
                  'valor' => $value4->valor,
                  'tipo' => $value3->tipo,
                  'name' => $value3->name
                );
                // echo "R:".$value4->texto." <br> ";
              }
              //  var_dump($radiotemptabla);
              $filatemp= array('opciones' => $radiotemptabla,'pregunta' =>$value3->pregunta,'tipo'=>"radio");
              unset($radiotemptabla);
              //  var_dump($filatemp);
              //  $tempfila[]= array('pregunta' => , );
            }else {
              if($value3->tipo=="numero")
              {
                $texttemptabla[]= array(
                  'tipo' => "number",
                  'name' => $value3->name
                );
                //  $filatemp= array('pregunta' =>':3');
              }else {
                if($value3->tipo=="numeroespsificar")
                {
                  echo "DOBLE :3";
                }
              }
              $filatemp= array('opciones' => $texttemptabla,'pregunta' =>$value3->pregunta,'tipo'=>"text");
              unset($texttemptabla);
            }
            if($filatemp){
              $filas[]=$filatemp;
            }
          }
          //  var_dump($filas);
          //  echo "$tamanocolumans <br>";
          $tamencabezado=count($value2->encabezado);
          $tempencabezado;
          foreach ($value2->encabezado as $key => $valores) {
            $tempencabezado[]=$valores->titulo;
          }
          $datos.=$this->GeneradorEncuestas3->generarEncabezadoEncuesta($tempencabezado);
          $datos.='<tbody>';
          $datos.=$this->GeneradorEncuestas3->generarFilasTabla($filas,$tamencabezado);
          $datos.='</tbody></table>';
          unset($tempencabezado);
          unset($filas);
          unset($filatemp);
        }else {
          if($value2->tipo=="radio"){
            $radiotemp;
            foreach ($value2->respuesta as $key => $value3) {
              $radiotemp[]=$campo_select = array(
                'texto' => $value3->texto,
                'valor' => $value3->valor,
                'tipo' => $value2->tipo,
                'name'=>$value2->name
              );
            }
            $datos.=$this->GeneradorEncuestas3->generarPreguntaRadio($radiotemp,$value2->name,$value2->pregunta);
            unset($radiotemp);
          }else {
            if($value2->tipo=="seleccion"){
              $tempselect;
              foreach ($value2->datos as $key => $value3) {
                $tempselect[]=$campo_select = array(
                  'nombre' => $value3->nombre,
                  'valor' => $value3->valor
                );
              }
              $tempselector=$this->GeneradorEncuestas3->generarSelect($tempselect,$value2->name,$value2->titulo);
              $datos.=$this->GeneradorEncuestas3->cardSeleccion($value2->pregunta,$tempselector);
              unset($tempselect);
            }else {
              if($value2->tipo=="texto"){
                $datos.='
                <div class="row">
                <div class="col-md-12">
                <p class="textopreguntas"  style="margin-left:10px;">'.$value2->pregunta.'</p>
                <textarea class="form-control" name="'.$value2->name.'" rows="3" placeholder="'.$value2->placeholder.'" ></textarea>
                </div>
                </div>
                ';
              }
            }
          }
        }
        $datos.="<br>";
      }
      $datos.=$this->GeneradorEncuestas3->generarBotonSubmit();
    }
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
  public function cardSeleccion($pregunta,$selector)
  {
    $datos='
    <div class="form-row">
    <div class="col-md-5">
    <p class="textopreguntas">'.$pregunta.'</p>
    </div>
    <div class="col-md-4">
    '.$selector.'
    </div>
    <div class="col-md-3">
    </div>
    </div>
    ';
    return $datos;
  }
  public function tablaAfuera($tabla)
  {
    $datos='
    <div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
    '.$tabla.'
    </div>
    </div>
    ';
    return $datos;
  }
  public function generarSelect($arreglo_datos,$name,$titulo)
  {
    $datos='  <select class="form-control"  name="'.$name.'" id="'.$name.'" title="'.$titulo.'" required>';
    if(count($arreglo_datos)>0){
      for ($i=0; $i < count($arreglo_datos); $i++) {
        $datos.='<option value="'.$arreglo_datos[$i]["valor"].'">'.$arreglo_datos[$i]["nombre"].'</option>';
      }
    }else {
      $datos.='<option value="0">SIN DATOS</option>';
    }
    $datos.="</select>";
    unset($arreglo_datos);
    return $datos;
  }
  public function generarPreguntaRadio($arreglo_datos,$name,$titulo)
  {
    $tamaños1=array(2,4);
    $tamaños2=array(2,2,2);
    $tamaños3=array(1,1,1,1,1,1);
    $datos='<div class="row">';
    $datos.='
    <div class="col-md-6">
    <p class="textopreguntas">'.$titulo.'</p>
    </div>
    ';
    $tamtemp;
    $pos=1;
    if (count($arreglo_datos)>2) {
      $tamtemp=$tamaños2;
    }else {
      if (count($arreglo_datos)>3) {
        $tamtemp=$tamaños3;
      }else {
        $tamtemp=$tamaños1;
      }
    }
    if(count($arreglo_datos)>0){
      for ($i=0; $i < count($arreglo_datos); $i++) {
        $datos.='
        <div class="col-md-'.$tamtemp[$i].'">
        <div class="form-check abc-radio">
        <input class="form-check-input" type="'.$arreglo_datos[$i]["tipo"].'" name="'.$arreglo_datos[$i]["name"].'" id="'.$arreglo_datos[$i]["name"].'_'.$pos.'" value="'.$arreglo_datos[$i]["valor"].'" required>
        <label class="form-check-label" for="'.$arreglo_datos[$i]["name"].'_'.$pos.'">'.$arreglo_datos[$i]["texto"].'
        </label>
        </div>
        </div>
        ';
        $pos++;
      }
    }else {
      $datos.='<option value="0">SIN DATOS</option>';
    }
    $datos.="</div>";
    unset($arreglo_datos);
    $pos=1;
    return $datos;
  }
  public function generarBotonSubmit()
  {
    $datos='
    <div class="botonEnviar">
    <br>
    <center>
    <button type="submit" class="btn btn-success btn-lg btn-block " ><i class="fa fa-floppy-o" aria-hidden="true"></i> CONTESTAR </button>
    </center>
    </div>
    ';
    return $datos;
  }
  public function generarEncabezadoEncuesta($encabezado)
  {
    $datos='<thead><tr>';
    for ($i=0; $i < count($encabezado); $i++) {
      $datos.='  <td class="textoNegritas2">'.$encabezado[$i].'</td>';
    }
    $datos.='</tr></thead>';
    return $datos;
  }
  public function generarFilasTabla($filaentrada,$tamano)
  {
    $datos="";
    for ($i=0; $i < count($filaentrada); $i++) {
      if($filaentrada[$i]["tipo"]=="radio"){
        $datos.='<tr><td>'.$filaentrada[$i]["pregunta"].'</td>';
        $post=1;
        foreach ($filaentrada[$i]["opciones"] as $key => $value) {
          $datos.='
          <td>
          <div class="form-check abc-radio">
          <input class="form-check-input" type="radio" name="'.$value["name"].'" id="'.$value["name"].'_'.($post).'" value="'.$value["valor"].'"  required>
          <label class="form-check-label radioTabla" for="'.$value["name"].'_'.($post).'"
          </label>
          </div>
          </td>
          ';
          $post++;
        }
        $post=1;
        $datos.='</tr>';
      }else {
        if($filaentrada[$i]["tipo"]=="text"){
          $datos.='<tr><td>'.$filaentrada[$i]["pregunta"].'</td>';
          $post=1;
          foreach ($filaentrada[$i]["opciones"] as $key => $value) {
            $datos.='
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
            ';
            $post++;
          }
          $post=1;
          $datos.='</tr>';
        }
      }
    }
    unset($filaentrada);
    return $datos;
  }
}

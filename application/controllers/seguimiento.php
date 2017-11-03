<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*MODELO SISTEMA*/
		$this->load->model('Sistema');
		/*MODELO ALUMNOS*/
		$this->load->model('Alumnos');
		/*MODELO SEGUIMIENTO*/
		$this->load->model('SeguimientoModelo');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	public function index()
	{
		$sistemaproduccion = $this->Sistema->obtenerproduccion();
		if ($sistemaproduccion[0]->produccion==1) {
			$this->load->view('encuesta/inicio');
		}
		else {
			$datos["mensajesistema"]=$this->mensajeErrorSistema();
			$this->load->view('encuesta/inicio',$datos);
		}
	}
	public function Contestar()
	{
		if ($this->session->userdata('is_logued_in')==true && $this->session->userdata('alumno')==true) {
			$this->load->view('encuesta/seguimientovi');
		}else {
			redirect(base_url().'index.php/Seguimiento/');
		}
	}
	public function verificarAlumnoEncuesta()
	{
		$sistemaproduccion = $this->Sistema->obtenerproduccion();
		if ($sistemaproduccion[0]->produccion==1) {
			/* VERIFICAR ALUMNOS */
			$NUMERO_CONTROL=$this->input->post('numero_control');
			$ALUMNOVERIFICADO = $this->Alumnos->verificarAlumno($NUMERO_CONTROL);
			$NOMBREALUM="";
			if($ALUMNOVERIFICADO)
			{
				$idcarreras="";
				foreach ($ALUMNOVERIFICADO as $key => $value) {
					$idcarreras=$value->id_carrera;
					$NOMBREALUM=$value->nombre;
				}
				/* OBTENER DEPARTAMENTO ALUMNO*/
				$IDDEPARTAMENTO=$this->obtenerDepartamentoPorCarrera($idcarreras);
				$PERIODOACTUAL=$this-> generarPeriodo();
				$contra_aplicacion=$this->input->post('contra_aplicacion');
				/* VERIFICAR SI EXISTE APLICACION EL PERIODO Y DEPARTAMENTO*/
				$APLICACIONVERIFICADA = $this->SeguimientoModelo->verificarAplicacion($contra_aplicacion,$PERIODOACTUAL,$IDDEPARTAMENTO);
				if($APLICACIONVERIFICADA){
					$idaplicaciones="";
					$idplantilla="";
					foreach ($APLICACIONVERIFICADA as $key => $value) {
						$idaplicaciones=$value->idaplicaciones;
						$idplantilla=$value->plantilla_encuestas_idplantilla_encuestas;
					}
					$ENCUESTAS= $this->SeguimientoModelo->obtenerEncuestas($idaplicaciones,$NUMERO_CONTROL);
					if($ENCUESTAS){
						$PROGRESOENCUESTAS=0;
						//	echo "$IDDEPARTAMENTO $PERIODOACTUAL $idaplicaciones  $idplantilla ";
						//echo "EXISTE <br>";
						$ID_ENCUESTAS="";
						$TAMANO=count($ENCUESTAS); // OBTENER EL TAMAÑO
						$POSENCUESTAS=0; //
						/* CONCATENAR ID ENCUESTAS*/
						foreach ($ENCUESTAS as $key => $value) {
							//$this->consolaLOG("".$value->idencuesta_seguimiento."");
							if($POSENCUESTAS<$TAMANO-1)
							{
								$ID_ENCUESTAS.=$value->idencuesta_seguimiento.",";
							}else {
								$ID_ENCUESTAS.=$value->idencuesta_seguimiento;
							}
							$PROGRESOENCUESTAS++;
							$POSENCUESTAS++;
						}
						$POSENCUESTAS=0;
						//$this->consolaLOG("ID ENCUESTAS: ".$ID_ENCUESTAS);
						$DATOS_ALUMNOS = array(
							'is_logued_in' => true,
							'numero_control' => $NUMERO_CONTROL,
							'nombre_alumno' => $NOMBREALUM,
							'alumno'=>true,
							'idencuestas'=>$ID_ENCUESTAS,
							'progresolimite'=>$PROGRESOENCUESTAS,
							'progresoactual'=>0,
							'idplantilla'=>$idplantilla
						);
						$this->session->set_userdata($DATOS_ALUMNOS);
						if($idplantilla==1) //PLANTILLA NORMAL
						{
							redirect(base_url().'index.php/Seguimiento/contestar/');
						}else { // PLANTILLA EDITADAS

						}
					}else{
						$datos["ErrorInicio"]=$this->mensajeError("No cuentas con encuesta hasta el momento");
						$this->load->view('encuesta/inicio',$datos);
					}
					/* OBTENER LAS APLICACIONES CORE*/
				}else {
					$datos["ErrorInicio"]=$this->mensajeError(" Error con la contraseña de la aplicacion y/o la aplicacion no existe.");
					$this->load->view('encuesta/inicio',$datos);
				}
			}else {
				$datos["ErrorInicio"]=$this->mensajeError("Error al ingresar el numero de control.");
				$this->load->view('encuesta/inicio',$datos);
			}

		}else {
			$datos["mensajesistema"]=$this->mensajeErrorSistema();
			$this->load->view('encuesta/inicio',$datos);
		}
	}
	public function obtenerDepartamentoPorCarrera($idCarrera)
	{
		$DepartamentoEnviar="";
		switch ($idCarrera) {
			case '2': //TIC´S
			$DepartamentoEnviar=3; //DEPARTAMENTO DE SISTEMAS Y COMPUTACION
			break;
			case '7': //SISTEMAS
			$DepartamentoEnviar=3;  //DEPARTAMENTO DE SISTEMAS Y COMPUTACION
			break;
			case '3':// ARQUITECTURA
			$DepartamentoEnviar=2; //CIENCIAS DE LA TIERRA
			break;
			default:
			# code...
			break;
		}
		return $DepartamentoEnviar;
	}
	public function generarPeriodo()
	{ /* FUNCION PARA OBTENER EL PERIODO ACTUAL  */
		$anio=date("Y");
		$mes=date("m");
		$periodo="";
		if ($mes>=1 && $mes<=6) {
			$periodo=$anio."1";
		}else {
			if ($mes>=8 && $mes<=12) {
				$periodo=$anio."3";
			}
			else {
				$periodo=$anio."2";
			}
		}
		return $periodo;
	}
	/* FUNCION PARA GENERAR MENSAJES DE ERRORES*/
	public function mensajeError($Mensaje)
	{
		$enviar="
		<br>
		<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
		<center>
		<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
		<br><br><b>".$Mensaje."</b>
		</center>
		</div>
		";
		return $enviar;
	}
	/* FUNCION PARA GENERAR MENSAJES DE ERRORES*/
	public function mensajeErrorSistema()
	{
		$enviar="
		<br>
		<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
		<center>
		<br>
		<i style='font-size:600%;' class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
		<br><br><b  style='font-size:150%;' > El sistema se encuentra actualmente en mantenimiento<i class='fa fa-wrench' aria-hidden='true'></i>.</b>
		</center>
		<br>
		<br>
		<br>
		</div>
		";
		return $enviar;
	}
	public function consolaLOG($Mensaje)
	{
		echo "$Mensaje <br>";
	}
}

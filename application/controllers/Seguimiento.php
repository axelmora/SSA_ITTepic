<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*MODELO SISTEMA*/
		$this->load->model('Sistema');
		/*MODELO ALUMNOS*/
		$this->load->model('Alumnos');
		$this->load->model('Departamentos');
		$this->load->model('PeriodoModelo');
		$this->load->model('Aplicaciones');
		/*MODELO SEGUIMIENTO*/
		$this->load->model('SeguimientoModelo');
		$this->load->model('Plantilla');
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
			if($this->session->userdata('numero_control')!=""){
				$IDencuestas=$this->session->userdata('idencuestas');
				$IDencuEnviar = explode(",",$IDencuestas);
				if($IDencuEnviar[0]!="")
				{
					$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($IDencuEnviar[0]);
					$datos['encabezado'] = $this->Plantilla->cargarPlantillaID($this->session->userdata('idplantilla'));
					$rutajson = $this->Plantilla->cargarPlantillaID($this->session->userdata('idplantilla'));
					/* GENERADA MEDIANTE JSON */
					$rutajson=$rutajson[0]->estructura;
					$this->load->model('GeneradorEncuestas3');
					$datos["EncuestaRetro"]=$this->GeneradorEncuestas3->generarEncu($rutajson);
					/* GENERADA MEDIANTE JSON */
					$this->load->view('encuesta/seguimientovi_generada',$datos);
					//		$this->load->view('encuesta/seguimientovi',$datos);
				}else {
					redirect(base_url().'index.php/Seguimiento/completado');
				}
			}else {
				redirect(base_url().'index.php/Seguimiento/');
			}
		}else {
			redirect(base_url().'index.php/Seguimiento/');
		}
	}
	public function completado()
	{
		$this->load->view('encuesta/completado');
	}
	public function enviarEncuesta($idencuesta_seguimiento)
	{
		if ($this->session->userdata('alumno')==true) {
			$RESULTADO = $this->input->post();
			if (count($RESULTADO)>0) {
				$IDencuestas=$this->session->userdata('idencuestas');
				$IDencuEnviar = explode(",",$IDencuestas);
				$NUEVOS_ID="";
				if(count($IDencuEnviar)>1){
					for ($i=1; $i < count($IDencuEnviar); $i++) {
						if($i<count($IDencuEnviar)-1)
						{
							$NUEVOS_ID.=$IDencuEnviar[$i].",";
						}else {
							$NUEVOS_ID.=$IDencuEnviar[$i];
						}
					}
				}
				$DATOS_RESULTADOS= array(
					'fecha_contestado' =>''.date('Y-m-d H:i:s'),
					'respuestas' => json_encode($RESULTADO),
					'estado'=>1,
					//'no_de_control'=>$this->session->userdata('numero_control'),
					//'encuestas_seguimiento_idencuesta_seguimiento'=>$idencuesta_seguimiento
				);
				$this->SeguimientoModelo->actualizarRespuesta($DATOS_RESULTADOS,$idencuesta_seguimiento,$this->session->userdata('numero_control'));
				$progresoactual=$this->session->userdata('progresoactual');
				$progresoactual++;
				$this->session->set_userdata('idencuestas',$NUEVOS_ID);
				$this->session->set_userdata('progresoactual',$progresoactual);
				redirect(base_url().'index.php/Seguimiento/contestar/');
			}else {
				redirect(base_url().'index.php/Seguimiento/');
			}
		}else {
			redirect(base_url().'index.php/Seguimiento/');
		}
	}
	public function verificarAlumnoEncuesta()
	{
		//	$idcarreras="";
		$idAplicacionesActuales=false;
		$sistemaproduccion = $this->Sistema->obtenerproduccion();
		if ($sistemaproduccion[0]->produccion==1) {
			$PERIODOACTUAL=$this->PeriodoModelo->obtenerPeriodoActual();
			$PERIODOACTUAL=$PERIODOACTUAL[0]->idperiodos;
		//	$PERIODOACTUAL="20123";
			$NUMERO_CONTROL=$this->input->post('numero_control');
			$IDAPLICACIONES_ENCUESTAS=FALSE;
			$nip=$this->input->post('contra_aplicacion');
			if ($nip!="" && $NUMERO_CONTROL!="") {
				$ALUMNOVERIFICADO=$this->Alumnos->verificarAlumno($NUMERO_CONTROL,$nip);
				$NOMBREALUM="";
				$idplantilla=false;
				if($ALUMNOVERIFICADO)
				{
					foreach ($ALUMNOVERIFICADO as $key => $value) {
						$NOMBREALUM=$value->nombre;
					}
					$iddepartamentosAplicaciones=$this->Aplicaciones->cargarAplicacionesPublicas($PERIODOACTUAL);
					if ($iddepartamentosAplicaciones) {
						foreach ($iddepartamentosAplicaciones as $key => $value) {
							$Aplicaciones=$this->Aplicaciones->cargarAplicacionesDepartamento($value->departamento_academico_iddepartamento_academico,$PERIODOACTUAL);
							if ($Aplicaciones) {
								$idAplicacionesActuales[]=$Aplicaciones[0]->idaplicaciones;
								$idplantilla=$Aplicaciones[0]->plantilla_encuestas_idplantilla_encuestas;
							}
						}
						$PROGRESOENCUESTAS=0;
						$ID_ENCUESTAS="";
						//	$TAMANO=count($ENCUESTAS);
						if ($idAplicacionesActuales) {
							for ($i=0; $i < count($idAplicacionesActuales); $i++) {
								$ENCUESTAS= $this->SeguimientoModelo->obtenerEncuestas($idAplicacionesActuales[$i],$NUMERO_CONTROL);
								if ($ENCUESTAS) {
									//	var_dump($ENCUESTAS);
									foreach ($ENCUESTAS as $key => $value) {
										if(!$this->SeguimientoModelo->verificarEncuestaContestada($value->idencuesta_seguimiento,$NUMERO_CONTROL)){
											//	echo "SI CONESTAR <br>";
											$IDAPLICACIONES_ENCUESTAS[]=$value->idencuesta_seguimiento;
										}
									}
								}
							}
						}
						$ID_ENCUESTAS="";
						$TAMANO=0;
						if ($IDAPLICACIONES_ENCUESTAS) {
							$TAMANO=count($IDAPLICACIONES_ENCUESTAS);
							for ($i=0; $i < count($IDAPLICACIONES_ENCUESTAS) ; $i++) {
								if ($i<count($IDAPLICACIONES_ENCUESTAS)-1) {
									$ID_ENCUESTAS.=$IDAPLICACIONES_ENCUESTAS[$i].",";
								}else {
									$ID_ENCUESTAS.=$IDAPLICACIONES_ENCUESTAS[$i];
								}
							}
							$DATOS_ALUMNOS = array(
								'is_logued_in' => true,
								'numero_control' => $NUMERO_CONTROL,
								'nombre_alumno' => $NOMBREALUM,
								'alumno'=>true,
								'idencuestas'=>$ID_ENCUESTAS,
								'progresolimite'=>$TAMANO,
								'progresoactual'=>0,
								'idplantilla'=>$idplantilla
							);
							$this->session->set_userdata($DATOS_ALUMNOS);
							redirect(base_url().'index.php/Seguimiento/contestar/');
						}else {
							$datos["ErrorInicio"]=$this->mensajeError("No cuentas con encuestas de seguimiento en el aula.");
							$this->load->view('encuesta/inicio',$datos);
						}
						//	var_dump($IDAPLICACIONES_ENCUESTAS);
					}else {
						$datos["ErrorInicio"]=$this->mensajeError("No cuentas con encuestas de seguimiento en el aula.");
						$this->load->view('encuesta/inicio',$datos);
					}
				}else {
					$datos["ErrorInicio"]=$this->mensajeError("Error al ingresar el numero de control y/o nip.");
					$this->load->view('encuesta/inicio',$datos);
				}
			}else {
				redirect(base_url().'index.php/Seguimiento/');
			}
		}
		else {
			$datos["mensajesistema"]=$this->mensajeErrorSistema();
			$this->load->view('encuesta/inicio',$datos);
		}

		// $idcarreras="";
		// $sistemaproduccion = $this->Sistema->obtenerproduccion();
		// if ($sistemaproduccion[0]->produccion==1) {
		// 	/* VERIFICAR ALUMNOS */
		// 	$NUMERO_CONTROL=$this->input->post('numero_control');
		// 	$ALUMNOVERIFICADO = $this->Alumnos->verificarAlumno($NUMERO_CONTROL,$this->input->post('contra_aplicacion'));
		// 	//	var_dump($ALUMNOVERIFICADO);
		// 	$NOMBREALUM="";
		// 	if($ALUMNOVERIFICADO)
		// 	{
		// 		foreach ($ALUMNOVERIFICADO as $key => $value) {
		// 			$idcarreras=$value->id_carrera;
		// 			$NOMBREALUM=$value->nombre;
		// 		}
		// 		/* OBTENER DEPARTAMENTO ALUMNO*/
		// 		$IDDEPARTAMENTO=$this->obtenerDepartamentoPorCarrera("'".$idcarreras."'");
		// 		//	var_dump($IDDEPARTAMENTO);
		// 		/*GENERAR PERIODO AUTOMATICO*/
		// 		//$PERIODOACTUAL=$this-> generarPeriodo();
		// 		/*OBTENER PERIODO SII*/
		// 		$PERIODOACTUAL=$this->PeriodoModelo->obtenerPeriodoActual();
		// 		$PERIODOACTUAL=$PERIODOACTUAL[0]->idperiodos;
		// 		//$PERIODOACTUAL="20101";
		// 		/* VERIFICAR SI EXISTE APLICACION EL PERIODO Y DEPARTAMENTO*/
		// 		$APLICACIONVERIFICADA = $this->SeguimientoModelo->verificarAplicacion($PERIODOACTUAL,$IDDEPARTAMENTO);
		// 		$APLICACIONVERIFICADAexterna = $this->SeguimientoModelo->verificarAplicacionExterna($PERIODOACTUAL,$IDDEPARTAMENTO);
		// 		//	var_dump($APLICACIONVERIFICADAexterna);
		// 		//var_dump($APLICACIONVERIFICADA);
		// 		if($APLICACIONVERIFICADA){
		// 			$idaplicaciones="";
		// 			$idplantilla="";
		// 			foreach ($APLICACIONVERIFICADA as $key => $value) {
		// 				if($this->SeguimientoModelo->obtenerEncuestas($value->idaplicaciones,$NUMERO_CONTROL)){
		//
		// 					$idaplicaciones=$value->idaplicaciones;
		// 					$idplantilla=$value->plantilla_encuestas_idplantilla_encuestas;
		// 				}
		// 			}
		// 			$idaplicacionesEXT="";
		// 			$idplantillaEXT="";
		// 			$ENCUESTASext=false;
		// 			if($APLICACIONVERIFICADAexterna){
		// 				foreach ($APLICACIONVERIFICADAexterna as $key => $value) {
		// 					if($this->SeguimientoModelo->obtenerEncuestas($value->idaplicaciones,$NUMERO_CONTROL)){
		// 						$idaplicacionesEXT=$value->idaplicaciones;
		// 						$idplantillaEXT=$value->plantilla_encuestas_idplantilla_encuestas;
		// 					}
		// 				}
		// 			}
		// 			if($idaplicaciones!=""){
		// 				$ENCUESTAS= $this->SeguimientoModelo->obtenerEncuestas($idaplicaciones,$NUMERO_CONTROL);
		// 				if($idaplicacionesEXT!=""){
		// 					$ENCUESTASext= $this->SeguimientoModelo->obtenerEncuestas($idaplicacionesEXT,$NUMERO_CONTROL);
		// 				}
		// 			}else {
		// 				$ENCUESTAS=false;
		// 			}
		// 			//		var_dump($ENCUESTAS);
		// 			if($ENCUESTAS){
		// 				$PROGRESOENCUESTAS=0;
		// 				//	echo "$IDDEPARTAMENTO $PERIODOACTUAL $idaplicaciones  $idplantilla ";
		// 				//echo "EXISTE <br>";
		// 				$ID_ENCUESTAS="";
		// 				$TAMANO=count($ENCUESTAS); // OBTENER EL TAMAÑO
		// 				$POSENCUESTAS=0; //
		// 				/* CONCATENAR ID ENCUESTAS*/
		// 				foreach ($ENCUESTAS as $key => $value) {
		// 					//$this->consolaLOG("".$value->idencuesta_seguimiento."");
		// 					/* VERIFICAR SI YA FUE CONTESTADA */
		// 					if(!$this->SeguimientoModelo->verificarEncuestaContestada($value->idencuesta_seguimiento,$NUMERO_CONTROL)){
		// 						if($POSENCUESTAS<$TAMANO-1)
		// 						{
		// 							$ID_ENCUESTAS.=$value->idencuesta_seguimiento.",";
		// 						}else {
		// 							if($ENCUESTASext){
		// 								$ID_ENCUESTAS.=$value->idencuesta_seguimiento.",";
		// 							}else {
		// 								$ID_ENCUESTAS.=$value->idencuesta_seguimiento;
		// 							}
		// 						}
		// 						$PROGRESOENCUESTAS++;
		// 						$POSENCUESTAS++;
		// 					}else {
		// 					}
		// 				}
		// 				$POSENCUESTAS=0;
		// 				if ($ENCUESTASext) {
		// 					$TAMANO2=count($ENCUESTASext);
		// 					foreach ($ENCUESTASext as $key => $value) {
		// 						if(!$this->SeguimientoModelo->verificarEncuestaContestada($value->idencuesta_seguimiento,$NUMERO_CONTROL)){
		// 							if($POSENCUESTAS<$TAMANO2-1)
		// 							{
		// 								$ID_ENCUESTAS.=$value->idencuesta_seguimiento.",";
		//
		// 							}else {
		// 								$ID_ENCUESTAS.=$value->idencuesta_seguimiento;
		// 							}
		// 							$PROGRESOENCUESTAS++;
		// 							$POSENCUESTAS++;
		// 						}else {
		// 						}
		// 					}
		// 				}
		// 				//	echo "$ID_ENCUESTAS";
		// 				//$this->consolaLOG("ID ENCUESTAS: ".$ID_ENCUESTAS);
		// 				$DATOS_ALUMNOS = array(
		// 					'is_logued_in' => true,
		// 					'numero_control' => $NUMERO_CONTROL,
		// 					'nombre_alumno' => $NOMBREALUM,
		// 					'alumno'=>true,
		// 					'idencuestas'=>$ID_ENCUESTAS,
		// 					'progresolimite'=>$PROGRESOENCUESTAS,
		// 					'progresoactual'=>0,
		// 					'idplantilla'=>$idplantilla
		// 				);
		// 				$this->session->set_userdata($DATOS_ALUMNOS);
		// 				redirect(base_url().'index.php/Seguimiento/contestar/');
		// 			}else{
		// 				$IDDEPARTAMENTO=$this->obtenerDepartamentoPorCarrera("'".$idcarreras."'");
		// 				$PERIODOACTUAL=$this->PeriodoModelo->obtenerPeriodoActual();
		// 				$PERIODOACTUAL=$PERIODOACTUAL[0]->idperiodos;
		// 				$APLICACIONVERIFICADAexterna = $this->SeguimientoModelo->verificarAplicacionExterna($PERIODOACTUAL,$IDDEPARTAMENTO);
		// 				if($APLICACIONVERIFICADAexterna){
		// 					$idaplicacionesEXT="";
		// 					$idplantillaEXT="";
		// 					$ENCUESTASext=false;
		// 					if($APLICACIONVERIFICADAexterna){
		// 						foreach ($APLICACIONVERIFICADAexterna as $key => $value) {
		// 							if($this->SeguimientoModelo->obtenerEncuestas($value->idaplicaciones,$NUMERO_CONTROL)){
		// 								$idaplicacionesEXT=$value->idaplicaciones;
		// 								$idplantillaEXT=$value->plantilla_encuestas_idplantilla_encuestas;
		// 							}
		// 						}
		// 					}
		// 					if($idaplicacionesEXT!=""){
		// 						$ENCUESTASext= $this->SeguimientoModelo->obtenerEncuestas($idaplicacionesEXT,$NUMERO_CONTROL);
		// 						if ($ENCUESTASext) {
		// 							$TAMANO2=count($ENCUESTASext);
		// 							foreach ($ENCUESTASext as $key => $value) {
		// 								if(!$this->SeguimientoModelo->verificarEncuestaContestada($value->idencuesta_seguimiento,$NUMERO_CONTROL)){
		// 									if($POSENCUESTAS<$TAMANO2-1)
		// 									{
		// 										$ID_ENCUESTAS.=$value->idencuesta_seguimiento.",";
		//
		// 									}else {
		// 										$ID_ENCUESTAS.=$value->idencuesta_seguimiento;
		// 									}
		// 									$PROGRESOENCUESTAS++;
		// 									$POSENCUESTAS++;
		// 								}
		// 							}
		// 						}
		// 						$DATOS_ALUMNOS = array(
		// 							'is_logued_in' => true,
		// 							'numero_control' => $NUMERO_CONTROL,
		// 							'nombre_alumno' => $NOMBREALUM,
		// 							'alumno'=>true,
		// 							'idencuestas'=>$ID_ENCUESTAS,
		// 							'progresolimite'=>$PROGRESOENCUESTAS,
		// 							'progresoactual'=>0,
		// 							'idplantilla'=>$idplantilla
		// 						);
		// 						$this->session->set_userdata($DATOS_ALUMNOS);
		// 						redirect(base_url().'index.php/Seguimiento/contestar/');
		// 					}
		// 					else {
		// 						$datos["ErrorInicio"]=$this->mensajeError("No cuentas con encuesta hasta el momento");
		// 						$this->load->view('encuesta/inicio',$datos);
		// 					}
		// 				}else {
		// 					$datos["ErrorInicio"]=$this->mensajeError("No cuentas con encuesta hasta el momento");
		// 					$this->load->view('encuesta/inicio',$datos);
		// 				}
		// 			}
		// 			/* OBTENER LAS APLICACIONES CORE*/
		// 		}else {
		// 			$datos["ErrorInicio"]=$this->mensajeError(" Error con la contraseña de la aplicacion y/o la aplicacion no existe.");
		// 			$this->load->view('encuesta/inicio',$datos);
		// 		}
		// 	}else {
		// 		$datos["ErrorInicio"]=$this->mensajeError("Error al ingresar el numero de control.");
		// 		$this->load->view('encuesta/inicio',$datos);
		// 	}
		// }else {
		// 	$datos["mensajesistema"]=$this->mensajeErrorSistema();
		// 	$this->load->view('encuesta/inicio',$datos);
		// }
	}
	public function obtenerDepartamentoPorCarrera($idCarrera)
	{
		$departamento=$this->Departamentos->obtenerDepartamentoPorCarrera($idCarrera);
		$DepartamentoEnviar=$departamento[0]->departamento_academico_iddepartamento_academico;
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

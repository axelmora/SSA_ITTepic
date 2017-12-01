<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->model('SeguimientoModelo');
		$this->load->model('Materia');
		$this->load->model('Docentes');
		$this->load->model('Alumnos');
		$this->load->model('Departamentos');
		$this->load->model('Mesa_AyudaModel');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$this->load->view('ssainicio');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function aplicaciones()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarAplicaciones($this->session->userdata('departamento'));
			$datos["AplicacionesPerido"]=$this->SeguimientoModelo->cargarAplicacionesPeriodo($this->session->userdata('departamento'),$this->session->userdata('periodosemestre'));
			if($datos["Aplicaciones"]!=false)
			{
				$valorescontados;
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$valor=$this->SeguimientoModelo->contarEncuestas($value->idaplicaciones);
					foreach ($valor as $key => $nuermos) {
						$valorescontados[]=$nuermos->numero;
					}
				}
				$datos["Cantidad_Encuestas"]=$valorescontados;
			}
			$this->load->view('aplicaciones',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function generarAplicacion()
	{
		$Contras=$this->SeguimientoModelo->verificarAplicacionContasena($this->session->userdata('periodosemestre'),$this->session->userdata('departamento'));
		$Error=false;
		$Contra="";
		foreach ($Contras as $key => $value) {
			if($this->input->post('contrasenaapp')==$value->contrasena){
				$Error=true;
			}
		}
		if($Error)
		{
			$datos["ErrorContra"]="Ya existe una aplicacion con la misma contraseña.";
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarAplicaciones($this->session->userdata('departamento'));
			$datos["AplicacionesPerido"]=$this->SeguimientoModelo->cargarAplicaciones($this->session->userdata('departamento'),$this->session->userdata('periodo'));
			//$datos["Cantidad_Encuestas"]="";
			if($datos["Aplicaciones"]!=false)
			{
				$valorescontados;
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$valor=$this->SeguimientoModelo->contarEncuestas($value->idaplicaciones);
					foreach ($valor as $key => $nuermos) {
						$valorescontados[]=$nuermos->numero;
					}
				}
				$datos["Cantidad_Encuestas"]=$valorescontados;
			}
			if ($this->session->userdata('tipo')=='1') {
				$this->load->view('aplicaciones',$datos);
			}else {
				if ($this->session->userdata('tipo')=='2') {
					$this->load->view('aplicaciones',$datos);
				}
				else {
					redirect(base_url().'index.php');
				}
			}
		}else {
			$Contra=$this->input->post('contrasenaapp');
			$datos= array(
				'contrasena' => ''.$Contra,
				'plantilla_encuestas_idplantilla_encuestas' => ''.$this->input->post('plantilla'),
				'fecha_creacion' => ''.date('Y-m-d H:i:s'),
				'periodo'=> ''.$this->session->userdata('periodosemestre'),
				'departamento_academico_iddepartamento_academico'=> ''.$this->session->userdata('departamento')
			);
			$this->SeguimientoModelo->crearAplicacion($datos);
			if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
				redirect(base_url().'index.php/Panel_seguimiento/aplicaciones');
			}else {
				redirect(base_url().'index.php');
			}
		}
	}
	public function listado($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
			$datos["AplicacionData"]=$idAplicacion;
			$NumeroTotal;
			$ActualContestados;
			if($datos["Aplicaciones"])
			{
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$tempTotal=$this->SeguimientoModelo->contadorAlumnosGrupo($value->idencuesta_seguimiento);
					$NumeroTotal[]=$tempTotal[0]->total;
					$tempContestados=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
					$ActualContestados[]=$tempContestados[0]->total;

				}
				$datos["totalAlumnos"]=$NumeroTotal;
				$datos["totalContestados"]=$ActualContestados;
			}else {

			}
			$this->load->view('aplicaciones_lista',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function nuevo_grupo($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$depa=$this->obtenerDepartamento($this->session->userdata('departamento'));
			//	$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$datos["MateriasExistentes"]=$this->Materia->cargarMateriasDepartamento($this->session->userdata('departamento'));
			$datos["Docentes"]=$this->Docentes->cargarDocentesDepartamento($depa);
			$datos["AlumnosCopiar"]=$this->SeguimientoModelo->cargarEncuestasGrupos($idAplicacion);
			$datos["AplicacionDatos"]=$idAplicacion;
			$datos["AlumnosCargados"]=$this->obtenerAlumnosPorDepartamento($this->session->userdata('departamento'));
			$this->load->view('aplicaciones_add_grupo',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function obtenerAlumnosSeguimiento($idseguimiento)
	{
		$grupo=$this->SeguimientoModelo->obtenerGrupoPorSeguimiento($idseguimiento);
		$alumnos=$this->SeguimientoModelo->getAlumnosEncuesta($grupo[0]->idgrupos);
		echo json_encode($alumnos);
		//var_dump($alumnos);
	}
	/*  INSERTAR MATERIA */
	public function insertarMateria()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos= array(
				'nombre_materia' => ''.strtoupper($this->input->post('nombre_materia')),
				'departamento_academico_iddepartamento_academico'=> ''.$this->session->userdata('departamento')
			);
			$this->Materia->insertarMateria($datos);
			$datos['idmaterias']=$this->Materia->ultimaMateriaAgregadaDepa($this->session->userdata('departamento'));
			$idenviar="";
			foreach ($datos['idmaterias'] as $key => $value) {
				$idenviar = array("idmateria"=>$value->maximo);
			}
			echo json_encode($idenviar);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function obtenerDepartamento($departamentoid)
	{
		$departamentoRetorno="";
		switch ($departamentoid) {
			case '2':
			$departamentoRetorno="DEPARTAMENTO DE CIENCIAS DE LA TIERRA";
			break;
			case '3':
			$departamentoRetorno="DEPARTAMENTO DE SISTEMAS Y COMPUTACION";
			break;
			case '4':
			$departamentoRetorno="DEPARTAMENTO DE QUIMICA Y BIOQUIMICA";
			break;
			case '5':
			$departamentoRetorno="DEPTO. DE INGENIERIA INDUSTRIAL";
			break;
			case '6':
			$departamentoRetorno="DEPARTAMENTO DE INGENIERIA ELECTRICA Y ELECTRONICA";
			break;
			case '7':
			$departamentoRetorno="DEPARTAMENTO DE INGENIERIAS";
			break;
			case '8':
			$departamentoRetorno="DEPARTAMENTO DE CIENCIAS ECONOMICO ADMINISTRATIVAS";
			break;
			default:
			$departamentoRetorno="DEPARTAMENTO DE SISTEMAS Y COMPUTACION";
			break;
		}
		return $departamentoRetorno;
	}
	public function obtenerAlumnosPorDepartamento($departamentoid)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$AlumosEnviar;
			$idenviar="";
			$carreras=$this->Departamentos->obtenerCarrerasDepartamento($departamentoid);
			$tamano=count($carreras);
			$pos=0;
			foreach ($carreras as $key => $value) {
				if($pos<$tamano-1){
					$idenviar.="".$value->carreras_id_carrera.",";
				}else {
					$idenviar.="".$value->carreras_id_carrera;
				}
				$pos++;
			}
			$AlumosEnviar=$this->Alumnos->cargarAlumnosDosCarreras($idenviar);
			return $AlumosEnviar;
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function insertarSeguimientoGrupo($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			/*CREACION SEGUIMIENTO*/
			$Seguimiento= array(
				'fecha_creacion' => ''.date('Y-m-d H:i:s'),
				'aplicaciones_idaplicaciones' => ''.$idAplicacion,
				'materias_idmaterias' => ''.$this->input->post('idmateria'),
				'docentes_rfc' => ''.$this->input->post('rfcdocente')
			);
			$this->SeguimientoModelo->crearSeguimiento($Seguimiento);
			$idSeguimientoCreado=$this->SeguimientoModelo->obtenerIdSeguimiento();
			$UltimoID="";
			foreach ($idSeguimientoCreado as $key => $id) {
				$UltimoID=$id->maximo;
			}
			/*CREACION GRUPO*/
			$GrupoData= array("encuestas_seguimiento_idencuesta_seguimiento"=>$UltimoID);
			$this->SeguimientoModelo->crearGrupo($GrupoData);
			$idGrupóCreado=$this->SeguimientoModelo->obtenerIdGrupo();
			$UltimoIDg="";
			foreach ($idSeguimientoCreado as $key => $id) {
				$UltimoIDg=$id->maximo;
			}
			/*CREACION GRUPO*/
			/*CREACION GRUPO-ALUMNOS*/
			$NumerosDeControl = explode(',', $this->input->post('numero_control_alumnos'));
			$GrupoAlumnosNumeros =array();
			for ($i=0; $i < count($NumerosDeControl) ; $i++) {
				$GrupoAlumnosNumeros[]=array("alumnos_numero_control"=>$NumerosDeControl[$i],"grupos_idgrupos"=>$UltimoIDg);
			}
			$this->SeguimientoModelo->insertarGrupos($GrupoAlumnosNumeros);
			/*CREACION GRUPO-ALUMNOS FIN*/
			redirect(base_url().'index.php/Panel_seguimiento/gestionarGrupo/'.$UltimoID.'');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function gestionarGrupo($idGrupo)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idGrupo);
			$ALUMNOSCONTESTADOS;
			if($datos["ALUMNOSGRUPO"] ){
				$idEncuesta=$datos["ALUMNOSGRUPO"][0]->encuestas_seguimiento_idencuesta_seguimiento;
				foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
					if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->alumnos_numero_control,$idEncuesta))
					{
						$ALUMNOSCONTESTADOS[]=true;
					}else {
						$ALUMNOSCONTESTADOS[]=false;
					}
				}
				$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			}
			$idSeguimiento=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idGrupo);
			$datos["idEncuesta"]=$idSeguimiento[0]->aplicaciones_idaplicaciones;
			$datos["IDGRUPO"]=$idGrupo;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idGrupo);
			$this->load->view('aplicaciones_grupos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function agregarAlumnosGrupo($idGrupo)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idGrupo);
			$datos["IDGRUPO"]=$idGrupo;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idGrupo);
			$datos["AlumnosCargados"]=$this->obtenerAlumnosPorDepartamento($this->session->userdata('departamento'));
			$this->load->view('aplicaciones_add_grupo_alumnos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionlista($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
			$datos["AplicacionData"]=$idAplicacion;
			$this->load->view('aplicaciones_lista_retro',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionseguimiento($idaplicacion)
	{
		// $json=json_decode(file_get_contents('file/json/seguimiento1.json'));
		// // echo "".	$datos["EstructuaEncuesta"]->Seguimiento->"1"->tipo;
		// //echo "".$json["Seguimiento"]["1"][0] ;
		// //print_r($json);
		// foreach ($json as $key => $value) {
		// 	foreach ($value as $key => $value2) {
		// 		echo "TIPO:   ".$value2->tipo." <br> ".$value2->pregunta." <br>";
		// 		if($value2->tipo=="tabla")
		// 		{
		// 			foreach ($value2->subpreguntas as $key => $value3) {
		// 				echo "__".$value3->pregunta."   ".$value3->name."  <br>  ";
		// 				if($value3->tipo=="radio")
		// 				{
		// 					foreach ($value3->respuesta as $key => $value4) {
		// 						echo "R:".$value4->texto." ";
		// 					}
		// 				}
		// 				echo "<br>";
		// 			}
		// 		}else {
		// 			if($value2->tipo=="radio"){
		// 				foreach ($value2->respuesta as $key => $value3) {
		// 					echo "R____:".$value3->texto."                  _";
		// 				}
		// 			}
		// 		}
		// 	}
		// }
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idaplicacion);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idaplicacion);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idaplicacion);
			$this->load->model('GeneradorEncuestas');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idaplicacion);
			$datos["idRetroAlimntacion"]=$idaplicacion;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			$this->load->view('aplicaciones_retro',$datos);
		}else {
			redirect(base_url().'index.php');
		}
		//echo "".$json->preguntas[0]->tipo." <br> ".$json->preguntas[0]->pregunta;
	}
	public function guardaretroAlimentacion($idretro)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('id');
			$retro=$this->input->post('retroalimentacion');
			$fecha=date('Y-m-d H:i:s');
			$this->SeguimientoModelo->actualizarRetro($idretro,$retro,$fecha);
			redirect(base_url().'index.php/Panel_seguimiento/retroalimentacionlista/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionseguimientocon($idaplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idaplicacion);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idaplicacion);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idaplicacion);

			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idaplicacion);
			$datos["idRetroAlimntacion"]=$idaplicacion;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$this->load->model('GeneradorEncuestas');
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			$this->load->view('aplicaciones_retro_m',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function guardaretroAlimentacionContinua($idretro)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('id');
			$retro=$this->input->post('retroalimentacion');
			$fecha=date('Y-m-d H:i:s');
			$this->SeguimientoModelo->actualizarRetro($idretro,$retro,$fecha);
			redirect(base_url().'index.php/Panel_seguimiento/retroalimentacioncontinua/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacioncontinua($idaplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idenviar=1;
			$idarreglo;
			$arreloaumnos;
			$idfinales;
			$datos=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idaplicacion);
			if($datos)
			{
				$poosi=0;
				foreach ($datos as $key => $value) {
					if($value->retroalimentacion=="")
					{
						$d=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
						foreach ($d as $key => $value2) {
							$arreloaumnos[]=$value2->total;
						}
						$idarreglo[]=$value->idencuesta_seguimiento;
					}
				}
				for($i=0;$i<count($idarreglo);$i++)
				{
					if($arreloaumnos[$i]>0){
						$idfinales[]=$idarreglo[$i];
					}
				}
				if(isset($idfinales))
				{
					$this->retroalimentacionseguimientocon($idfinales[0]);
				}else {
					redirect(base_url().'index.php/Panel_seguimiento/retroalimentacionlista/'.$idaplicacion);
				}
			}else {
				redirect(base_url().'index.php/Panel_seguimiento/retroalimentacionlista/'.$idaplicacion);
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function manual_usuario($value='')
	{
		if ($this->session->userdata('tipo')=='2') {
			$this->load->view('manual_usuariovista');
		}
		else {
			redirect(base_url().'index.php');
		}
	}
	public function docentes()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$depa=$this->obtenerDepartamento($this->session->userdata('departamento'));
			$datos["DOCENTES"]=$this->Docentes->cargarDocentesDepartamento($depa);
			$this->load->view('seg_docentes',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function alumnos()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AlumnosCargados"]=$this->obtenerAlumnosPorDepartamento($this->session->userdata('departamento'));
			$this->load->view('seg_alumnos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function materias()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["MATERIAS"]=$this->Materia->cargarMateriasDepartamento($this->session->userdata('departamento'));
			$this->load->view('seg_materias',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	/* Elimar grupo inicio*/
	public function eliminarEncuestaDatos($idEncuesta)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos=$this->SeguimientoModelo->obtenerDocenteMateria($idEncuesta);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaDatosAplicacion($idEncuesta)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idEncuesta);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaGrupo()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('idAplicacionPostEliminar');
			$idEliminarEncur=$this->input->post('idEliminarEncu');
			$this->SeguimientoModelo->borrarEncuestaSeguimiento($idEliminarEncur);
			redirect(base_url().'index.php/Panel_seguimiento/listado/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaSeguimientoCompleta()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idAplicaciones=$this->input->post('idAplicacionesBorrar');
			$this->SeguimientoModelo->borrarAplicacionSeguimiento($idAplicaciones);
			redirect(base_url().'index.php/Panel_seguimiento/aplicaciones/');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function resulados($idSeguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idSeguimiento);
			$ALUMNOSCONTESTADOS;
			foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
				if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->alumnos_numero_control,$idSeguimiento))
				{
					$ALUMNOSCONTESTADOS[]=true;
				}else {
					$ALUMNOSCONTESTADOS[]=false;
				}
			}
			$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idSeguimiento);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idSeguimiento);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idSeguimiento);
			$this->load->model('GeneradorEncuestas');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idSeguimiento);
			$datos["idEncuesta"]=$datos["idSegui"][0]->aplicaciones_idaplicaciones;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			$this->load->view('aplicaciones_resultados',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	/* Elimar grupo fin*/
	public function reportesAplicacion($idAplicaciones)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicaciones);
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicaciones);
			$datos["AplicacionData"]=$idAplicaciones;
			$NumeroTotal;
			$ActualContestados;
			if($datos["Aplicaciones"])
			{
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$tempTotal=$this->SeguimientoModelo->contadorAlumnosGrupo($value->idencuesta_seguimiento);
					$NumeroTotal[]=$tempTotal[0]->total;
					$tempContestados=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
					$ActualContestados[]=$tempContestados[0]->total;
				}
				$datos["totalAlumnos"]=$NumeroTotal;
				$datos["totalContestados"]=$ActualContestados;
			}else {
			}
			$datos["DOCENTES"]=$this->SeguimientoModelo->docentesReportes($idAplicaciones);
			$this->load->view('aplicaciones_reportes',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reporteGeneradorAplicacion($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$datos["APLICACIONESCONSULTADAS"]=$this->SeguimientoModelo->reportesAplicacionesGeneral($idAplicacion);
			$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idAplicacion);
			$peridoencuesta=$this->genePerido($tempperiodo[0]->periodo);
			$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
			$this->load->model('GeneradorEncuestas');
			$EncuestasIMPRIMIR;
			if($datos["APLICACIONESCONSULTADAS"]){
				foreach ($datos["APLICACIONESCONSULTADAS"] as $key => $value) {
					$resultados=$this->SeguimientoModelo->resultadosEncuesta($value->idencuesta_seguimiento);
					$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
					$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($value->idencuesta_seguimiento);
					$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($value->idencuesta_seguimiento);
					$DOCENTE="";
					$MATERIA="";
					if(isset($datos["DATOSMATERIA"])){
						foreach ($datos["DATOSMATERIA"] as $key => $value) {
							$DOCENTE="". utf8_decode($value->nombres." ".$value->apellidos);
							$MATERIA="".$value->nombre_materia ;
						}
					}else {
						$DOCENTE="ERROR";
						$MATERIA="ERROR";
					}
					$temphtml= "<table  class='' width='100%' cellspacing='0' >
					<thead>
					<tr>
					<th> MATERIA</th>
					<th> DOCENTE</th>
					</tr>
					</thead>
					<tr>
					<td>  $MATERIA</td>
					<td>  $DOCENTE</td>
					</tr>
					</table>
					";
					$temphtml.= $datos["EncuestasResultados"];
					if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
						$temphtml.= "\n";
						$temphtml.= "<b>Retroalimentación</b>";
						$temphtml.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
					}
					$EncuestasIMPRIMIR[]=$temphtml;
				}
			}else {
				$EncuestasIMPRIMIR[0]="<p style='font-size: 250%;'>No existen materias en esta aplicacion.</p>";
			}
			/*    CARGAR DATOS      */
			$this->load->library('Pdf');
			$resolution = array(216, 279);
			$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->SetAuthor('Fernando Manuel Avila Cataño');
			$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula - Docente');
			$pdf->SetSubject('Seguimiento en el aula reporte');
			$pdf->SetKeywords('Reporte, docente, seguimiento, en, el , aula');
			$image_file = 'cabecera.png';
			$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(true);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
			$resolution = array(279, 216);
			$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
			$html = '';
			for ($i=0; $i < count($EncuestasIMPRIMIR) ; $i++) {
				$html.='
				<table style="height: 53px;" width="100%"  border="0">
				<tbody>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"> </td>
				</tr>
				</tbody>
				</table>';
				$html .= "<style type=text/css>";
				$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
				$html .= "td{background-color: #FFF; color: #000; border: 1px solid black}";
				$html .= "</style>";
				$html .= "<table  class='' cellspacing='0' >";
				$html.=$EncuestasIMPRIMIR[$i];
				$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
				$html="";
				if( $i <count($EncuestasIMPRIMIR)-1){
					$pdf->AddPage();
				}
			}
			$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_general.pdf");
			$pdf->Output($nombre_archivo, 'I');
		}else {
			redirect(base_url().'index.php');
		}
	}
	function reporteDocenteGenerador($rfcdoncete,$idAplicaciones) {
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			/*    CARGAR DATOS      */
			$idAplicacionesGenerar=$this->SeguimientoModelo->reporteDocentePDFMaterias($rfcdoncete,$idAplicaciones);
			$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacionesGenerar[0]->aplicaciones_idaplicaciones);
			$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idAplicacionesGenerar[0]->aplicaciones_idaplicaciones);
			$peridoencuesta=$this->genePerido($tempperiodo[0]->periodo);
			$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
			$this->load->model('GeneradorEncuestas');
			$EncuestasIMPRIMIR;
			if($idAplicacionesGenerar){
				foreach ($idAplicacionesGenerar as $key => $value) {
					$resultados=$this->SeguimientoModelo->resultadosEncuesta($value->idencuesta_seguimiento);
					$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
					$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($value->idencuesta_seguimiento);
					$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($value->idencuesta_seguimiento);
					$DOCENTE="";
					$MATERIA="";
					if(isset($datos["DATOSMATERIA"])){
						foreach ($datos["DATOSMATERIA"] as $key => $value) {
							$DOCENTE="".$value->nombres." ".$value->apellidos;
							$MATERIA="".$value->nombre_materia ;
						}
					}else {
						$DOCENTE="ERROR";
						$MATERIA="ERROR";
					}
					$temphtml= "    <table  class='' cellspacing='0' >
					<thead>
					<tr>
					<th> MATERIA</th>
					<th> DOCENTE</th>
					</tr>
					</thead>
					<tr>
					<td>  $MATERIA</td>
					<td>  $DOCENTE</td>
					</tr>
					</table>

					";
					$temphtml.= $datos["EncuestasResultados"];
					if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
						$temphtml.= "<p>";
						$temphtml.= "<b>Retroalimentación</b>";
						$temphtml.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
					}
					$EncuestasIMPRIMIR[]=$temphtml;
				}
			}else {
				$EncuestasIMPRIMIR[0]="Error al generar reporte";
			}
			/*    CARGAR DATOS      */
			$this->load->library('Pdf');
			$resolution = array(216, 279);
			$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->SetAuthor('Fernando Manuel Avila Cataño');
			$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula - Docente');
			$pdf->SetSubject('Seguimiento en el aula reporte');
			$pdf->SetKeywords('Reporte, docente, seguimiento, en, el , aula');
			$image_file = 'cabecera.png';
			$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(true);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
			$resolution = array(279, 216);
			$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
			$html = '';
			for ($i=0; $i < count($EncuestasIMPRIMIR) ; $i++) {
				$html.='
				<table style="height: 53px;" width="100%"  border="0">
				<tbody>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"> </td>
				</tr>
				</tbody>
				</table>';
				$html .= "<style type=text/css>";
				$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
				$html .= "td{background-color: #FFF; color: #000; border: 1px solid black}";
				$html .= "</style>";
				$html .= "<table  class='' cellspacing='0' >";
				$html.=$EncuestasIMPRIMIR[$i];
				$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
				$html="";
				if( $i <count($EncuestasIMPRIMIR)-1){
					$pdf->AddPage();
				}
			}
			$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_docente.pdf");
			$pdf->Output($nombre_archivo, 'I');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reporteIndividual($idencuesta_seguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			/*    CARGAR DATOS      */
			$this->load->model('GeneradorEncuestas');

			$idseguimientotemp=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idencuesta_seguimiento);
			$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idseguimientotemp[0]->aplicaciones_idaplicaciones);
			$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idseguimientotemp[0]->aplicaciones_idaplicaciones);
			$peridoencuesta=$this->genePerido($tempperiodo[0]->periodo);
			$departamentoacademico=$tempdepartamento[0]->nombre_departamento;

			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idencuesta_seguimiento);
			$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idencuesta_seguimiento);
			$DOCENTE="";
			$MATERIA="";
			if(isset($datos["DATOSMATERIA"])){
				foreach ($datos["DATOSMATERIA"] as $key => $value) {
					$DOCENTE="".utf8_decode($value->nombres." ".$value->apellidos);
					$MATERIA="".$value->nombre_materia ;
				}
			}else {
				$DOCENTE="ERROR";
				$MATERIA="ERROR";
			}
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idencuesta_seguimiento);
			/*    CARGAR DATOS      */
			$this->load->library('Pdf');
			$resolution = array(216, 279);
			$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->SetAuthor('Fernando Manuel Avila Cataño');
			$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula');
			$pdf->SetSubject('Seguimiento en el aula reporte');
			$pdf->SetKeywords('Reporte, individual, ');
			$image_file = 'cabecera.png';
			$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(true);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
			$resolution = array(279, 216);
			$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
			$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
			$html = '';
			$html.='
			<table style="height: 53px;" width="100%"  border="0">
			<tbody>
			<tr>
			<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
			</tr>
			<tr>
			<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
			</tr>
			<tr>
			<td style="text-align: center; border:none; width: 100%;"> </td>
			</tr>
			</tbody>
			</table>';
			$html .= "<style type=text/css>";
			$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
			$html .= "td{background-color: #FFF; color: #000; border: 1px solid black}";
			$html .= "</style>";
			$html .= "    <table  class='' cellspacing='0' >
			<thead>
			<tr>
			<th> MATERIA</th>
			<th> DOCENTE</th>
			</tr>
			</thead>
			<tr>
			<td>  $MATERIA</td>
			<td>  $DOCENTE</td>
			</tr>
			</table>
			";
			$html.= $datos["EncuestasResultados"];
			if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
				$html.= "\n";
				$html.= "<b>Retroalimentación</b>";
				$html.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
			}
			$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
			$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_individual.pdf");
			$pdf->Output($nombre_archivo, 'I');
		}else {
			redirect(base_url().'index.php');
		}
	}
	function borrarAlumnosNumeroControl()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$numero_control=$this->input->post('numero_Control_eliminar');
			$idencuesta=$this->input->post('idGrupoEnviar');
			$idgrupo=$this->SeguimientoModelo->getGrupoPorEncuesta($idencuesta);
			$this->SeguimientoModelo->deleteEncuestaAlumno($numero_control,$idencuesta);
			$this->SeguimientoModelo->deleteAlumnoGrupo($numero_control,$idgrupo[0]->idgrupos);
			redirect(base_url().'index.php/Panel_seguimiento/gestionarGrupo/'.$idencuesta);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reactivaralumno()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$numero_control=$this->input->post('numero_Control_reactivar');
			$idencuesta=$this->input->post('idGrupoEnviar');
			$resultados=$this->SeguimientoModelo->deleteEncuestaAlumno($numero_control,$idencuesta);
			redirect(base_url().'index.php/Panel_seguimiento/gestionarGrupo/'.$idencuesta);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function datosAlumno($numero_control)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$resultados=$this->Alumnos->getAlumno($numero_control);
			echo json_encode($resultados);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function addAlumnos($idseguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			if($this->input->post('numero_control_alumnos')!=""){
				$idgrupo=$this->SeguimientoModelo->getGrupoPorEncuesta($idseguimiento);
				$NumerosDeControl = explode(',', $this->input->post('numero_control_alumnos'));
				$GrupoAlumnosNumeros =array();
				if(count($NumerosDeControl)>0){
					for ($i=0; $i < count($NumerosDeControl) ; $i++) {
						if($this->SeguimientoModelo->verificarAlumnoGrupoDB($NumerosDeControl[$i],$idgrupo[0]->idgrupos)){
							$GrupoAlumnosNumeros[]=array("alumnos_numero_control"=>$NumerosDeControl[$i],"grupos_idgrupos"=>$idgrupo[0]->idgrupos);
						}
					}
					if(count($GrupoAlumnosNumeros)>0){
						$this->SeguimientoModelo->insertarGrupos($GrupoAlumnosNumeros);
					}
				}
			}
			redirect(base_url().'index.php/Panel_seguimiento/gestionarGrupo/'.$idseguimiento);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function soporte_tecnico()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["MENSAJESENVIADOS"]=$this->Mesa_AyudaModel->cargarSolicitudesDeSoporte($this->session->userdata('idusuarios'));
			$this->load->view('mesa_ayuda_usuario',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function soporte_respuesta($idsoporte)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$datos['asuntos'] = $this->Mesa_AyudaModel->mostrarAsuntosUnico($idsoporte);
			$datos['respuestas'] = $this->Mesa_AyudaModel->mostrarMensjesAunsto($idsoporte);
			$this->load->view('soporte_individual',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function borrarMensajeprincipal($mensaje)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$this->Mesa_AyudaModel->borarMensajeSoporte($mensaje);
			redirect(base_url().'index.php/Panel_seguimiento/soporte_tecnico');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function cambiarEstadoMensaje()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$idmensaje = $this->input->post('idmensaje');
			$nuevoestado = $this->input->post('estado');
			$this->Mesa_AyudaModel->cambioEstado($idmensaje,$nuevoestado);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function respuesta($idmensajeprincipal)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$respus = $this->input->post('respuestamesaje');
			$iduser=$this->session->userdata('idusuarios');
			$this->Mesa_AyudaModel->insertarRespuesta($idmensajeprincipal,$respus,$iduser);
			redirect(base_url().'index.php/Panel_seguimiento/soporte_respuesta/'.$idmensajeprincipal);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function borrarRespuesta($mensaje)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$idmensajeprincipal = $this->input->post('idmensajeprincipal_b');
			$this->Mesa_AyudaModel->borarMensajeRespuesta($mensaje);
			redirect(base_url().'index.php/Panel_seguimiento/soporte_respuesta/'.$idmensajeprincipal);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function gestion_del_curso()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$this->load->view('procedimiento_gestion_del_curso');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function obtenerAlumnosSelecionados()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$numeros_control = $this->input->post('numeros_control');
			$datos=$this->Alumnos->cargarAlumnosNumeroeControl($numeros_control);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	function genePerido($periodo)
	{
		$anioac = substr($periodo, 0,strlen($periodo)-1);
		$peridotTexto="";
		if($periodo==$anioac."1")
		{
			$peridotTexto="Enero-Junio ".$anioac;
		}
		else {
			if($periodo==$anioac."2")
			{
				$peridotTexto="Verano ".$anioac;
			}
			else {
				if($periodo==$anioac."3")
				{
					$peridotTexto="Agosto-Diciembre ".$anioac;
				}
			}
		}
		return $peridotTexto;
	}
}

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
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('ssainicio');
		}else {
			if ($this->session->userdata('tipo')=='2') {
				$this->load->view('ssainicio');
			}
			else {
				redirect(base_url().'index.php');
			}
		}
	}
	public function aplicaciones()
	{
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
				'usuarios_idusuarios'=> ''.$this->session->userdata('idusuarios'),
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
			foreach ($datos["Aplicaciones"] as $key => $value) {
					$tempTotal=$this->SeguimientoModelo->contadorAlumnosGrupo($value->idencuesta_seguimiento);
					$NumeroTotal[]=$tempTotal[0]->total;
					$tempContestados=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
					$ActualContestados[]=$tempContestados[0]->total;

			}
			$datos["totalAlumnos"]=$NumeroTotal;
			$datos["totalContestados"]=$ActualContestados;
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
	/*  INSERTAR MATERIA */
	public function insertarMateria()
	{
		$datos= array(
			'nombre_materia' => ''.$this->input->post('nombre_materia'),
			'departamento_academico_iddepartamento_academico'=> ''.$this->session->userdata('departamento')
		);
		$this->Materia->insertarMateria($datos);
		$datos['idmaterias']=$this->Materia->ultimaMateriaAgregadaDepa($this->session->userdata('departamento'));
		$idenviar="";
		foreach ($datos['idmaterias'] as $key => $value) {
			$idenviar = array("idmateria"=>$value->maximo);
		}
		echo json_encode($idenviar);
	}
	public function obtenerDepartamento($departamentoid)
	{
		$departamentoRetorno="";
		switch ($departamentoid) {
			case '3':
			$departamentoRetorno="DEPARTAMENTO DE SISTEMAS Y COMPUTACION";
			break;
			case '2':
			$departamentoRetorno="DEPARTAMENTO DE CIENCIAS DE LA TIERRA";
			break;
			default:
			# code...
			break;
		}
		return $departamentoRetorno;
	}
	public function obtenerAlumnosPorDepartamento($departamentoid)
	{
		$AlumosEnviar;
		switch ($departamentoid) {
			case '3':
			$AlumosEnviar=$this->Alumnos->cargarAlumnosDosCarreras(2,7);
			break;
			case '2':
			$AlumosEnviar=$this->Alumnos->cargarAlumnosDosCarreras(3,4);
			break;
			default:
			# code...
			break;
		}
		return $AlumosEnviar;
	}
	public function insertarSeguimientoGrupo($idAplicacion)
	{
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
	}
	public function gestionarGrupo($idGrupo)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idGrupo);
			$idEncuesta=$datos["ALUMNOSGRUPO"][0]->encuestas_seguimiento_idencuesta_seguimiento;
			$ALUMNOSCONTESTADOS;
			foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
				if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->alumnos_numero_control,$idEncuesta))
				{
					$ALUMNOSCONTESTADOS[]=true;
				}else {
					$ALUMNOSCONTESTADOS[]=false;
				}
			}
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idEncuesta);
			$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			$this->load->view('aplicaciones_grupos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionlista($idAplicacion)
	{
		$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
		$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
		$datos["AplicacionData"]=$idAplicacion;
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('aplicaciones_lista_retro',$datos);
		}else {
			if ($this->session->userdata('tipo')=='2') {
				$this->load->view('aplicaciones_lista_retro',$datos);
			}
			else {
				redirect(base_url().'index.php');
			}
		}
	}
	public function retroalimentacionseguimiento($idaplicacion)
	{
		$this->load->view('aplicaciones_retro');
	}
	public function retroalimentacioncontinua($idaplicacion)
	{
		$this->load->view('aplicaciones_retro_multi');
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
		$depa=$this->obtenerDepartamento($this->session->userdata('departamento'));
		$datos["DOCENTES"]=$this->Docentes->cargarDocentesDepartamento($depa);
		$this->load->view('seg_docentes',$datos);
	}
	public function alumnos()
	{
		$datos["AlumnosCargados"]=$this->obtenerAlumnosPorDepartamento($this->session->userdata('departamento'));
		$this->load->view('seg_alumnos',$datos);
	}
	public function materias()
	{
		$datos["MATERIAS"]=$this->Materia->cargarMateriasDepartamento($this->session->userdata('departamento'));
		$this->load->view('seg_materias',$datos);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->model('SeguimientoModelo');
		$this->load->model('Materia');
		$this->load->model('Docentes');
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
		$datos= array(
			'contrasena' => ''.$this->input->post('contrasenaapp'),
			'plantilla_encuestas_idplantilla_encuestas' => ''.$this->input->post('plantilla'),
			'fecha_creacion' => ''.date('Y-m-d H:i:s'),
			'periodo'=> ''.$this->session->userdata('periodosemestre'),
			'usuarios_idusuarios'=> ''.$this->session->userdata('idusuarios'),
			'departamento_academico_iddepartamento_academico'=> ''.$this->session->userdata('departamento')
		);
		$this->SeguimientoModelo->crearAplicacion($datos);
		if ($this->session->userdata('tipo')=='1') {
			redirect(base_url().'index.php/Panel_seguimiento/aplicaciones');
		}else {
			if ($this->session->userdata('tipo')=='2') {
				redirect(base_url().'index.php/Panel_seguimiento/aplicaciones');
			}
			else {
				redirect(base_url().'index.php');
			}
		}
	}

	public function listado($idAplicacion)
	{
		$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
		$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('aplicaciones_lista',$datos);
		}else {
			if ($this->session->userdata('tipo')=='2') {
				$this->load->view('aplicaciones_lista',$datos);
			}
			else {
				redirect(base_url().'index.php');
			}
		}
	}
	public function nuevo_grupo()
	{
		$depa=$this->obtenerDepartamento($this->session->userdata('departamento'));
		//	$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
		$datos["MateriasExistentes"]=$this->Materia->cargarMateriasDepartamento($this->session->userdata('departamento'));
		$datos["Docentes"]=$this->Docentes->cargarDocentesDepartamento($depa);
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('aplicaciones_add_grupo',$datos);
		}else {
			if ($this->session->userdata('tipo')=='2') {
				$this->load->view('aplicaciones_add_grupo',$datos);
			}
			else {
				redirect(base_url().'index.php');
			}
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
		echo json_encode($datos);
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
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_Administrativo extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->model('SeguimientoModelo');
		$this->load->model('Materia');
		$this->load->model('Docentes');
		$this->load->model('Alumnos');
		$this->load->model('Departamentos');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='3') {
			$this->load->view('administrativo/ssainicioadministrativo');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function manual_usuario()
	{
		if ($this->session->userdata('tipo')=='3'|| $this->session->userdata('tipo')=='1' ) {
			$this->load->view('administrativo/manual_usuariovistaadmin');
		}
		else {
			redirect(base_url().'index.php');
		}
	}
	public function reportes()
	{
		if ($this->session->userdata('tipo')=='3'|| $this->session->userdata('tipo')=='1' ) {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
			$this->load->view('administrativo/administrativo_departamentos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function aplicaciones($iddepartamento_academico)
	{
		if ($this->session->userdata('tipo')=='3'|| $this->session->userdata('tipo')=='1' ) {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentosID($iddepartamento_academico);
			$datos['APLICACIONES'] = $this->SeguimientoModelo->obtenerApliacionesDepartamento($iddepartamento_academico);
			$this->load->view('administrativo/administrativo_dept_aplicaciones',$datos);
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
}

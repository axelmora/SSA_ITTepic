<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->model('SeguimientoModelo');
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
}

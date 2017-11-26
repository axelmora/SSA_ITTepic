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
			$this->load->view('ssainicio');
		}else {
			redirect(base_url().'index.php');
		}
	}
}

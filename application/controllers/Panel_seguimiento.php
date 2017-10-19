<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
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
		if ($this->session->userdata('tipo')=='1') {
				$this->load->view('aplicaciones');
		}else {
			if ($this->session->userdata('tipo')=='2') {
					$this->load->view('aplicaciones');
			}
			else {
				redirect(base_url().'index.php');
			}
		}
	}
	public function GenerarPeriodoCompleto()
	{
		echo "Hola papus";
	}
}

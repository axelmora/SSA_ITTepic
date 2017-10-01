<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ssapanel extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
    $this->load->view('ssainicio');
			/*if ($this->session->userdata('perfil')=='Administrador') {
				$this->load->view('administracion/vperfil');
			}else {
				$this->load->view('vperfil');
			}*/
	}
}

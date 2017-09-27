<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_Inicio extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form'));
			$this->load->library(array('session', 'form_validation'));
	}
	public function index()
	{
		if ($this->session->userdata('perfil')=='Administrador') {
			redirect(base_url().'index.php/c_panel_administracion/');
		}else {
			$this->load->view('inicio');
		}
	}
}

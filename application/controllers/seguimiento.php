<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*modelo usuario*/
	//	$this->load->model('Usuarios');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		$this->load->view('encuesta/inicio');
	}
}

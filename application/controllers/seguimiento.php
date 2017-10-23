<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*modelo usuario*/
		//	$this->load->model('Usuarios');
		$this->load->model('Sistema');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		$sistemaproduccion = $this->Sistema->obtenerproduccion();
		if ($sistemaproduccion[0]->produccion==1) {
			$this->load->view('encuesta/inicio');
		}
		else {
			$datos["mensajesistema"]="
			<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
			<center>
			<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
			<br><b> El sistema se encuentra actualmente en Mantenimiento</b>
			</center>
			</div>
			";
			$this->load->view('encuesta/inicio',$datos);
		}
	}
	public function verificar()
	{

	}

}

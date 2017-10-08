<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_administracion extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Sistema');
		$this->load->model('Usuarios');
		$this->load->model('Mesa_Ayuda');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	public function index()
	{
		if ($this->session->userdata('perfil')=='Administrador') {
			$this->load->view('administracion/vpanel_administracion');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function sistemainfo() {
		if ($this->session->userdata('perfil')=='Administrador') {
			$sistemadatos['produccion']= $this->Sistema->obtenerproduccion();
			$this->load->view('administracion/vpanel_administracion_info',$sistemadatos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function sistemainfoactualizarpro($valor) {
		$this->Sistema->actualizarprodiccion($valor,"".date('Y-m-d H:i:s'));
	}
	public function lista_usuarios() {
		if ($this->session->userdata('perfil')=='Administrador') {
			$iduser=$this->session->userdata('idusuarios');
			$datos['usuarios'] = $this->Usuarios->mostrarusuarios($iduser);
			$this->load->view('administracion/vpanel_administracion_usuarios',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function mesadeayuda() {
		if ($this->session->userdata('perfil')=='Administrador') {
			$iduser=$this->session->userdata('idusuarios');
			$datos['asuntos'] = $this->Mesa_Ayuda->mostrarAsuntos();
			$this->load->view('administracion/mesa_ayuda',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function editor() {
		$this->load->view('editor_plantillas');
	}
}

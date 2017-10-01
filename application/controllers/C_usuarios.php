<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*modelo usuario*/
		$this->load->model('Usuarios');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
			if ($this->session->userdata('perfil')=='Administrador') {
				$this->load->view('administracion/vperfil');
			}else {
				$this->load->view('vperfil');
			}
	}
	/* inicio de sesion*/
	public function iniciosesion() {
		$usuario = $this->input->post('userid');
		$password = sha1($this->input->post('passwordid'));
		$verificarusuario = $this->Usuarios->iniciarsesionm($usuario, $password);
		if ($verificarusuario == TRUE) {
			$datos = array(
				'is_logued_in' => TRUE,
				'idusuarios' => $verificarusuario[0]->idusuarios,
				'perfil' =>$verificarusuario[0]->nombre_departamento,
				'departamento' => $verificarusuario[0]->idusuarios,
				'username' => $verificarusuario[0]->nombre_usuario
			);
			$this->session->set_userdata($datos);
			$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
			if ($this->session->userdata('perfil')=="Administrador") {
				redirect(base_url().'index.php/c_panel_administracion/');
			}
			else {
				redirect(base_url().'index.php/ssapanel/');
			}
			return true;
		} else {
			$this->form_validation->set_message('a', ' Usuario o contraseña inválida.');
			$this->load->view('inicio');
			return false;
		}
	}
	/* funcion para destruri sesiones*/
	public function logout() {
		$this->session->sess_destroy();
		redirect('c_inicio');
	}
}

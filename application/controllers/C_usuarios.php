<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		/*modelo usuario*/
		$this->load->model('Usuarios');
		$this->load->model('Sistema');
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
		$peridioactual=$this->generarPeriodo();
		$usuario = $this->input->post('userid');
		$password = sha1($this->input->post('passwordid'));
		$verificarusuario = $this->Usuarios->iniciarsesionm($usuario, $password);
		if ($verificarusuario == TRUE) {
			$datos = array(
				'is_logued_in' => TRUE,
				'idusuarios' => $verificarusuario[0]->idusuarios,
				'perfil' =>$verificarusuario[0]->nombre_departamento,
				'departamento' => $verificarusuario[0]->iddepartamento_academico,
				'departamentonombre' => $verificarusuario[0]->nombre_departamento,
				'username' => $verificarusuario[0]->nombre_usuario,
				'tipo' => $verificarusuario[0]->tipo,
				'periodosemestre'=>$peridioactual
			);
			$sistemaproduccion = $this->Sistema->obtenerproduccion();
			if ($sistemaproduccion[0]->produccion==1) {
				$this->session->set_userdata($datos);
				$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
				if ($this->session->userdata('perfil')=="Administrador") {
					redirect(base_url().'index.php/Panel_administracion/');
				}
				else {
					redirect(base_url().'index.php/Panel_seguimiento/');
				}
			}else {
				if ($verificarusuario[0]->tipo==1) {
					$this->session->set_userdata($datos);
					$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
					if ($this->session->userdata('perfil')=="Administrador") {
						redirect(base_url().'index.php/Panel_administracion/');
					}
				}else {
					$datos["mensajesistema"]="
					<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
					<center>
					<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
					<br><b> El sistema se encuentra actualmente en Mantenimiento</b>
					</center>
					</div>
					";
					$this->load->view('inicio',$datos);
				}
			}
			return true;
		} else {
			/*$this->form_validation->set_message('a', ' Usuario o contraseña inválida.');*/
			$datos["mensajesistema"]="
			<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
			<center>
			<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
			</center>
			<center>
			Datos incorrectos.
			</center>
			</div>
			";
			$this->load->view('inicio',$datos);
			return false;
		}
	}
	/* funcion para destruri sesiones*/
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'index.php/C_Inicio/');
	}
	public function generarPeriodo()
	{
		 $anio=date("Y");
		 $mes=date("m");
		 $periodo="";
		 if ($mes>=1 && $mes<=6) {
			 	$periodo=$anio."1";
		 }else {
			 if ($mes>=8 && $mes<=12) {
					$periodo=$anio."3";
			 }
			 else {
			 		$periodo=$anio."2";
			 }
		 }
		 return $periodo;
	}
}

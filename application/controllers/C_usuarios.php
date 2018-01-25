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
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3'  ) {
			$this->load->view('vperfil');
		}else {
			redirect(base_url().'index.php');
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
				if ($this->session->userdata('perfil')=="Administrador") {
					if($verificarusuario[0]->estado==1)
					{
						$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
						redirect(base_url().'index.php/Panel_administracion/');
					}else {
						$datos["mensajesistema"]="
						<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
						<center>
						<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
						<br><b> Lo sentimos su cuenta esta actualmente desactivada. </b>
						</center>
						</div>
						";
						$this->load->view('inicio',$datos);
					}
				}
				else {
					if($verificarusuario[0]->estado==1)
					{
						if($this->session->userdata('tipo')=="2")
						{
							$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
							redirect(base_url().'index.php/Panel_seguimiento/');
						}else {
							if($this->session->userdata('tipo')=="3")
							{
								$this->Usuarios->actualizarultima_sesion($verificarusuario[0]->idusuarios,"".date('Y-m-d H:i:s'));
								redirect(base_url().'index.php/Panel_Administrativo/');
							}
						}
					}else {
						$datos["mensajesistema"]="
						<div class='alert alert-danger sombrapaneles alertasistema animated bounceInLeft' role='alert'>
						<center>
						<i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i>
						<br><b> Lo sentimos su cuenta esta actualmente desactivada. </b>
						</center>
						</div>
						";
						$this->load->view('inicio',$datos);
					}
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
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3'  ) {
			$this->session->sess_destroy();
			redirect(base_url().'index.php');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function actualizarInformacion()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3'  ) {
			$usuario = $this->input->post('nombre_usuario');
			$this->Usuarios->actualizar_nombre($usuario,$this->session->userdata('idusuarios'));
			$this->session->set_userdata('username', $usuario);
			redirect(base_url().'index.php/C_usuarios/');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function actualizarContrasena()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3'  ) {
			$contraactual = $this->input->post('contraactual');
			$contranueva = $this->input->post('contra_nueva1');
			$contrabase=$this->Usuarios->verificarContrasena($this->session->userdata('idusuarios'));
			if($contraactual!=$contranueva)
			{
				//echo "".$contrabase[0]->password."---".sha1($contraactual);
				if($contrabase[0]->password==sha1($contraactual))
				{
					$this->Usuarios->actualizar_contrasena($this->session->userdata('idusuarios'),sha1($contranueva));
					//redirect(base_url().'index.php/C_usuarios/');
					$datos["MensajeExito"]=$this->mensajeExisto("La contraseña se actualizo  correctamente.");
					$this->load->view('vperfil',$datos);
				}else {
					$datos["errorSubmit"]=$this->mensajeError("La contraseña actual es incorrecta.");
					$this->load->view('vperfil',$datos);
				}
			}else {
				$datos["errorSubmit"]=$this->mensajeError("La contraseña nueva es la misma contraseña que la actual.");
				$this->load->view('vperfil',$datos);
			}
		}else {
			redirect(base_url().'index.php');
		}
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
	public function cambiarEstado()
	{
		if ($this->session->userdata('tipo')=='1') {
			$idusuarios = $this->input->post('idusuarios');
			$estado = $this->input->post('estado');
			$this->Usuarios->actualizarEstado($idusuarios,$estado);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function datosUsuario($idusuarios)
	{
		if ($this->session->userdata('tipo')=='1') {
			$datosUser=$this->Usuarios->selecionarUsuario($idusuarios);
			echo json_encode($datosUser);
		}else {
			redirect(base_url().'index.php');
		}
	}
	/* FUNCION PARA GENERAR MENSAJES DE ERRORES*/
	public function mensajeError($Mensaje)
	{
		$enviar="
		<div class='alert alert-danger sombrapaneles  animated bounceInLeft' role='alert'>
		<center>
		<i class='fa fa-exclamation-circle  animated tada infinite' aria-hidden='true'></i>
		<br>".$Mensaje."</b>
		</center>
		</div>
		";
		return $enviar;
	}
	public function mensajeExisto($Mensaje)
	{
		$enviar="
		<div class='alert alert-success sombrapaneles  animated bounceInLeft' role='alert'>
		<center>
		<br>".$Mensaje."</b>
		</center>
		</div>
		";
		return $enviar;
	}
	/* FUNCION PARA GENERAR MENSAJES DE ERRORES*/
}

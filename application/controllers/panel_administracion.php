<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_administracion extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Sistema');
		$this->load->model('Usuarios');
		$this->load->model('Mesa_AyudaModel');
		$this->load->model('Departamentos');
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
			$datos['asuntos'] = $this->Mesa_AyudaModel->mostrarAsuntos();
			$this->load->view('administracion/mesa_ayuda',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function editor() {
		$this->load->view('editor_plantillas');
	}
	public function adduser() {
		$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
		$this->load->view('administracion/vpanel_nusuario',$datos);
	}
	public function agrearUsuario( )
	{
		$nombre_userv = $this->input->post('nombre_user');
		$nombre_userv = preg_replace('/\s/', '', $nombre_userv);
		$existe= $this->Usuarios->verificarNUsuario($nombre_userv);
		if ($existe == FALSE)
		{
			$datos["error_mismo_usario"]="El nombre de usuario  '$nombre_userv' ya existe.";
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
			$this->load->view('administracion/vpanel_nusuario',$datos);
		}else {
			$nombre_user = $this->input->post('nombre_user');
			$contrasena = $this->input->post('contrasena');
			$nombre_userc = $this->input->post('nombre_userc');
			$departamento_academico= $this->input->post('departamento_academico');
			$tipo="";
			if($departamento_academico==1)
			{
				$tipo=1;
			}else {
				$tipo=2;
			}
			$nombre_user = preg_replace('/\s/', '', $nombre_user);
			$datos= array(
				'usuario' => ''.$nombre_user,
				'password' => sha1($contrasena),
				'tipo'=>$tipo,
				'estado'=>1,
				'nombre_usuario'=> ''.$nombre_userc,
				'departamento_academico_iddepartamento_academico'=> ''.$departamento_academico
			);
			$this->Usuarios->insertarUsuario($datos);
			redirect(base_url().'index.php/Panel_administracion/lista_usuarios');
		}
	}
	public function deleteUsuario()
	{
		  $idusuarios= $this->input->post('idusuarios');
			$this->Usuarios->borrarUSUARIO($idusuarios);
		 	redirect(base_url().'index.php/Panel_administracion/lista_usuarios');
	}
	public function manual_tecnico(){
		$this->load->view('administracion/manual_tecnicovista_admin');
	}
	public function manual_usuario(){
		$this->load->view('administracion/manual_usuariovista_admin');
	}
	/* SECCION DE DEPARTAMENTOS ACADEMICOS */
	public function departamentos()
	{
		$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
		$this->load->view('administracion/vpanel_administracion_departamenos',$datos);
	}
	public function nuevo_departamento()
	{
		$datos['CARRERAS'] = $this->Departamentos->cargarCarreras();
		$this->load->view('administracion/vpanel_administracion_departamenos_nuevo',$datos);
	}
	public function editar_departamento($iddepartamento_academico)
	{
		$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentosID($iddepartamento_academico);
		$this->load->view('administracion/vpanel_administracion_departamenos',$datos);
	}
	public function add_departamento()
	{
		$nombre_departamento = $this->input->post('nombre_departamento');
		$carreras = $this->input->post('carreras');
		$this->Departamentos->insertarDepartamento($nombre_departamento);
		$idMaximo=$this->Departamentos->obtenerIDdepartamento();
		for ($i=0; $i <count($carreras) ; $i++) {
			$this->Departamentos->insRelacionDepaCarrera($idMaximo[0]->maximo,$carreras[$i]);
		}
		redirect(base_url().'index.php/panel_administracion/departamentos');
	}
	public function agregarCorreoElectronico()
	{
		$correo = $this->input->post('correo');
		$this->Sistema->actualizarCorreo($correo);
		redirect(base_url().'index.php/panel_administracion/sistemainfo');
	}
	/* SECCION DE DEPARTAMENTOS ACADEMICOS */
}

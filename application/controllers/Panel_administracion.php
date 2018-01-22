<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_administracion extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Sistema');
		$this->load->model('Usuarios');
		$this->load->model('Mesa_AyudaModel');
		$this->load->model('Departamentos');
		$this->load->model('Plantilla');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	public function index()
	{
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('administracion/vpanel_administracion');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function sistemainfo() {
		if ($this->session->userdata('tipo')=='1') {
			$sistemadatos['produccion']= $this->Sistema->obtenerproduccion();
			$this->load->view('administracion/vpanel_administracion_info',$sistemadatos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function sistemainfoactualizarpro($valor) {
		if ($this->session->userdata('tipo')=='1') {
			$this->Sistema->actualizarprodiccion($valor,"".date('Y-m-d H:i:s'));
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function lista_usuarios() {
		if ($this->session->userdata('tipo')=='1') {
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
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('editor_plantillas');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function adduser() {
		if ($this->session->userdata('tipo')=='1') {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
			$this->load->view('administracion/vpanel_nusuario',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function agrearUsuario( )
	{
		if ($this->session->userdata('tipo')=='1') {
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
					if($departamento_academico== 10 || $departamento_academico== 11  || $departamento_academico== 12  || $departamento_academico== 13 || $departamento_academico== 9 ){
						$tipo=3;
					}else {
						$tipo=2;
					}
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
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function deleteUsuario()
	{
		if ($this->session->userdata('tipo')=='1') {
			$idusuarios= $this->input->post('idusuarios');
			$this->Usuarios->borrarUSUARIO($idusuarios);
			redirect(base_url().'index.php/Panel_administracion/lista_usuarios');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function manual_tecnico(){
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('administracion/manual_tecnicovista_admin');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function manual_usuario(){
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('administracion/manual_usuariovista_admin');
		}else {
			redirect(base_url().'index.php');
		}
	}
	/* SECCION DE DEPARTAMENTOS ACADEMICOS */
	public function departamentos()
	{
		if ($this->session->userdata('tipo')=='1') {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
			$this->load->view('administracion/vpanel_administracion_departamenos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function nuevo_departamento()
	{
		if ($this->session->userdata('tipo')=='1') {
			$datos['CARRERAS'] = $this->Departamentos->cargarCarreras();
			$this->load->view('administracion/vpanel_administracion_departamenos_nuevo',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function editar_departamento($iddepartamento_academico)
	{
		if ($this->session->userdata('tipo')=='1') {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentosID($iddepartamento_academico);
			$datos['DEPARTAMENTOS_CARRERAS'] = $this->Departamentos->cargarDepartamentosIDCarreras($iddepartamento_academico);
			$datos['CARRERAS'] = $this->Departamentos->cargarCarreras();
			$this->load->view('administracion/vpanel_administracion_departamenos_editar',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarDepartamento()
	{
		if ($this->session->userdata('tipo')=='1') {
			$iddepartamento_academico=$this->input->post('iddepartamento_academico');
			$idedepartametnos=$this->Departamentos->cargarAplicacionesporDepartamento($iddepartamento_academico);
			if($idedepartametnos){
				foreach ($idedepartametnos as $key => $value) {
					$this->Departamentos->borrarAplicacionSeguimiento($value->idaplicaciones);
				}
			}
			$usuariosdepa=$this->Departamentos->cargarUsuariosDepa($iddepartamento_academico);
			if($usuariosdepa){
				$this->Departamentos->reasignarUsuarios($iddepartamento_academico);
			}
			$this->Departamentos->eliminarDepartamento($iddepartamento_academico);
			redirect(base_url().'index.php/panel_administracion/departamentos');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function editar_departamento_formulario($iddepartamento_academico)
	{
		$nombre_departamento = $this->input->post('nombre_departamento');
		$carreras = $this->input->post('carreras');
		$this->Departamentos->actualizarDepartamento($iddepartamento_academico,$nombre_departamento);
		$actuales=$this->Departamentos->cargarDepartamentosIDCarreras($iddepartamento_academico);
		$carreras = $this->input->post('carreras');
		/*SE ELIMINAN LOS DATOS ACTUALES*/
		$this->Departamentos->borrarRelacionCarrerasDepartamento($iddepartamento_academico);
		/*SE AGREGAN LOS NUEVOS*/
		for ($i=0; $i <count($carreras) ; $i++) {
			$this->Departamentos->insRelacionDepaCarrera($iddepartamento_academico,$carreras[$i]);
		}
		redirect(base_url().'index.php/panel_administracion/departamentos');
	}
	public function add_departamento()
	{
		$nombre_departamento = $this->input->post('nombre_departamento');
		$carreras = $this->input->post('carreras');
		$this->Departamentos->insertarDepartamento($nombre_departamento,2);
		$idMaximo=$this->Departamentos->obtenerIDdepartamento();
		for ($i=0; $i <count($carreras) ; $i++) {
			$this->Departamentos->insRelacionDepaCarrera($idMaximo[0]->maximo,$carreras[$i]);
		}
		redirect(base_url().'index.php/panel_administracion/departamentos');
	}
	/* SECCION DE DEPARTAMENTOS ACADEMICOS */
	public function agregarCorreoElectronico()
	{
		$correo = $this->input->post('correo');
		$this->Sistema->actualizarCorreo($correo);
		redirect(base_url().'index.php/panel_administracion/sistemainfo');
	}
	public function editarUsuario($idusuarios)
	{
		if ($this->session->userdata('tipo')=='1') {
			$datos['DEPARTAMENTOS'] = $this->Departamentos->cargarDepartamentos();
			$datos["usuarioEditar"]=$datosUser=$this->Usuarios->selecionarUsuario($idusuarios);
			$this->load->view('administracion/vpanel_eusuario',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function updateUser($idusuarios)
	{
		if ($this->session->userdata('tipo')=='1') {
			$contrasena = $this->input->post('contrasena');
			$nombre_userc = $this->input->post('nombre_userc');
			$departamento_academico= $this->input->post('departamento_academico');
			$tipo="";
			if($departamento_academico==1)
			{
				$tipo=1;
			}else {
				if($departamento_academico== 10 || $departamento_academico== 11  || $departamento_academico== 12  || $departamento_academico== 13 || $departamento_academico== 9 ){
					$tipo=3;
				}else {
					$tipo=2;
				}
			}
			$datos= array(
				'tipo'=>$tipo,
				'nombre_usuario'=> ''.$nombre_userc,
				'departamento_academico_iddepartamento_academico'=> ''.$departamento_academico
			);
			$this->Usuarios->actualizarUsuarioInformacion($idusuarios,$datos);
			redirect(base_url().'index.php/Panel_administracion/lista_usuarios');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function restablecerpassword()
	{
		if ($this->session->userdata('tipo')=='1') {
			$contrasña=sha1($this->input->post('usuarioname'));
			$idusuarioenviar= $this->input->post('idusuarioenviar');
			$this->Usuarios->actualizar_contrasena($idusuarioenviar,$contrasña);
			redirect(base_url().'index.php/Panel_administracion/lista_usuarios');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function db()
	{
		if ($this->session->userdata('tipo')=='1') {
			$CI = &get_instance();
			$CI->load->database();
			$datos["nomnbrebase"]="Tables_in_".$CI->db->database;
			$datos["nomnbrebasemostrar"]=$CI->db->database;
			$datos["TABLAS"]=$this->Sistema->cargarTablasBaseDedatos();
			$this->load->view('administracion/vpanel_administracion_db',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function dbtablas($nombretabla)
	{
		if ($this->session->userdata('tipo')=='1') {
			$CI = &get_instance();
			$CI->load->database();
			$datos["nomnbretabla"]=$nombretabla ;
			$datos["TABLA"]=$this->Sistema->cargarDatosTabla($nombretabla);
			$this->load->view('administracion/vpanel_administracion_db_tabla',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function db_backup()
	{
		if ($this->session->userdata('tipo')=='1') {
			$this->load->dbutil();
			$preferencias= array(
				'format'      => 'zip',
				'filename'    => 'ssadb-'.date("Y-m-d-H-i-s").'.sql'
			);
			$respladodb=& $this->dbutil->backup($preferencias);
			$db_nombre = 'resplado-ssa-'. date("Y-m-d-H-i-s") .'.zip';
			$guardar = 'file/db/backups/'.$db_nombre;
			$this->load->helper('file');
			write_file($guardar, $respladodb);
			$this->load->helper('download');
			force_download($db_nombre, $respladodb);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function info_servidor()
	{
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('administracion/vpanel_info');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function encabezado()
	{
		if ($this->session->userdata('tipo')=='1') {
			$datos['encabezado'] = $this->Plantilla->cargarPlantilla();
			$this->load->view('administracion/vpanel_encabezado',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function encabezado_actualizar()
	{
		if ($this->session->userdata('tipo')=='1') {
			$nuevoencabezado = $this->input->post('encabezado');
			$this->Plantilla->actualizarEncabezado($nuevoencabezado);
			redirect(base_url().'index.php/panel_administracion/encabezado');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function subir_logo_tec()
	{
		if ($this->session->userdata('tipo')=='1') {
			$path_to_file = './images/escudo_itt_grande.png';
			if(unlink($path_to_file)) {
				$config['upload_path'] = './images/';//this is the folder where the image is uploaded
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '10000';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$config['file_name'] = 'escudo_itt_grande.png';//rename file here
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('logotec'))
				{
					$datos['produccion']= $this->Sistema->obtenerproduccion();
					$datos["error_foto"]=$this->upload->display_errors();
					$this->load->view('administracion/vpanel_administracion_info', $datos);
				}
				else
				{
					//   $data = array('upload_data' => $this->upload->data());
					//   $this->load->view('upload_success', $data);
					//   $file = $data['upload_data']['full_path'];
					redirect(base_url().'index.php/panel_administracion/sistemainfo');
				}
			}
			else {
				redirect(base_url().'index.php');
			}
		}else {
			redirect(base_url().'index.php');
		}
	}

	public function subir_manual()
	{
		if ($this->session->userdata('tipo')=='1') {
			$path_to_file = './file/manual/Manual_Usuario_SSA.pdf';
			if(unlink($path_to_file)) {
				$config['upload_path'] = './file/manual/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '10000';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$config['file_name'] = 'Manual_Usuario_SSA.pdf';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('manual'))
				{
					$datos['produccion']= $this->Sistema->obtenerproduccion();
					$datos["error_manual"]=$this->upload->display_errors();
					$this->load->view('administracion/vpanel_administracion_info', $datos);
				}
				else
				{
					redirect(base_url().'index.php/panel_administracion/sistemainfo');
				}
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function plantillas_seguimiento() {
		if ($this->session->userdata('tipo')=='1') {
			$datos["PLANTILLAS"]=$this->Plantilla->cargarPlantilla();
			$this->load->view('administracion/vpanel_administracion_plantillas',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function visualizar_encuesta($id)
	{
		if ($this->session->userdata('tipo')=='1') {
			$plantilla=$this->Plantilla->cargarPlantillaID($id);
			$rutajson="";
			foreach ($plantilla as $key => $value) {
				$rutajson=$value->estructura;
			}
			$this->load->model('GeneradorEncuestas3');
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas3->generarEncu($rutajson);
			$datos['encabezado'] = $this->Plantilla->cargarPlantillaID($id);
			$datos['boton'] = "LISTA";
			$this->load->view('encuesta/seguimientovi_generada_visualizar',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function nueva_plantilla()
	{
		if ($this->session->userdata('tipo')=='1') {
			$this->load->view('administracion/vpanel_editor_encuesta_agregar');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function visualizar_encuesta_edicion($id)
	{
		if ($this->session->userdata('tipo')=='1') {
			$plantilla=$this->Plantilla->cargarPlantillaID($id);
			$rutajson="";
			foreach ($plantilla as $key => $value) {
				$rutajson=$value->estructura;
				$datos["IDPLANTILLA"]=$value->idplantilla_encuestas;
			}
			$this->load->model('GeneradorEncuestas3');
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas3->generarEncu($rutajson);
			$datos['encabezado'] = $this->Plantilla->cargarPlantillaID($id);
			$datos['boton'] = "";
			$this->load->view('encuesta/seguimientovi_generada_visualizar',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function editor_encuesta($id)
	{
		if ($this->session->userdata('tipo')=='1') {
			$plantilla=$this->Plantilla->cargarPlantillaID($id);
			$rutajson="";
			if ($plantilla) {
				foreach ($plantilla as $key => $value) {
					$rutajson=$value->estructura;
					$datos["IDPLANTILLA"]=$value->idplantilla_encuestas;
					$datos["encabezado"]=$value->encabezado;
					$datos["nombre"]=$value->nombre;
				}
				$datos["FORMATO_ENCUESTA"]=(file_get_contents($rutajson));
			}else {
				$datos["FORMATO_ENCUESTA"]="ERROR";
			}
			$this->load->view('administracion/vpanel_editor_encuesta',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function agregar_nueva_plantilla()
	{
		if ($this->session->userdata('tipo')=='1') {
			$maximo=$this->Plantilla->cargarPlantillaMaximo();
			$nplantilla = $this->input->post('nplantilla');
			$encabezado = $this->input->post('encabezado');
			$data1 = $this->input->post('data1');
			$ruta='file/json/seguimiento'.($maximo[0]->maximo+1).'.json';
			//	$data1 = json_encode($data1, JSON_PRETTY_PRINT);
			file_put_contents('file/json/seguimiento'.($maximo[0]->maximo+1).'.json',$data1);
			$informacionenviar= array(
				'nombre' =>''.$nplantilla,
				'estructura' => $ruta,
				'encabezado'=>$encabezado,
				'fecha_creacion'=>''.date('Y-m-d H:i:s'),
				'fecha_modificacion'=>''.date('Y-m-d H:i:s')
			);
			$this->Plantilla->addplantilla($informacionenviar);
			redirect(base_url().'index.php/panel_administracion/plantillas_seguimiento');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function actualizarplantilla($idplantilla)
	{
		if ($this->session->userdata('tipo')=='1') {
			$nplantilla = $this->input->post('nplantilla');
			$encabezado = $this->input->post('encabezado');
			$data1 = $this->input->post('data1');
			$ruta='file/json/seguimiento'.$idplantilla.'.json';
			file_put_contents('file/json/seguimiento'.$idplantilla.'.json',$data1);
			$informacionenviar= array(
				'nombre' =>''.$nplantilla,
				'encabezado'=>$encabezado,
				'fecha_modificacion'=>''.date('Y-m-d H:i:s')
			);
			$this->Plantilla->updateplantilla($informacionenviar,$idplantilla);
			redirect(base_url().'index.php/panel_administracion/plantillas_seguimiento');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminar_plantilla()
	{
		if ($this->session->userdata('tipo')=='1') {
			$idplantilla = $this->input->post('idplantilla');
			$ruta = $this->input->post('ruta');
			if(unlink($ruta)) {
				echo 'Se borro correctamente';
			}
			else {
				echo 'Ocurrio un error';
			}
			$this->Plantilla->borrar_plantilla($idplantilla);
			redirect(base_url().'index.php/panel_administracion/plantillas_seguimiento');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function datosPlantilla($id)
	{
		if ($this->session->userdata('tipo')=='1') {
			$datosUser=$this->Plantilla->cargarPlantillaID($id);
			echo json_encode($datosUser);
		}else {
			redirect(base_url().'index.php');
		}
	}
}

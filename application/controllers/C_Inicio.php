<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_Inicio extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Sistema');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	public function index()
	{
		$sistemaproduccion = $this->Sistema->obtenerproduccion();
		if($sistemaproduccion){
			$datos["CORREO"]=$sistemaproduccion[0]->correo_sistema;
		}
		if ($sistemaproduccion[0]->produccion==1) {
			if ($this->session->userdata('tipo')=='1') {
				redirect(base_url().'index.php/Panel_administracion/');
			}else {
				if ($this->session->userdata('tipo')=='2') {
					redirect(base_url().'index.php/Panel_seguimiento/');
				}
				else {
					if ($this->session->userdata('tipo')=='3') {
						redirect(base_url().'index.php/Panel_Administrativo/');
					}else {
						$this->load->view('inicio',$datos);
					}
				}
			}
		}
		else {
			if ($this->session->userdata('tipo')=='1') {
				redirect(base_url().'index.php/panel_administracion/');
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
	}
	/* TestJson*/
	public function test()
	{
		$todo = $this->input->post();
		echo json_encode($todo);
		echo "<br>";
		foreach ($todo as $value)
		{
			echo "$value <br>";
		}
		echo "<br>";
		$data = json_decode(html_entity_decode('{"1":"Hola","2":"xD","3":":3 carito ññ mi amor <3"}'), TRUE);
		foreach ($data as $value)
		{
			echo "$value <br>";
		}
	}
}

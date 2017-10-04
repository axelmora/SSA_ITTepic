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
			//redirect(base_url().'index.php/panel_administracion/');
		}else {
			$this->load->view('inicio');
		}
	}
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

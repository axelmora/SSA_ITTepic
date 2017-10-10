<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_usuarios extends CI_Controller {
  function __construct() {
    parent::__construct();
    /*modelo usuario*/
    $this->load->model('Usuarios');
    $this->load->model('Sistema');
    $this->load->model('Mesa_ayuda');
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
  public function insertarSolicitud() {
    	$iduser=$this->session->userdata('idusuarios');
      $this->Mesa_ayuda->solicitarsoporte($iduser);
  }
}

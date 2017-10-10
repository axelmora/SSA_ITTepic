<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mesa_ayuda extends CI_Controller {
  function __construct() {
    parent::__construct();
    /*modelo usuario*/
    $this->load->model('Usuarios');
    $this->load->model('Sistema');
    $this->load->model('Mesa_AyudaModel');
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
    $asunto = $this->input->post('asunto');
    $descipcion = $this->input->post('descipcion');
    $url = $this->input->post('url');
    $this->Mesa_AyudaModel->solicitarsoporte($iduser,$asunto,$descipcion,$url);
  }
}

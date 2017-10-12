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
    redirect(base_url().'index.php');
  }
  public function soporte($idmensaje)
  {
    if ($this->session->userdata('perfil')=='Administrador') {
      $datos['asuntos'] = $this->Mesa_AyudaModel->mostrarAsuntosUnico($idmensaje);
      $datos['respuestas'] = $this->Mesa_AyudaModel->mostrarMensjesAunsto($idmensaje);
      $this->load->view('administracion/mesa_ayudaindividual',$datos);
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function insertarSolicitud() {
    $iduser=$this->session->userdata('idusuarios');
    $asunto = $this->input->post('asunto');
    $descipcion = $this->input->post('descipcion');
    $url = $this->input->post('url');
    $this->Mesa_AyudaModel->solicitarsoporte($iduser,$asunto,$descipcion,$url);
  }
  public function respuesta($idmensajeprincipal)
  {
    $respus = $this->input->post('respuestamesaje');
    $iduser=$this->session->userdata('idusuarios');
    $this->Mesa_AyudaModel->insertarRespuesta($idmensajeprincipal,$respus,$iduser);
    redirect(base_url().'index.php/mesa_ayuda/soporte/'.$idmensajeprincipal);
  }
  public function respuestaEliminar($idrespuesta)
  {
    # code...
  }
  public function borrarMensajeprincipal($mensaje)
  {
    $this->Mesa_AyudaModel->borarMensajeSoporte($mensaje);
    redirect(base_url().'index.php/panel_administracion/mesadeayuda');
  }
}

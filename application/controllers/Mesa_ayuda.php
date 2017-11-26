<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mesa_ayuda extends CI_Controller {
  function __construct() {
    parent::__construct();
    /*modelo Usuario*/
    $this->load->model('Usuarios');
    /*modelo Sistema*/
    $this->load->model('Sistema');
    /*modelo Mesa de Ayuda*/
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
    if ($this->session->userdata('tipo')=='1') {
      $datos['asuntos'] = $this->Mesa_AyudaModel->mostrarAsuntosUnico($idmensaje);
      $datos['respuestas'] = $this->Mesa_AyudaModel->mostrarMensjesAunsto($idmensaje);
      $this->load->view('administracion/mesa_ayudaindividual',$datos);
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function insertarSolicitud() {
    if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
      $iduser=$this->session->userdata('idusuarios');
      $asunto = $this->input->post('asunto');
      $descipcion = $this->input->post('descipcion');
      $url = $this->input->post('url');
      $this->Mesa_AyudaModel->solicitarsoporte($iduser,$asunto,$descipcion,$url);
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function respuesta($idmensajeprincipal)
  {
    if ($this->session->userdata('tipo')=='1') {
      $respus = $this->input->post('respuestamesaje');
      $iduser=$this->session->userdata('idusuarios');
      $this->Mesa_AyudaModel->insertarRespuesta($idmensajeprincipal,$respus,$iduser);
      redirect(base_url().'index.php/mesa_ayuda/soporte/'.$idmensajeprincipal);
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function borrarMensajeprincipal($mensaje)
  {
    if ($this->session->userdata('tipo')=='1') {
      $this->Mesa_AyudaModel->borarMensajeSoporte($mensaje);
      redirect(base_url().'index.php/panel_administracion/mesadeayuda');
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function borrarRespuesta($mensaje)
  {
    if ($this->session->userdata('tipo')=='1') {
      $idmensajeprincipal = $this->input->post('idmensajeprincipal_b');
      $this->Mesa_AyudaModel->borarMensajeRespuesta($mensaje);
      redirect(base_url().'index.php/mesa_ayuda/soporte/'.$idmensajeprincipal);
    }else {
      redirect(base_url().'index.php');
    }
  }
  public function cambiarEstadoMensaje()
  {
    if ($this->session->userdata('tipo')=='1') {
      $idmensaje = $this->input->post('idmensaje');
      $nuevoestado = $this->input->post('estado');
      $this->Mesa_AyudaModel->cambioEstado($idmensaje,$nuevoestado);
    }else {
      redirect(base_url().'index.php');
    }

  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error_ssa extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper(array('url', 'form'));
    $this->load->library(array('session', 'form_validation'));
  }
  public function index()
  {
    $this->output->set_status_header('404');
    $data['content'] = 'error_404';
    $this->load->view('error_404_ssa',$data);
  }
}

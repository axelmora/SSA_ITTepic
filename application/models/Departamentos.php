<?php
class Departamentos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarDepartamentos()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_academico ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarDepartamentosID($iddepartamento_academico)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_academico where iddepartamento_academico=$iddepartamento_academico");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

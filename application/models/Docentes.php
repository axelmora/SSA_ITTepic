<?php
class Docentes extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarDocentesDepartamento($Departamento)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM docentes where departamento='$Departamento'");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}
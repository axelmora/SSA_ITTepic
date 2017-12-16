<?php
class Materia extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarMateriasCarrera($departamento_academico)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM materias_carrera as mc ,materias as m WHERE mc.codigo IN ($departamento_academico) and mc.materias_idmaterias = m.idmaterias;");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}

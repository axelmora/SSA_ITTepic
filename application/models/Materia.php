<?php
class Materia extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function insertarMateria($datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->insert('materias',$datos);
  }
  public function ultimaMateriaAgregadaDepa($departamento_academico)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT MAX(idmaterias) as maximo FROM materias where departamento_academico_iddepartamento_academico=$departamento_academico");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function cargarMateriasDepartamento($departamento_academico)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM materias where departamento_academico_iddepartamento_academico=$departamento_academico");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}

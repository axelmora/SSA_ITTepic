<?php
class Alumnos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function iniciarsesionm($usuario, $password)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM usuarios as u, departamento_academico as da where u.usuario='$usuario' and password='$password' and u.departamento_academico_iddepartamento_academico = da.iddepartamento_academico;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function cargarAlumnosPorDepartamento($carreras_id_carrera)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM alumnos where carreras_id_carrera=$carreras_id_carrera");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarAlumnosDosCarreras($carreras_id_carrera,$carreras_id_carrera2)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM alumnos where carreras_id_carrera=$carreras_id_carrera and carreras_id_carrera=$carreras_id_carrera2");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

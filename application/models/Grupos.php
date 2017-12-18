<?php
class Grupos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function obtenerAlumnosGrupo_Materia($idgrupo,$idmateria)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM materias_carrera as mc ,materias as m WHERE mc.carreras_id_carrera IN ($carreras_id_carrera) and mc.materias_idmaterias = m.idmaterias;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

<?php
class Materia extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarMateriasCarrera($carreras_id_carrera)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM materias_carrera as mc ,materias as m WHERE mc.carreras_id_carrera IN ($carreras_id_carrera) and mc.materias_idmaterias = m.idmaterias;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarMateriasPeriodoCarrera($carreras_id_carrera,$periodo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("
    SELECT * FROM grupos as gr, materias_carrera as mc, materias as ma,docentes as d where
     mc.carreras_id_carrera in ($carreras_id_carrera) and  gr.periodos_escolares_idperiodos='$periodo'
     and ma.idmaterias=gr.materias_idmaterias and ma.idmaterias= mc.materias_idmaterias and d.rfc=gr.docentes_rfc;
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

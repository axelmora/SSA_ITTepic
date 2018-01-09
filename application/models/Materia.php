<?php
class Materia extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarMateriasSII()
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM materias");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
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
    /*OLD CONSULTA PARA GRUPOS DIFERENTES*/
    /*    $query=$DB2->query("
    SELECT  DISTINCT (idgrupos) FROM grupos as gr, materias_carrera as mc, materias as ma,docentes as d where
    mc.carreras_id_carrera in ($carreras_id_carrera) and  gr.periodos_escolares_idperiodos='$periodo'
    and ma.idmaterias=gr.materias_idmaterias and ma.idmaterias= mc.materias_idmaterias and d.rfc=gr.docentes_rfc;
    ");*/
    $query=$DB2->query("
    SELECT * from grupos as gr where  gr.periodos_escolares_idperiodos='$periodo' ;
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarNombreMateria($idmaterias)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("
    select * from materias where idmaterias='$idmaterias';
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function comprobar_materia_carrera($carerras,$idmaterias)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("
    select * from materias_carrera where materias_idmaterias='$idmaterias' and carreras_id_carrera in ($carerras);
    ");
    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
}

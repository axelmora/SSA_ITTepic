<?php
class Grupos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function obtenerAlumnosGrupo_Materia($idgrupo,$idmateria,$periodo,$carrera)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("select * from seleccion_materias as sm, alumnos as al where
     sm.materias_idmaterias='$idmateria' and sm.periodos_escolares_idperiodos='$periodo'
     and sm.grupos_idgrupos='$idgrupo' and sm.alumnos_numero_control=al.numero_control
    and al.carreras_id_carrera in (".$carrera.")
      ;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function obtenerAlumnosGrupo_MateriaExcluvivo($idgrupo,$idmateria,$periodo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("select * from seleccion_materias as sm, alumnos as al where
     sm.materias_idmaterias='$idmateria' and sm.periodos_escolares_idperiodos='$periodo'
     and sm.grupos_idgrupos='$idgrupo' and sm.alumnos_numero_control=al.numero_control

      ;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function verificarGrupoCarrera($idgrupo,$periodo,$materia,$carrera)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("
    select * from seleccion_materias as sm, alumnos as al where sm.periodos_escolares_idperiodos='".$periodo."'
    and sm.grupos_idgrupos='".$idgrupo."' and sm.materias_idmaterias='".$materia."'
    and al.carreras_id_carrera in (".$carrera.") and sm.alumnos_numero_control=al.numero_control;
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function contadorAlumnosGrupo($idencuesta_seguimiento)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT count(no_de_control) as total FROM  resultados_seguimiento where encuestas_seguimiento_idencuesta_seguimiento=$idencuesta_seguimiento");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return  0;
    }
  }
}

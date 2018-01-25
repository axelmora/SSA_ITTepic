<?php
class Grupos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function v3obtenerAlumnosGrupo_Materia($idgrupo,$idmateria,$periodo)
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
  /*METODO 2*/
  public function m2CargarGrupos($peridot){
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * from grupos where periodos_escolares_idperiodos='$peridot'");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return  0;
    }
  }
  public function m2VerificarGrupo($idgrupo,$Carreras){
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * from seleccion_materias where grupos_idgrupos='$idgrupo' ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return  0;
    }
  }
  public function m2VerificarAlumnosGrupo($idgrupo,$Carreras,$Periodo,$Materia){
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("
    select * from alumnos as al, seleccion_materias as sm where
     sm.grupos_idgrupos='$idgrupo' and sm.alumnos_numero_control=al.numero_control and
     sm.materias_idmaterias='$Materia' and sm.periodos_escolares_idperiodos='$Periodo' and al.carreras_id_carrera in ($Carreras);
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return  0;
    }
  }
  public function m3ObtenerGruoposPeriodo($Periodo){
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("
     SELECT * FROM grupos where periodos_escolares_idperiodos='$Periodo' ;
    ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return  0;
    }
  }
}

<?php
class Alumnos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function verificarAlumno($NUMERO_CONTROL)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM alumnos as al, carreras as ca where
      al.numero_control='$NUMERO_CONTROL' and al.carreras_id_carrera=ca.id_carrera;");
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }
    public function getAlumno($NUMERO_CONTROL)
    {
      $DBcon = $this->load->database('default', TRUE);
      $query=$DBcon->query("SELECT * FROM alumnos  where numero_control='$NUMERO_CONTROL'");
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
      //$query=$DB2->query("SELECT * FROM alumnos as al, carreras as ca where al.carreras_id_carrera=$carreras_id_carrera and al.carreras_id_carrera=$carreras_id_carrera2 and ca.id_carrera=al.carreras_id_carrera");
      //$query=$DB2->query("SELECT * FROM alumnos as al, carreras as ca where al.carreras_id_carrera=$carreras_id_carrera  and ca.id_carrera=al.carreras_id_carrera");
      $query=$DB2->query("SELECT * FROM alumnos as al,carreras as ca where ca.id_carrera=al.carreras_id_carrera and al.carreras_id_carrera IN ($carreras_id_carrera,$carreras_id_carrera2);");
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }
    public function cargarAlumnosporGrupo($idgrupo)
    {
      // $DB2 = $this->load->database('default', TRUE);
      // $query=$DB2->query("SELECT * FROM alumnos");
      // if ($query->num_rows() > 0) {
      //   return $query->result();
      // } else {
      //   return false;
      // }
    }
  }

<?php
class Departamentos extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarDepartamentos()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_academico ");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarDepartamentosID($iddepartamento_academico)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_academico where iddepartamento_academico=$iddepartamento_academico");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarCarreras()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM carreras");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function insertarDepartamento($nombre_departamento)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('nombre_departamento', $nombre_departamento );
    $DB2->insert('departamento_academico');
  }
  public function obtenerIDdepartamento()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT MAX(iddepartamento_academico) as maximo FROM departamento_academico");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function insRelacionDepaCarrera($iddepa,$idcarrera)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('departamento_academico_iddepartamento_academico', $iddepa );
    $DB2->set('carreras_id_carrera', $idcarrera );
    $DB2->insert('departamento_carreras');
  }
  public function cargarCarrerasDepartamento($iddepartamento_academico)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_carreras");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function obtenerCarrerasDepartamento($iddepartamento_academico)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_carreras where departamento_academico_iddepartamento_academico=$iddepartamento_academico");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function obtenerDepartamentoPorCarrera($idcarreras)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM departamento_carreras where carreras_id_carrera=$idcarreras");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function obtenerDepartamentoPorAplicacion($idaplicacion)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT departamento_academico_iddepartamento_academico as iddepa FROM aplicaciones where idaplicaciones=$idaplicacion");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

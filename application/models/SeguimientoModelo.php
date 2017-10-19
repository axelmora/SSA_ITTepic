<?php
class SeguimientoModelo extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function crearAplicacion($datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->insert('aplicaciones',$datos);
  }
  public function cargarAplicaciones($iddepartamento_academico)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('*');
    $DB2->order_by('fecha_creacion DESC');
    $DB2->where('departamento_academico_iddepartamento_academico',$iddepartamento_academico);
    $DB2->from('aplicaciones');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarAplicacionesPeriodo($iddepartamento_academico,$Periodo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('*');
    $DB2->order_by('fecha_creacion DESC');
    $DB2->where('departamento_academico_iddepartamento_academico',$iddepartamento_academico);
    $DB2->where('periodo',$Periodo);
    $DB2->from('aplicaciones');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

}

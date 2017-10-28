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
  public function obtenerPeriodoAplicacion($idSeguimiento)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('periodo');
    $DB2->where('idaplicaciones',$idSeguimiento);
    $DB2->from('aplicaciones');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarEncuestasSeguimiento($idSeguimiento)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM encuestas_seguimiento as es, materias as ma, docentes as do, grupos as gr
     where es.aplicaciones_idaplicaciones=$idSeguimiento AND es.idencuesta_seguimiento=gr.encuestas_seguimiento_idencuesta_seguimiento  and es.docentes_rfc = do.rfc and es.materias_idmaterias= ma.idmaterias
     order by es.fecha_creacion DESC
     ");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function contarEncuestas($idSeguimiento)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('COUNT(idencuesta_seguimiento) as numero');
    $DB2->where('aplicaciones_idaplicaciones',$idSeguimiento);
    $DB2->from('encuestas_seguimiento');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function crearGrupo($datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->insert('grupos',$datos);
  }
  public function obtenerIdGrupo()
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('MAX(idgrupos) as maximo');
    $DB2->from('grupos');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function crearSeguimiento($datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->insert('encuestas_seguimiento',$datos);
  }
  public function obtenerIdSeguimiento()
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('MAX(idencuesta_seguimiento) as maximo');
    $DB2->from('encuestas_seguimiento');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function insertarGrupos($datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->insert_batch('grupo_alumnos',$datos);
  }
  public function cargarGrupoId($idrupo)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM  grupos as gr, grupo_alumnos as ga, alumnos as al, carreras as ca where
       gr.idgrupos=$idrupo and gr.idgrupos=ga.grupos_idgrupos and ga.alumnos_numero_control=al.numero_control and al.carreras_id_carrera=ca.id_carrera;
     ");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function cargarDoceneteGrupo($idrupo)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * FROM  grupos as gr, grupo_alumnos as ga, alumnos as al, carreras as ca where
       gr.idgrupos=$idrupo and gr.idgrupos=ga.grupos_idgrupos and ga.alumnos_numero_control=al.numero_control and al.carreras_id_carrera=ca.id_carrera;
     ");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}

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
    $query=$DBcon->query("SELECT * FROM departamento_academico as da
      where da.iddepartamento_academico=$iddepartamento_academico  ");
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }
    public function cargarDepartamentosIDCarreras($iddepartamento_academico)
    {
      $DBcon = $this->load->database('default', TRUE);
      $query=$DBcon->query("SELECT * FROM departamento_carreras as dc, carreras as ca
        where $iddepartamento_academico=dc.departamento_academico_iddepartamento_academico and ca.id_carrera=dc.carreras_id_carrera");
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

      public function cargarAplicacionesporDepartamento($id)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT idaplicaciones from aplicaciones where departamento_academico_iddepartamento_academico=$id");
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
      public function borrarAplicacionSeguimiento($idaplicaciones)
      {
        $DBcon = $this->load->database('default', TRUE);
        $tempID=$this->getIDSeguimientoEnElAula($idaplicaciones);
        if($tempID)
        {
          foreach ($tempID as $key => $value) {
            $this->borrarResultadosEncuesta($value->idencuesta_seguimiento);
            $this->borrarEncuestaSeguimiento($value->idencuesta_seguimiento);
          }
        }
        $DBcon->where('idaplicaciones', $idaplicaciones );
        $DBcon->delete('aplicaciones');
      }
      public function borrarEncuestaSeguimiento($idencuesta_seguimiento)
      {
        $DB2 = $this->load->database('default', TRUE);
        $DB2->where('idencuesta_seguimiento', $idencuesta_seguimiento );
        $DB2->delete('encuestas_seguimiento');
      }
      public function borrarResultadosEncuesta($idaplicaciones)
      {
        $DBcon = $this->load->database('default', TRUE);
        $DBcon->where('encuestas_seguimiento_idencuesta_seguimiento', $idaplicaciones );
        $DBcon->delete('resultados_seguimiento');
      }
      public function getIDSeguimientoEnElAula($idaplicaciones)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT idencuesta_seguimiento from encuestas_seguimiento where aplicaciones_idaplicaciones=$idaplicaciones");
        if ($query->num_rows() > 0)
        {
          return $query->result();
        } else {
          return false;
        }
      }
      public function eliminarDepartamento($iddepa)
      {
        $DB2 = $this->load->database('default', TRUE);
        $DB2->where('departamento_academico_iddepartamento_academico', $iddepa );
        $DB2->delete('departamento_carreras');
        $DB2->where('iddepartamento_academico', $iddepa );
        $DB2->delete('departamento_academico');
      }
      public function actualizarDepartamento($iddepa,$nombre_departamento)
      {
        $DB2 = $this->load->database('default', TRUE);
        $DB2->set('nombre_departamento', $nombre_departamento );
        $DB2->where('iddepartamento_academico', $iddepa );
        $DB2->update('departamento_academico');
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
        $query=$DBcon->query("SELECT *  FROM aplicaciones as ap,departamento_academico as dc where ap.idaplicaciones=$idaplicacion and dc.iddepartamento_academico=ap.departamento_academico_iddepartamento_academico");
        if ($query->num_rows() > 0) {
          return $query->result();
        } else {
          return false;
        }
      }
    }

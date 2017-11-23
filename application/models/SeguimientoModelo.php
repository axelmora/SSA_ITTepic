<?php
/**/
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
    $query=$DBcon->query("SELECT * FROM encuestas_seguimiento as es, materias as ma, docentes as do,
      grupos as gr
      where es.aplicaciones_idaplicaciones=$idSeguimiento AND
      es.idencuesta_seguimiento=gr.encuestas_seguimiento_idencuesta_seguimiento
      and es.docentes_rfc = do.rfc and es.materias_idmaterias= ma.idmaterias
      order by es.fecha_creacion DESC
      ");
      if ($query->num_rows() > 0) {
        return $query->result();
      }
      else {
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
      }
      else {
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
      }
      else {
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
        gr.idgrupos=$idrupo and gr.idgrupos=ga.grupos_idgrupos and
        ga.alumnos_numero_control=al.numero_control and
        al.carreras_id_carrera=ca.id_carrera;
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
        $query=$DBcon->query("SELECT count(idgrupo_alumnos) as total FROM  grupos as gr, grupo_alumnos as ga where ga.grupos_idgrupos=gr.idgrupos and gr.encuestas_seguimiento_idencuesta_seguimiento=$idencuesta_seguimiento ");
        if ($query->num_rows() > 0) {
          return $query->result();
        } else {
          return  0;
        }
      }
      public function verificarContestadoAlumno($numeroControl,$idEncuesta)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT * FROM  resultados_seguimiento where no_de_control='$numeroControl' and encuestas_seguimiento_idencuesta_seguimiento=$idEncuesta   ");
        if ($query->num_rows() > 0) {
          return true;
        } else {
          return false;
        }
      }
      public function encuestaTotalContestados($idencuesta)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT count(idresultado_seguimiento) as total FROM  resultados_seguimiento  where encuestas_seguimiento_idencuesta_seguimiento=$idencuesta ");
        if ($query->num_rows() > 0) {
          return $query->result();
        } else {
          return  0;
        }
      }
      public function cargarDoceneteGrupo($idrupo)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT * FROM  grupos as gr, grupo_alumnos as ga, alumnos as al, carreras as ca where
          gr.idgrupos=$idrupo and gr.idgrupos=ga.grupos_idgrupos and
          ga.alumnos_numero_control=al.numero_control and
          al.carreras_id_carrera=ca.id_carrera;
          ");
          if ($query->num_rows() > 0)
          {
            return $query->result();
          } else {
            return false;
          }
        }
        public function verificarAplicacion($Contra,$Periodo,$Departamento)
        {
          $DBcon = $this->load->database('default', TRUE);
          $query=$DBcon->query("SELECT * FROM  aplicaciones  where periodo=$Periodo and contrasena='$Contra' and departamento_academico_iddepartamento_academico=$Departamento order by fecha_creacion desc; ");
          if ($query->num_rows() > 0)
          {
            return $query->result();
          } else {
            return false;
          }
        }
        public function verificarAplicacionContasena($Periodo,$Departamento)
        {
          $DBcon = $this->load->database('default', TRUE);
          $query=$DBcon->query("SELECT * FROM  aplicaciones  where periodo=$Periodo and departamento_academico_iddepartamento_academico=$Departamento order by fecha_creacion desc; ");
          if ($query->num_rows() > 0)
          {
            return $query->result();
          } else {
            return false;
          }
        }
        public function obtenerEncuestas($idaplicaciones,$numero_control)
        {
          $DBcon = $this->load->database('default', TRUE);
          $query=$DBcon->query("SELECT * FROM encuestas_seguimiento as es, grupos as gr,grupo_alumnos as ga where es.aplicaciones_idaplicaciones=$idaplicaciones "
          ."and es.idencuesta_seguimiento=gr.encuestas_seguimiento_idencuesta_seguimiento and ".
          "gr.idgrupos=ga.grupos_idgrupos and ga.alumnos_numero_control=$numero_control"
        );
        if ($query->num_rows() > 0)
        {
          return $query->result();
        } else {
          return false;
        }
      }
      public function verificarEncuestaContestada($idaplicaciones,$numero_control)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT * FROM resultados_seguimiento where encuestas_seguimiento_idencuesta_seguimiento=$idaplicaciones and no_de_control=$numero_control" );
        if ($query->num_rows() > 0)
        {
          return true;
        } else {
          return false;
        }
      }
      public function obtenerDocenteMateria($idaplicaciones)
      {
        $DBcon = $this->load->database('default', TRUE);
        $query=$DBcon->query("SELECT es.idencuesta_seguimiento,ma.nombre_materia,d.nombres,d.apellidos FROM  encuestas_seguimiento as es, docentes as d, materias as ma ".
        " where es.idencuesta_seguimiento=$idaplicaciones and es.materias_idmaterias=ma.idmaterias".
        " and es.docentes_rfc=d.rfc;"
      );
      if ($query->num_rows() > 0)
      {
        return $query->result();
      } else {
        return false;
      }
    }
    public function insertarRespuestas($datos)
    {
      $DB2 = $this->load->database('default', TRUE);
      $DB2->insert('resultados_seguimiento',$datos);
    }
    public function cargarEncuestasGrupos($idAplicacion)
    {
      $DBcon = $this->load->database('default', TRUE);
      $query=$DBcon->query("SELECT es.idencuesta_seguimiento,ma.nombre_materia,d.nombres,d.apellidos FROM  encuestas_seguimiento as es, docentes as d, materias as ma ".
      " where es.idencuesta_seguimiento=$idAplicacion and es.materias_idmaterias=ma.idmaterias".
      " and es.docentes_rfc=d.rfc;"
    );
    if ($query->num_rows() > 0)
    {
      return $query->result();
    } else {
      return false;
    }
  }
  public function resultadosEncuesta($idseguimiento)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT respuestas from resultados_seguimiento where encuestas_seguimiento_idencuesta_seguimiento=$idseguimiento"
  );
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function actualizarRetro($id,$retro,$fecha)
{
  $DBcon = $this->load->database('default', TRUE);
  $DBcon->set('retroalimentacion', $retro);
  $DBcon->set('fecha_retro', $fecha);
  $DBcon->where('idencuesta_seguimiento', $id);
  $DBcon->update('encuestas_seguimiento');
  return true;
}
public function obtenerIdSeguimientoporGrupo($seguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT aplicaciones_idaplicaciones from encuestas_seguimiento where idencuesta_seguimiento=$seguimiento");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function cargarRetroAlimentacionID($seguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT retroalimentacion,aplicaciones_idaplicaciones from encuestas_seguimiento where idencuesta_seguimiento=$seguimiento");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function verificarExistenciaRespuestas($idencuesta_seguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT * from resultados_seguimiento where encuestas_seguimiento_idencuesta_seguimiento=$idencuesta_seguimiento");
  if ($query->num_rows() > 0)
  {
    return true;
  } else {
    return false;
  }
}
public function verificarExistenciaAlumnos($idencuesta_seguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT * from grupos as gr,grupo_alumnos as ga where gr.encuestas_seguimiento_idencuesta_seguimiento=$idencuesta_seguimiento and gr.idgrupos=ga.grupos_idgrupos");
  if ($query->num_rows() > 0)
  {
    return true;
  } else {
    return false;
  }
}
public function getIDGruposSeguimiento($idencuesta_seguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT idgrupos from grupos where encuestas_seguimiento_idencuesta_seguimiento=$idencuesta_seguimiento");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function borrarEncuestaSeguimiento($idencuesta_seguimiento)
{
  $DB2 = $this->load->database('default', TRUE);
  if($this->verificarExistenciaAlumnos($idencuesta_seguimiento))
  {
    if ($this->verificarExistenciaRespuestas($idencuesta_seguimiento))
    {
      $DB2->where('encuestas_seguimiento_idencuesta_seguimiento', $idencuesta_seguimiento );
      $DB2->delete('resultados_seguimiento');
      $tempIDGRUPO=$this->getIDGruposSeguimiento($idencuesta_seguimiento);
      $DB2->where('grupos_idgrupos', $tempIDGRUPO[0]->idgrupos );
      $DB2->delete('grupo_alumnos');
      $DB2->where('encuestas_seguimiento_idencuesta_seguimiento', $idencuesta_seguimiento );
      $DB2->delete('grupos');
    }else {
      $tempIDGRUPO=$this->getIDGruposSeguimiento($idencuesta_seguimiento);
      $DB2->where('grupos_idgrupos', $tempIDGRUPO[0]->idgrupos );
      $DB2->delete('grupo_alumnos');
      $DB2->where('encuestas_seguimiento_idencuesta_seguimiento', $idencuesta_seguimiento );
      $DB2->delete('grupos');
    }
  }else {
    $DB2->where('encuestas_seguimiento_idencuesta_seguimiento', $idencuesta_seguimiento );
    $DB2->delete('grupos');
  }
  $DB2->where('idencuesta_seguimiento', $idencuesta_seguimiento );
  $DB2->delete('encuestas_seguimiento');
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
public function borrarAplicacionSeguimiento($idaplicaciones)
{
  $DBcon = $this->load->database('default', TRUE);
  $tempID=$this->getIDSeguimientoEnElAula($idaplicaciones);
  if($tempID)
  {
    foreach ($tempID as $key => $value) {
      $this->borrarEncuestaSeguimiento($value->idencuesta_seguimiento);
    }
  }
  $DBcon->where('idaplicaciones', $idaplicaciones );
  $DBcon->delete('aplicaciones');
}
public function docentesReportes($idAplicacion)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT DISTINCT es.docentes_rfc,d.rfc,d.nombres,d.apellidos,es.aplicaciones_idaplicaciones FROM encuestas_seguimiento as es,docentes as d where es.aplicaciones_idaplicaciones=$idAplicacion and d.rfc=es.docentes_rfc;");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function reporteDocentePDFMaterias($rfcdoncete,$idAplicaciones)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT * FROM encuestas_seguimiento as es,docentes as d where es.aplicaciones_idaplicaciones=$idAplicaciones and d.rfc=es.docentes_rfc and  '$rfcdoncete'=es.docentes_rfc;");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function reportesAplicacionesGeneral($idAplicaciones)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT * FROM encuestas_seguimiento where aplicaciones_idaplicaciones=$idAplicaciones;");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function deleteEncuestaAlumno($numero_control,$seguimieno)
{
  $DBcon = $this->load->database('default', TRUE);
  $DBcon->where('encuestas_seguimiento_idencuesta_seguimiento', $seguimieno );
  $DBcon->where('no_de_control', $numero_control );
  $DBcon->delete('resultados_seguimiento');
}
public function getGrupoPorEncuesta($idseguimiento)
{
  $DBcon = $this->load->database('default', TRUE);
  $query=$DBcon->query("SELECT idgrupos FROM grupos where encuestas_seguimiento_idencuesta_seguimiento=$idseguimiento");
  if ($query->num_rows() > 0)
  {
    return $query->result();
  } else {
    return false;
  }
}
public function deleteAlumnoGrupo($numerocontrol,$idgrupo)
{
  $DBcon = $this->load->database('default', TRUE);
  $DBcon->where('grupos_idgrupos', $idgrupo );
  $DBcon->where('alumnos_numero_control', $numerocontrol );
  $DBcon->delete('grupo_alumnos');
}
}

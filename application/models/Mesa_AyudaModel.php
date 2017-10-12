<?php
class Mesa_AyudaModel extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function mostrarAsuntos()
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT *  From mesa_ayuda as ma,usuarios as u where u.idusuarios=ma.usuarios_idusuarios order by ma.fecha_mensaje desc;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function mostrarAsuntosUnico($idasunt)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT *  From mesa_ayuda as ma,usuarios as u where u.idusuarios=ma.usuarios_idusuarios and ma.idmesa_ayuda=$idasunt order by ma.fecha_mensaje desc;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function mostrarMensjesAunsto($idasunt)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT *  From respuestas_mesa as ma,usuarios as u where u.idusuarios=ma.usuarios_idusuarios and ma.mesa_ayuda_idmesa_ayuda=$idasunt order by ma.fecha_respuesta desc;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function actualizarultima_sesion($usuario,$fechayhora)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('ult_conexion', $fechayhora);
    $DB2->where('idusuarios', $usuario);
    $DB2->update('usuarios');
    return true;
  }
  public function solicitarsoporte($idusuario,$asunto,$mensaje,$url)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('asunto', $asunto );
    $DB2->set('mensaje',$mensaje);
    $DB2->set('url_mensaje',$url);
    $DB2->set('fecha_mensaje',date('Y-m-d H:i:s'));
    $DB2->set('estado', 1);
    $DB2->set('usuarios_idusuarios', $idusuario);
    $DB2->insert('mesa_ayuda');
  }
  public function borarMensajeSoporte($idmensaje)
  {
    if ($this->mostrarMensjesAunsto($idmensaje)==false) {
      $DB2 = $this->load->database('default', TRUE);
      $DB2->where('idmesa_ayuda', $idmensaje );
      $DB2->delete('mesa_ayuda');
    }else {
      echo "existen mensajes interno";
    }
  }
  public function insertarRespuesta($idmensajeprincipal,$respus,$iduser)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('mesa_ayuda_idmesa_ayuda', $idmensajeprincipal );
    $DB2->set('respuesta', $respus );
    $DB2->set('fecha_respuesta',date('Y-m-d H:i:s'));
    $DB2->set('usuarios_idusuarios', $iduser);
    $DB2->insert('respuestas_mesa');
  }
}

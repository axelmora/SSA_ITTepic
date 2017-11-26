<?php
class Mesa_AyudaModel extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function mostrarAsuntos()
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT u.nombre_usuario, ma.idmesa_ayuda,ma.estado,ma.asunto,ma.mensaje,ma.fecha_mensaje,ma.url_mensaje  From mesa_ayuda as ma,usuarios as u where u.idusuarios=ma.usuarios_idusuarios order by ma.fecha_mensaje desc;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function mostrarAsuntosUnico($idasunt)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT u.nombre_usuario, ma.idmesa_ayuda,ma.estado,ma.asunto,ma.mensaje,ma.fecha_mensaje,ma.url_mensaje
        From mesa_ayuda as ma,usuarios as u where u.idusuarios=ma.usuarios_idusuarios and ma.idmesa_ayuda=$idasunt order by ma.fecha_mensaje desc;");
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
  public function solicitarsoporte($idusuario,$asunto,$mensaje,$url)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('asunto', $asunto );
    $DB2->set('mensaje',$mensaje);
    $DB2->set('url_mensaje',$url);
    $DB2->set('fecha_mensaje',date('Y-m-d H:i:s'));
    $DB2->set('estado', 0);
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
      /*  echo "existen mensajes interno";*/
      /*Borrar los mensajes internos*/
      $DB2 = $this->load->database('default', TRUE);
      $DB2->where('mesa_ayuda_idmesa_ayuda', $idmensaje );
      $DB2->delete('respuestas_mesa');
      /*Borra el mensaje principal */
      $DB2 = $this->load->database('default', TRUE);
      $DB2->where('idmesa_ayuda', $idmensaje );
      $DB2->delete('mesa_ayuda');
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
  public function borarMensajeRespuesta($idmensaje)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->where('idrespuestas_mesa', $idmensaje );
    $DB2->delete('respuestas_mesa');
  }
  public function cambioEstado($idmensaje,$nuevoestado)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('estado', $nuevoestado);
    $DB2->where('idmesa_ayuda', $idmensaje);
    $DB2->update('mesa_ayuda');
    return true;
  }
  public function cargarSolicitudesDeSoporte($idusuario)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT *  From mesa_ayuda where usuarios_idusuarios=$idusuario order by fecha_mensaje desc;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

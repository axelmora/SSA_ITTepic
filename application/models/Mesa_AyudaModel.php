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
    $DB2->set('fecha_mensaje',date('Y-m-d H:i:s'));
    $DB2->set('estado', 1);
    $DB2->set('usuarios_idusuarios', $idusuario);
    $DB2->insert('mesa_ayuda');
  }
}

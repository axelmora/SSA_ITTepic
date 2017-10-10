<?php
class Mesa_Ayuda extends CI_Model {
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
  public function solicitarsoporte($idusuario,$datos)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('ult_conexion', $fechayhora);
    $DB2->where('idusuarios', $usuario);
    $DB2->insert('mesa_ayuda');
  }
}

<?php
class Sistema extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function obtenerproduccion()
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->select('*');
    $DB2->where('idconfiguracion_sistema',1);
    $DB2->from('configuracion_sistema');
    $query = $DB2->get();
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function actualizarprodiccion($valor,$fechayhora)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('produccion', $valor);
    $DB2->set('produccion_fecha', $fechayhora);
    $DB2->where('idconfiguracion_sistema',1);
    $DB2->update('configuracion_sistema');
    return true;
  }
  public function actualizarCorreo($correo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $DB2->set('correo_sistema', $correo);
    $DB2->update('configuracion_sistema');
    return true;
  }
}

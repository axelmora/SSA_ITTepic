<?php
class Mesa_Ayuda extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function mostrarusuarios($idusuarios)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM usuarios as u, departamento_academico as da where u.idusuarios!=$idusuarios and u.departamento_academico_iddepartamento_academico = da.iddepartamento_academico order by u.ult_conexion desc;");
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
}

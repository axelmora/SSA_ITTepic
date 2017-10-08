<?php
class Usuarios extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function iniciarsesionm($usuario, $password)
  {
    $DBcon = $this->load->database('default', TRUE);
  /*  $DB2->select('*');
    $DB2->where('usuario', $usuario);
    $DB2->where('password', $password);*/
    $query=$DBcon->query("SELECT * FROM usuarios as u, departamento_academico as da where u.usuario='$usuario' and password='$password' and u.departamento_academico_iddepartamento_academico = da.iddepartamento_academico;");
  /*  $DB2->from('usuarios');
    $query = $DB2->get();*/
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function actualizarultima_sesion($usuario,$fechayhora)
  {
    $DBcon = $this->load->database('default', TRUE);
    $DBcon->set('ult_conexion', $fechayhora);
    $DBcon->where('idusuarios', $usuario);
    $DBcon->update('usuarios');
    return true;
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
}

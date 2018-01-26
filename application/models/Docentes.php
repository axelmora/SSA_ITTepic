<?php
class Docentes extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarDocentesDepartamento($Departamento)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM docentes where departamento='$Departamento'");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function obtenerDocenteRFC($rfc)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT CONCAT(nombres,' ',apellidos) as nombre_docente FROM docentes where rfc='$rfc'");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function verificarDocenteDepartamento($rfc,$departamento_verifcar)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM docentes where rfc='$rfc' and departamento in($departamento_verifcar)");
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
  }
}

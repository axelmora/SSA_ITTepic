<?php
class Aplicaciones extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarAplicacionesDepartamento($iddepa,$periodo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM aplicaciones where periodos_escolares_idperiodos='$periodo' and departamento_academico_iddepartamento_academico=$iddepa order by fecha_creacion desc");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function cargarAplicacionesPublicas($periodo)
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT DISTINCT (departamento_academico_iddepartamento_academico)
    FROM aplicaciones where periodos_escolares_idperiodos='$periodo' ;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
}

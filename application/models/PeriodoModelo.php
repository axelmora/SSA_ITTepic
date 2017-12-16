<?php
class PeriodoModelo extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarPeriodos()
  {
    $DB2 = $this->load->database('default', TRUE);
    $query=$DB2->query("SELECT * FROM periodos_escolares  order by idperiodos desc");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}

<?php
class Plantilla extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function cargarPlantilla()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * from plantilla_encuestas");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function actualizarEncabezado($encabezado)
  {
    $DBcon = $this->load->database('default', TRUE);
    $DBcon->set('encabezado',$encabezado);
    $DBcon->where('idplantilla_encuestas', 1 );
    $DBcon->update('plantilla_encuestas');
  }
  public function cargarPlantillaID($id)
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * from plantilla_encuestas where idplantilla_encuestas=$id");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
}

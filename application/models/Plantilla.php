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
  public function cargarPlantillaOrdenadas()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT * from plantilla_encuestas order by fecha_creacion desc");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function cargarPlantillaMaximo()
  {
    $DBcon = $this->load->database('default', TRUE);
    $query=$DBcon->query("SELECT MAX(idplantilla_encuestas) as maximo from plantilla_encuestas");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
  }
  public function addplantilla($datos)
  {
    $DBcon =$this->load->database('default', TRUE);
    $DBcon->insert('plantilla_encuestas',$datos);
  }
  public function updateplantilla($datos,$id)
  {
    $DBcon =$this->load->database('default', TRUE);
    $DBcon->where('idplantilla_encuestas', $id );
    $DBcon->update('plantilla_encuestas',$datos);
  }
  public function actualizarEncabezado($encabezado)
  {
    $DBcon = $this->load->database('default', TRUE);
    $DBcon->set('encabezado',$encabezado);
    $DBcon->where('idplantilla_encuestas', 1 );
    $DBcon->update('plantilla_encuestas');
  }
  public function borrar_plantilla($id)
  {
    $DBcon = $this->load->database('default', TRUE);
    $DBcon->where('idplantilla_encuestas', $id );
    $DBcon->delete('plantilla_encuestas');
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

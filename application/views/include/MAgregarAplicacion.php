<!-- Modal Agregar Aplicacion -->
<form id="agregarAplicacionForm" method="post" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/generarAplicacion" >
  <div class="modal fade" id="modalAplicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear nueva aplicacion  <b><?php echo "".genePeridoActual($this->session->userdata('periodosemestre')); ?></b> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="contrasenaapp">Elegir periodo:</label>
            <select  class="form-control" id="periodo" name="periodo" required>
              <option selected value="1">Agosto- Diciembre 2017</option>
            </select>
          </div>
          <div class="form-group">
            <label for="plantilla">Seleccionar plantilla</label>
            <select  class="form-control" id="plantilla" name="plantilla" required >
              <option selected value="1">ITTEPIC-AC-PO-004-07</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-4">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> CANCELAR</button>
            </div>
            <div class="col-lg-6">
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR NUEVA APLICACION</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Modal Agregar Aplicacion Fin -->
<!-- Modal ERROR -->
<div class="modal fade " id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo "$ErrorContra"; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

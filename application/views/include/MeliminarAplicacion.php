<!-- Modal Borrar Aplicaciones -->
<form  action="<?php echo base_url(); ?>index.php/Panel_seguimiento/eliminarEncuestaSeguimientoCompleta" method="post">
  <div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">¿Desea eliminar esta aplicacion?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="number" id="idAplicacionesBorrar" name="idAplicacionesBorrar" value="" hidden required />
          <div class="card text-white bg-danger ">
            <div class="card-body">
              <h4 class="card-title"><i class="fa fa-exclamation-triangle animated tada infinite" aria-hidden="true"></i> Atención</h4>
              <p class="card-text"><b>Al borrar esta aplicación de seguimiento en el aula se perderán la siguiente información.</b></p>
              <ul>
                <li>Resultados de todas la encuesta seguimiento en el aula.</li>
                <li>Todos los grupos de alumnos para esta aplicación.</li>
                <li>Todos los reportes de avance.</li>
              </ul>
            <p class="card-text"><center><b>Una vez eliminada <i class="fa fa-eraser" aria-hidden="true"></i> la aplicación es imposible recuperar <i class="fa fa-undo" aria-hidden="true"></i> las encuestas.</b></center></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> NO</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> SI </button>
        </div>
      </div>
    </div>
  </div>
</form>

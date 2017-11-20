<!-- modal eliminar -->
<form class="" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/eliminarEncuestaGrupo/" method="post">
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <center><i class="fa fa-trash text-danger" aria-hidden="true"></i>¿Desea  eliminar esta encuesta de seguimiento en el aula?    </center> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="number" id="idEliminarEncu" name="idEliminarEncu" value="" required hidden>
            <input type="number" id="idAplicacionPostEliminar" name="idAplicacionPostEliminar" value="" required hidden>
            <table class="table table-bordered table-sm">
              <caption>Datos de la encuesta a eliminar.</caption>
              <thead>
                <tr>
                  <th scope="col">MATERIA</th>
                  <th scope="col">DOCENTE</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><div id="idEliminarMateriaNombre"></div></td>
                  <td><div id="idEliminarDocenteNombre"></div></td>
                </tr>
              </tbody>
            </table>
            <div class="card text-white bg-danger ">
              <div class="card-body">
                <h4 class="card-title"><i class="fa fa-exclamation-triangle animated tada infinite" aria-hidden="true"></i> Atención</h4>
                <p class="card-text"><b>Al borrar esta encuesta de seguimiento se perderán la siguiente información.</b></p>
                <ul>
                  <li>Resultados de la encuesta seguimiento en el aula.</li>
                  <li>Grupo de alumnos para esta encuesta.</li>
                  <li>Reporte de avance.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> CANCELAR</button>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash " aria-hidden="true"></i> ELIMINAR </button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- modal eliminar  fin -->

<!-- Modal Agregar Aplicacion -->
<form id="agregarAplicacionForm" method="post" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/generarAplicacion" >
  <div class="modal fade" id="modalAplicacion" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false"  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=""><i class="fa fa-plus-square" aria-hidden="true"></i> Crear nueva aplicacion de seguimiento en el aula.  </h5>
          <button id="botoncerrar" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group" id="p1">
            <label for="contrasenaapp"><b>Elegir periodo:</b></label>
            <input type="text" name="periodo_texto" id="periodo_texto" hidden value="">
            <select  class="form-control" id="periodo" name="periodo" required>
              <?php
              if($Periodos){
                $poss=0;
                foreach ($Periodos as $key => $value) {
                  if($poss==0){
                    ?>
                    <option selected value="<?php echo $value->idperiodos; ?>"><?php echo $value->identificacion_larga ." - ". $value->idperiodos; ?></option>
                    <?php
                  }else {
                    ?>
                    <option  value="<?php echo $value->idperiodos; ?>"><?php echo $value->identificacion_larga ." - ". $value->idperiodos; ?></option>
                    <?php
                  }
                  $poss++;
                }
              }else {
                ?>
                <option selected value="NINGUNO">ERROR SIN PERIODOS </option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group" id="p2">
            <label for="plantilla"><b>Seleccionar plantilla:</b></label>
            <select  class="form-control" id="plantilla" name="plantilla" required >
              <?php
              $pos=0;
              foreach ($Plantillas as $key => $value) {
                if ($pos==0) {
                  echo '<option selected value="'.$value->idplantilla_encuestas.'">'.$value->nombre.'</option>';
                }else {
                  echo '<option value="'.$value->idplantilla_encuestas.'">'.$value->nombre.'</option>';
                }
                $pos++;
              }
              ?>
            </select>
          </div>
          <div class="card bg-danger text-white animated fadeInUp" id="panel_advertenciaperiodo" style="display:none">
            <div class="card-body">
              <center>
                <i class="fa fa-exclamation-circle tamanoiconos animated tada infinite" aria-hidden="true"></i> <br> <br>
                <b>Atención</b> se seleccionó un periodo diferente al actual.
              </center>
            </div>
          </div>
          <div style="display:none" id="panel_atencion" class="col-lg-12">
            <div   class="card text-white bg-warning ">
              <div class="card-header">Generando encuestas para el periodo <b><span id="textoaplicacion"></span></b>... </div>
              <div class="card-body">
                <center><p class="card-text"><b>Atención</b> este proceso puede durar más de 1 minuto. </p></center>
                <center><p class="card-text"><b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Mientras el proceso se está ejecutando, favor de no cerrar esta página y ventana.</b></p></center>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div  id="botoncancelargrupos"class="col-lg-4">
              <button   type="button" class="btn btn-danger " data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> CANCELAR</button>
            </div>
            <div class="col-lg-6">
              <button type="submit" id="botonenviargrupos" style="margin-left: 15px;" class="btn btn-primary carobtn"><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR NUEVA APLICACION</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Modal Agregar Aplicacion Fin -->

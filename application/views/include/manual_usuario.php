<!-- Modal Manual de usuario -->
<script src="<?php echo base_url(); ?>js/pdfobject.js"></script>
<div class="modal fade" id="modalmanualdeusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Manual de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="manualdeusuariover"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> CERRAR</button>
        <a href="<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf" class="btn btn-primary" download> <i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a>
      </div>
    </div>
  </div>
  <style>
  .pdfobject-container { height: 650px;}
  .pdfobject { border: 1px solid #666; }
  </style>
</div>
<!-- FIN Modal Manual de usuario -->

<div class="sombranav">
  <nav class="navbar  navbar-fixed-top pulse-header navbar-light bg-light">
    <ul class="nav navbar-nav navbar-nav-left">
      <li class="nav-item"><a href="#" class="open-pulse-sidebar"><i class="ion-grid pulse-icons"></i></a></li>
    </ul>
    <ul class="nav navbar-nav float-xs-right">
      <li class="nav-item"><a href="#" class="toggle-search"><i class="ion-ios-search-strong pulse-icons"></i></a></li>
      <li class="nav-item">
        <a href="#" class="open-notification-sidebar">
          <i class="ion-earth pulse-icons"></i>
          <span class="pulse-circle"></span>
        </a>
      </li>
      <li class="nav-item"><a href="#" class="open-chat-sidebar"><i class="ion-chatboxes pulse-icons"></i></a></li>
    </ul>
    <img class="img-fluid"  src="<?php echo base_url(); ?>images/logochico.png" alt="Instituto Tecnológico de Tepic" />
  </nav>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" style="font-size:30px; color:#FF8000;" href="<?php echo base_url(); ?>Panel_seguimiento/"> SSA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>index.php"><i class="fa fa-home" aria-hidden="true"></i> INICO <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>Panel_Administrativo/reportes"><i class="icon-clipboard" aria-hidden="true"></i>  REPORTES POR DEPARTAMENTO ACADEMICO</a>
        </li>
      </ul>
      <ul class='navbar-nav'>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo "".$this->session->userdata('username');?> </b>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>C_usuarios/"><i class="fa fa-user" aria-hidden="true"></i> PERFIL</a>
            <button class="dropdown-item" data-toggle="modal" data-target="#modalmanualdeusuario" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> MANUAL USUARIO</button>
            <a class="dropdown-item" href="<?php echo base_url(); ?>C_usuarios/logout" ><i class="fa fa-sign-out" aria-hidden="true"></i> SALIR</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>
<!-- Modal Manual de usuario -->
<script src="<?php echo base_url(); ?>js/pdfobject.js"></script>
<div class="modal fade" id="modalmanualdeusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content h-100">
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
</div>
<!-- FIN Modal Manual de usuario -->

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
    <a class="navbar-brand" style="font-size:30px; color:#FF8000;" href="<?php echo base_url(); ?>index.php/"> SSA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo "".base_url().'index.php/panel_administracion/';?>"><i class="fa fa-home" aria-hidden="true"></i> INICO <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo "".base_url().'index.php/panel_administracion/lista_usuarios';?>"><i class="fa fa-users" aria-hidden="true"></i>USUARIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo "".base_url().'index.php/panel_administracion/mesadeayuda';?>"><i class="fa fa-question" aria-hidden="true"></i> MESA DE AYUDA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo "".base_url().'index.php/panel_administracion/sistemainfo';?>"><i class="fa fa-server" aria-hidden="true"></i>INFORMACION SISTEMA</a>
        </li>
      </ul>
      <ul class='navbar-nav'>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <b>  <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo "".$this->session->userdata('username');?> </b>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/C_usuarios/" ><i class="fa fa-user" aria-hidden="true"></i> PERFIL</a>
            <button class="dropdown-item" data-toggle="modal" data-target="#modalmanualdeusuario" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> MANUAL USUARIO</button>
            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/C_usuarios/logout" ><i class="fa fa-sign-out" aria-hidden="true"></i> SALIR</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - Usuarios</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/tec.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="description" content="">
	<meta name="author" content="Fernando Manuel Avila Cataño">
	<meta name="theme-color" content="#FFFFFF">
	<meta name="msapplication-navbutton-color" content="#FFFFFF">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
  <link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/dataTables.bootstrap4.min.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/responsive.bootstrap4.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <?php $this->load->view('include/menuadmin'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="card menus">
        <div class="card-body">
          <div class="row" >
            <div class="col-lg-2">
              <h3><i class="fa fa-users" aria-hidden="true"></i> Nuevo usuario</h3>
              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/lista_usuarios" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row" >
                <div class="col-lg-12">
                  <form>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Check me out
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">AGREGAR NUEVO USUARIO</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('include/manual_usuario'); ?>
  <?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/responsive.bootstrap4.min.js"></script>
<script>

$(document).ready(function(){
  var opciones = {
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
});
</script>
</html>

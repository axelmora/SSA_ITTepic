<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - Editar usuario <?php echo $usuarioEditar[0]->nombre_usuario; ?> </title>
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
            <div class="col-lg-6">
              <h3><i class="fa fa-users" aria-hidden="true"></i> Editar usuario- <?php echo $usuarioEditar[0]->usuario; ?></h3>
              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/panel_administracion/lista_usuarios" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row" >
                <div class="col-lg-12">
                  <form method="post" action="<?php echo base_url(); ?>index.php/panel_administracion/updateUser/<?php  echo $usuarioEditar[0]->idusuarios; ?>" >
                    <div class="form-group">
                      <label for="nombre_user">Nombre actual  del usuario:</label>
                      <input type="text" class="form-control" id="nombre_user" name="nombre_user" aria-describedby="nombre_userHelp" placeholder="Ingresar nombre del usuario." required value="<?php echo set_value('nombre_user'); echo $usuarioEditar[0]->usuario; ?>">
                      <small id="nombre_userHelp" class="form-text text-muted">Nombre del usuario por el cual iniciara sesión.</small>
                      <?php
                      if(isset($error_mismo_usario)){
                        ?>
                        <div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

                          <?php
                            echo "$error_mismo_usario";
                          ?>
                        </div>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="nombre_userc">Nombre completo actual del usuario:</label>
                      <input type="text" class="form-control" id="nombre_userc"  name="nombre_userc"  placeholder="Ingresar nombre completo de usuario." value="<?php echo set_value('nombre_userc'); echo $usuarioEditar[0]->nombre_usuario; ?>" required>
                    </div>
                    <div class="form-group">
                  <!--    <label for="contrasena">Contraseña:</label>
                      <input type="password" class="form-control" id="contrasena" name="contrasena"  value="" placeholder="Ingresar contraseña" required>
                -->    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Departamento actual del usuario: </label>
                      <select name="departamento_academico" id="departamento_academico" class="custom-select" required>
                        <?php
                        if($DEPARTAMENTOS)
                        {
                        //  $pos=0;
                          foreach ($DEPARTAMENTOS as $key => $value) {
                            if($value->iddepartamento_academico==$usuarioEditar[0]->departamento_academico_iddepartamento_academico)
                            {
                              echo '<option selected value="'.$value->iddepartamento_academico.'">'.$value->nombre_departamento.'</option>';
                            }
                            else {
                              echo '<option value="'.$value->iddepartamento_academico.'">'.$value->nombre_departamento.'</option>';
                            }
                        //    $pos++;
                          }
                        }
                        ?>
                      </select>
                      <div id="esAdmin" class="alert alert-warning" role="alert" style="display:none; margin-top:10px;">
                        <i class="fa fa-exclamation-circle animated tada infinite" aria-hidden="true"></i>   Atención esta seleccionado un tipo de cuenta de administración.
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success">ACTUALIZAR INFORMACION DE <?php  echo $usuarioEditar[0]->nombre_usuario; ?></button>
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

  if($(this).find("option:selected").attr('value')==1)
  {
    $("#esAdmin").fadeIn();
  }else {
    $("#esAdmin").fadeOut();
  }


  var opciones = {
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed("<?php echo base_url(); ?>file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
  $('#departamento_academico').change(function(){
    if($(this).find("option:selected").attr('value')==1)
    {
      $("#esAdmin").fadeIn();
    }else {
      $("#esAdmin").fadeOut();
    }
  });
});
</script>
</html>

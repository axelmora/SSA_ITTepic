<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- PANEL SEGUIMIENTO EN EL AULA</title>
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
  <?php $this->load->view('include/menu'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="card caro">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-5">
                  <h3><i class="fa fa-commenting-o" aria-hidden="true"></i>Retroalimentación</h3>
                  <?php
                  $idcampo="";
                  $retro="";
                  if($RetroAlimentacion)
                  {
                    foreach ($RetroAlimentacion as $key => $value) {
                      $idcampo=$value->aplicaciones_idaplicaciones;
                      $retro=$value->retroalimentacion;
                    }
                  }
                  $DOCENTE="";
                  $MATERIA="";
                  foreach ($DATOSMATERIA as $key => $value) {
                    $DOCENTE="".$value->nombre_docente;
                    $MATERIA="".$value->nombre_materia ;
                  }
                  ?>
                  <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionlista/<?php echo "".$idcampo; ?>" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                  <?php
                  $id="";
                  foreach ($idSegui as $key => $value) {
                    $id=$value->aplicaciones_idaplicaciones;
                  }
                  ?>
                </div>
                <div class="col-lg-5">

                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-5 col-md-5">
                  <form method="post" action="<?php echo base_url(); ?>index.php/Panel_seguimiento/guardaretroAlimentacion/<?php echo $idRetroAlimntacion; ?>">

                    <input type="number"name="id" value="<?php echo $id; ?>" hidden required >
                    <textarea name="retroalimentacion" required><?php echo "$retro"; ?> </textarea>
                    <br>
                    <center>
                      <?php
                      if (isset($ExistenResultados)) {
                        ?>
                        <div class="card text-white bg-danger" >
                          <div class="card-body">
                            <p class="card-text">No es posible generar una retroalimentación sin resultados.
                              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionlista/<?php echo "".$idcampo; ?>" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                            </p>
                          </div>
                        </div>
                        <?php
                      }else {
                        ?>
                        <button type="submit"  class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> PUBLICAR</button>
                        <a class="btn btn-danger"  href='<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionlista/<?php echo "".$idcampo; ?>'><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</a>
                        <?php
                      }
                      ?>

                    </center>
                  </form>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="scrolleador">
                    <div class="card">
                      <div class="card-body">
                        <table class="table table-bordered menus">
                          <thead>
                            <tr>
                              <th scope="col">DOCENTE</th>
                              <th scope="col">MATERIA</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo "$DOCENTE"; ?></td>
                              <td><?php echo "$MATERIA"; ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <?php
                        if($EncuestaRetro)
                        {
                          echo "$EncuestaRetro";
                        }
                        ?>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', 	menubar:false,statusbar: false,
plugins: [
  'advlist autolink lists link image charmap print preview hr anchor pagebreak',
  'searchreplace wordcount visualblocks visualchars code fullscreen',
  'insertdatetime media nonbreaking save table contextmenu directionality',
  'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
],
toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
image_advtab: true,
templates: [
  { title: 'La retroalimentación fue la siguiente ', content: 'La retroalimentación fue la siguiente ' },
  { title: 'En difinitiva la retroalimentación fue la siguiente ', content: 'En difinitiva la retroalimentación fue la siguiente' }
],
content_css: [
  '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  '//www.tinymce.com/css/codepen.min.css'
],
language: 'es_MX',
height : "325"});</script>
<script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
</html>

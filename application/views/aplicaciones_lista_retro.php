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
  <div class="">
    <div class="row" style="margin-right: 0px; margin-left: 0px;">
      <div class="col-lg-12">
        <div class="card caro">
          <div class="card-body" style="z-index: 1">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-10">
                    <?php
                    $peridotlista="";
                    foreach ($AplicacionesPeriodo as $key => $valorPeriodo) {
                      $peridotlista= genePerido($valorPeriodo->periodo);
                    }
                    ?>
                    <h3>
                      <i class="fa fa-commenting-o" aria-hidden="true"></i> Retroalimentación de la aplicación  del periodo de <?php echo "$peridotlista";  ?>
                    </h3>
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/aplicaciones" role="button"><i class="fa fa-undo" aria-hidden="true"></i></a>

                  </div>
                  <div class="col-lg-2">

                  </div>
                </div>
                <br>
                <br>
                <?php
                if ($Aplicaciones) {
                  ?>
                  <table id="tablaaplicaciones" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th><i class="fa fa-book " aria-hidden="true"></i> MATERIA</th>
                        <th><i class="fa fa-user-circle-o" aria-hidden="true"></i> DOCENTE</th>
                        <th><i class="fa fa-commenting-o" aria-hidden="true"></i> RETROALIMENTADO</th>
                        <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($Aplicaciones as $key => $valor) {
                        $retro="";
                        if($valor->retroalimentacion!="")
                        {
                          $retro="SI";
                        }else {
                          $retro="NO";
                        }
                        ?>
                        <tr>
                          <td><?php echo "".$valor->nombre_materia; ?></td>
                          <td><?php echo "".utf8_decode($valor->nombres)." ".utf8_decode($valor->apellidos); ?></td>
                          <td><?php echo "".$retro; ?></td>
                          <td>
                            <div class="btn-group btn-block">
                              <a href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionseguimiento/<?php echo "".$valor->idgrupos; ?>"  class="btn btn-primary btn-block text-white"   >
                                <i class="fa fa-commenting-o" aria-hidden="true"></i> RETROALIMENTACIÓN INDIVIDUAL
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <?php
                }
                else {
                  ?>
                  <div class="card bg-danger text-white animated fadeInUp" style="z-index: 1" >
                    <div class="card-body">
                      <center>
                        <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i> <br> <br>
                        Actualmente no existen grupos para esta aplicación  de seguimiento en el aula generada.
                      </center>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  function genePerido($periodo)
  {
    $anioac = substr($periodo, 0,strlen($periodo)-1);
    $peridotTexto="";
    if($periodo==$anioac."1")
    {
      $peridotTexto="Enero-Junio ".$anioac;
    }
    else {
      if($periodo==$anioac."2")
      {
        $peridotTexto="Verano ".$anioac;
      }
      else {
        if($periodo==$anioac."3")
        {
          $peridotTexto="Agosto-Diciembre ".$anioac;
        }
      }
    }
    return $peridotTexto;
  }
  ?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/clipboard.js"></script>
<script type="text/javascript">
var botonCopiar = new Clipboard('.btncopiar');
botonCopiar.on('success', function(e) {
  $('#botonCopiar').tooltip('show');
});
</script>
<script type="text/javascript">var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
</html>

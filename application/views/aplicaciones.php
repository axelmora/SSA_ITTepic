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
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-9">
                    <h3><i class="icon-clipboard" aria-hidden="true"></i>Aplicaciones de seguimiento en el aula de <?php  echo "".$this->session->userdata('departamentonombre');?></h3>
                    <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="Volver" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

                  </div>
                  <div class="col-lg-3">
                    <center>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAplicacion"  role="button"><i class="fa fa-plus-circle" aria-hidden="true" ></i> GENERAR NUEVA APLICACION</button>
                    </center>
                  </div>
                </div>
                <br>
                <br>
                <?php
                if ($Aplicaciones) {
                  $posicionencuestas=0;
                  ?>
                  <table id="tablaaplicaciones" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th><i class="fa fa-calendar" aria-hidden="true"></i> PERIODO</th>
                        <th><i class="fa fa-hashtag" aria-hidden="true"></i> NUMERO DE ENCUESTAS</th>
                        <th><i class="fa fa-calendar-check-o" aria-hidden="true"></i> FECHA CREACION</th>
                        <th><i class="fa fa-bars" aria-hidden="true"></i> OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($Aplicaciones as $key => $valor) {
                        $NumeroEncuestas="";
                        if($Cantidad_Encuestas[$posicionencuestas][0]==0){
                          $NumeroEncuestas='<center><span class="badge badge-pill badge-danger medalla"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No existen encuestas creadas.</span></center>';
                        }else {
                          $NumeroEncuestas=$Cantidad_Encuestas[$posicionencuestas][0];
                          $NumeroEncuestas='<center><span class="badge badge-pill badge-success medalla"><i class="fa fa-hashtag" aria-hidden="true"></i> '.$Cantidad_Encuestas[$posicionencuestas][0].' </span></center>';
                        }
                        ?>
                        <tr>
                          <td><?php echo "".($valor->periodos_escolares_idperiodos) ?></td>
                          <td> <?php echo "".$NumeroEncuestas?></td>
                          <td><?php echo "".$valor->fecha_creacion; ?></td>
                          <td>
                            <center>
                              <div class="btn-group">
                                <button type="button" class="btn  btn-primary text-white  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-bars" aria-hidden="true"></i>  OPCIONES
                                </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo "".$valor->idaplicaciones; ?>"><i class="fa fa-users colorGrupos" aria-hidden="true"></i> GESTIONAR GRUPOS</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/reportesAplicacion/<?php echo "".$valor->idaplicaciones; ?>"><i class="fa fa-file-pdf-o colorBorrar" aria-hidden="true"></i> REPORTES</a>
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacionlista/<?php echo "".$valor->idaplicaciones; ?>"><i class="fa fa-commenting-o colorRetroAlimentacion" aria-hidden="true"></i> RETROALIMENTACIÓN INDIVIDUAL</a>
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/retroalimentacioncontinua/<?php echo "".$valor->idaplicaciones; ?>"><i class="fa fa-comments-o colorRetroAlimentacion" aria-hidden="true"></i> RETROALIMENTACIÓN CONTINUA</a>
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/generadorCatel/<?php echo "".$valor->idaplicaciones; ?>"><i class="fa fa-picture-o colorRetroAlimentacion" aria-hidden="true"></i> GENERAR CARTEL PROMOCIONAL</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="eliminarAplicacion(<?php echo "".$valor->idaplicaciones; ?>)" ><i class="fa fa-trash-o colorBorrar" aria-hidden="true"></i> ELIMINAR APLICACION</a>
                                </div>
                              </div>
                            </center>
                            <!--<div class="btn-group btn-block">
                            <a href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo "".$valor->idaplicaciones; ?>"  class="btn btn-primary btn-block text-white"   >
                            <i class="fa fa-bars" aria-hidden="true"></i> GESTIONAR
                          </a>
                        </div> -->
                      </td>
                    </tr>
                    <?php
                    $posicionencuestas++;
                  }
                  ?>
                </tbody>
              </table>
              <?php
            }
            else {
              ?>
              <div class="card bg-danger text-white animated fadeInUp">
                <div class="card-body">
                  <center>
                    <i class='fa fa-exclamation-circle tamanoiconos animated tada infinite' aria-hidden='true'></i> <br> <br>
                    Actualmente no existen aplicaciones de seguimiento en el aula generadas.
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
/*Funcion semestre actual*/
function genePeridoActual($peridot)
{
  $peridotTexto="";
  $anioac="";
  $anioac=date("Y"); //Obtener el año actual
  if($peridot==$anioac."1")
  {
    $peridotTexto="Enero-Junio ".$anioac;
  }
  else {
    if($peridot==$anioac."2")
    {
      $peridotTexto="Verano ".$anioac;
    }
    else {
      if($peridot==$anioac."3")
      {
        $peridotTexto="Agosto-Diciembre ".$anioac;
      }
    }
  }
  return $peridotTexto;
}
?>
<?php $this->load->view('include/MeliminarAplicacion'); ?>
<?php $this->load->view('include/MAgregarAplicacion'); ?>
<?php $this->load->view('include/footer'); ?><a href="javascript:" id="top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
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
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa-validador.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $('#periodo').on('change', function() {
    if($('#periodo').prop('selectedIndex') !=0){
        $('#panel_advertenciaperiodo').show();
    }else {
        $('#panel_advertenciaperiodo').hide();
    }
  })
});

</script>
<?php
if (isset($ErrorContra)) {
  ?>
  <script type="text/javascript">
  $('#modalError').modal('show');
  </script>
  <?php
}
?>
</html>

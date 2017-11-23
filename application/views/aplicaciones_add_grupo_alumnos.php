<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<?php
if(isset($DATOSMATERIA)){
  foreach ($DATOSMATERIA as $key => $value) {
    $DOCENTE="".utf8_decode($value->nombres." ".$value->apellidos);
    $MATERIA="".$value->nombre_materia ;
  }
}else {
  $DOCENTE="ERROR";
  $MATERIA="ERROR";
}

?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- AGREGAR ALUMNOS</title>
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
  <link href="<?php echo base_url(); ?>css/dataTables.checkboxes.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <?php $this->load->view('include/menu'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="card caro">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-5">
              <h3><i class="icon-clipboard" aria-hidden="true"></i>Agregar alumnos a la aplicación existente <!-- <?php// echo "$peridotlista";  ?> --> </h3>
              <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/gestionarGrupo/<?php echo $IDGRUPO; ?>" role="button" data-original-title="Volver"><i class="fa fa-undo" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-7">
              <center>
                <center><h6 class="text-success"><i class="fa fa-university" aria-hidden="true"></i> DATOS DE LA MATERIA</h6></center>
                <table  class="table table-sm table-striped table-responsive table-bordered dt-responsive " cellspacing="0" >
                  <thead>
                    <tr>
                      <th><i class="fa fa-book" aria-hidden="true"></i> MATERIA</th>
                      <th><i class="fa fa-user" aria-hidden="true"></i> DOCENTE</th>
                      <th><i class="fa fa-user" aria-hidden="true"></i> AGREGAR NUEVOS ALUMNOS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo "$MATERIA" ; ?></td>
                      <td><?php echo "$DOCENTE" ; ?></td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
              </center>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <?php
              if ($ALUMNOSGRUPO) {
                ?>
                <center><h5 class="text-success"><i class="fa fa-graduation-cap animated tada infinite" aria-hidden="true"></i> ALUMNOS ACTUALES EN EVALUACION</h5></center>
                <table id="tablaGrupoAlumnosAgregar" class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th><i class="fa fa-hashtag" aria-hidden="true"></i> NUMERO DE CONTROL</th>
                      <th><i class="fa fa-graduation-cap" aria-hidden="true"></i> NOMBRE</th>
                      <th><i class="fa fa-users" aria-hidden="true"></i> CARRERA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $pos=0;
                    foreach ($ALUMNOSGRUPO as $key => $valor) {
                      ?>
                      <tr>
                        <td><?php echo "".$valor->numero_control; ?></td>
                        <td><?php echo "".$valor->nombre ?></td>
                        <td><?php echo "".$valor->carrera; ?></td>
                      </tr>
                      <?php
                      $pos++;
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
                      Actualmente no se cuentan con alumnos en este grupo.
                    </center>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <div class="col-lg-6">
              <center><h5 class="text-primary"><i class="fa fa-graduation-cap animated tada infinite" aria-hidden="true"></i> AGREGAR NUEVOS ALUMNOS</h5></center>
              <table id="tablaSeleccionAlumnos" class="table table-striped  table-bordered dt-responsive tablaletradocentes "  width="100%" cellspacing="0" >
                <thead>
                  <tr>
                    <th><!--<input type="checkbox" name="select_all" value="1" id="example-select-all">--></th>
                    <th>NUMERO CONTROL</th>
                    <th>NOMBRE</th>
                    <!--<th>CODIGO</th>-->
                    <th>CARRERA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($AlumnosCargados as $key => $valores) {
                    ?>
                    <tr>
                      <td><?php echo "".utf8_decode($valores->numero_control);?></td>
                      <td>
                        <?php echo "".utf8_decode($valores->numero_control); ?>
                      </td>
                      <td>
                        <?php echo "".($valores->nombre); ?>
                      </td>
                      <!--  <td>
                      <?php echo "".utf8_decode($valores->codigo); ?>
                    </td> -->
                    <td>
                      <?php echo "".($valores->carrera); ?>
                    </td>

                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.bootstrap4.min.js"></script>
<script>var urlsistema = '<?php echo base_url()?>';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
<script>
function selecionarMat(idmateria,nombre) {
  $("#idmateria").val(""+idmateria);
  $("#nombre_materiaenviar").val(""+nombre.toUpperCase());
  $("#nombre_materiaenviar" ).removeClass( "animated bounceIn" )
  $('#modalSeleccionMateria').modal('hide');
  $("#nombre_materiaenviar").addClass( "animated bounceIn" );
}
function selecionarDoc(idmateria,nombre) {
  $("#rfcdocente").val(""+idmateria);
  $("#nombredocente").val(""+nombre.toUpperCase());
  $("#nombredocente" ).removeClass( "animated bounceIn" )
  $('#modalDocentes').modal('hide')
  $("#nombredocente").addClass( "animated bounceIn" );
}
function verAlumnos(idEncuestSeguimiento) {
  $('#modalAlumnosCopiar').modal('hide')
  $('#modalverAlumnosCopiar').modal('show');
}
$('#modalverAlumnosCopiar').on('hidden.bs.modal', function () {
  $('#modalAlumnosCopiar').modal('show');
})
</script>
</html>

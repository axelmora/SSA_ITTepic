<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA- AGREGAR GRUPO</title>
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
  <link href="<?php echo base_url(); ?>css/awesome-bootstrap-checkbox2.css" type="text/css" rel="stylesheet" />
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
                <h3><i class="icon-clipboard" aria-hidden="true"></i>Crear nuevo grupo de aplicacion <!-- <?php// echo "$peridotlista";  ?> --> </h3>
                <a class="btn btn-naranja" data-toggle="tooltip" data-placement="top" title="" href="<?php echo base_url(); ?>index.php/Panel_seguimiento/listado/<?php echo $AplicacionDatos; ?>" role="button" data-original-title="Volver"><i class="fa fa-undo" aria-hidden="true"></i></a>
              </div>
            </div>
            <br>
            <form method="post"  action="<?php echo base_url(); ?>index.php/Panel_seguimiento/insertarSeguimientoGrupo/<?php echo $AplicacionDatos; ?>">
              <div class="row">
                <div class="col-lg-2">
                  <label class="formulariolabel"><i class="fa fa-book" aria-hidden="true"></i> Materia:</label>
                </div>
                <div class="col-lg-4">
                  <input value="" name="idmateria" id="idmateria" placeholder="Seleccionar materia" class="form-control"  hidden required/>
                  <input value="" name="nombre_materiaenviar" id="nombre_materiaenviar" placeholder="Seleccionar materia" class="form-control"  readonly required/>
                </div>
                <div class="col-lg-3">
                  <button type="button"  data-toggle="modal" data-target="#modalAgregarMateria" class="btn btn-primary btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> AGREGAR MATERIA</button>
                </div>
                <div class="col-lg-3">
                  <?php
                  if($MateriasExistentes)
                  {
                    ?>
                    <div class="animated bounceInRight">
                      <button type="button" data-toggle="modal" data-target="#modalSeleccionMateria"  class="btn btn-info btn-block " ><i class="fa  fa-search-plus" aria-hidden="true"></i> SELECCIONAR  MATERIAS EXISTENTES</button>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-2">
                  <label class="formulariolabel"><i class="fa fa-user-circle" aria-hidden="true"></i> Docente:</label>
                </div>
                <div class="col-lg-4">
                  <input value="" id="rfcdocente" name="rfcdocente" placeholder="Seleccionar docente" class="form-control" hidden required/>
                  <input value="" id="nombredocente" name="nombredocente" placeholder="Seleccionar docente" class="form-control"  readonly required/>
                </div>
                <div class="col-lg-3">
                </div>
                <div class="col-lg-3">
                  <button type="button"  data-toggle="modal" data-target="#modalDocentes" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECCIONAR DOCENTE</button>
                  <!--  <button type="button" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECCIONAR  MATERIA EXISTENTE</button> -->
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-3">
                  <label class="formulariolabel"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alumnos:</label>
                  <input type="text" hidden value="" id="numero_control_alumnos" name="numero_control_alumnos" />
                </div>
                <div class="col-lg-3">
                  <div class="card  bg-light " id="panelAlumnosSelecionados" style="display:none" >
                    <div class="card-body">
                      <center>
                        <p class="card-text">Alumnos selecionados.</p>
                      </center>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <button type="button"  data-toggle="modal" data-target="#modalAlumnos" class="btn btn-primary btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> SELECIONAR ALUMNOS</button>
                </div>
                <div class="col-lg-3">
                  <?php
                  if($AlumnosCopiar)
                  {
                    ?>
                    <button type="button"  data-toggle="modal" data-target="#modalAlumnosCopiar" class="btn btn-info btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> COPIAR ALUMNOS ENCUESTA</button>

                    <?php
                  }
                  ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-success btn-block " ><i class="fa fa-plus-circle" aria-hidden="true"></i> CREAR GRUPO</button>
                </div>
              </div>
            </form>
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
  <!-- MODAL ALUMNOS  -->
  <form method="post" id="formularioAlumnos">
    <!--  <div class="modal fade" id="modalAlumnos" tabindex="-1" role="dialog" aria-labelledby="modalDocentes" aria-hidden="true"> -->
    <div class="modal fade"   id="modalAlumnos" tabindex="-1" role="dialog" aria-labelledby="modalDocentes" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Seleccionar alumnos.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div style="overflow-x:auto;">
              <table id="tablaSeleccionAlumnos" class="table table-striped table-hover  table-sm  table-bordered dt-responsive  "  width="100%" cellspacing="0" >
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
          <button  type="submit" class="btn btn-success">ACPETAR SELECCIONADOS </button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- MODAL ALUMNOS FIN  -->
<pre id="example-console">
</pre>
<!-- MODAL ALUMNOS COPIAR -->
<div class="modal fade"   id="modalAlumnosCopiar" tabindex="-1" role="dialog" aria-labelledby="modalDocentes" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Seleccionar alumnos de grupos existentes.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="overflow-x:auto;">
          <table  width="100%" id="tablaCopiarAlumnos" class="table table-striped  table-bordered dt-responsive " cellspacing="0" >
            <thead>
              <tr>
                <th>MATERIA</th>
                <th>DOCENTES</th>
                <th>ALUMNOS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($AlumnosCopiar as $key => $valores) {
                ?>
                <tr>
                  <td>
                    <?php echo "". $valores->nombre_materia;?>
                  </td>
                  <td>
                    <?php echo "".utf8_decode($valores->nombres)." ".utf8_decode($valores->apellidos);?>
                  </td>
                  <td>
                    <center>
                      <a role="button" class="btn btn-info text-white" onclick="verAlumnos(<?php echo $valores->idencuesta_seguimiento; ?>)" ><i class="fa fa-eye" aria-hidden="true"></i> VER ALUMNOS</a>
                    </center>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
        <button  type="submit" class="btn btn-success">ACPETAR SELECCIONAR GRUPO </button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL VER ALUMNOS -->
<div class="modal fade menus" id="modalverAlumnosCopiar" tabindex="2" role="dialog" aria-labelledby="modalAlumnosCopiar" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Lista de alumnos incluidos en el grupo:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div style="   height: 300px;   overflow-y: scroll;">
          <table class="table table-sm  table-responsive" id="tablaveralumnosya" >
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">NUMERO DE CONTROL</th>
                <th scope="col">NOMBRE DEL ALUMNO</th>
                <th scope="col">CARRERA</th>
              </tr>
            </thead>
            <tbody id="ttablaveralumnosyacuerpo">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success">SELECIONAR ESTE GRUPO</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL ALUMNOS COPIAR FIN  -->
<!-- MODAL DOCENTES  -->
<div class="modal fade" id="modalDocentes" tabindex="-1" role="dialog" aria-labelledby="modalDocentes" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar docente.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="tablaSeleccionDocentes" class="table table-striped   table-sm table-responsive table-bordered dt-responsive " cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>MATERIA</th>
                <th>DEPARTAMENTO</th>
                <th>OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($Docentes as $key => $valores) {
                ?>
                <tr>
                  <td>
                    <?php echo "".utf8_decode($valores->nombres)." ".utf8_decode($valores->apellidos); ?>
                  </td>
                  <td>
                    <?php echo "".utf8_decode($valores->departamento); ?>
                  </td>
                  <td>
                    <center>
                      <button type="button" onclick="selecionarDoc('<?php echo $valores->rfc; ?>','<?php echo "".utf8_decode($valores->nombres)." ".utf8_decode($valores->apellidos)?>')" class="btn btn-info" >
                        <i class="fa  fa-check-square" aria-hidden="true"></i>

                      </button>
                    </center>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL DOCENTES FIN  -->
<!-- MODAL AGREGAR MATERIA  -->
<form method="post" id="formularioAgregarMateria">
  <div class="modal fade" id="modalAgregarMateria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarMateria" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  >Agregar nueva materia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-3">
              <label class="formulariolabel">Nombre de la materia:</label>
            </div>
            <div class="col-lg-9">
              <input value="" style="text-transform:uppercase" name="nombre_materia" id="nombre_materia" placeholder="Nombre de la materia" class="form-control"  required/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
          <button  type="submit" class="btn btn-success">AGREGAR MATERIA</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- MODAL AGREGAR MATERIA  -->
<!-- MODAL SELECIONAR MATERIAS  -->
<div class="modal fade" id="modalSeleccionMateria" tabindex="-1" role="dialog" aria-labelledby="modalSeleccionMateria" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Seleccionar materia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="tablaSelecionarMaterias" class="table table-striped table-hover  table-sm  table-bordered dt-responsive " cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>MATERIA</th>
                    <th>OPCION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($MateriasExistentes as $key => $valores) {
                    ?>
                    <tr>
                      <td>
                        <?php echo "".$valores->nombre_materia; ?>
                      </td>
                      <td>
                        <center>
                          <button type="button" onclick="selecionarMat(<?php echo $valores->idmaterias; ?>,'<?php echo $valores->nombre_materia; ?>')" class="btn btn-info " ><i class="fa  fa-check-square" aria-hidden="true"></i> SELECCIONAR</button>
                        </center>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL SELECIONAR MATERIAS  -->
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
  var datosAlumno;
  $('#modalAlumnosCopiar').modal('hide')
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: urlsistema+'index.php/Panel_seguimiento/obtenerAlumnosSeguimiento/'+idEncuestSeguimiento,
    success: function(data)
    {
      $.each(data, function(i, campo){
        datosAlumno+="<tr><td></td><td>"+campo.alumnos_numero_control+"</td><td>"+campo.nombre+"</td><td>"+campo.carrera+"</td></tr>";
      });
      $('#ttablaveralumnosyacuerpo').html(""+datosAlumno);
      $('#tablaveralumnosya').width("100%");
      $('#modalverAlumnosCopiar').modal('show');
    //  $('#tablaveralumnosya').dataTable();
      $('#tablaveralumnosya').DataTable({
        responsive: true,
        "language": {
          "url": urlsistema+"js/datatables/Alumnos.json"
        },
        "columnDefs": [
          {
            "targets": 0,
            "checkboxes": {
              "selectRow": true,
              'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
            },
            "render": function(data, type, row, meta){
              if(type === 'display'){
                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
              }
              return data;
            }
          }
        ],
        "select": {
          "style": "multi"
        },
        "order": [[2, "asc" ]]
      });
    }
  });
}
$('#modalverAlumnosCopiar').on('hidden.bs.modal', function () {
  $('#modalAlumnosCopiar').modal('show');
})
</script>
</html>

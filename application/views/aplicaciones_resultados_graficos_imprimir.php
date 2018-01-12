<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $TOTALAlumnosEncuestados=0;
  $EvaluacionesContestadas=0;
  $PorcentajeActual=0;
  if(isset($APLICADOS))
  {
    for ($i=0; $i < count($APLICADOS) ; $i++) {
      if( $APLICADOS[$i]){
        $EvaluacionesContestadas++;
      }
      $TOTALAlumnosEncuestados++;
    }
    $PorcentajeActual=($EvaluacionesContestadas*100)/$TOTALAlumnosEncuestados;
  }else {
    $TOTALAlumnosEncuestados=0;
    $EvaluacionesContestadas=0;
  }
  $DOCENTE="";
  $MATERIA="";
  if(isset($DATOSMATERIA)){
    foreach ($DATOSMATERIA as $key => $value) {
      $DOCENTE="".utf8_decode($value->nombre_docente);
      $MATERIA="".$value->nombre_materia ;
    }
  }else {
    $DOCENTE="ERROR";
    $MATERIA="ERROR";
  }
  ?>
  <meta charset="utf-8">
  <title>SSA-GRUPO RESULTADOS ENCUESTA - <?php  echo "$MATERIA - $DOCENTE";  ?></title>
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

  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <center>
                <table  class="table table-sm table-striped table-bordered dt-responsive " cellspacing="0" >
                  <thead>
                    <tr>
                      <th><i class="fa fa-book" aria-hidden="true"></i> MATERIA</th>
                      <th><i class="fa fa-user" aria-hidden="true"></i> DOCENTE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo "$MATERIA" ; ?></td>
                      <td><?php echo "$DOCENTE" ; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </center>
              </div>
            </div>
<?php echo "".$EncuestasResultados; ?>
          </div>
        </div>
      </div>
    </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/ssatables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tabletojson.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/graficos/highcharts.src.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/graficos/data.js"></script>
<script type="text/javascript">
window.onfocus=function(){ window.close();}
var arreglo;
$( document ).ready(function() {

  arreglo=  $("[id^=tabla]");
  var graficos=  $("[id^=grafico]");
  //  var tabla1 = $("#"+arreglo[3].id).tableToJSON();
  for (var i = 0; i < graficos.length; i++) {
    generarGrafico(graficos[i].id,arreglo[i].id);
  }
  window.print();
});
function generarGrafico(divid,tabla) {
  var graficogenerado=  Highcharts.chart(''+divid, {
    data: {
      table: ''+tabla
    },
    chart: {
      type: 'column',

    },
    title: {
      text: ''
    },
    plotOptions: {
      column: {
        dataLabels: {
          enabled: true,
          crop: false,
          overflow: 'none',

        },
        animation: false
      }
    },
    yAxis: {
      allowDecimals: false,
      title: {
        text: 'Respuestas'
      }
    },
    tooltip: {
      formatter: function () {
        return '<b>' + this.series.name + '</b><br/>' +
        this.point.y + ' ' + this.point.name.toLowerCase();
      }
    }
  });
  return graficogenerado;
}
</script>

</html>

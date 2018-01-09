/*
--------------------------------------------------------------------------------------------------------------------
ssatables.js
Autor: Fernand Manuel Avila Cataño
Version 1.0.0
12/10/2017
-------------------------------------------------------------------------------------------------------------------- */
/* TABLA APLICACIONES*/
$(document).ready(function(){
  $('#tablaaplicaciones').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 2, "desc" ]]
  });
  $('#tablaaplicaciones2').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 4, "desc" ]]
  });
  $('#tablaAdministrativos').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/departamentos.json"
    },
    "order": [[ 0, "asc" ]]
  });
  $('#tablaAplicacionespordepa').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 0, "desc" ]]
  });
  $('#tablasoporte_tenico_usuario').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/soporte_tecnico.json"
    },
    "order": [[ 1, "asc" ]]
  });
});
/* TABLA SELECCION MATERIAS*/
$(document).ready(function(){
  $('#tablaSelecionarMaterias').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/materias.json"
    },
    "order": [[0, "desc" ]]
  });
  $('#tablaSeleccionDocentes').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Docentes.json"
    },
    "order": [[0, "asc" ]]
  });
  $('#tablaDocentes').DataTable({
    responsive: true,
    "iDisplayLength": 50,
    "language": {
      "url": urlsistema+"js/datatables/Docentes.json"
    },
    "order": [[0, "asc" ]]
  });
  $('#tablaAlumnosVer').DataTable({
    responsive: true,
    "iDisplayLength": 100,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "order": [[0, "asc" ]]
  });
  $('#tablaMaterias').DataTable({
    responsive: true,
    "iDisplayLength": 50,
    "language": {
      "url": urlsistema+"js/datatables/materias.json"
    },
    "order": [[0, "asc" ]]
  });
  $('#tablaGrupoAlumnos').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "order": [[3, "asc" ],[0, "asc" ]]
  });
  /*TABLA ALUMNOS*/
  $('#tablaGrupoAlumnosAgregar').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "order": [[0, "asc" ]]
  });

  /* TABLA ALUMNOS COPIAR */
  $('#tablaCopiarAlumnos').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "order": [[0, "asc" ]]
  });

  var tablealumnos = $('#tablaSeleccionAlumnos').DataTable({
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


  var tablamaterias = $('#materias_sii').DataTable({
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


  $('#formularioAlumnos').on('submit', function(e){
    var form = this;
    var rows_selected = tablealumnos.column(0).checkboxes.selected();
    $.each(rows_selected, function(index, rowId){
      $(form).append(
        $('<input>')
        .attr('type', 'hidden')
        .attr('name', 'id[]')
        .val(rowId)
      );
    });
    $('#modalAlumnos').modal('hide')
    $('#numero_control_alumnos').val(rows_selected.join(","));
    if ($('#numero_control_alumnos').val()!="") {
      $("#panelAlumnosSelecionados").show();
    }
    else {
      $("#panelAlumnosSelecionados").hide();
    }
    e.preventDefault();
  });
  /*TABLA ALUMNOS FIN*/
});
/*FIN JS*/

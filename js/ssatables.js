/*
--------------------------------------------------------------------------------------------------------------------
ssatables.js
Autor: Fernand Manuel Avila Cataño
Version 1.0.0
12/10/2017
--------------------------------------------------------------------------------------------------------------------
*/
/* TABLA APLICACIONES*/
$(document).ready(function(){
  $('#tablaaplicaciones').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 3, "desc" ]]
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
  $('#tablaGrupoAlumnos').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "order": [[0, "asc" ]]
  });
  /*TABLA ALUMNOS*/
  var tablealumnos = $('#tablaSeleccionAlumnos').DataTable({
    responsive: true,
    "language": {
      "url": urlsistema+"js/datatables/Alumnos.json"
    },
    "columnDefs": [
      {
        "targets": 0,
        "checkboxes": {
          "selectRow": true
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
    $("#panelAlumnosSelecionados").show();
    $('#numero_control_alumnos').val(rows_selected.join(","));
    //$('#example-console').text(rows_selected.join(","));
    e.preventDefault();
  });
  /*TABLA ALUMNOS FIN*/
});
/*FIN JS*/

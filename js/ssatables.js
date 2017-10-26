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

  /*TABLA ALUMNOS*/
  var table = $('#tablaSeleccionAlumnos').DataTable({
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
    var rows_selected = table.column(0).checkboxes.selected();
    $.each(rows_selected, function(index, rowId){
      $(form).append(
        $('<input>')
        .attr('type', 'hidden')
        .attr('name', 'id[]')
        .val(rowId)
      );
    });
    $('#example-console').text(rows_selected.join(","));
     e.preventDefault();
  });
  //
  // /*TABLA ALUMNOS*/
  // var table =  $('#tablaSeleccionAlumnos').DataTable({
  //   responsive: true,
  //   "language": {
  //     "url": urlsistema+"js/datatables/Alumnos.json"
  //   },
  //   'columnDefs': [{
  //     'targets': 0,
  //     'searchable': false,
  //     'orderable': false,
  //     'className': 'dt-body-center',
  //     'render': function (data, type, full, meta){
  //       //return '<input type="checkbox" class="form-check-input position-static" name="id[]" value=" ' + $('<div/>').text(data).html() + '">';
  //       return '<input type="checkbox" class=" position-static" name="id[]" value=" ' + $('<div/>').text(data).html() + '">';
  //     }
  //   }],
  //   "order": [[2, "asc" ]]
  // });
  // $('#example-select-all').on('click', function(){
  //   // Get all rows with search applied
  //   var rows = table.rows({ 'search': 'applied' }).nodes();
  //   // Check/uncheck checkboxes for all rows in the table
  //   $('input[type="checkbox"]', rows).prop('checked', this.checked);
  // });
  // $('#example tbody').on('change', 'input[type="checkbox"]', function(){
  //   // If checkbox is not checked
  //   if(!this.checked){
  //     var el = $('#example-select-all').get(0);
  //     // If "Select all" control is checked and has 'indeterminate' property
  //     if(el && el.checked && ('indeterminate' in el)){
  //       // Set visual state of "Select all" control
  //       // as 'indeterminate'
  //       el.indeterminate = true;
  //     }
  //   }
  // });
  // // Handle form submission event
  // $('#formularioAlumnos').on('submit', function(e){
  //   var form = this;
  //   // Iterate over all checkboxes in the table
  //   table.$('input[type="checkbox"]').each(function(){
  //     // If checkbox doesn't exist in DOM
  //     if(!$.contains(document, this)){
  //       // If checkbox is checked
  //       if(this.checked){
  //         // Create a hidden element
  //         $(form).append(
  //           $('<input>')
  //           .attr('type', 'hidden')
  //           .attr('name', this.name)
  //           .val(this.value)
  //         );
  //       }
  //     }
  //   });
  //   function fixedEncodeURI (str) {
  //     return encodeURI(str).replace(/%5B/g, '[').replace(/%5D/g, ']');
  //   }
  //   var values = {};
  //   $.each($('#formularioAlumnos').serializeArray(), function(i, field) {
  //     values[field.name] = field.value;
  //   });
  //   $('#example-console').text(values);
  //   //$('#example-console').text($(form).serialize());
  //   //  $('#example-console').text(fixedEncodeURI($(form).serialize()));
  //   console.log("Form submission", $(form).serialize());
  //   // Prevent actual form submission
  //   e.preventDefault();
  // });
  /*TABLA ALUMNOS*/
});
/*FIN JS*/

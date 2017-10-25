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
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 3, "desc" ]]
  });

});
/* TABLA SELECCION MATERIAS*/
$(document).ready(function(){
  $('#tablaSelecionarMaterias').DataTable({
    "language": {
      "url": urlsistema+"js/datatables/materias.json"
    },
    "order": [[0, "desc" ]]
  });
  $('#tablaSeleccionDocentes').DataTable({
    "language": {
      "url": urlsistema+"js/datatables/Docentes.json"
    },
    "order": [[0, "asc" ]]
  });
});
/*FIN JS*/

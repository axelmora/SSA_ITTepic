/*
--------------------------------------------------------------------------------------------------------------------
ssatables.js
Autor: Fernand Manuel Avila Cataño
Version 1.0.0
12/10/2017
--------------------------------------------------------------------------------------------------------------------
*/
$(document).ready(function(){

  $('#tablaaplicaciones').DataTable({
    "language": {
      "url": urlsistema+"js/datatables/aplicaciones.json"
    },
    "order": [[ 3, "desc" ]]
  });

});
/*FIN JS*/

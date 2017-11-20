/*
--------------------------------------------------------------------------------------------------------------------
ssa.js
Autor: Fernand Manuel Avila Cataño <feranimaciones@gmail.com>
Version 1.0.0
12/10/2017
--------------------------------------------------------------------------------------------------------------------
*/
$(document).ready(function(){
  /* ANIMACIONES MENU */
  $(".animenu").mouseenter(function(event) {
    $(this).addClass("animated pulse");
  });
  $(".animenu").on("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd", function(event) {
    $(this).removeClass("animated pulse");
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  /* TAMNAÑO ICONOS */
  $(function() {
    $('.caro').matchHeight();
  });
  /* CARGR MANUAL PDF */
  var opciones = {
    pdfOpenParams: { messages: '0' },
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed(urlsistema+"file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
  var opciones2 = {
    pdfOpenParams: { messages: '0' },
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed(urlsistema+"file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover2", opciones2);
  var opciones3 = {
    pdfOpenParams: { messages: '0' },
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed(urlsistema+"file/manual/Manual_Tecnico_SSA.pdf","#manualdeusuariover3", opciones3);
  /*SUBMIT mesa de ayuda*/
  $( "#mesayudaform" ).submit(function( event ) {
    $.ajax({
      type: "POST",
      url: urlsistema+'index.php/Mesa_ayuda/insertarSolicitud',
      data: $("#mesayudaform").serialize(),
      success: function(data)
      {
        $( "#panelformulario" ).slideUp( "slow", function() {
          $( "#asunto" ).val("");$( "#descipcion" ).val("");
          $( "#panelformulariocompletado" ).slideDown( "slow", function() {
          });
        });
      }
    });
    event.preventDefault();
  });
  /* Mesa de ayuda detectar cerrado*/
  $("#modalsoporte").on("hide.bs.modal", function () {
    $( "#panelformulariocompletado" ).hide();
    $( "#panelformulario" ).slideDown( "slow", function() {
    });
  });
  /**/
  /*------------------------ PANEL SEGUIMIENTO --------------- */
  /*SUBMIT AGREGAR MATERIA*/
  $( "#formularioAgregarMateria" ).submit(function( event ) {
    $.ajax({
      type: "POST",
      url: urlsistema+'index.php/Panel_seguimiento/insertarMateria',
      data: $("#formularioAgregarMateria").serialize(),
      success: function(data)
      {
        var datos = $.parseJSON(data);
        //console.log(datos);
        var materiaNombre=$("#nombre_materia").val();
        $("#idmateria").val(""+datos.idmateria);
        $("#nombre_materiaenviar").val(materiaNombre.toUpperCase());
        $('#modalAgregarMateria').modal('hide')
        $("#nombre_materia").val("");
        $("#nombre_materiaenviar").addClass( "animated bounceIn" );
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Error: " + textStatus); alert("Error: " + errorThrown);
      }
    });
    event.preventDefault();
  });
  // ===== Funcion top====
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {    // Si se mueve mas de 50px
      $('#top').fadeIn("fast");       //octula la flecha
    } else {
      $('#top').fadeOut("fast");      // des oculta la flecha
    }
  });
  $('#top').click(function() {            // cuando la fecha es precionada
    $('body,html').animate({
      scrollTop : 0                   // mueve la pagina
    }, 500);
  });
  // ===== Funcion top==== FIN
});
function eliminarEncuestaSeguimiento(idencuesta_seguimiento){
  $.ajax({
    type: 'GET',
    url: urlsistema+'index.php/Panel_seguimiento/eliminarEncuestaDatos/'+idencuesta_seguimiento,
    data: { get_param: 'value' },
    dataType: 'json',
    success: function (data) {
      $.each(data, function(index, elemento) {
        $("#idEliminarMateriaNombre").html(elemento.nombre_materia);
        $("#idEliminarDocenteNombre").html(elemento.nombres+" "+elemento.apellidos);
        console.log(elemento.nombre_materia);
      });
    }
  });
  $.ajax({
    type: 'GET',
    url: urlsistema+'index.php/Panel_seguimiento/eliminarEncuestaDatosAplicacion/'+idencuesta_seguimiento,
    data: { get_param: 'value' },
    dataType: 'json',
    success: function (data) {
      $.each(data, function(index, elemento) {
        $("#idAplicacionPostEliminar").val(elemento.aplicaciones_idaplicaciones);
        console.log(elemento.nombre_materia);
      });
    }
  });
  $("#idEliminarEncu").val(idencuesta_seguimiento);
}
function eliminarAplicacion(idaplicaciones) {
  $('#idAplicacionesBorrar').val(idaplicaciones);
  $('#modalBorrar').modal('show');
}
try {
  var msg ='================SSA=====================\n';
  msg += '========================================\n¡Bienvenid@ a la consola! Parece que sabes lo que haces.\n¡Y si no lo sabes mejor no veas mucho!\n========================================\n';
  console.log(msg);
} catch (e) {}
/*FIN JS*/

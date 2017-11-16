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
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed(urlsistema+"file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover", opciones);
  var opciones2 = {
    fallbackLink: '<p>El navegador no soporta este manual  <center><a href="[url]"  class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> DESCARGAR MANUAL</a></center></p>'
  };
  PDFObject.embed(urlsistema+"file/manual/Manual_Usuario_SSA.pdf","#manualdeusuariover2", opciones2);
  var opciones3 = {
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
        $("#idmateria").val(""+datos.idmateria);
        $("#nombre_materiaenviar").val($("#nombre_materia").val().toUpperCase());
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
  // ===== Scroll to Top ====
  $(window).scroll(function() {
      if ($(this).scrollTop() >= 50) {    // If page is scrolled more than 50px
          $('#top').fadeIn("fast");       // Fade in the arrow
      } else {
          $('#top').fadeOut("fast");      // Else fade out the arrow
      }
  });
  $('#top').click(function() {            // When arrow is clicked
      $('body,html').animate({
          scrollTop : 0                   // Scroll to top of body
      }, 500);
  });
});
/*FIN JS*/

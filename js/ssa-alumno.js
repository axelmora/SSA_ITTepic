/*
--------------------------------------------------------------------------------------------------------------------
ssa-alumno.js
Autor: Fernand Manuel Avila Cataño <feranimaciones@gmail.com>
Version 1.0.0
19/11/2017
--------------------------------------------------------------------------------------------------------------------
*/
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
/*MENSAJE CONSOLA*/
try {
     var msg ='================SSA=====================\n';
     msg += '========================================\n¡Bienvenid@ a la consola! Parece que sabes lo que haces.\n¡Y si no lo sabes mejor no veas mucho!\n========================================\n';
     console.log(msg);
 } catch (e) {}
/*FIN JS*/

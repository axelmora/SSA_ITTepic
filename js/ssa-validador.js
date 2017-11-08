/*
--------------------------------------------------------------------------------------------------------------------
ssa-validador.js
Autor: Fernand Manuel Avila Cataño <feranimaciones@gmail.com>
Version 1.0.0
12/10/2017
--------------------------------------------------------------------------------------------------------------------
*/
$(document).ready(function(){
  /* FORMULARIO LOGIN*/
  $( "#formularioDatosUsuario").validate({
    rules: {
      userid: {
        required: true,
        minlength: 5,
        maxlength: 20
      },
      passwordid: {
        required: true,
        minlength: 6,
        maxlength: 20
      }
    },
    messages :{
      userid: {
        required: ""+generarErrores("Se requiere el nombre de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 5 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 20 caracteres.","texto-plano")
      },
      passwordid: {
        required: ""+generarErrores("Se requiere la contraseña de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 6 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 20 caracteres.","texto-plano")
      }
    }
  });
  /* FORMULARIO LOGIN FIN */
});
/*FUNCION QUE GENERA MENSAJES ERRORES PARA EL VALIDADOR*/
function generarErrores(Mensaje,Tipo) {
  var icono="<span class='fa-stack fa-lg errorStakTamano animated tada infinite'><i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-exclamation-circle fa-stack-1x fa-inverse'></i></span>"
  switch (Tipo) {
    case "card":
    return "<center><div class='alert alert-danger' role='alert'>"+icono+" "+Mensaje+"</div></center>";
    break;
    case "texto-plano":
    return "<p class='colorErrorValidador'>"+icono+" "+Mensaje+"</p>";
    break;
    default:
  }
}
/*FIN JS*/

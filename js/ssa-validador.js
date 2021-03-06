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
  /* FORMULARIO REGISTRO*/
  $( "#formularionNuevoUsuario").validate({
    rules: {
      nombre_user: {
        required: true,
        minlength: 5,
        maxlength: 20
      },
      nombre_userc: {
        required: true,
        minlength: 5,
        maxlength: 40
      },
      contrasena: {
        required: true,
        minlength: 6,
        maxlength: 20
      }
    },
    messages :{
      nombre_user: {
        required: ""+generarErrores("Se requiere el nombre de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 5 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 20 caracteres.","texto-plano")
      },
      nombre_userc: {
        required: ""+generarErrores("Se requiere el nombre de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 5 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 40 caracteres.","texto-plano")
      },
      contrasena: {
        required: ""+generarErrores("Se requiere la contraseña de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 6 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 20 caracteres.","texto-plano")
      }
    }
  });
  /* FORMULARIO SEGUIMIENTO LOGIN*/
  $( "#formularioAlumnoSeguimiento").validate({
    rules: {
      numero_control: {
        required: true,
        minlength: 8,
        maxlength: 10,
        noHTML: true,
        noSpace: true
      },
      contra_aplicacion: {
        required: true,
        minlength: 4,
        maxlength: 5,
        noHTML: true,
        noSpace: true
      }
    },
    messages :{
      numero_control: {
        required: ""+generarErrores("Se requiere el numero de control.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 8 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 10 caracteres.","texto-plano"),
        noHTML: ""+generarErrores("Error accion invalida.","texto-plano"),
        noSpace: ""+generarErrores("Error accion invalida. Tienes espacios en blanco.","texto-plano")
      },
      contra_aplicacion: {
        required: ""+generarErrores("Se requiere la contraseña proporcionada por su departamento academico.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 4 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 5 caracteres.","texto-plano"),
        noHTML: ""+generarErrores("Error accion invalida","texto-plano"),
        noSpace: ""+generarErrores("Error accion invalida.Tienes espacios en blanco.","texto-plano")
      }
    }
  });

  jQuery.validator.addMethod("noHTML", function(value, element) {
    return this.optional(element) || /^([a-z0-9]+)$/.test(value);
  }, "No HTML tags are allowed!");

  jQuery.validator.addMethod("noSpace", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
  }, "No space please and don't leave it empty");

  /* FORMULARIO SEGUIMIENTO LOGIN FIN*/
  /* FORMULARIO SEGUIMIENTO CONTRASEÑA CAMBIAR */
  $( "#formularioContrasena" ).validate({
    rules: {
      contraactual: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      contra_nueva1: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      contra_nueva2: {
        required: true,
        minlength: 6,
        maxlength: 15,
        equalTo: "#contra_nueva1"
      }
    },
    messages :{
      contraactual: {
        required: ""+generarErrores("Se requiere la contraseña actual","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 6 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 15 caracteres.","texto-plano"),
      },
      contra_nueva1: {
        required: ""+generarErrores("Se requiere la nueva contraseña.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 6 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 15 caracteres.","texto-plano")
      },
      contra_nueva2: {
        required: ""+generarErrores("Se requiere la confirmacion de la nueva contraseña.","texto-plano"),
        minlength: ""+generarErrores(" Se requiere al menos 6 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 15 caracteres.","texto-plano"),
        equalTo: ""+generarErrores("Las contraseñas no son iguales.","texto-plano")
      }
    }
  });
  /* FORMULARIO SEGUIMIENTO CONTRASEÑA CAMBIAR */
  /* FORMULARIO SEGUIMIENTO DATOS */
  $("#formularioDatosUsuarioModificar").validate({
    rules: {
      nombre_usuario: {
        required: true,
        minlength: 2,
        maxlength: 120
      }
    },
    messages :{
      nombre_usuario: {
        required: ""+generarErrores("Se requiere el nombre de usuario.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 2 caracteres. ","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 120 caracteres.","texto-plano")
      }
    }
  });
  /* FORMULARIO SEGUIMIENTO DATOS FIN*/
  $( "#agregarAplicacionForm").validate({
    rules: {
      contrasenaapp: {
        required: true,
        minlength: 4,
        maxlength: 20
      }
    },
    messages :{
      contrasenaapp: {
        required: ""+generarErrores("Se requiere la contraseña para esta aplicacion.","texto-plano"),
        minlength: ""+generarErrores("Se requiere al menos 4 caracteres.","texto-plano"),
        maxlength: ""+generarErrores("Se requiere un maximo de 20 caracteres.","texto-plano")
      }
    }
  });
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

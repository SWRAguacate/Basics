
$(document).ready(function () {
    
    $('.receptor').click(function () {
          var idReceptor = $(this).find('.id_receptor').val();
          $('#id_form_receptor').attr('value', idReceptor);
          window.location.href = "ver_mensajes_usuarios.php?id_receptor=" + idReceptor;
    });
    
    $('#boton_enviar_mensaje').click(function () {
          var mensaje = $('#mensaje_para_enviar').val();
          var idReceptor = $('#id_form_receptor').val();
          $('#mensaje_emisor').attr('value', mensaje);
          if(idReceptor > 0 && idReceptor != null) {
              if(mensaje != "" && mensaje != null){
          $('#btn_enviar_formulario').click();
              } 
          } else {
              alert('Seleccione un usuario antes de mandar mensajes');
          }
    });

});
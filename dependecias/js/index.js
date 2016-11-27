$(document).ready(function(){
  var frm = $('#login');
  frm.validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
      console.log('Completa los campos necesarios');
    }else{
      $('#alerta').html('<div class="alert alert-info"><strong><i class="fa fa-refresh fa-spin"></i> Procesando datos</strong></div>');
      $.ajax({
              type: "POST",
              url: "funciones/login",
              data: frm.serialize(),
              success: function (data) {
                if(data.concecion){
                  $('#alerta').html('<div class="alert alert-success"><strong><i class="fa fa-check"></i> Ingresando al sistema</strong></div>');
                  window.location="confirmacion";
                }else
                  $('#alerta').html('<div class="alert alert-warning"><strong><i class="fa fa-exclamation"></i> No esta invitado, consulte con</strong> <a href="mailto:odm_sd@hotmail.com" class="alert-link">odm_sd@hotmail.com</a> </div>');
              }
          });
      e.preventDefault();
      return false;
    }
  });
});

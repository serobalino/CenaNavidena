cargar();
function cargar(){
  $.ajax({
          type: "POST",
          url: "funciones/confirmacion",
          data: "familias=1",
          success: function (data) {
              $('#filia').html(data);
              $('input:radio').change(function(){
                  var ingreso = $(this).val();
                  $.ajax({
                    type: "POST",
                    url: "funciones/confirmacion",
                    data: "input="+ingreso,
                    success: function (data){
                      cargar();
                    }
                  });
              });
              $('#enviar').click(function(){
                if($('#nom').val()!=='' && $('#email').val()!==''){
                  console.log('Valido');
                  var nom   = $('#nom').val();
                  var email = $('#email').val();
                  $('#alerta').html('<div class="text-center"><span class="fa fa-spinner fa-spin"></span></div>');
                  $.ajax({
                    type: "POST",
                    url: "funciones/confirmacion",
                    data: "nuevo&email="+email+"&nom="+nom,
                    success:function (data){
                      console.log(data);
                      if(data==="1"){
                        $('#alerta').html('<div class="alert alert-success"><b><span class="fa fa-paper-plane-o"></span> Se ha enviado una invitación a '+nom+'</b></div>');
                      }else{
                          $('#alerta').html('<div class="alert alert-danger"><b><span class="fa fa-envelope-o"></span> '+nom+' ya está invitad@</b></div>');
                          $('#nom').val('');
                          $('#email').val('');
                      }
                    }
                  });
                }else {
                  $('#alerta').html('<div class="alert alert-warning"><b><span class="fa fa-asterisk"></span> Completa todos los campos</b></div>');
                  console.log('Compelta los campos');
                  cargar();
                }
              });
          }
      });
}

cargar();

function cargar(){
  $.ajax({
          type: "POST",
          url: "funciones/ayudas",
          data: "listar",
          success: function (data) {
              $('#filia').html(data);
              blokear();
          }
      });
}
function leer(id){
  var sel = $('#sel'+id).val();
  var mat = $('#mat'+id).val();
  if(sel==1){
    $('#in'+id).attr('disabled',false);
    $('#in'+id).focus();
    $('#alerta').html('<div class="alert alert-info"><b><span class="fa fa-info"></span> Digita la cantidad de '+mat+'.</b></div>');
  }
}
function guardar(id){
  var numero = $('#in'+id).val();
  if(numero>0){
    $.ajax({
            type: "POST",
            url: "funciones/ayudas",
            data: "agregar="+numero+"&id="+id,
            success: function (data) {
                $('#alerta').html(data);
                cargar();
            }
        });
  }else{
    $('#alerta').html('<div class="alert alert-warning"><b><span class="fa fa-info"></span> Solo se admite números.</b></div>');
  }
}
function blokear(){
  var max =$('#imax').val();
  for(var i=1;i<=max;i++){
    $('#in'+i).attr('disabled',true);
  }
}

cargar();
completar();
function cargar(){
  $.ajax({
          type: "POST",
          url: "funciones/numeros",
          data: "listanumeros",
          success: function (data) {
              $('#filia').html(data);
          }
      });
}
function completar(){
  $.ajax({
          type: "POST",
          url: "funciones/numeros",
          data: "consulta",
          success: function (data) {
              var datos=data[0];
              if(datos.sql=='insert'){
                $('#guardar').click(function(){
                  insertar();
                });
              }else{
                $('#titulo').val(datos.tipo);
                $('#texto_nue').text(datos.detalle);
                $('#guardar').click(function(){
                  actualizar();
                });
              }
          }
      });
}
function insertar(){
  console.log('insertar');
  var titulo = $('#titulo').val();
  var detalle= $('#texto_nue').val();
  if(titulo!='' && detalle!=''){
    $.ajax({
            type: "POST",
            url: "funciones/numeros",
            data: "insertar&titulo="+titulo+"&detalle="+detalle,
            success: function (data) {
              $('#alerta').html(data);
              cargar();
              completar();
            }
    });

  }else{
    $('#alerta').html('<div class="alert alert-warning"><b><span class="fa fa-times"></span> No se puede guardar si un campo está vacío.</b></div>');
  }
}
function actualizar(){
  console.log('actualizar');
  var titulo = $('#titulo').val();
  var detalle= $('#texto_nue').val();
  if(titulo!='' && detalle!=''){
    $.ajax({
            type: "POST",
            url: "funciones/numeros",
            data: "actualizar&titulo="+titulo+"&detalle="+detalle,
            success: function (data) {
              $('#alerta').html(data);
              cargar();
              completar();
            }
    });
  }else{
    $('#alerta').html('<div class="alert alert-warning"><b><span class="fa fa-times"></span> No se puede guardar si un campo está vacío.</b></div>');
  }
}

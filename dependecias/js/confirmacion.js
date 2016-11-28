$.ajax({
        type: "POST",
        url: "funciones/confirmacion",
        data: "familias=1",
        success: function (data) {
            $('#filia').html(data);
        }
    });

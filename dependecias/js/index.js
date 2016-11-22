countdown();
function countdown(){
    var fecha=new Date('2016','10','21','20','00','00');
    var hoy=new Date();
    var dias    =0;
    var horas   =0;
    var minutos =0;
    var segundos=0;

    if (fecha>hoy){
            var diferencia=(fecha.getTime()-hoy.getTime())/1000;
            dias      =Math.floor(diferencia/86400);
            diferencia=diferencia-(86400*dias);
            horas     =Math.floor(diferencia/3600);
            diferencia=diferencia-(3600*horas);
            minutos   =Math.floor(diferencia/60);
            diferencia=diferencia-(60*minutos);
            segundos  =Math.floor(diferencia);

            $('#tiempo').html('Quedan ' + dias + ' D&iacute;as, ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos');

            if (dias>0 || horas>0 || minutos>0 || segundos>0){
                    setTimeout("countdown()",1000);
            }
    }
}

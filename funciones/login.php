<?php
  if(require_once("../conexion/base.php")){
    if(isset($_POST['mail'])){
      $input           =  $_POST['mail'];
      $stmt_query="SELECT * FROM invitados NATURAL JOIN familias WHERE EMAIL_INVI ='$input' LIMIT 1";
      $stmt = $base_var->query($stmt_query) or die(mysqli_error());
      $stmt_row = mysqli_fetch_assoc($stmt);
      @session_start();
      sleep(3);
      $lista = array('concecion'       => false);
      if($stmt_row) {
        $_SESSION["USR_ID"]     = $stmt_row['ID_INVI'];
        $_SESSION["USR_NOM"]    = $stmt_row['NOMBRES_INVI'];
        $_SESSION["USR_FILIA"]  = $stmt_row['ID_FAMILIA'];
        $_SESSION["USR_FNOM"]   = $stmt_row['DENO_FAMILIA'];
        $lista = array('concecion'       => true);
      }
      header('Content-type: application/json; charset=UTF-8');
      echo json_encode($lista);
    }
    if(isset($_GET['fecha'])){
      @session_start();
      $stmt_query ="SELECT DATE_FORMAT(FECHA_CENAS,'%Y') ANO,DATE_FORMAT(FECHA_CENAS,'%m')-1 MES,DATE_FORMAT(FECHA_CENAS,'%d') DIA,DATE_FORMAT(HORA_CENAS,'%H') HORA,DATE_FORMAT(HORA_CENAS,'%i') MINUTOS,ID_CENAS,LUGAR_CENAS,ENCARGADOS_CENAS FROM cenas WHERE FECHA_CENAS>now() LIMIT 1";
      $stmt = $base_var->query($stmt_query) or die(mysqli_error());
      $stmt_row = mysqli_fetch_assoc($stmt);
      if($stmt_row){
        $_SESSION["CENA_ID"]    = $stmt_row['ID_CENAS'];
        $_SESSION["CENA_LUGAR"] = $stmt_row['LUGAR_CENAS'];
        $_SESSION["CENA_ENCA"]  = $stmt_row['ENCARGADOS_CENAS'];
      ?>
      countdown();
      function countdown(){
          var fecha=new Date('<?php echo $stmt_row['ANO'] ?>','<?php echo $stmt_row['MES'] ?>','<?php echo $stmt_row['DIA'] ?>','<?php echo $stmt_row['HORA'] ?>','<?php echo $stmt_row['MINUTOS'] ?>','00');
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

                  $('#tiempo').html('Faltan ' + dias + ' D&iacute;as, ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos');

                  if (dias>0 || horas>0 || minutos>0 || segundos>0){
                          setTimeout("countdown()",1000);
                  }
          }
      }
      <?php
      }
      header('Content-type: application/javascript; charset=UTF-8');
    }
    mysqli_close($base_var);
  }
?>

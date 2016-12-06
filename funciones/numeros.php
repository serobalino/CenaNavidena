<?php
@ session_start();
if(isset($_POST['listanumeros'])){
  if(require_once("../conexion/base.php")){
    //cenas
    $cid = $_SESSION["CENA_ID"];
    $clu = $_SESSION["CENA_LUGAR"];
    $cen = $_SESSION["CENA_ENCA"];
    //usuario
    $uid = $_SESSION["USR_ID"];
    $uno = $_SESSION["USR_NOM"];
    $ufi = $_SESSION["USR_FILIA"];
    $ufn = $_SESSION["USR_FNOM"];

    $query_eventos = "SELECT cenas.ID_CENAS,DETALLE_EVENTO,TIPO_EVENTO,NOMBRES_INVI,familias.ID_FAMILIA,DENO_FAMILIA FROM eventos
    RIGHT JOIN cenas ON eventos.ID_CENAS=cenas.ID_CENAS RIGHT JOIN familias ON familias.ID_FAMILIA=eventos.ID_FAMILIA JOIN invitados ON invitados.ID_FAMILIA=familias.ID_FAMILIA WHERE cenas.ID_CENAS=$cid OR cenas.ID_CENAS IS NULL ORDER BY familias.ID_FAMILIA";
    $eventos = $base_var->query($query_eventos) or die(mysqli_error());
    $eventos_row = mysqli_fetch_assoc($eventos);
    $html='<table class="table table-hover">
    <thead>
      <tr>
        <th>Familia</th>
        <th>Miembros</th>
        <th>Participación</th>
      </tr>
    </thead><tbody>';
    $nombre="";


    $aux=$eventos_row['ID_FAMILIA'];
    do{
      if($aux!=$eventos_row['ID_FAMILIA']){
        if($aux==$ufi)
          $color="class='bg-info'";
        else
          $color="";
        $html.="<tr $color><td> $familia</td><td>$nombre</td><td>$detalle</td></tr>";
        $nombre="";
      }
      $nombre.='<li>'.$eventos_row['NOMBRES_INVI'].'</li>';
      $familia=$eventos_row['DENO_FAMILIA'];
      $detalle=$eventos_row['TIPO_EVENTO'];
      $aux=$eventos_row['ID_FAMILIA'];
    }while ($eventos_row = mysqli_fetch_assoc($eventos));
    if($aux==$ufi)
      $color="class='bg-info'";
    else
      $color="";
    $html.="<tr $color><td>$familia</td><td>$nombre</td><td>$detalle</td></tr>";
    $html.="<tbody>";
    echo $html;
    mysqli_close($base_var);
  }
}
if(isset($_POST['consulta'])){
  if(require_once("../conexion/base.php")){
    //cenas
    $cid = $_SESSION["CENA_ID"];
    $clu = $_SESSION["CENA_LUGAR"];
    $cen = $_SESSION["CENA_ENCA"];
    //usuario
    $uid = $_SESSION["USR_ID"];
    $uno = $_SESSION["USR_NOM"];
    $fid = $_SESSION["USR_FILIA"];
    $ufn = $_SESSION["USR_FNOM"];

    $query_eventos = "SELECT * FROM eventos WHERE ID_CENAS=$cid AND ID_FAMILIA=$fid";
    $eventos = $base_var->query($query_eventos) or die(mysqli_error());
    $eventos_row = mysqli_fetch_assoc($eventos);
    if($eventos_row){
      $sql="update";
    }else{
      $sql="insert";
    }


    $lista[] = array(
                      'tipo'     => $eventos_row['TIPO_EVENTO'],
                      'detalle'  => $eventos_row['DETALLE_EVENTO'],
                      'sql'      => $sql,
                      'fecha'    => $eventos_row['FECHA_EVENTO']
                      );
  header('Content-type: application/json; charset=UTF-8');
  echo json_encode($lista);
  mysqli_close($base_var);
  }
}

if(isset($_POST['insertar'])){
  if(require_once("../conexion/base.php")){
    //cenas
    $cid = $_SESSION["CENA_ID"];
    $clu = $_SESSION["CENA_LUGAR"];
    $cen = $_SESSION["CENA_ENCA"];
    //usuario
    $uid = $_SESSION["USR_ID"];
    $uno = $_SESSION["USR_NOM"];
    $fid = $_SESSION["USR_FILIA"];
    $ufn = $_SESSION["USR_FNOM"];

    $det=$_POST['detalle'];
    $tit=$_POST['titulo'];


    $stmt =$base_var->prepare("INSERT INTO eventos (ID_CENAS,ID_FAMILIA,DETALLE_EVENTO,TIPO_EVENTO)VALUES($cid,$fid,'$det','$tit')");
    $base_var->query($stmt_query) or die(mysqli_error());
    echo '<div class="alert alert-info"><b><span class="fa fa-check"></span> Se guardo Correctamente.</b></div>';
  }
}
if(isset($_POST['actualizar'])){
  if(require_once("../conexion/base.php")){
    //cenas
    $cid = $_SESSION["CENA_ID"];
    $clu = $_SESSION["CENA_LUGAR"];
    $cen = $_SESSION["CENA_ENCA"];
    //usuario
    $uid = $_SESSION["USR_ID"];
    $uno = $_SESSION["USR_NOM"];
    $fid = $_SESSION["USR_FILIA"];
    $ufn = $_SESSION["USR_FNOM"];

    $stmt =$base_var->prepare("UPDATE eventos SET DETALLE_EVENTO=?, TIPO_EVENTO=? WHERE ID_CENAS=? AND ID_FAMILIA=? LIMIT 1");
    $stmt->bind_param("ssii",$_POST['detalle'],$_POST['titulo'],$cid,$fid);
    $stmt->execute();
    echo '<div class="alert alert-success"><b><span class="fa fa-check"></span> Se ha actualizado Correctamente.</b></div>';
  }
}
?>

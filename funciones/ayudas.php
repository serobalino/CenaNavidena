<?php
@session_start();
if(isset($_POST['listar'])){
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


    $query_materiales = "SELECT ID_MENUS,DETALLE_MENUS,ingredientes.ID_INGRE,CANTIDAD_INGRE,UNIDAD_INGRE,DETALLE_INGRE,CANTI_TRAE,NOMBRES_INVI FROM menus NATURAL JOIN ingredientes LEFT JOIN trae ON trae.ID_INGRE=ingredientes.ID_INGRE LEFT JOIN invitados ON invitados.ID_INVI=trae.ID_INVI WHERE ID_CENAS=$cid";
  	$materiales = $base_var->query($query_materiales) or die(mysqli_error());
    $materiales_row = mysqli_fetch_assoc($materiales);
    $html='<table class="table table-hover">
    <thead>
      <tr>
        <th>Detalle</th>
        <th>Materiales</th>
        <th></th>
        <th>Puedes ayudar?</th>
        <th>Cantidad</th>
      </tr>
    </thead><tbody>';
    $ingrediente="";
    $cantidad="";
    $check="";
    $input="";


    $aux=$materiales_row['ID_MENUS'];
    do{
      $i=$materiales_row['ID_INGRE'];
      if($aux!=$materiales_row['ID_MENUS']){//<td rowspan="2">$50</td>
        $html.="<tr><td>$plato</td><td>$ingrediente</td><td>$cantidad</td><td>$check</td><td>$input</td></tr>";
        $ingrediente="";
        $cantidad="";
        $check="";
        $input="";
      }
      $ingrediente.='<dt>'."<input type='text' value='".$materiales_row['DETALLE_INGRE']."' id='mat".$i."' class='form-control input-sm' readonly/>".'</dt>';
      $cantidad.='<dt>'."<input type='text' value='".$materiales_row['CANTIDAD_INGRE'].' '.$materiales_row['UNIDAD_INGRE']."' class='form-control input-sm' readonly/>".'</dt>';
      $plato=$materiales_row['DETALLE_MENUS'];
      if(!$materiales_row['NOMBRES_INVI']){
        $check.='<dt><select class="form-control input-sm" id="sel'.$i.'" onchange="leer('.$i.')"><option disabled selected >elige</option><option value="0">No</option><option value="1">Si</option></select></dt>';
        $input.="<dt><input type='number'size='4' maxlength='4' id='in$i' value='' class='form-control input-sm' onblur=\"guardar($i)\"></dt>";
      }else{
        $check.="<dt><input type='text' class='form-control input-sm' readonly value='".$materiales_row['NOMBRES_INVI']."'/></dt>";
        $input.="<dt><input type='text' class='form-control input-sm' readonly value='".$materiales_row['CANTI_TRAE'].' '.$materiales_row['UNIDAD_INGRE']."'/></dt>";
      }
      $aux=$materiales_row['ID_MENUS'];
    }while ($materiales_row = mysqli_fetch_assoc($materiales));
    $html.="<tr><td>$plato</td><td>$ingrediente</td><td>$cantidad</td><td>$check</td><td>$input</td></tr>";
    $html.="<tbody><input type='hidden' id='imax' value='$i'/>";
    echo $html;
    mysqli_close($base_var);
  }
}
if(isset($_POST['agregar']) && isset($_POST['id'])){
  if(require_once("../conexion/base.php")){
    $trae=1;
    $id=$_POST['id'];
    if($_POST['agregar']>0)
      $trae=$_POST['agregar'];
    //cenas
    $cid = $_SESSION["CENA_ID"];
    $clu = $_SESSION["CENA_LUGAR"];
    $cen = $_SESSION["CENA_ENCA"];
    //usuario
    $uid = $_SESSION["USR_ID"];
    $uno = $_SESSION["USR_NOM"];
    $ufi = $_SESSION["USR_FILIA"];
    $ufn = $_SESSION["USR_FNOM"];

    $query_materiales = "INSERT INTO trae(ID_INGRE,ID_INVI,CANTI_TRAE) VALUES ($id,$uid,$trae)";
  	$materiales = $base_var->query($query_materiales) or die(mysqli_error());
    echo '<div class="alert alert-success"><b><span class="fa fa-smile-o"></span> Muchas Gracias por tu colaboración.</b></div>';

    mysqli_close($base_var);
  }

}
?>

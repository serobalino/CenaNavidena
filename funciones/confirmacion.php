<?php
@session_start();
if(isset($_POST['familias']) && $_POST['familias']==1){
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


    $query_confirmacion = "SELECT * FROM confirma NATURAL JOIN invitados WHERE ID_CENAS=$cid  AND ID_INVI=$uid";
  	$confirmacion = $base_var->query($query_confirmacion) or die(mysqli_error());
    $confirmacion_row = mysqli_fetch_assoc($confirmacion);

    if(!$confirmacion_row){
      $query_familias = "SELECT * FROM invitados NATURAL JOIN familias WHERE ID_FAMILIA=$uid";
    	$familias = $base_var->query($query_familias) or die(mysqli_error());
      $familias_row = mysqli_fetch_assoc($familias);
      $familias_num = mysqli_num_rows($familias);
      if($familias_num>1){
        $html="<b>¿Puedes afirmar que todos ellos va a ir a la Cena de Navideña?</b><div class='radio'><label><input type='radio' name='asis' value='1'>Si, todos ellos asistiran conmigo <i class='fa fa-users'></i></label></div><ul>";
        $query_todo="INSERT INTO confirma(ID_INVI,ID_CENAS) VALUES ";
        do{
          $query_todo.='('.$familias_row['ID_INVI'].','.$cid.'),';
          $html.="<li>".$familias_row['NOMBRES_INVI']."</li>";
        }while ($familias_row = mysqli_fetch_assoc($familias));
        $query_todo=trim($query_todo,',');
        $html.="</ul> <div class='radio'><label class='text-warning'><input type='radio' name='asis' value='1'>No, solo puedo afirmar mi asistencia <i class='fa fa-user'></i></label></div>";
      }else{
        $query_todo="INSERT INTO confirma(ID_INVI,ID_CENAS) VALUES ($uid,$cid)";
        $html = "<b>Vas a ir a la Cena Navideña?</b><div class='radio'><label class='text-warning'><input type='radio' name='asis' value='1'>Si</label></div>";
      }
      $_SESSION["CON_QUERY"]=$query_todo;
    }else{
      $html="<b>Gracias, ya confirmaste o alguien de tu familia confirmo tu asistencia <i class='fa fa-smile-o'></i></b>";
    }
    
    echo $html;
  }
}
?>

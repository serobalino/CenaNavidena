<?php
function acceso(){
  @session_start();
  $MM_restrictGoTo = "./";
  if(isset($_SESSION["USR_ID"]) && isset($_SESSION["USR_NOM"]) && isset($_SESSION["USR_FILIA"]) && isset($_SESSION["USR_FNOM"])){
    $j=1;
  }else{
    if(isset($_GET['hash'])){
      if(require_once("conexion/base.php")){
        $input           =  $_GET['hash'];
        $stmt =$base_var->prepare("SELECT * FROM invitados NATURAL JOIN familias WHERE HASH_INVI = ? LIMIT 1");
        $stmt->bind_param("s", $input);
        $stmt->execute();
        $result = $stmt->get_result();
        $i=0;
        while ($stmt_row = $result->fetch_assoc()) {
          $_SESSION["USR_ID"]     = $stmt_row['ID_INVI'];
          $_SESSION["USR_NOM"]    = $stmt_row['NOMBRES_INVI'];
          $_SESSION["USR_FILIA"]  = $stmt_row['ID_FAMILIA'];
          $_SESSION["USR_FNOM"]   = $stmt_row['DENO_FAMILIA'];
          $i++;
        }
        if($i==0)
          header("Location: ". $MM_restrictGoTo);
        mysqli_close($base_var);
      }
    }else{
      header("Location: ". $MM_restrictGoTo);
  	  exit;
    }
  }
}
 ?>

<?php
function acceso(){
  @session_start();
  $MM_restrictGoTo = "./";
  if(isset($_SESSION["USR_ID"]) && isset($_SESSION["USR_NOM"]) && isset($_SESSION["USR_FILIA"]) && isset($_SESSION["USR_FNOM"])){
    $i=1;
  }else{
    if(isset($_GET['hash'])){
      if(require_once("conexion/base.php")){
        $input           =  $_GET['hash'];
        $stmt_query="SELECT * FROM invitados NATURAL JOIN familias WHERE HASH_INVI = '$input' LIMIT 1";
        $stmt = $base_var->query($stmt_query) or die(mysqli_error());
        $stmt_row = mysqli_fetch_assoc($stmt);
        $i=0;
        if ($stmt_row) {
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

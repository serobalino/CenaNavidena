<?php
function base(){
  $hostname = "localhost";
  $database = "NavidadPuyo2016";
  $username = "root";
  $password = "";
  $base_var = new mysqli($hostname, $username, $password,$database) or trigger_error(mysqli_error(),E_USER_ERROR);

  if($base_var){
    mysqli_set_charset($feriapuce,'utf8');
    return true;
  }else{
    return false;
  }
}

?>
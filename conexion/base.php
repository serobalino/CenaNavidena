<?php
  $hostname = "localhost";
  $database = "NavidadPuyo2017";
  $username = "root";
  $password = "";
  $base_var = new mysqli($hostname, $username, $password,$database) or trigger_error(mysqli_error(),E_USER_ERROR);

  if($base_var){
    mysqli_set_charset($base_var,'utf8');
    return true;
  }else{
    return false;
  }
?>

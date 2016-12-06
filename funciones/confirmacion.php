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
      $query_familias = "SELECT * FROM invitados NATURAL JOIN familias WHERE ID_FAMILIA=$ufi";
    	$familias = $base_var->query($query_familias) or die(mysqli_error());
      $familias_row = mysqli_fetch_assoc($familias);
      $familias_num = mysqli_num_rows($familias);
      $query_todo1="";
      if($familias_num>1){
        $html="<b>¿Puedes afirmar que todos ellos va a ir a la Cena de Navideña?</b><div class='radio'><label><input type='radio' name='asis' value='1'>Si, todos ellos asistiran conmigo <i class='fa fa-users'></i></label></div><ul>";
        $query_todo1="INSERT INTO confirma(ID_INVI,ID_CENAS) VALUES ";
        do{
          $query_todo1.='('.$familias_row['ID_INVI'].','.$cid.'),';
          $html.="<li>".$familias_row['NOMBRES_INVI']."</li>";
        }while ($familias_row = mysqli_fetch_assoc($familias));
        $query_todo1=trim($query_todo1,',');
        $html.="</ul> <div class='radio'><label class='text-warning'><input type='radio' name='asis' value='0'>No, solo puedo afirmar mi asistencia <i class='fa fa-user'></i></label></div>";

      }else{

        $html = "<b>Vas a ir a la Cena Navideña?</b><div class='radio'><label class='text-warning'><input type='radio' name='asis' value='0'>Si</label></div>";

      }
      $query_todo0="INSERT INTO confirma(ID_INVI,ID_CENAS) VALUES ($uid,$cid)";
      $_SESSION["CON_QUERY1"]=$query_todo1;
      $_SESSION["CON_QUERY0"]=$query_todo0;



    }else{
      $html="<b>Gracias, ya confirmaste o alguien de tu familia confirmo tu asistencia <i class='fa fa-smile-o'></i></b>";
    }
    $html.='
    <br><br>
    <div class="">
    <b class="text-muted">Invita a alguien más</b>
    <div class="form-inline" method="post">
      <div class="form-group">
        <label for="email" class="text-muted">email:</label>
        <input type="email" class="form-control" id="email" placeholder="juan@hotmail.com" required>
      </div>
      <div class="form-group">
        <label for="pwd" class="text-muted">nombres:</label>
        <input type="text" class="form-control" id="nom" placeholder="Juan Robalino" required>
      </div>
      <button type="button" class="btn btn-info" id="enviar">Enviar <span class="fa fa-paper-plane"></span></button>
    </div></div>';
    echo $html;
    mysqli_close($base_var);
  }
}
if(isset($_POST['input'])){
  $input=$_POST['input'];
  if(require_once("../conexion/base.php")){
    if($input){
      $query=$_SESSION["CON_QUERY1"];
      $base_var->query($query) or die(mysqli_error());
    }else{
      $query=$_SESSION["CON_QUERY0"];
      $base_var->query($query) or die(mysqli_error());
    }
    mysqli_close($base_var);
  }
}
if(isset($_POST['nuevo'])){
  if(require_once("../conexion/base.php")){
    require_once('emails.php');
    $id_filia=$_SESSION["USR_FILIA"];
    $email=strtolower($_POST['email']);
    $nombr=$_POST['nom'];
    $stmt_query ="SELECT * FROM invitados WHERE EMAIL_INVI ='$email' OR NOMBRES_INVI='$nombr'";
    $stmt = $base_var->query($stmt_query) or die(mysqli_error());
    $stmt_row = mysqli_fetch_assoc($stmt);
    if(!$stmt_row){
      $stmt_query ="INSERT INTO invitados(ID_FAMILIA,NOMBRES_INVI,EMAIL_INVI,HASH_INVI) VALUES ($id_filia,'$nombr','$email',SHA1('$email'))";
      $base_var->query($stmt_query) or die(mysqli_error());
      c_email($nombr,$email);
      echo 1;
    }else{
      echo 0;
    }
    mysqli_close($base_var);
  }
}
?>

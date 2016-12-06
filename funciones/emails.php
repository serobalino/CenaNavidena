<?php
@session_start();
if(isset($_POST['enviar'])){
	envia_todos();
}
function c_email($nombre,$correo){
	@ include_once('class.phpmailer.php');
	@ include_once('class.smtp.php');
	@ session_start();
  $cuerpo = leerEmail($nombre,$correo);
    $mail = new PHPMailer();
  	$mail->IsSMTP();
  	$mail->Subject  = "🎄 Invitación";
  	$mail->MsgHTML($cuerpo);
  	$mail->AddAddress($correo,$nombre);
  	if($mail->Send())
			return true;
		else
			return false;
}
function leerEmail($replace,$email){
		ob_start();
		$idcena=$_SESSION["CENA_ID"];
  	require_once '../emails/'.$idcena.'.html';
		$hash	= SHA1($email);
		$content = ob_get_clean();
	  $nombres   = "Nombre Apellido";
	  //$replace   = 'Sebastian Robalino';
	  $content   = str_replace($nombres, $replace, $content);
		$link="http://filia.asecont-puyo.com/cena/";

		$link1=$link.'ayudas?hash='.$hash;
		$link2=$link.'numeros?hash='.$hash;
		$link3=$link.'confirmacion?hash='.$hash;

	  $content   = str_replace('link1',$link1,$content);
	  $content   = str_replace('link2',$link2,$content);
	  $content   = str_replace('link3',$link3,$content);
	  return $content;
}
function envia_todos(){
	if(require_once("../conexion/base.php")){
		$query_cena = "SELECT ID_CENAS FROM cenas WHERE FECHA_CENAS>now() LIMIT 1";
		$cena = $base_var->query($query_cena) or die(mysqli_error());
    $cena_row = mysqli_fetch_assoc($cena);
		$_SESSION["CENA_ID"]=$cena_row['ID_CENAS'];

		$query_mailing = "SELECT NOMBRES_INVI,EMAIL_INVI FROM invitados";
  	$mailing = $base_var->query($query_mailing) or die(mysqli_error());
    $mailing_row = mysqli_fetch_assoc($mailing);
		do{
			if(c_email($mailing_row['NOMBRES_INVI'],$mailing_row['EMAIL_INVI'])){
				echo "<li>Se ha enviado el correo a ".$mailing_row['NOMBRES_INVI']."</li>";
			}else{
				echo "<li>NO SE ha enviado el correo a ".$mailing_row['NOMBRES_INVI']."</li>";
			}
		}while ($mailing_row = mysqli_fetch_assoc($mailing));
	}
}
?>

<?php 
error_reporting(0);
include_once("conect.php");
if($_POST['t']){
$re=mysql_fetch_object(mysql_query("select * from usuarios where idus=1"));
$rp=mysql_fetch_object(mysql_query("select * from productos where codp=". $_POST['t']));
$pro=$rp->nombrep;
$la=$_POST['la'];
	$dest = $re->email;
	//$head = "From: ".$_POST['email']."\r\n";
	$head = "From: info@chacay.com \r\n";
		// Ahora creamos el cuerpo del mensaje
	$msg = "------------------------------- \n";
	$msg.= "        FORMULARIO DE RESERVA            \n";
	$msg.= "------------------------------- \n";
	$msg.= "TOUR:   ".$pro."\n";
	$msg.= "NOMBRE:   ".$_POST['nom']."\n";
	$msg.= "CIUDAD:    ".$_POST['ciu']."\n";
	$msg.= "TELEFONO:    ".$_POST['tel']."\n";
	$msg.= "EMAIL:    ".$_POST['ema']."\n";
	$msg.= "PARA LA FECHA:    ".$_POST['fec']."\n";
	$msg.= "N0. Personas:    ".$_POST['np']."\n";
	$msg.= "COMENTARIOS:    ".$_POST['com']."\n\n\n\n";
	$msg.= "HORA:     ".date("h:i:s a ")."\n";
	$msg.= "FECHA:    ".date("D, d M Y")."\n";
		$msg.= " Mensaje creado por www.chacay.com \n";
	// Finalmente enviamos el mensaje
	//if (mail($dest, "Nueva Reserva", $msg, $head)) {
		mail($dest, "Nueva Reserva", $msg, $head);
		mysql_query("insert into reservas values('','$ser','". $pro ."','". trim($_POST['nom']) ."','". trim($_POST['ciu']) ."','". trim($_POST['tel']) ."','". trim($_POST['ema']) ."','". trim($_POST['fec']) ."','". trim($_POST['np']) ."','". trim($_POST['com']) ."',NOW(),'','','','','')");
		 header("Location: producto.php?in=1&p=". $_POST['t'] ."&op=". $_POST['op'] ."&pa=".$la);
	//} else {
		//echo "rpta=error";
	//	header("Location: reserva.php?e=2&h=". $_POST['h']);
	//}
}
?>
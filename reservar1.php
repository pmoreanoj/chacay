<?php 
error_reporting(0);
include_once("conect.php");
if($_POST){
$re=mysql_fetch_object(mysql_query("select * from usuarios where idus=1"));
$la=$_POST['la'];
	$dest = $re->email;
	//$head = "From: ".$_POST['email']."\r\n";
	$head = "From: info@chacay.com \r\n";
	if($_POST['des']){
	$pro=$_POST['des'];
	}else{
		$pro="Region:". $_POST['reg'].", Intereses: ". $_POST['tin'].", Presupuesto: ". $_POST['prec'].", Dias:".$_POST['dias'];
	}
		// Ahora creamos el cuerpo del mensaje
	$msg = "------------------------------- \n";
	$msg.= "        FORMULARIO DE PEDIDO            \n";
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
		mail($dest, "Nuevo Pedido", $msg, $head);
		mysql_query("insert into reservas values('','$ser','". $pro ."','". trim($_POST['nom']) ."','". trim($_POST['ciu']) ."','". trim($_POST['tel']) ."','". trim($_POST['ema']) ."','". trim($_POST['fec']) ."','". trim($_POST['np']) ."','". trim($_POST['com']) ."',NOW(),'','','','','')");
		 header("Location: reservas.php?in=1&p=". $_POST['t'] ."&op=". $_POST['op'] ."&pa=".$la);
	//} else {
		//echo "rpta=error";
	//	header("Location: reserva.php?e=2&h=". $_POST['h']);
	//}
}
?>
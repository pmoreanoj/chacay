<?php 
//inicializat session
if (!isset($_SESSION)) {
  session_start();
}
//conexion a la base de datos
include_once("conect.php");
/*$res=$_GET['r'];
$idf=$_GET['n'];*/
if($_GET['tx']){///datos de PAYPAL
//resivir datos enviados desde PAYPAL
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';
$tx_token = $_GET['tx'];
$auth_token = "p1SzI8CSL1wLL_tHFVK8JUVj3xwSMT-uL63QTNCVae0SCaKs-_PTzfNSi54";
$req .= "&tx=$tx_token&at=$auth_token";

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
$er='No hubo conexion';
} else {
$er='Si hubo conexion';
	fputs ($fp, $header.$req);
	// read the body data 
	$res = '';
	$headerdone = false;
	while (!feof($fp)) {
	$line = fgets ($fp, 1024);
		if (strcmp($line, "\r\n") == 0){
		// read the header
		$headerdone = true;
		}else if ($headerdone){
		// header has been read. now read the contents
		$res .= $line;
		}
    }
// parse the data
$lines = explode("\n", $res);
$keyarray = array();
	if (strcmp ($lines[0], "SUCCESS") == 0) {
	$er.='EXITO';
		for ($i=1; $i<count($lines);$i++){
		list($key,$val) = explode("=", $lines[$i]);
		$keyarray[urldecode($key)] = urldecode($val);
		}
	// check the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your Primary PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment
	//$firstname = $keyarray['first_name'];
	//$lastname = $keyarray['last_name'];
	//$itemname = $keyarray['item_name'];
	//$amount = $keyarray['payment_gross'];
	$idf = $keyarray['item_number'];
	$estado = $keyarray['auth_status'];
	$estadop=$keyarray['payment_status'];
	$pais=$keyarray['address_country'];
	$ciudad=$keyarray['address_city'];
	$direccion=$keyarray['address_street'];
	$telefono=$keyarray['contact_phone'];
	$email=$keyarray['payer_email'];
	//crear factura
	$rr=mysql_fetch_object(mysql_query("select * from reservas where idr=".$idf));
	 mysql_query("insert into facturas values('','".$idf."','','','".$rr->precio."','No Pagado','','".$rr->cliente."','','".$pais."','".$ciudad."','".$direccion."','".$telefono."','".$email."','','".$rr->servicio."','".$rr->precio."','1',Now())");
	 $numf=mysql_insert_id();
	 $in=1;
	
	}else if (strcmp ($lines[0], "FAIL") == 0) {
	$er.='FRACASO';
	// log for manual investigation
	}

}
fclose ($fp);
}//fin de if($_GET['tx']){///datos de PAYPAL
$in=0;
if($_POST['ref']){///recibir datos desde cs
$in=1;
$res=$_POST['res'];
$idf=$_POST['ref'];
 //obtener datos de trasaccion desde cs
 $ch = curl_init();
	$url='http://www.comprasegura.com.ec/webserver/ecs.php';
	curl_setopt($ch, CURLOPT_URL, $url);
	$elements['e']=1163;
	$elements['t']=6;
	$elements['p']=$idf;
	curl_setopt($ch, CURLOPT_POST,true);  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $elements);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$resultado = curl_exec($ch);
	$error = curl_error($ch);
	curl_close($ch);
	 $xml = simplexml_load_string($resultado);
	 $transaccion=$xml->transaccion;
	 //mysql_query("update facturas set pais='".$transaccion->pais."',ciudad='".$transaccion->ciudad."',direccion='".$transaccion->direccion."',telefono='".$transaccion->telefono."' where numfactura=".$idf);
	 $rr=mysql_fetch_object(mysql_query("select * from reservas where idr=".$idf));
	 mysql_query("insert into facturas values('','".$idf."','','','".$rr->precio."','No Pagado','','".$rr->cliente."','','".$transaccion->pais."','".$transaccion->ciudad."','".$transaccion->direccion."','".$transaccion->telefono."','".$transaccion->email."','','".$rr->servicio."','".$rr->precio."','1',Now())");
	 $numf=mysql_insert_id();
	 $in=1;
}else{
$idf=$_GET['n'];
}
if($res==1 or $estadop=='Completed'){
	mysql_query("update facturas set estado='Pagado' where numfactura=".$numf);
	////correo de aviso a usuario y administrador
	$df=mysql_fetch_object(mysql_query("select * from facturas where numfactura=".$numf));
    $df1=mysql_fetch_object(mysql_query("select * from reservas where idr=".$idf));
	$cuerpo='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chacay</title>
</head>
<body>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="0" style="border:solid 1px #000066; text-align: center;">
  <tr>
    <td width="60" bgcolor="#BDDDF0"><img src="http://www.amigosprofesionales.com/chacay/imagenes/chacay.png" width="120" height="50" /></td>
    <td width="60" bgcolor="#BDDDF0">&nbsp;</td>
    <td width="120" bgcolor="#BDDDF0">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2>Compra Finalizada</h2>
    <table width="350" border="0" align="center" cellpadding="1" cellspacing="2">
          <tr>
            <td colspan="2" align="c"><h3>Orden No. '. sprintf("%04d",$numf) .'</h3></td>
            </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;"><strong><u>Datos del Cliente</u></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="140" style="text-align: right; font-weight: bold;">Nombre:</td>
            <td style="text-align: left">'.$df->cliente.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Pa&iacute;s:</td>
            <td style="text-align: left">'.$df->pais.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Ciudad:</td>
            <td style="text-align: left">'.$df->ciudad.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Direcci&oacute;n:</td>
            <td style="text-align: left">'.$df->direccion.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Tel&eacute;fono:</td>
            <td style="text-align: left">'.$df->telefono.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">E-Mail:</td>
            <td style="text-align: left">'.$df->email.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;"><strong><u>Datos de la Compra</u></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Tour:</td>
            <td style="text-align: left">'.$df->tour.'></td>
          </tr><tr>
            <td style="text-align: right; font-weight: bold;">Para la fecha:</td>
            <td style="text-align: left">'.$df1->fechar.'</td>
          </tr><tr>
            <td style="text-align: right; font-weight: bold;">No de Personas:</td>
            <td style="text-align: left">'.$df1->personas.'</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Valor: </td>
            <td bgcolor="#BDDDF0" style="text-align: left">$'.$df->total.' USD</td>
          </tr>
          <tr bgcolor="#FFFFFF">
                  <td align="right" bgcolor="#BDDDF0" class="Bold11Pt"><strong>Transacci&oacute;n:</strong></td>
                  <td bgcolor="#BDDDF0" class="precio" style="text-align: left">Aprobada Exitosamente</td>
                </tr>
        </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#003"><em>www.chacay.com</em></td>
  </tr>
</table>
</body>
</html>';
// Para enviar correo HTML, la cabecera Content-type debe definirse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
		   $cabeceras .= 'From: info@chacay.com' . "\r\n";
		 // Enviamos el mensaje por e-mail
			@mail($df->email, 'Confirmacion de Compra', $cuerpo,$cabeceras);
			//@mail('info@comprasegura.com.ec', 'Se Realizo una compra', $cuerpo,$cabeceras);
	header('location:result.php?n='.numf); 
}
$df=mysql_fetch_object(mysql_query("select * from facturas where numfactura=".$numf));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	<link href="slides/css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
    <script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
</head>

<body>
<!--<div id="top">
  <div id="top_a">
  	Toll free number: <span id="fono">888 776 6802</span>
  </div>
</div>-->
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">
    <div id="contenido_right">
      <div class="textos"><table border="0" align="center" cellpadding="15" cellspacing="0">
<tr>
  <td width="472">
        <h1>Finalizaci&oacute;n de Compra</h1>
        <table width="350" border="0" align="center" cellpadding="1" cellspacing="2">
          <tr>
            <td colspan="2" align="c"><h3>Orden No. <?php echo sprintf("%04d",$numf); ?></h3></td>
            </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;"><strong><u>Datos del Cliente</u></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="140" style="text-align: right; font-weight: bold;">Nombre:</td>
            <td align="left"><?php echo $df->cliente; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Pa&iacute;s:</td>
            <td align="left"><?php echo $df->pais; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Ciudad:</td>
            <td align="left"><?php echo $df->ciudad; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Direcci&oacute;n:</td>
            <td align="left"><?php echo $df->direccion; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Tel&eacute;fono:</td>
            <td align="left"><?php echo $df->telefono; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">E-Mail:</td>
            <td align="left"><?php echo $df->email; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;"><strong><u>Datos de la Compra</u></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Tour:</td>
            <td align="left"><?php echo $df->paquete; ?></td>
          </tr>
          <?php if($rp->fechas!=''){?>
          <tr>
            <td style="text-align: right; font-weight: bold;">Para la fecha:</td>
            <td align="left"><?php echo $df->fechas; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td style="text-align: right; font-weight: bold;">No. Personas:</td>
            <td align="left"><?php echo $df->hotel; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Valor: </td>
            <td align="left" bgcolor="#9BCDFF">$<?php echo $df->total; ?> USD</td>
          </tr>
          <tr bgcolor="#FFFFFF">
                  <td align="right" bgcolor="#9BCDFF" class="Bold11Pt"><strong>Transacci&oacute;n:</strong></td>
                  <td align="left" bgcolor="#9BCDFF" class="precio">
                  <?php if($df->estado=='Pagado'){?>
                  Aprobada Exitosamente
                  <?php }else{ ?>
                  No Aprobada
                  <?php }?>
                  </td>
                </tr>
        </table></td>
    </tr>
        
        <tr>
          <td><table align="center">
              <tr>
                <td ><input name="btnenvio" type="button" style="width:100px; height:30px; font-weight:bold" id="btnenvio" onclick="window.location.href='index.php'"  value="SALIR" />                </td>
                <td><?php if($df->estado=='Pagado'){?><input name="reset" type="button" value="IMPRIMIR" style="width:100px; height:30px; font-weight:bold" onClick="Javascript:window.open('imprimirf.php?f=<?php echo $idf;?>', 'IMPRIMIR', 'scrollbars=yes,width=750,height=400,top=100, left=200')" />  <?php } ?>              </td>
              </tr>
          </table></td>
        </tr>
  </table></div>
    </div>
  </div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
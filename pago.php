<?php 
include_once("conect.php");
$ido=$_GET['id'];
$rowo=@mysql_fetch_object(mysql_query("select * from reservas where idl='".$ido."'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pago Chacay</title>
<script language="javascript">
function ir(){
document.pagar_paypal.submit();
}
</script>
</head>
<body onload="ir()">
<form action="https://comprasegura.com.ec/pagos/?sid=dasdsa454545a64s5da" method="post" name="frmcs" id="frmcs">
  <input name="idco" type="hidden" id="idco" value="1163" />
  <input name="ref" type="hidden" id="ref" value="<?php echo $rowo->idr; ?>" />
  <input name="valor"type="hidden" id="valor" value="<?php echo $rowo->precio; ?>" />
  <input name="extra1" type="hidden" id="extra1" value="Pago reserva <?php echo $rowo->idr; ?>"/>
  <input name="na" type="hidden" id="na" value="<?php $n=explode(" ",$rowo->cliente); echo $n[0]; ?>" />
  <input name="aa" type="hidden" id="aa" value="<?php echo $n[1]; ?>" />
  <input name="ta" type="hidden" id="ta" value="<?php echo $rowo->telefono; ?>" />
  <input name="ea" type="hidden" id="ea" value="<?php echo $rowo->email; ?>" />
</form>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pagar_paypal" id="pagar_paypal" target="_parent">
  <input type="hidden" name="cmd" value="_xclick" />
  <input type="hidden" name="business" value="chacay@comprasegura.com.ec" />
  <input type="hidden" name="item_name" value="Pago <?php echo $rowo->servicio; ?>" />
  <input type="hidden" name="item_number" value="<?php echo $rowo->idr; ?>" />
  <input type="hidden" name="amount" value="<?php echo $rowo->precio; ?>" />
  <input type="hidden" name="no_shipping" value="1" />
  <input type="hidden" name="return" value="" />
  <input type="hidden" name="cancel_return" value="http://www.amigosprofesionales.com/chacay/" />
  <input type="hidden" name="no_note" value="1" />
  <input type="hidden" name="currency_code" value="USD" />
  <?php $n=explode(" ",$rowo->cliente);  ?>
  <input type="hidden" name="first_name" value="<?php echo $n[0]; ?>" />
  <input type="hidden" name="last_name" value="<?php echo $n[1];	?>" />
  <input type="hidden" name="address1" value="<?php echo $rowo->direccion; ?>" />
  <input type="hidden" name="address2" value="" />
  <input type="hidden" name="city" value="<?php echo $rowo->ciudad; ?>" />
  <input type="hidden" name="state" value="" />
  <input type="hidden" name="zip" value="" />
  <input type="hidden" name="lc" value="EC" />
  <input type="hidden" name="email" value="<?php echo $rowo->email; ?>" />
  <input type="hidden" name="night_phone_a" value="<?php echo $rowo->telefono; ?>" />
  <input type="hidden" name="night_phone_b" value="" />
</form>

</body>
</html>
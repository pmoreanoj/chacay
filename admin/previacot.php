<?php 
if (!isset($_SESSION)) {
  session_start();
}
include_once("../conect.php");
if($_SESSION['id_us']){
$idop=$_SESSION['id_us'];
$du=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$idop));
}else{
header("Location:index.php");
}//fin de if($_SESSION['cod_e']){
include_once("../conexion.php");
$vvc=$_GET['vc'];
if($vvc==1){
$rowc=mysql_fetch_object(mysql_query("select * from cotiza where idcot=".sprintf("%d",$_GET['idc'])));
echo $rowc->msj;
 }else{//caso contrario  de if($fl!=1){?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<LINK HREF="../style.css" TYPE="text/css" REL="stylesheet">
<title>COTIZACIÓN <?php echo $numfactura; ?></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
	font-size:10px;
	font-family:Verdana;
}
.style1 {color: #FFFFFF}
.style21 {font-size: 12px}

-->
</style>
<script language="JavaScript">
<!--
function cerrar()
{
opener=null;
window.close()
}
//-->
</script> 
</head>

<body onload="window.focus()">
<br />
<p>
  
</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>| <a onclick="window.print()" href="#"><img src="../imagenes/printer.gif" border="0" /> Imprimir </a> | <a href="#" onclick="window.close()">Cerrar Ventana</a>
      </p>
      <br />
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><table width="100%" border="0" cellpadding="5" cellspacing="0">
              <tr>
                <td><img src="../imagenes/logo.png" width="120" height="56" /></td>
                <td>
				<div align="center">
                      <strong>Sovistour Cia. Ltda.</strong><br />
                      Matriz: <?php echo $du->direccion; ?><br />Teléfono:<?php echo $du->telefono; ?> <br /> 
                      <?php echo $du->ciudad; ?>-<?php echo $du->pais; ?><br />
                      </div>
				</td>
              </tr>
            </table>
          </td>
          <td class="ladod"><strong>Proforma N&ordm;</strong>: </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><strong>Nombre: </strong><?php echo $_POST['nomc']; ?></td>
          <td nowrap="nowrap" class="ladod"><strong>Fecha: </strong><?php echo date('d-m-Y');; ?></td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <th width="170" bgcolor="#FFFFFF" class="ladobi">Producto</th>
          <th width="70" bgcolor="#FFFFFF" class="ladobi">V. Unit </th>
          <th width="50" bgcolor="#FFFFFF" class="ladobi">Cantidad</th>
          <th width="80" bgcolor="#FFFFFF" class="ladobi">V. Total </th>
        </tr>
        <?php //EL CONTENIDO DE LA FACTURA 
			  $i=1;
			  $compramp=$_SESSION['cotiza'];
			     foreach($compramp as $k => $v){ 
				 //$producto=mysql_query("select * from productos where codp='$k'");
				 //$producto1=mysql_fetch_object($producto);?>
        <tr bgcolor="#FFFFFF">
          <td class="ladobi"><div align="center"><?php echo $compramp[$k]['prod']; ?></div></td>
          <td class="ladobi"><div align="center"><?php echo sprintf("%01.2f",$compramp[$k]['prec']); ?></div></td>
          <td class="ladobi"><div align="center"><?php echo $compramp[$k]['cant']; ?></div></td>
          <td class="ladobi"><div align="center">
              <?php 
				$vtotal=$compramp[$k]['cant']*$compramp[$k]['prec'];
				echo sprintf("%01.2f",$vtotal); 
				$subtotal=$subtotal+$vtotal;?>
          </div></td>
        </tr>
        <?php 
			  } // fin de foreach($compramp as $k => $v){ ?>
        
        <tr bgcolor="#FFFFFF">
          <td colspan="3" class="ladoi"><div align="right" ><strong>TOTAL</strong></div></td>
          <td nowrap="nowrap" class="ladobi"><div align="center">
              <?php 
			  $total=round($subtotal+$iva+$operadora,2);
			  echo sprintf("%01.2f",$total); ?>
              <input name="tot" type="hidden" id="tot" value="<?php echo $total ?>" />
          </div></td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><?php echo $_POST['comc'] ?></td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php } // fin de if($vvc==1){?>
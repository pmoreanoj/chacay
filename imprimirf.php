<?php 
//conexion a la base de datos
include_once("conect.php");
$idf=$_GET['f'];
$df=mysql_fetch_object(mysql_query("select * from facturas where numfactura=".$idf));
$df1=mysql_fetch_object(mysql_query("select * from reservas where idr=".$df->referencia));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<style media="print">
		.noPrint{
		display: none;
		}
		.yesPrint{
		display: block !important;
		}
		</style>
</head>
<body>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="0" style="border:solid 1px #000066; text-align: center;">
  <tr>
    <td width="60" bgcolor="#BDDDF0"><img src="http://www.amigosprofesionales.com/chacay/imagenes/chacay.png" width="120" height="50" /></td>
    <td width="60" bgcolor="#BDDDF0"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="./imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td width="120" bgcolor="#BDDDF0"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="./imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
  <tr>
    <td colspan="3"><h2>Compra Finalizada</h2>
    <table width="350" border="0" align="center" cellpadding="1" cellspacing="2">
          <tr>
            <td colspan="2" align="c"><h3>Orden No. <?php echo sprintf("%04d",$idf); ?></h3></td>
            </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;"><strong><u>Datos del Cliente</u></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="140" style="text-align: right; font-weight: bold;">Nombre:</td>
            <td style="text-align: left"><?php echo $df->cliente; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Pa&iacute;s:</td>
            <td style="text-align: left"><?php echo $df->pais; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Ciudad:</td>
            <td style="text-align: left"><?php echo $df->ciudad; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Direcci&oacute;n:</td>
            <td style="text-align: left"><?php echo $df->direccion; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Tel&eacute;fono:</td>
            <td style="text-align: left"><?php echo $df->telefono; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">E-Mail:</td>
            <td style="text-align: left"><?php echo $df->email; ?></td>
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
            <td style="text-align: left"><?php echo $df->tour; ?></td>
          </tr>
          <?php if($rp->fechas!=''){?>
          <tr>
            <td style="text-align: right; font-weight: bold;">Para la fecha:</td>
            <td style="text-align: left"><?php echo $df1->fechar; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td style="text-align: right; font-weight: bold;">No. Personas:</td>
            <td style="text-align: left"><?php echo $df1->personas; ?></td>
          </tr>
          <tr>
            <td style="text-align: right; font-weight: bold;">Valor: </td>
            <td bgcolor="#BDDDF0" style="text-align: left">$<?php echo $df->total; ?> USD</td>
          </tr>
          <tr bgcolor="#FFFFFF">
                  <td align="right" bgcolor="#BDDDF0" class="Bold11Pt"><strong>Transacci&oacute;n:</strong></td>
                  <td bgcolor="#BDDDF0" class="precio" style="text-align: left">
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
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#003"><em>www.chacay.com</em></td>
  </tr>
</table>
</body>
</html>
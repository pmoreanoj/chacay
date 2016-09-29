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
$mes=array("Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic.");
//categorias
$sc=mysql_query("select * from categorias");
while($rowc=mysql_fetch_object($sc)){
 if($rowc->tipo=='t'){
  $ct[$rowc->cat]=$rowc->nom;
 }
 if($rowc->tipo=='h'){
  $ch[$rowc->cat]=$rowc->nom;
 }
}
$sql=$_SESSION['print'];
$vi=$_GET['i'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir</title>
<style type="text/css">
<!--
.link1 {color:#550000; font-family:Verdana; font-size:10px; font-weight:bold}
.lorden {color:#550000; font-family:Verdana; font-size:12px}
.texto {font:Arial; font-size:14px }
.Estilo2 {color: #FFFFFF}
-->
</style>
<style media="print">
		.noPrint{
		display: none;
		}
		.yesPrint{
		display: block !important;
		}
		</style>
<style type="text/css">
<!--
.texto1 {font:Arial; font-size:14px; color:#000 }
a.link1 {background-color:#550000}
a.lorden {background-color:#550000}
.link2 {color:#000099; font-family:Verdana; font-size:12px; font-weight:bold}
a.ba311 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
.texto11 {font:Arial; font-size:14px }
-->
</style>
</head>

<body>
<?php if($vi=='p'){ 
$sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
      $sqli=mysql_query($sql);
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Tours</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
<tr bgcolor="#666666">
            <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
            <th bgcolor="#CCCCCC">Regi&oacute;n</th>
            <th bgcolor="#CCCCCC">Nombre</th>
            <th bgcolor="#CCCCCC">Imagen</th>
            <th bgcolor="#CCCCCC">Precio</th>
            <th bgcolor="#CCCCCC"><div align="center">Fecha Ingreso</div></th>
          </tr>
          <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqli)){
  $i=$i+1;
  //$dp=mysql_fetch_object(mysql_query("select codc,nombrep,imagenp,fechaingreso from productos where codp=".$rp->codp));
  ?>
          <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
            <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
            <td>
              <div align="center"><?php echo $c[$rp->codc]; ?></div>            </td>
            <td><div align="center"><?php echo $rp->nombrep; ?></div></td>
            <td><div align="center">
            <?php $ip=explode("+",$rp->imagenp); ?>
             <img src="../imagenes/p/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
            <td><div align="center">$<?php echo sprintf("%01.2f",$rp->precio); ?></div></td>
            <td><div align="center">
              <?php 
		  $fecha_1=explode(" ",$rp->fechaingreso);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
            </div></td>
          </tr>
          <?php }//fin de while?>
        </table>
<?php }elseif($vi=='so'){ 
 $sqli=mysql_query($sql);
 $sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
$m[1]="Afiliaci&oacute;n por medio a&ntilde;o";
        $m[2]="Afiliaci&oacute;n por un a&ntilde;o";
        $pm[1]=97.5;
        $pm[2]=195; 	
?>             
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Socios</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr bgcolor="#CCCCCC">
    <th><div align="center">N&ordm;</div></th>
    <th>C&eacute;dula</th>
    <th>Nombre</th>
    <th><div align="center">Ciudad</div></th>
    <th><div align="center">Tel&eacute;fono</div></th>
    <th><div align="center">E-mail</div></th>
    <th><div align="center">Membres&iacute;a</div></th>
    <th><div align="center">Fecha</div></th>
  </tr>
  <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqli)){
  $i=$i+1;
  ?>
  <tr class="texto1" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#EBFCE2'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><?php echo $i; ?></div></td>
    <td><div align="center"><?php echo $row->ruc_ci; ?></div></td>
    <td><div align="center"><?php echo $row->cliente; ?></div></td>
    <td><div align="center"><?php echo $row->ciudad; ?></div></td>
    <td><div align="center"><?php echo $row->telefono; ?></div></td>
    <td><div align="center"><?php echo $row->email; ?></div></td>
    <td><div align="center"><?php echo $m[$row->tipo]; ?></div></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php }//fin de while?>
</table>
<?php }elseif($vi=='us'){ //usuarios
 $sqli=mysql_query($sql);	
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Usuarios</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr bgcolor="#CCCCCC">
    <th><div align="center">N&ordm;</div></th>
    <th>C&eacute;dula</th>
    <th>Nombre</th>
    <th><div align="center">Ciudad</div></th>
    <th><div align="center">Tel&eacute;fono</div></th>
    <th><div align="center">E-mail</div></th>
    <th><div align="center">Fecha Ingreso</div></th>
  </tr>
  <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqli)){
  $i=$i+1;
  ?>
  <tr class="texto1" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#EBFCE2'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><?php echo $i; ?></div></td>
    <td><div align="center"><?php echo $row->usuario; ?></div></td>
    <td><div align="center"><?php echo $row->nombre; ?></div></td>
    <td><div align="center"><?php echo $row->ciudad; ?></div></td>
    <td><div align="center"><?php echo $row->telefono; ?></div></td>
    <td><div align="center"><?php echo $row->email; ?></div></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php }//fin de while?>
</table>
<?php }elseif($vi=='ret'){ 
 $sqli=mysql_query($sql);
 $sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
?>        
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Restaurantes</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr bgcolor="#666666">
    <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
    <th bgcolor="#CCCCCC">Categor&iacute;a</th>
    <th bgcolor="#CCCCCC">Nombre</th>
    <th bgcolor="#CCCCCC">Imagen</th>
    <th bgcolor="#CCCCCC"><div align="center">Fecha Ingreso</div></th>
  </tr>
  <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqli)){
  $i=$i+1;
  //$dp=mysql_fetch_object(mysql_query("select codc,nombrep,imagenp,fechaingreso from productos where codp=".$rp->codp));
  ?>
  <tr class="texto" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#CCCCCC'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
    <td><div align="center"><?php echo $c[$rp->cat]; ?></div></td>
    <td><?php echo $rp->nom; ?></td>
    <td><div align="center">
      <?php $ip=explode("+",$rp->foto); ?>
      <img src="../imagenes/p/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php }//fin de while?>
</table>
<?php }elseif($vi=='vu'){ 
 $sqli=mysql_query($sql);
 $sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Vuelos</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr bgcolor="#666666">
    <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
    <th bgcolor="#CCCCCC">Categor&iacute;a</th>
    <th bgcolor="#CCCCCC">Nombre</th>
    <th bgcolor="#CCCCCC">Imagen</th>
    <th bgcolor="#CCCCCC"><div align="center">Fecha Ingreso</div></th>
  </tr>
  <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqli)){
  $i=$i+1;
  //$dp=mysql_fetch_object(mysql_query("select codc,nombrep,imagenp,fechaingreso from productos where codp=".$rp->codp));
  ?>
  <tr class="texto" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#CCCCCC'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
    <td><div align="center"><?php echo $c[$rp->cat]; ?></div></td>
    <td><?php echo $rp->nom; ?></td>
    <td><div align="center">
      <?php $ip=explode("+",$rp->foto); ?>
      <img src="../imagenes/p/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php }//fin de while?>
</table>
<?php }elseif($vi=='ho'){ 
 $sqli=mysql_query($sql);
 $sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Hoteles</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
<tr bgcolor="#666666">
            <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
            <th bgcolor="#CCCCCC">Categor&iacute;a</th>
            <th bgcolor="#CCCCCC">Nombre</th>
            <th bgcolor="#CCCCCC">Imagen</th>
            <th bgcolor="#CCCCCC"><div align="center">Fecha Ingreso</div></th>
          </tr>
          <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqli)){
  $i=$i+1;
  //$dp=mysql_fetch_object(mysql_query("select codc,nombrep,imagenp,fechaingreso from productos where codp=".$rp->codp));
  ?>
          <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
            <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
            <td>
              <div align="center"><?php echo $c[$rp->cat]; ?></div>            </td>
            <td><?php echo $rp->nom; ?></td>
            <td><div align="center">
            <?php $ip=explode("+",$rp->foto); ?>
             <img src="../imagenes/p/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
            <td><div align="center">
              <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
            </div></td>
          </tr>
          <?php }//fin de while?>
        </table>
<?php }elseif($vi=='h'){ 
$sqli=mysql_query($_SESSION['sql_his']);
$tv=$_SESSION['sql_hist'];
$fc=$_SESSION['sql_hisf'];
$num_filas=mysql_num_rows($sqli);
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom">&nbsp;</td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong>Ventas:</strong> <span class="link2"><?php echo $num_filas; ?></span></td>
        <td>&nbsp;</td>
        <td><strong>Valor: </strong><span class="link2">$<?php echo sprintf("%01.2f",$tv); ?></span></td>
         <td>&nbsp;</td>
        <td><strong><?php echo $fc; ?></strong></td>
      </tr>
    </table>
      <br />
      <?php if($num_filas>0){ ?>
      <table border="0" cellpadding="2" cellspacing="1">
        <tr bgcolor="#666666">
          <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
          <th bgcolor="#CCCCCC">Orden</th>
          <th bgcolor="#CCCCCC">Cliente</th>
          <th bgcolor="#CCCCCC">Valor</th>
          <th bgcolor="#CCCCCC">Estado</th>
          <th bgcolor="#CCCCCC"><div align="center">Fecha </div></th>
        </tr>
        <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqli)){
  $i=$i+1;
  ?>
        <tr class="texto1" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#CCCCCC'" onmouseout="this.style.backgroundColor='#F5F5F5'">
          <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
          <td><div align="center"><?php echo sprintf("%04d",$rp->numfactura); ?></div></td>
          <td><?php echo $rp->cliente; ?></td>
          <td>$<?php echo sprintf("%01.2f",$rp->total); ?></td>
          <td><?php echo $rp->estado; ?></td>
          <td><div align="center">
            <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
          </div></td>
        </tr>
        <?php }//fin de while?>
      </table>
      <?php }else{ ?>
      <span class="texto1">No hay registros en el rango de fechas consultado </span>
      <?php }//fin de if($numv<0)?></td>
  </tr>
</table>
<?php }elseif($vi=='r'){ 
$sqli=mysql_query($sql);
$numpe=mysql_num_rows($sqli);
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Reservaciones</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#CCCCCC">
  <tr bgcolor="#CAE2A5">
    <th  bgcolor="#CCCCCC">N&ordm;</th>
    <th  bgcolor="#CCCCCC">Tipo</th>
    <th  bgcolor="#CCCCCC">Servicio</th>
    <th  bgcolor="#CCCCCC">Nombre</th>
    <th  bgcolor="#CCCCCC">Ciudad</th>
    <th  bgcolor="#CCCCCC">Tel&eacute;fono</th>
    <th  bgcolor="#CCCCCC">E-Mail</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Para Fecha</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">No. Personas</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Comentarios</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Fecha </th>
  </tr>
  <?php 
			$i=$ini;
		while($row=mysql_fetch_object($sqli)){
		$j=$i+1;
		?>
  <tr class="texto11" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#CCCCCC'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><strong><?php echo $j; ?></strong></div></td>
    <td><?php echo $row->tipo; ?></td>
    <td><?php echo $row->servicio; ?></td>
    <td><?php echo $row->cliente; ?></td>
    <td nowrap="nowrap"><?php echo $row->ciudad; ?></td>
    <td nowrap="nowrap"><?php echo $row->telefono; ?></td>
    <td nowrap="nowrap"><?php echo $row->email; ?></td>
    <td><?php echo $row->fechar; ?></td>
    <td><?php echo $row->personas; ?></td>
    <td><?php echo $row->comentario; ?></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php 
		$i=$i+1;
		}//fin while?>
</table>
<?php }elseif($vi=='u'){ 
$sqli=mysql_query($sql);
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td width="120"><img src="../imagenes/chacay.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Listado de Contactos</strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#666666">
  <tr bgcolor="#CCCCCC">
    <th><div align="center">N&ordm;</div></th>
    <th>Nombre</th>
    <th><div align="center">Ciudad</div></th>
    <th><div align="center">Tel&eacute;fono</div></th>
    <th><div align="center">E-mail</div></th>
    <th><div align="center">Requerimiento</div></th>
    <th><div align="center">Fecha</div></th>
  </tr>
  <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqli)){
  $i=$i+1;
  ?>
  <tr class="texto1" style="background-color:#F5F5F5" onmouseover="this.style.backgroundColor='#EBFCE2'" onmouseout="this.style.backgroundColor='#F5F5F5'">
    <td><div align="center"><?php echo $i; ?></div></td>
    <td><div align="center"><?php echo $row->nombre; ?></div></td>
    <td><div align="center"><?php echo $row->ciudad; ?></div></td>
    <td><div align="center"><?php echo $row->telefono; ?></div></td>
    <td><div align="center"><?php echo $row->email; ?></div></td>
    <td><div align="center"><?php echo $row->asunto; ?></div></td>
    <td><div align="center">
      <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
    </div></td>
  </tr>
  <?php }//fin de while?>
</table>
<?php } ?>
</body>
</html>
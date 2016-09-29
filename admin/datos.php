<?php 
if (!isset($_SESSION)) {
  session_start();
}
if ( (!isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != 'on') && stristr($_SERVER["SERVER_NAME"],'comprasegura.com.ec')!=false) {
  header("Location: " . "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
  exit();
}
include_once("../conect.php");
//fechas dessde y hasta cuando puede ver estadisticas
$aniod=2012;
$mesd=7;
$anioh=date('Y');
$mesh=date('n');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Grafico Estadistico</title>
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
.Estilo2 {font-family: Verdana;
	color: #000066;
	font-size:10px
}
.numesta {font-size:16px; color:#000000 }
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
-->
</style>
<script language="JavaScript">
	function setIframeHeight(iframeName) {
  var iframeEl = window.parent.document.getElementById? window.parent.document.getElementById(iframeName): window.parent.document.all? window.parent.document.all[iframeName]: null;
  if (iframeEl) {
    iframeEl.style.height = "auto";
    var h = alertSize();
	//var h = 1000;
    var new_h = h+50;
    iframeEl.style.height = new_h + "px";
  }
}
function alertSize() {
  var myHeight = 0;
  if (!window.opera && document.all && document.getElementById){
    myHeight=document.body.scrollHeight;
	
   } else if(document.getElementById) {
     myHeight=document.body.scrollHeight;
  }
  return myHeight;
}
</script>
</head>

<body>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" style="border-bottom:solid 1px #000066">
  <tr>
    <td><img src="../imagenes/logo-sovistur.png" width="112" height="56" /></td>
    <td valign="bottom"><strong>Datos Estad&iacute;sticos <?php echo date('d/m/Y'); ?></strong></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.print()"><img src="../imagenes/printer.gif" width="16" height="15" border="0" />Imprimir </a></div></td>
    <td valign="bottom"><div align="right" class="noPrint"><a href="#" style="color:#003399; font-weight:bold; text-decoration:none" onclick="window.close()"><img src="../imagenes/icon_error.gif" width="15" height="15" border="0" />Cerrar Ventana </a></div></td>
  </tr>
</table>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px; margin-bottom:10px">
        <tr>
          <td colspan="2" style="border-bottom:solid 1px #000000"><strong>Visitas</strong></td>
        </tr>
        <tr>
          <td style="border-bottom:solid 1px #000000">Hoy</td>
          <td style="border-bottom:solid 1px #000000"><div align="left"><strong><img src="../Contador/imagenes/userinvit.gif" border="0" /><strong>
            <?php $rowh=mysql_fetch_object(mysql_query("select * from visitast"));
		  echo $rowh->hoy + $num_vb;
		  ?>
          </strong></div></td>
        </tr>
        <tr>
          <td style="border-bottom:solid 1px #000000">Totales</td>
          <td style="border-bottom:solid 1px #000000"><div align="left"><strong><img src="../Contador/imagenes/usertotal.gif" border="0" /><strong>
            <?php 
		  echo $rowh->cont;
		  ?>
          </strong></div></td>
        </tr>
        
      </table>

<table border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px; margin-bottom:10px">
  <tr>
    <td colspan="3" style="border-bottom:solid 1px #000000"><strong>Productos Mas Visitados </strong></td>
  </tr>
  <?php
								  $sqlp=mysql_query("select  nombrep,visto from productos where visto>0 order by visto DESC limit 0,20");
			$sqlpst=mysql_fetch_object(mysql_query("select sum(visto) as vt from productos where visto>0"));
			$sumav1=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 if($p==0){
			  $sumav=$rowp->visto;
			 }
			 $p=$p+1;
			 //calculo de porcentaje
			  $por=round(($rowp->visto*100)/$sumav1,2);
			  $bar=ceil(($rowp->visto*200)/$sumav);
			?>
  <tr>
    <td style="border-bottom:solid 1px #000000"><strong><?php echo $p ?>&deg;</strong></td>
    <td style="border-bottom:solid 1px #000000; font-family:Verdana; font-size:11px"><div align="left"><?php echo $rowp->nombrep ?></div></td>
    <td style="border-bottom:solid 1px #000000"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="middle"><div align="right"><img src="../imagenes/barra.png" width="<?php echo $bar ?>" height="15" /></div></td>
        <td><span class="Estilo2"><?php echo $por ?>%</span></td>
      </tr>
    </table></td>
  </tr>
  <?php } ?>
</table>
<?php if($_SESSION['pai']==1){ ?>
<?php }else{ ?>
<table border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px">
  <tr>
    <td colspan="4" style="border-bottom:solid 1px #000000"><strong>Origen de Visitantes </strong></td>
  </tr>
  <?php
			$sqlp=mysql_query("select  * from paises where hit>0 order by hit DESC limit 0,20");
			$sqlpst=mysql_fetch_object(mysql_query("select sum(hit) as vt from paises where hit>0"));
			$sumav1=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 if($p==0){
			  $sumav=$rowp->hit;
			 }
			 $p=$p+1;
			 //calculo de porcentaje
			  $por=round(($rowp->hit*100)/$sumav1,2);
			  $bar=ceil(($rowp->hit*200)/$sumav);
			?>
  <tr>
    <td style="border-bottom:solid 1px #000000"><strong><?php echo $p ?>&deg;</strong></td>
    <td style="border-bottom:solid 1px #000000"><img src="../imagenes/flags/<?php 
$search  = array(' ', 'Ñ');
$replace = array('', 'N');
									  echo str_replace($search,$replace,$rowp->nombre); ?>.png" /></td>
    <td style="border-bottom:solid 1px #000000; font-family:Verdana; font-size:11px"><div align="left"><?php echo $rowp->nombre ?></div></td>
    <td style="border-bottom:solid 1px #000000"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="middle"><div align="right"><img src="../imagenes/barra.png" width="<?php echo $bar ?>" height="15" /></div></td>
        <td><span class="Estilo2"><?php echo $por ?>%</span></td>
      </tr>
    </table></td>
  </tr>
  <?php } ?>
</table>
<?php }//fin de if($_SESSION['pai']==1){ ?>
<table width="100%" border="0" cellpadding="1" cellspacing="0" align="center" style="display:none">
  <?php
//include("funciones.php");
$mess = $_GET['mess'];
$anio = $_GET['anio'];
$mes['1']="Enero";
$mes['2']="Febrero";
$mes['3']="Marzo";
$mes['4']="Abril";
$mes['5']="Mayo";
$mes['6']="Junio";
$mes['7']="Julio";
$mes['8']="Agosto";
$mes['9']="Septiembre";
$mes['10']="Octubre";
$mes['11']="Noviembre";
$mes['12']="Diciembre";
if($mess == "" || $anio == ""){
    $anio = date("Y");
    $mess = date("n");
}
$sqldat='hitst';
$fechaic= $anio."-". sprintf("%02d",$mess)."-01";
$fechahc= $anio."-". sprintf("%02d",$mess)."-".date("t",mktime(0, 0, 0, $mess, 1, $anio));
$sqlcal=mysql_query("select fecha,".$sqldat." as dato from estadistica where date(fecha)>=date('$fechaic') and date(fecha)<=date('$fechahc')");
$sqlmin=mysql_fetch_object(mysql_query("select min(".$sqldat.") as mindato from estadistica where date(fecha)>=date('$fechaic') and date(fecha)<=date('$fechahc')"));
$sqlmax=mysql_fetch_object(mysql_query("select max(".$sqldat.") as maxdato from estadistica where date(fecha)>=date('$fechaic') and date(fecha)<=date('$fechahc')"));
	$numpecal=mysql_num_rows($sqlcal);
		while ($rowcal=mysql_fetch_object ($sqlcal))  {
        $cal[$rowcal->fecha]= $rowcal;
		$sum=$sum+$rowcal->dato;
        }
		$promedio=round($sum/$numpecal,2);
    $ultimo = date("t",mktime(0, 0, 0, $mess, 1, $anio));
    if($mess == '12' || $mess == '1'){
        if($mess == '12'){
            $next = 1;
            $prev = $mess -1;
            $anion = $anio + 1;
            $aniop = $anio;
        }
        if($mess == '1'){
            $next = $mess + 1;
            $prev = 12;
            $anion = $anio;
            $aniop = $anio -1;        
        }
    }else{
        $next = $mess + 1;
        $prev = $mess - 1;    
        $aniop = $anio;
        $anion = $anio;
    }
 $j=0;
    while($diaa <= $ultimo){
        $dia = date("D",mktime(0,0,0,$mess,$diaa,$anio)); # retorna el d&iacute;a de la semana en letras...
        $fecha = date("d",mktime(0,0,0,$mess,$diaa,$anio)); #retorna el d&iacute;a del mes en 01/31
        $dia_semana = date("w",mktime(0,0,0,$mess,$diaa,$anio)); #retorna el d&iacute;a de la semana en n&uacute;mero
		if($cal[$anio."-". sprintf("%02d",$mess)."-".$fecha]){
		$ydata[$j]=$cal[$anio."-". sprintf("%02d",$mess)."-".$fecha]->dato;
		$xdata[$j]=$fecha;
		$j++;
		}
        $diaa++;
    }
	$_SESSION['xd']=$xdata;
	$_SESSION['yd']=$ydata;
?>
  <tr>
    <th><table align="center" style="border:solid 1px #999">
      <tr>
        <td><input name="atras" type="button" id="atras" value="&lt;&lt;" class="noPrint" onclick="window.location.href='datos.php?mess=<?php echo $prev ?>&amp;anio=<?php echo $aniop ?>&amp;dat=<?php echo $sqldat ?>'" <?php if($anion==$aniod and $mess==$mesd){ ?>disabled="disabled" <?php } ?>/></td>
        <td><strong><?php echo $mes[$mess]." ".$anio ?></strong></td>
        <td><input name="adelante" type="button" id="adelante" value="&gt;&gt;" class="noPrint" onclick="window.location.href='datos.php?mess=<?php echo $next ?>&amp;anio=<?php echo $anion ?>&amp;dat=<?php echo $sqldat ?>'" <?php if($anion==$anioh and $mess==$mesh){ ?>disabled="disabled" <?php } ?> /></td>
      </tr>
    </table></th>
  </tr>
</table>
<table border="0" align="center" cellpadding="2" cellspacing="0" style="display:none">
  <tr>
    <td><?php if(count($xdata)>1){ ?>
      <img src="grafico.php?tip=<?php echo $sqldat; ?>" />
      <table width="80%" border="0" cellpadding="1" cellspacing="0" align="center" style="border:solid 1px #333333; font-family:Verdana; font-size:10px">
        <tr>
          <td><strong>M&aacute;ximo:</strong> <?php echo $sqlmax->maxdato ?><br />
            <strong>M&iacute;nimo:</strong> <?php echo $sqlmin->mindato ?><br />
            <strong>Promedio:</strong> <?php echo $promedio ?><br />
            <strong>TOTAL:</strong> <?php echo $sum ?></td>
        </tr>
      </table>
      <?php } else{
	?>
      No existen Datos
      <?php } ?></td>
  </tr>
</table>
</body>
</html>
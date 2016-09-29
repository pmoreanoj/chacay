<?php 
if (!isset($_SESSION)) {
  session_start();
}
/*error_reporting(0);*/
include_once("../conect.php");
if($_SESSION['id_us']){
$idop=$_SESSION['id_us'];
$du=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$idop));
}else{
header("Location:index.php");
}//fin de if($_SESSION['cod_e']){
$ib=$_GET['b'];
if($ib==1){
	$x=244;
	$y=164;
}
if($ib==2){
	$x=244;
	$y=346;
}
if($ib==3){
	$x=980;
	$y=162;
}
///Actualizar Banner
if($_POST){
////////////////////tratar imagenes/////
$i1= $_FILES['img']['name'];
  if($i1!=''){
  $ni1= subir_imgb($_FILES['img'],$x,$y);
   $rutag="../imagenes/g/". $_POST['ba'];
		if (file_exists($rutag)){
		unlink($rutag);
		}
  }
  $sql="update galeria set imagen='$ni1' where tipo=3 and cat='$ib'";
  mysql_query($sql);
   
   $fallo='Datos Actualizados'.mysql_error();
}elseif($_POST){ 
 $fallo='Datos No Actualizados';
}// fin de if(strlen($vtextot)>10){
	$b[1]="Membresia";	
	$b[2]="Revista";
    $b[3]="Pie";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="../favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingreso Banner</title>
<style type="text/css">
<!--
.Estilo10 {	font-size: 20px;
	color: #000033;
}
.Estilo11 {	font-size: 20px;
	color:#990000;
}
.boton {width:115px; height:25px; font-size:11px; font-family:Verdana; font-weight:bold }
.Estilo14 {
	font-size: 10px;
	font-family: Verdana;
}
.Estilo1 {
	color: #990000;
	font-weight: bold;
}
.link2 {color:#000099; font-family:Verdana; font-size:12px; font-weight:bold}
-->
</style>
<script language="javascript">
function ver(op){
 obj = document.getElementById('ti');
 obj1 = document.getElementById('tv');
 obj.style.display='none';
 obj1.style.display='none';
 if(op==1){
 obj.style.display='block';
 }
 if(op==2){
 obj1.style.display='block';
 }
}
function enviot(f){
 var  msj='';
 if(f.img.value==''){ msj=msj + "Seleccione una Imagen"; }
 if(msj==''){
  f.env.value='Enviando';
  f.env.disabled=true;
  f.submit();
 }else{
  alert(msj);
 }
}
function ingresado(){
//window.opener.location.href='index_1.php?option=us';
window.opener.location.reload();
//window.close();
}
</script>
</head>

<body onLoad="<?php if($fallo=='Datos Actualizados'){ echo "ingresado()";}  ?>">
<form action="igaleria2.php?b=<?php echo $ib; ?>" method="post" enctype="multipart/form-data" name="fdoc" id="fdoc">
  <div align="right"><a href="#" onclick="window.close()" style="color:#993300; font-weight:bold">Cerrar Ventana</a></div>
  <table border="0" align="center" cellpadding="1" cellspacing="2" style="border:solid 1px #000000">
    <tr>
      <td width="76">&nbsp;</td>
      <td width="540"><span class="Estilo10">Actualizar Imagen <?php echo $b[$ib]; ?></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php 
			echo ' <span class="Estilo1">'.$fallo.'</span>';
			?></td>
    </tr>
	<?php 
	$im=mysql_fetch_object(mysql_query("select * from galeria where tipo=3 and cat=".$ib));
	?>
    <tr>
      <td colspan="2"><div align="left" id="ti" style="padding-left:25px">
        <strong>Imagen:</strong><input name="img" type="file" id="img" />
        <input name="ba" type="hidden" id="ba" value="<?php echo $im->imagen; ?>" />
        <br /><span class="Estilo14">(Formato .jpg o .gif, Tama&ntilde;o m&aacute;ximo 1MB, Dimensiones (<?php echo $x."x".$y; ?>)px</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="left" id="tv" style="display:none; padding-left:7px"><strong>Url Video: </strong><input name="url" type="text" id="url" size="70" /></div> </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="env" type="button" class="boton" id="env" onclick="enviot(fdoc)" value="Ingresar" /></td>
    </tr>
  </table>
</form>
</body>
</html>
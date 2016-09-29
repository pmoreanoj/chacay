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
	
$vn=$_GET['n'];
///Insertar Noticia
if($_POST){
 if(get_magic_quotes_gpc()) {//escapar comillaa
            $vtit=$_POST['tit'];
            $vtex=$_POST['tex'];
        } else {
		    $vtit=addslashes($_POST['tit']);
            $vtex=addslashes($_POST['tex']);
        }
////////////////////tratar imagenes/////
$i1= $_FILES['fotn']['name'];
if($i1!=''){
$ni1= subir_img1($_FILES['fotn']);
$ni=",f1='".$ni1."'";
}
$sql="update noticias set tit='$vtit',des='$vtex'".$ni." where idn=".$vn;
mysql_query($sql);
 
 $fallo='Datos Actualizados'.mysql_error();
}elseif($_POST){ 
 $fallo='Datos No Actualizados';
}// fin de if(strlen($vtextot)>10){
	
$rown=mysql_fetch_object(mysql_query("select * from noticias where idn=".$vn));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingreso Noticia</title>
<script language="javascript" type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,bullist,numlist,hr,removeformat,visualaid,sub,sup,",
		theme_advanced_buttons2 : "undo,redo,|,link,unlink,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,tablecontrols",
		theme_advanced_buttons3 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
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
.textop {font-family:Verdana; font-size:10px; color:#333 }
-->
</style>
<script language="javascript">
function enviot(f){
 var  msj='';
 if(f.tit.value==''){ msj=msj + "Ingrese un titulo"; }
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
<div align="right"><a href="#" onclick="window.close()" style="font-size:smaller; color:#000000">Cerrar Ventana</a></div>
<form action="anoticia.php?n=<?php echo $vn; ?>" method="post" enctype="multipart/form-data" name="fdoc" id="fdoc">
        <table border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#F4F4F4">
          <tr>
            <td>&nbsp;</td>
            <td class="Estilo10">Actualizar noticia </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><?php 
			echo ' <span class="Estilo1">'.$fallo.'</span>';
			?></td>
          </tr>
          <tr>
            <td width="76"><div align="right"><strong>T&iacute;tulo</strong></div></td>
            <td width="540"><input name="tit" type="text" id="tit" value="<?php echo $rown->tit; ?>" size="50" maxlength="100"></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Imagen:</strong></div></td>
            <td><?php if($rown->f1!=''){?><img src="../imagenes/p/<?php echo $rown->f1; ?>" width="50" height="50" />Seleccione otra imagen <?php }else{ echo 'Sin imagen'; }?><br>
                <input name="fotn" type="file" id="fotn" size="20">
                <br /><span class="textop">Puede ingresar archivos (Tama&ntilde;o Max.1MB, formatos: jpj, gif)</span></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Descripci&oacute;n:</strong><br>
            <textarea name="tex" cols="80" rows="15" id="tex">
			  <?php echo $rown->des; ?>
			  </textarea></td>
          </tr>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="env" type="button" class="boton" id="env" onClick="enviot(fdoc)" value="Actualizar"></td>
          </tr>
        </table>
      </form>
</body>
</html>
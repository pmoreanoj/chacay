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
//categorias
$sc=mysql_query("select * from categorias");
while($rowc=mysql_fetch_object($sc)){
 if($rowc->tipo=='t'){
  $ct[$rowc->cat]=$rowc->nom;
 }
 if($rowc->tipo=='h'){
  $ch[$rowc->cat]=$rowc->nom;
 }
 if($rowc->tipo=='g'){
  $cg[$rowc->cat]=$rowc->nom;
 }
}
///Insertar Galeria
if($_POST){
 if(get_magic_quotes_gpc()) {//escapar comillaa
            $vcat=$_POST['cat'];
            $vtip=$_POST['tipo'];
            $vurl=$_POST['url'];
        } else {
		    $vcat=addslashes($_POST['cat']);
            $vtip=addslashes($_POST['tipo']);
            $vurl=addslashes($_POST['url']);
        }
////////////////////tratar imagenes/////
$i1= $_FILES['img']['name'];
if($i1!='' and $vtip==1){
$ni1= subir_img1($_FILES['img']);
}
if($vtip==3){
$ni1= $vurl;
}
$sql="insert into galeria values('','$vcat','$vtip','$ni1',Now())";
mysql_query($sql);
 
 $fallo='Datos Ingresados'.mysql_error();
}elseif($_POST){ 
 $fallo='Datos No Ingresados';
}// fin de if(strlen($vtextot)>10){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="../favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingreso Galeria</title>
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
 if(op==3){
 obj1.style.display='block';
 }
}
function enviot(f){
 var  msj='';
 if(f.tipo.value==''){ msj=msj + "Seleccione tipo"; }
 if(f.tipo.value==1){
   if(f.img.value==''){ msj=msj + "\nSeleccione una Imagen"; }
 }
 if(f.tipo.value==3){
   if(f.url.value==''){ msj=msj + "\nIngrese URL video"; }
 }
 
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

<body onLoad="<?php if($fallo=='Datos Ingresados'){ echo "ingresado()";}  ?>">
<form action="igaleria.php" method="post" enctype="multipart/form-data" name="fdoc" id="fdoc">
  <div align="right"><a href="#" onclick="window.close()" style="color:#993300; font-weight:bold">Cerrar Ventana</a></div>
  <table border="0" align="center" cellpadding="1" cellspacing="2" style="border:solid 1px #000000">
    <tr>
      <td width="76">&nbsp;</td>
      <td width="540"><span class="Estilo10">Nuevo Item Galer&iacute;a </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php 
			echo ' <span class="Estilo1">'.$fallo.'</span>';
			?></td>
    </tr>
	<?php 
	$numf=mysql_fetch_object(mysql_query("select count(*) as nf from galeria where tipo=1"));
											 $num_filas=$numf->nf;
	if($num_filas<30){ ?>
    <tr style="display:none">
          <td valign="bottom"><div align="right"><strong>Categor&iacute;a<span class="estilo1">*</span></strong>
          </div></td>
          <td><?php $ip=explode("+",$rp->imagenp); ?>
            <select name="cat" id="cat">
              <option value="1" <?php if(!$_POST['categoria']){?>selected <?php }?>><--seleccione--></option>
              <?php 
			  $sqlc=mysql_query("select * from categorias where cat>2 order by nom");
		         while($rowc=mysql_fetch_object($sqlc)){
				?>
              <option value="<?php echo $rowc->cat; ?>" <?php if($categoria==$rowc->cat){ echo 'selected';}?>><?php echo $rowc->nom; ?></option>
              <?php 
				}//fin foreach
			    ?>
            </select>
            <div id="ayuda"></div></td>
        </tr>
    <tr>
          <td valign="bottom"><div align="right"><strong>Tipo<span class="estilo1">*</span></strong>
          </div></td>
          <td><select name="tipo" id="tipo" onchange="ver(this.value)">
          <option value=""><--seleccione--></option>
           <option value="1" >Imagen</option>
             <option value="3">Video</option>
            </select>
    <div id="ayuda"></div></td>
        </tr>
    <tr>
      <td colspan="2"><div align="left" id="ti" style="padding-left:25px; display:none">
        <strong>Imagen:</strong><input name="img" type="file" id="img" />
      <span class="Estilo14">(Formato .jpg o .gif, Tama&ntilde;o m&aacute;ximo 1MB)</span></div>
      <div align="left" id="tv" style="display:none">
        <strong>URL Video:</strong><input name="url" type="text" id="url" size="70" /><span class="Estilo14"><br />Ej. http://www.youtube.com/watch?v=uelHwf8o7_U</span></div>
      </td>
    </tr>
    <tr>
      <td colspan="2"> </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="env" type="button" class="boton" id="env" onclick="enviot(fdoc)" value="Ingresar" /></td>
    </tr>
	<?php }//fin de $_SESSION['numi'] ?>
  </table>
</form>
</body>
</html>
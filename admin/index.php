<?php 
if (!isset($_SESSION)) {
  session_start();
}
include_once("../conect.php");
$error='';
if($_POST['cl']!='' and $_POST['us']!=''){
       if(get_magic_quotes_gpc()) {
            $usuario= stripslashes(strip_tags($_POST['us']));
            $clave=stripslashes(strip_tags($_POST['cl']));
        } else {
            $usuario= strip_tags($_POST['us']);
            $clave=strip_tags($_POST['cl']);
        }
        $consultacceso = sprintf("select idus,cargo from usuarios where usuario='%s' and clave='%s' and estado=0",mysql_real_escape_string($usuario,$enlace),mysql_real_escape_string($clave, $enlace),mysql_real_escape_string($ciu, $enlace));
        $acceso=mysql_query($consultacceso);
        $row=mysql_fetch_object($acceso);
	if($row!='' and $row->cargo=='Administrador'){
	$idop=$row->idus;
	//guardamos datos de acceso
    mysql_query("insert into acceso values('','$idop',Now(),'','a')");
	$sql_ida=mysql_query("SELECT LAST_INSERT_ID( ) AS ida FROM acceso");
	$ida=mysql_fetch_object($sql_ida);
	$_SESSION['id_a']=$ida->ida;//recuperamos y guradamos el id de acceso
	//redireccion a modulo
		$_SESSION['id_us']=$row->idus;
		header("Location:index_1.php");
	}elseif($row!='' and $row->cargo=='Operador'){
	$idop=$row->idus;
	//guardamos datos de acceso
    mysql_query("insert into acceso values('','$idop',Now(),'','o')");
	$sql_ida=mysql_query("SELECT LAST_INSERT_ID( ) AS ida FROM acceso");
	$ida=mysql_fetch_object($sql_ida);
	$_SESSION['id_a']=$ida->ida;//recuperamos y guradamos el id de acceso
	//redireccion a modulo
		$_SESSION['id_uso']=$row->idus;
		header("Location:../operador/index_1.php");	
	}else{
		$error="Usuario y Clave Ingresada es incorrecta";
		}//fin de if($row!=''){ 
}//fin de if($_POST['cl']!='' and $_POST['us']!=''){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="../favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APLICACION</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}
.Estilo1 {
	font-size: 18px;
	color: #990000;
}
.footer { color:#737373; margin-left:11px}
a {
	font-family: Century Gothic;
	color: #003333;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
.Estilo2 {color: #000000}
.boton {width:115px; height:25px; font-size:11px; font-family:Verdana; font-weight:bold }
.Estilo3 {
	color:#FFFFFF;
	font-weight: bold;
}
.Estilo8 {color: #000033}
-->
</style>
<script language="javascript">
function validar(login){
 if(login.us.value==''){
 alert("Usuario no ingresado");
 }else if(login.cl.value==''){
 alert("Clave no ingresada");
 }else{
 login.submit();
 }
}
function ver(dv,md){
var da = document.getElementById(dv);
if(md==2 || md==3){
 da.style.display="block";
 }else{
 da.style.display="none";
 }
}
function cambia(f){
	if(f.tipo.value==1){
		f.action='index.php';
	}else if(f.tipo.value==2){
		f.action='../chat/operator/login.php';
	}
}
</script>
</head>

<body>
<p>&nbsp;</p>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" style="border:solid 1px #000066; border-radius:5px">
<tr>
    <td class="Estilo2" style="height:10px"></td>
  </tr>
  <tr>
    <td height="400"><form action="index.php" method="post" name="form1" target="_self" id="form1">
      <div align="center">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td height="115" colspan="2" ><div align="center"><img src="../imagenes/chacay.png" /></div></td>
            </tr>
          <tr>
            <td style="height:10px"></td>
              <td></td>
            </tr>
        </table>
      </div>
      <p align="center" class="Estilo1"><?php echo $error;  ?></p>
      <p align="center"><strong>BIENVENIDO AL SISTEMA ADMINISTRATIVO</strong></p>
      <div align="center">
        <table width="270" border="0" align="center" cellpadding="0" cellspacing="4" bordercolor="#FFFFFF" bgcolor="#C35F2E" style="border-radius:5px; border:solid 1px #999">
          
          
          <tr>
            <td colspan="2" style="background:url(encc.jpg) top"><div align="center" class="Estilo3">ACCESO </div></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          <tr>
            <td><div align="right" class="Estilo3">Usuario:</div></td>
              <td><input name="us" type="text" id="us" size="20" maxlength="50" onblur="llena(this.value,'login')" />
              <input type="hidden" name="login" id="login" />               </td>
            </tr>
          <tr>
            <td><div align="right" class="Estilo3">Clave:</div></td>
              <td><input name="cl" type="password" id="cl" size="20" maxlength="20" onblur="llena(this.value,'password')" />
              <input type="hidden" name="password" id="password" />              </td>
            </tr>
          <tr>
            <td colspan="2"></td>
            </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><div align="center">
              <input name="Submit" type="button" class="boton" style="width:100px; height:35px" onclick="validar(form1)" value="Ingresar"/>
              </div></td>
            </tr>
        </table>
        <p>
          <input name="Submit2" type="button" class="boton" style="width:100px" value="Salir" onclick="window.location.href='../'" />
          </p>
      </div>
      <p align="center"><a href="../index.php"></a></p>
      
      <p align="center">&nbsp;</p>
    </form></td>
  </tr>
  <tr>
    <td style="background:url(pie.jpg) top"><div align="center"><span class="footer"><strong>Copyright &copy; <?php echo date('Y') ?> </strong></span></div>    </td>
  </tr>
</table>
</body>
</html>

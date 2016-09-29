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
	
//actualizacion de producto
//************************//actualizar producto******************************
if($_POST['actualizar']){
    //$nopermitidos = array("¬","*","$","#","%","&","=");//caracteres no permitidos
	foreach ($_POST as $key => $value) {
		//echo "Key: $key; Value: $value<br />\n";
		$dat[$key] = trim($value);
	}
	if(mysql_query("update usuarios set usuario='".$dat['cedula']."',nombre='".$dat['nombre']."',ciudad='".$dat['ciudad']."',direccion='".$dat['direccion']."',telefono='".$dat['telefono']."',email='".$dat['email']."',clave='".$dat['clave']."' where idus=".$dat['actualizar'])){
		
			  $idus=$dat['actualizar'];
		$error1="Datos Actualizados";
	}else{
		 $error1="Datos No Actualizados".$resultado1;
	}
}
////////////////////////fin de actualizar///////////////////////
$rp=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$_GET['u']));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Actualizar Usuario</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.estilo1 {color: #990033}
.Estilo3 {font-size: 12px}
.footer { color:#737373; margin-left:11px}
#ayuda {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	visibility: hidden;
}
.Estilo4 {color: #D9E7C3}
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
.Estilo4 {color: #D9E7C3}
.Estilo6 {
	color: #993300;
	font-weight: bold;
}
body,td,th {
	font-size: 14px;
}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
function envio(f,string){
//no = new Array ('profesion','fonotrabajo','n','n1','n2','dpto','ccn');
var no  = string.split(",");
var msj="";
var nc=0;
var opcional=0;
var campos='';
//bucle for paso 16 para saber el total campos
	for(i=0; i<f.length; i++){
	//si el elemento definido en la array formulario esta vacio...
		if(f.elements[i].value == ""){
		  for(j=0;j<no.length;j++){
			 if(f.elements[i].name==no[j]){//campos no *
			   opcional=1;
			  }
		  }
		   if(opcional!=1){
			// cambio de color el fondo a rojo y la letra
			f.elements[i].style.backgroundColor = '#FF8080';
			//campos=campos + f.elements[i].name;
			nc=1;
		   }
		   opcional=0;
		}else{
		f.elements[i].style.backgroundColor = '';
		}
	}
 //verificar email valido
/* if(f.email.value.indexOf('@')<1 && nc<1){
	 f.email.focus();
	 msj='E-Mail ingresado incorrecto';
 }////////////////fin email*/
 // verificar condiciones
 /*if(f.pv.checked==true && f.ac.checked==false && nc<1){
	 msj='Debe Aceptar las Condiciones de Uso';
 }////////////////fin email*/
/* if(f.Pais.value=='ECUADOR' && check_cedula(f)==false){
	 msj='Nº Cédula Invalido';
	 f.cedula.focus();
 }////////////////verificar cedula*/
 if(nc<1 && msj==''){
  f.target="_self";
  f.action="ausuario.php?u=<?php echo $_GET['u']; ?>";
  //f.insertar.value="1";
  f.env.value="Enviando";
  f.env.disabled=true;
  f.bor.disabled=true;
  f.submit();
 }else{
 alert("Favor ingrese todos los datos obligatorios: \n\n" + msj + campos);
 }	
} 
function activai(cambio,img){
	if(cambio.checked==true){
	img.disabled=false;
	}else{
	img.disabled=true;
	}
}
function actualizado(){
window.opener.location.reload();
//window.close();
}
function ver(v1,dv){
var da = document.getElementById(dv);
if(v1.checked==true){
 da.style.display="block";
 }else{
 da.style.display="none";
 }
}
//-->
</script>
<script language="javascript" src="../js/jquery.js"></script>
<script language="javascript">
function fechas_a(b,d,p){
		 $(d).html('Cargando ..');
	     $(d).load("funciones.php", {id: b, op:6, vp:p});
}
function hoteles_a(b1,d1,c1,p1,f){
	$(d1).html('Cargando ..');
	$(d1).load("funciones.php", {id: b1,op:7,idf:c1,vp:p1,vf:f});
}
function AgregarCampos_a(ch,c1,dc1,vc1,c2,dc2,vc2,c3,dc3,vc3){
  if(ch.checked==true){	
  campo = '<input type="text" id="' + dc1 + '"  name="' + dc1 + '" size="5" maxlength="10" value="' + vc1 + '"  />';
  $(c1).append(campo);
  campo1 = '<input type="text" id="' + dc2 + '"  name="' + dc2 + '" size="5" maxlength="10" value="' + vc2 + '"  />';
  $(c2).append(campo1);
  campo2 = '<input type="text" id="' + dc3 + '"  name="' + dc3 + '"  size="5" maxlength="10" value="' + vc3 + '" />';
  $(c3).append(campo2);
  }else{
	  campo='#' + dc1;
	  $(campo).remove();
	  campo1='#' + dc2;
	  $(campo1).remove();
	  campo2='#' + dc3;
	  $(campo2).remove();
  }
}
</script>
<link type="text/css" href="../fecha/css/jquery-ui-1.8.22.custom.css" rel="stylesheet" />
	<script src="../fecha/js/jquery.ui.core.min.js"></script>
	<script src="../fecha/js/jquery.ui.widget.min.js"></script>
	<script src="../fecha/js/jquery.ui.datepicker.min.js"></script>
	<script src="../fecha/js/jquery.ui.datepicker-es.js"></script>
    <script>
	function ff(df){
	 document.getElementById(df).focus();
	}
	</script>
</head>
<body onLoad="<?php if($_POST['actualizar']){ echo "actualizado()";}  ?>">
<table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td></td>
    <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >
     
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>Actualizaci&oacute;n de Usuario</strong></td>
          <td><div align="right"><a href="#" onClick="window.close()" style="font-size:smaller; color:#000000">Cerrar Ventana </a></div></td>
          <td>&nbsp;
            </td>
        </tr>
      </table>
  
  <?php  echo '<p align="center" class="Estilo6">'.$error1.' </p>'?>
  
  <br>
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#F4F4F4"  bgcolor="#F4F4F4">
          <tr>
            <td align="right"><strong>C&eacute;dula de Identidad</strong><span class="estilo1">*</span></td>
            <td align="left"><input name="cedula" type="text" class="Boxes" id="cedula" value="<?php echo $rp->usuario; ?>" size="30" />
            (usuario para login)</td>
          </tr>
          <tr> 
            
            
            <td align="right"><strong>Nombres y Apellidos</strong><span class="estilo1">*</span></td>
                <td align="left"> <input name="nombre" type="text" class="Boxes" id="nombre" value="<?php echo $rp->nombre; ?>" size="30" ></td>
          </tr>
			  <tr> 
            <td align="right"><strong>Ciudad</strong> <span class="estilo1">*</span></td>
                <td align="left"><input name="ciudad" type="text" class="Boxes" id="ciudad" value="<?php echo $rp->ciudad; ?>" size="30"></td>
              </tr>
			  <tr> 
            <td align="right"><strong>Direcci&oacute;n</strong> </td>
                <td align="left"><textarea name="direccion" cols="30" rows="2" class="Boxes2" id="direccion_cobro"><?php echo $rp->direccion; ?></textarea></td>
              </tr>
			  <tr> 
            <td align="right"><strong>Tel&eacute;fono</strong></td>
                <td align="left"> <input name="telefono" type="text" class="Boxes" id="telefono" value="<?php echo $rp->telefono; ?>" size="30" ></td>
              </tr>
			  <tr> 
            <td align="right"><strong>E-Mail </strong><span class="estilo1">*</span></td>
                <td align="left"><input name="email" type="text" class="Boxes" id="email" value="<?php echo $rp->email; ?>" size="30" ></td>
              </tr>
              <tr> 
            <td align="right"><strong>Clave </strong><span class="estilo1">*</span></td>
                <td align="left"><input name="clave" type="text" class="Boxes" id="clave" value="<?php echo $rp->clave; ?>" size="30" ></td>
              </tr>
          <tr> 
            <td colspan="2"> 
              <p><span class="campo-requerido"><span class="estilo1">*Campo requerido</span></span></p>                </td>
          </tr>
          <tr>
          <td colspan="2"><div align="center">
            <input type="button" name="env" value="Actualizar" onClick="envio(form1,'direccion,telefono')" style=" width:100px; height:50px; font-weight:bold" id="env"/>
            <input name="actualizar" type="hidden" id="actualizar" value="<?php echo $rp->idus; ?>">
            <input name="bor" type="button" style=" width:100px; height:50px; font-weight:bold" onClick="window.close()" value="Salir" id="bor">
          </div></td>
        </tr>
        </table>
    </form>	</td>
    <td></td>
  </tr>
</table>
</body>
</html>
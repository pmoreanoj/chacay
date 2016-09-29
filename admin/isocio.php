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
//guardar paquete
if(isset($_POST['nombre'])){
//$nopermitidos = array("¬","*","$","#","%","&","=","<",">");//caracteres no permitidos
	foreach ($_POST as $key => $value) {
		//$dat[$key] = trim(str_replace($nopermitidos, "",$value));
			$dat[$key] = trim($value);
	}
	$pm[1]=97.5;
    $pm[2]=195;
	$n1=explode(" ",$dat['nombre']); 
	$noper= array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ");
	$clave=str_replace($noper, "", strtolower($n1[0])). rand(0,100);
  if(mysql_query("insert into socios values('','1','".$dat['cedula']."','".$dat['nombre']."','".$dat['mem']."','".$dat['pais']."','".$dat['ciudad']."','".$dat['direccion']."','".$dat['telefono']."','".$dat['email']."','".$pm[$dat['mem']]."','1','".$clave."','".$idop."',NOW())")){
		  $ids=mysql_insert_id();
		  $dest = $dat['email'];
	//$head = "From: ".$_POST['email']."\r\n";
	$head = "From: info@sovistour.com \r\n";
		// Ahora creamos el cuerpo del mensaje
	$msg = "------------------------------- \n";
	$msg.= "        REGISTRO SOCIO SOVISTOUR            \n";
	$msg.= "------------------------------- \n";
	$msg.= "CEDULA:   ".$dat['cedula']."\n";
	$msg.= "NOMBRE:   ".$dat['nombre']."\n";
	$msg.= "EMAIL:    ".$dat['email']."\n";
	$msg.= "UBICACION:    ".$dat['pais'].", ".$dat['ciudad']."\n";
	$msg.= "TELEFONO:    ".$dat['telefono']."\n";
	$msg.= "CLAVE:    ".$clave."\n\n\n\n";
	$msg.= "HORA:     ".date("h:i:s a ")."\n";
	$msg.= "FECHA:    ".date("D, d M Y")."\n";
		$msg.= " Mensaje creado por www.sovistour.com \n";
	@mail($dest, "Nuevo SOCIO", $msg, $head); 
  header("Location:isocio.php?in=1");	
  }else{
   header("Location:isocio.php?in=3");	
  }
}
//fin de guardar paquete
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registrar Socio</title>
<script language="javascript" src="../js/jquery.js"></script>
<script language="javascript">
function fechas(b,d){
		 $(d).html('Cargando ..');
	     $(d).load("funciones.php", {id: b,op:1});
}
function hoteles(b1,d1,c1){
	$(d1).html('Cargando ..');
	$(d1).load("funciones.php", {id: b1,op:2,idf:c1});
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

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
	font: 62.5% "Trebuchet MS", sans-serif;
}
.estilo1 {color: #990033}
.Estilo3 {font-size: 12px}
#ayuda {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	visibility: hidden;
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
.Estilo6 {
	color: #993300;
	font-weight: bold;
}
body,td,th {
	font-size: 14px;
}
#form1 table {
	text-align: right;
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

jQuery.fn.generaNuevosCampos = function(etiqueta, nombreCampo, indice){
		$(this).each(function(){
			elem = $(this);
			elem.data("etiqueta",etiqueta);
			elem.data("nombreCampo",nombreCampo);
			elem.data("indice",indice);
			
			elem.click(function(e){
				e.preventDefault();
				elem = $(this);
				etiqueta = elem.data("etiqueta");
				nombreCampo = elem.data("nombreCampo");
				indice = elem.data("indice");
				texto_insertar = '<p>' + etiqueta + ' ' + indice + ':<br><input type="text" name="' + nombreCampo + indice + '" /></p>';
				indice ++;
				elem.data("indice",indice);
				nuevo_campo = $(texto_insertar);
				elem.before(nuevo_campo);
			});
		});
		return this;
	}
	
var nextinput = 0;
/*function AgregarCampos(){
nextinput++;
campo = '<li id="rut'+nextinput+'">Campo:'+nextinput+'<input type="text" size="20" id="campo' + nextinput + '"  name="campo' + nextinput + '"  /><a href="#" onclick="QuitarCampos(\'#rut' + nextinput + '\');">Quitar Campo</a></li>';
$("#campos").append(campo);
}*/
function AgregarCampos(ch,c1,dc1,c2,dc2,c3,dc3){
  if(ch.checked==true){	
  campo = '<input type="text" id="' + dc1 + '"  name="' + dc1 + '" size="5" maxlength="10"  />';
  $(c1).append(campo);
  campo1 = '<input type="text" id="' + dc2 + '"  name="' + dc2 + '" size="5" maxlength="10"  />';
  $(c2).append(campo1);
  campo2 = '<input type="text" id="' + dc3 + '"  name="' + dc3 + '"  size="5" maxlength="10" />';
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
function QuitarCampos(c){
//nextinput--;
//campo = '<li id="rut'+c+'">Campo:<input type="text" size="20" id="campo' + c + '"  name="campo' + c + '"  /></li><a href="#" onclick="QuitarCampos('+c+');">Quitar Campo</a>';
//$("#campos").append(campo);
$(c).remove();
//alert("Quitado" + c);
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
  f.action="isocio.php";
  //f.insertar.value="1";
  f.env.value="Enviando";
  f.env.disabled=true;
  //f.bor.disabled=true;
  f.submit();
 }else{
 alert("Favor ingrese todos los datos obligatorios: \n\n" + msj + campos);
 }	
} 
function vertalla(d,op){
	if(op==0){
	$(d).html('<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="140"><div align="right"><strong>Unidades Disponibles<span class="estilo1">*</span></strong></div></td><td><input name="unidades" type="text" id="unidades" value="" size="4" maxlength="4" /></td></tr><tr><td><div align="right"><strong>Precio<span class="estilo1">*</span></strong></div></td><td><input name="precio" type="text" id="precio" value="" size="10" maxlength="15" /><em>USD</em></td></tr></table>');
	}else{
		$(d).html('hola');
	}
}
function ver(v1,dv){
var da = document.getElementById(dv);
if(v1.checked==true){
 da.style.display="block";
 }else{
 da.style.display="none";
 }
}
function ingresado(){
window.opener.location.reload();
//window.close();
}
//-->
</script>
</head>
<body onLoad="<?php if($_GET['in']==1){ echo "ingresado()"; }  ?>">
  <?php //if($_POST['insertar']==1 and $resultado=='ok'){
	  if($_GET['in']==1){

?>

<p align="center" class="Estilo6">SOCIO INGRESADO EXITOSAMENTE </p>
<p align="center"><a href="#" onClick="window.close()">Cerrar Ventana </a>| <a href="isocio.php">Ingresar Socio</a>
</p>
  <?php //}elseif(mysql_num_rows(mysql_query("select * from productos where code='$ide'"))<=$max_p[$empresa1->plan]){
	  }elseif(0<=100){
	  ?>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td></td>
    <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<?php if($resultado!=''){?>
      <?php echo '<font color=#990033>'.$resultado.'</font><br>'; ?> 
	  <?php }//fin de if($error!='')?>
      
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><p><strong>Ingreso de nuevo Socio</strong></p></td>
          <td><div align="right"><a href="#" onClick="window.close()" style="font-size:smaller; color:#000000">Cerrar Ventana </a></div></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <p>Llene el siguiente formulario con los datos del nuevo Socio. </p>
     <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#F4F4F4"  bgcolor="#F4F4F4">
          <tr>
            <td align="right"><strong>Membres&iacute;a</strong><span class="estilo1">*</span></td>
            <td align="left"><label>
              <select name="mem" id="mem">
              <option value="">--------</option>
                <option value="1">Afiliaci&oacute;n por medio a&ntilde;o</option>
                <option value="2">Afiliaci&oacute;n por un a&ntilde;o</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td align="right"><strong>C&eacute;dula de Identidad</strong><span class="estilo1">*</span></td>
            <td align="left"><input name="cedula" type="text" class="Boxes" id="cedula" size="30" /></td>
          </tr>
          <tr> 
            
            
            <td align="right"><strong>Nombres y Apellidos</strong><span class="estilo1">*</span></td>
                <td align="left"> <input name="nombre" type="text" class="Boxes" id="nombre" value="<?php echo $_POST['na']; ?>" size="30" ></td>
          </tr>
          
          
          
          
          <tr> 
            <td align="right"><strong>Pa&iacute;s </strong><span class="estilo1">*</span></td>
<td align="left"><select name="pais" id="pais">
                                                        <?php 
         //llenamos los paises
           $consulta= "select nombre from paises ";
           $resultado=mysql_query($consulta);
          while($row=mysql_fetch_object ($resultado)){
			   if($row->nombre=='ECUADOR'){
				 echo '<option value="'.$row->nombre.'" selected>'.$row->nombre.'</option>';
			   }else{
			  echo '<option value="'.$row->nombre.'">'.$row->nombre.'</option>';
			  }
		  }
	?>
                                                      </select></td>
          </tr>
			  <tr> 
            <td align="right"><strong>Ciudad</strong> <span class="estilo1">*</span></td>
                <td align="left"><input name="ciudad" type="text" class="Boxes" id="ciudad" value="" size="30"></td>
              </tr>
			  <tr> 
            <td align="right"><strong>Direcci&oacute;n</strong> </td>
                <td align="left"><textarea name="direccion" cols="30" rows="2" class="Boxes2" id="direccion_cobro"></textarea></td>
              </tr>
			  <tr> 
            <td align="right"><strong>Tel&eacute;fono</strong></td>
                <td align="left"> <input name="telefono" type="text" class="Boxes" id="telefono" value="<?php echo $_POST['ta']; ?>" size="30" ></td>
              </tr>
			  <tr> 
            <td align="right"><strong>E-Mail </strong><span class="estilo1">*</span></td>
                <td align="left"><input name="email" type="text" class="Boxes" id="email" value="<?php echo $_POST['ea']; ?>" size="30" ></td>
              </tr>
          <tr> 
            <td colspan="2"> 
              <p><span class="campo-requerido"><span class="estilo1">*Campo requerido</span></span></p>                </td>
          </tr>
          <tr>
          <td colspan="2"><div align="center">
            <input type="button" name="env" value="Guardar" onClick="envio(form1,'direccion,telefono')" style=" width:100px; height:50px; font-weight:bold" id="env"/>
          </div></td>
        </tr>
        </table>
    </form>	</td>
    <td></td>
  </tr>
</table>
<?php }else{ ?>
<p align="center" class="Estilo6">No puede ingresar m&aacute;s de <?php echo $max_p[$empresa1->plan] ?> productos </p>
<p align="center"><a href="#" onClick="window.close()">Cerrar Ventana </a></p>
<?php }//fin de if($_POST['insertar']==1 and $error==''){ ?>
</body>
</html>
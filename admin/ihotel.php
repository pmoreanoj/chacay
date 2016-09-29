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
if(isset($_POST['nom'])){
//$nopermitidos = array("¬","*","$","#","%","&","=","<",">");//caracteres no permitidos
	foreach ($_POST as $key => $value) {
		//$dat[$key] = trim(str_replace($nopermitidos, "",$value));
			$dat[$key] = trim($value);
	}
	$imagen= $_FILES['imagen']['name'];
	$imagen1= $_FILES['imagen1']['name'];
	$imagen2= $_FILES['imagen2']['name'];
       if($imagen!=''){
		$fotos.=subir_imgp($_FILES['imagen']) . "+";
		}
		if($imagen1!=''){
		$fotos.=subir_imgp($_FILES['imagen1']) . "+";
		}
		if($imagen2!=''){
		$fotos.=subir_imgp($_FILES['imagen2']) . "+";
		}
  if(mysql_query("insert into hoteles values('','".$dat['cat']."','".$dat['nom']."','".$fotos."','". mysql_real_escape_string($dat['des']) ."','". mysql_real_escape_string($dat['ben']) ."','','',NOW())")){
		  $idh=mysql_insert_id();
	  /*//ingreso de detalles fechas
	    if($dat['nf']==0){
			$dat['nf']=1;//si no tiene fechas
		}
	  for($f=1;$f<=$dat['nf'];$f++){
		  $fs=$dat['fs'.$f];
		  $fr=$dat['fr'.$f];
		    for($h=1;$h<=$dat['nh'.$f];$h++){
				$hotel=$dat['hot'.$h.'_'.$f];
				if($dat['hs'.$h.'_'.$f]==1){//habitacion simple
				    $precioa=$dat['pas'.$h.'_'.$f];
					$precion=$dat['pns'.$h.'_'.$f];
					$unidades=$dat['dis'.$h.'_'.$f];
					mysql_query("insert into detalleproductos values('','$idp','$fs','$fr','$hotel','Simple','$precioa','$precion','$unidades','$unidades','')");
				}
				if($dat['hd'.$h.'_'.$f]==1){//habitacion doble
				    $precioa=$dat['pad'.$h.'_'.$f];
					$precion=$dat['pnd'.$h.'_'.$f];
					$unidades=$dat['did'.$h.'_'.$f];
					mysql_query("insert into detalleproductos values('','$idp','$fs','$fr','$hotel','Doble','$precioa','$precion','$unidades','$unidades','')");
				}
				if($dat['ht'.$h.'_'.$f]==1){//habitacion doble
				    $precioa=$dat['pat'.$h.'_'.$f];
					$precion=$dat['pnt'.$h.'_'.$f];
					$unidades=$dat['dit'.$h.'_'.$f];
					mysql_query("insert into detalleproductos values('','$idp','$fs','$fr','$hotel','Triple','$precioa','$precion','$unidades','$unidades','')");
				}
			}//fin de for($h=1;$h<=$dat['nh'];$h++){ hoteles
	  }//fin de for($f=1;$f<=$dat['nf'];$f++){ fechas*/
  header("Location:ihotel.php?in=1");	
  }else{
   header("Location:ihotel.php?in=3");	
  }
}
//fin de guardar paquete
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Insertar Hotel</title>
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
  f.action="ihotel.php";
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
<script language="javascript" type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
	theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
		
	});
</script>
</head>
<body onLoad="<?php if($_GET['in']==1){ echo "ingresado()"; }  ?>">
  <?php //if($_POST['insertar']==1 and $resultado=='ok'){
	  if($_GET['in']==1){

?>

<p align="center" class="Estilo6">HOTEL INGRESADO EXITOSAMENTE </p>
<p align="center"><a href="#" onClick="window.close()">Cerrar Ventana </a>| <a href="ihotel.php">Ingresar Hotel</a>
</p>
  <?php //}elseif(mysql_num_rows(mysql_query("select * from productos where code='$ide'"))<=$max_p[$empresa1->plan]){
	  }elseif(0<=100){
		  if($_GET['in']==3){
			  echo '<p align="center" class="Estilo6">PRODUCTO NO INGRESADO, OCURRIO UN ERROR </p>';
		  }
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
          <td><p><strong>Ingreso de nuevo Hotel </strong></p></td>
          <td><div align="right"><a href="#" onClick="window.close()" style="font-size:smaller; color:#000000">Cerrar Ventana </a></div></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <p>Llene el siguiente formulario con los datos del nuevo Hotel. </p>
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#F4F4F4"  bgcolor="#F4F4F4">
      <tr>
          <td valign="bottom" style="width:250px"><div align="right"><strong>Categor&iacute;a<span class="estilo1">*</span></strong>
          </div></td>
          <td><?php $ip=explode("+",$rp->imagenp); ?>
            <select name="cat" id="cat">
              <option value="" <?php if(!$_POST['categoria']){?>selected <?php }?>><--seleccione--></option>
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
          <td valign="bottom"><div align="right"><strong>T&iacute;tulo/Nombre del Hotel<span class="estilo1">*</span></strong>
            </div></td>
          <td><span class="Estilo3">Caracteres no permitidos (-,+,*,/,$,&amp;,@,&lt;,&gt;,#)</span>
            <input name="nom" type="text" id="nom" onKeyUp="contar(this,form1.num,50)" value="<?php echo $nombre;?>" size="50" maxlength="100"/></td>
        </tr>
        <tr>
          <td valign="top"><div align="right"></strong><em style="font-size:12px">(archivo .jpg o .gif , tama&ntilde;o m&aacute;ximo 1MB)</em><br><strong>
                Imagen<span class="estilo1">*</span>
          </div></td>
          <td>
            <span class="Estilo3">Se recomienda(500*500)px para una mejor visualizaci&oacute;n de la imagen en el cat&aacute;logo </span><br>
            <input name="imagen" type="file" id="imagen" size="30">
            <input name="imagen1" type="file" id="imagen1" size="30">            <input name="imagen2" type="file" id="imagen2" size="30"></td>
        </tr>
        <tr>
          <td valign="top"><div align="right"><strong>Descripci&oacute;n<span class="estilo1">*</span></strong><br>
          </div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><textarea name="des" cols="83" rows="15" id="des"><?php
		   $car=$caracteristica;
           $des=$descripcion;
           $car=explode('+',$car);
           $des=explode('+',$des);
           $nc=count($car); 
          for($i=0;$i<$nc;$i++){
           if($car[$i]!=''){
           echo '<p><strong>'.$car[$i].'</strong></p>';
           echo '<p>'.$des[$i].'</p>';
           }else{
           echo '<p>'.$des[$i].'</p>';
           }
          } 
  ?></textarea></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Beneficios Socios<span class="estilo1">*</span></strong><br>
            </div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div align="center">
              <textarea name="ben" cols="83" rows="7" id="ben"><?php
		   $car=$caracteristica;
           $des=$descripcion;
           $car=explode('+',$car);
           $des=explode('+',$des);
           $nc=count($car); 
          for($i=0;$i<$nc;$i++){
           if($car[$i]!=''){
           echo '<p><strong>'.$car[$i].'</strong></p>';
           echo '<p>'.$des[$i].'</p>';
           }else{
           echo '<p>'.$des[$i].'</p>';
           }
          } 
  ?>
            </textarea>
            </div></td>
          </tr>
        <tr>
          <td colspan="2"><strong style="font-size:12px; color:#990033">*Datos Obligatorios</strong></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            <input type="button" name="env" value="Guardar" onClick="envio(form1,'imagen1,imagen2')" style=" width:100px; height:50px; font-weight:bold" id="env"/>
          </div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
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
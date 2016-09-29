<?php 
error_reporting(0);
/* Conexión a la BD  */
$host= "webcompra.db.8526984.hostedresource.com";

/*$usuario= "root";
$contrasena= "";
$base_datos="chacay";*/
$usuario= "webcompra";
$contrasena= "Chacay2013!";
$base_datos= "webcompra";

$enlace= mysql_connect($host,$usuario,$contrasena) or die ("NO SE CONECTA"); 
mysql_select_db ($base_datos, $enlace) or die ("NO SE PUEDE SELECCIONAR".$base_datos);

/////////////funcion de redimension de imagen/////////////////////
function redimension($x,$y,$name,$type,$tmp_name,$t){

  $ruta="../imagenes".$t.$name;
  // Creando el thumbnail
   if(stristr($type,"jpeg") or stristr($type,"pjpeg") or stristr($type,"jpg")){
   $img = imagecreatefromjpeg($tmp_name);
  }elseif(stristr($type,"gif")){
  $img = imagecreatefromgif($tmp_name);
  }elseif(stristr($type,"png")){
  $img = imagecreatefrompng($tmp_name);
  }
  
  $thumb = imagecreatetruecolor($x, $y);
  $datos = getimagesize($tmp_name);
  imagecopyresized($thumb, $img, 0, 0, 0, 0, $x, $y, $datos[0], $datos[1]);
   if(stristr($type,"jpeg") or stristr($type,"pjpeg") or stristr($type,"jpg")){
    imagejpeg($thumb,$ruta);
  }elseif(stristr($type,"gif")){
   imagegif($thumb, $ruta);
  }elseif(stristr($type,"png")){
   imagepng($thumb, $ruta);
  }
 
}
//////////////////fin de funcion de redimension deimagen////////////////////
function subir_imgp($iname){//funcion subir imagen producto
		if($iname['name']!=''){
		  //codigo para subir el grafico al servidor
		  //-------------------------------------------------------------------------------------
		  //asignar un nombre unico a la imagen
		  mysql_query("insert into codimagen values('')");
		  $sql=mysql_fetch_object(mysql_query("SELECT LAST_INSERT_ID( ) AS nombre FROM codimagen"));
		  $ext=explode('/',$iname['type']);
		  $nombre_archivo = $sql->nombre.'.'.$ext[1]; //nombre imagen para operaciones de redimension
		  $imagen=$nombre_archivo ;//nombre imagen para guardar en la BD
		  ///////////////////////////////////////
		  //datos de la imagen
		  $tipo_archivo =$iname['type']; 
		  $tamano_archivo = $iname['size']; 
		  $archivo_temporal = $iname['tmp_name'];
		  //compruebo si las características del archivo son las que deseo 
		  //formato gif o jpg no existan imagenes duplicadas y tamaño maximo de 1MB
		if (!((stristr($tipo_archivo, "gif") || stristr($tipo_archivo, "jpeg") || stristr($tipo_archivo, "jpg") || stristr($tipo_archivo, "pjpeg")) && ($tamano_archivo < 1000000))) {
			 
			 $error1='No se pudo copiar la imagen, la extencion de la imagen debe ser .jpg o .gif y tener 1MB de tamaño maximo';
			 $_SESSION['e']=$error1.".<br> ";
			  
		}else{

		  //crear grafico pequeño
		  $t='/p/';
		  $x1=203;
		  $y1=66;
		  redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t);
		   //crear grafico normal o grande
			$t='/g/';
			$x1=610;
			$y1=200;
			 redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t); 
		}//fin de compruebo si las características del archivo son las que deseo
	}//fin de if($imagen!='')
return $imagen;	
}// fin de funcion subir imagen paquetes

///funcion subir imagen banner
function subir_imgb($iname,$a,$l){
		if($iname['name']!=''){
		  //codigo para subir el grafico al servidor
		  //-------------------------------------------------------------------------------------
		  //asignar un nombre unico a la imagen
		  mysql_query("insert into codimagen values('')");
		  $sql=mysql_fetch_object(mysql_query("SELECT LAST_INSERT_ID( ) AS nombre FROM codimagen"));
		  $ext=explode('/',$iname['type']);
		  $nombre_archivo = $sql->nombre.'.'.$ext[1]; //nombre imagen para operaciones de redimension
		  $imagen=$nombre_archivo ;//nombre imagen para guardar en la BD
		  ///////////////////////////////////////
		  //datos de la imagen
		  $tipo_archivo =$iname['type']; 
		  $tamano_archivo = $iname['size']; 
		  $archivo_temporal = $iname['tmp_name'];
		  //compruebo si las características del archivo son las que deseo 
		  //formato gif o jpg no existan imagenes duplicadas y tamaño maximo de 1MB
		if (!((stristr($tipo_archivo, "gif") || stristr($tipo_archivo, "jpeg") || stristr($tipo_archivo, "jpg") || stristr($tipo_archivo, "pjpeg")) && ($tamano_archivo < 1000000))) {
			 
			 $error1='No se pudo copiar la imagen, la extencion de la imagen debe ser .jpg o .gif y tener 1MB de tamaño maximo';
			 $_SESSION['e']=$error1.".<br> ";
			  
		}else{
			$t='/g/';
			$x1=$a;
			$y1=$l;
			 redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t); 
		}//fin de compruebo si las características del archivo son las que deseo
			
		}//fin de if($imagen!='')
return $imagen;	
}// fin de funcion subir imagens banner
///funcion subir imagen Galeria
function subir_img1($iname){
		if($iname['name']!=''){
		  //codigo para subir el grafico al servidor
		  //-------------------------------------------------------------------------------------
		  //asignar un nombre unico a la imagen
		  mysql_query("insert into codimagen values('')");
		  $sql=mysql_fetch_object(mysql_query("SELECT LAST_INSERT_ID( ) AS nombre FROM codimagen"));
		  $ext=explode('/',$iname['type']);
		  $nombre_archivo = $sql->nombre.'.'.$ext[1]; //nombre imagen para operaciones de redimension
		  $imagen=$nombre_archivo ;//nombre imagen para guardar en la BD
		  ///////////////////////////////////////
		  //datos de la imagen
		  $tipo_archivo =$iname['type']; 
		  $tamano_archivo = $iname['size']; 
		  $archivo_temporal = $iname['tmp_name'];
		  //compruebo si las características del archivo son las que deseo 
		  //formato gif o jpg no existan imagenes duplicadas y tamaño maximo de 1MB
		if (!((stristr($tipo_archivo, "gif") || stristr($tipo_archivo, "jpeg") || stristr($tipo_archivo, "jpg") || stristr($tipo_archivo, "pjpeg")) && ($tamano_archivo < 1000000))) {
			 
			 $error1='No se pudo copiar la imagen, la extencion de la imagen debe ser .jpg o .gif y tener 1MB de tamaño maximo';
			 $_SESSION['e']=$error1.".<br> ";
			  
		}else{
		  $datos = getimagesize($archivo_temporal);//obtener datos de ancho y alto, imagen
		  //crear grafico pequeño
		   if($datos[0]>180 or $datos[1]>180){
		   $t='/p/';
			 if($datos[0]>=$datos[1]){
			  $x1=180;
			  $ratio = ($datos[0]/$x1);
			  $y1= round($datos[1]/$ratio);
			  redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t);
			 }elseif($datos[1]>$datos[0]){
			  $y1=180;
			  $ratio = ($datos[1]/$y1);
			  $x1= round($datos[0]/$ratio);
			   redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t);
			 }//fin de if($datos[0]>=$datos[1]){ 
			}else{
			  $movido=1;//se ha subido el archivo
			  move_uploaded_file($iname['tmp_name'], "../imagenes/p/".$nombre_archivo);	 
		   }//fin de if($datos[0]>72 or $datos{1]>72){   
		   //crear grafico normal o grande
		   if($datos[0]>500){
			$t='/g/';
			$x1=500;
			$ratio = ($datos[0]/$x1);
			$y1= round($datos[1]/$ratio);
			 redimension($x1,$y1,$nombre_archivo,$tipo_archivo, $archivo_temporal,$t); 
		   }elseif($movido==1){
		     copy("../imagenes/p/".$nombre_archivo, "../imagenes/g/".$nombre_archivo);
		   }else{
			move_uploaded_file($iname['tmp_name'], "../imagenes/g/".$nombre_archivo);
		   }//fin de if($datos[0]>500){
			
		}//fin de compruebo si las características del archivo son las que deseo
			
		}//fin de if($imagen!='')
return $imagen;	
}// fin de funcion subir imagen Galeria
//funcion obtener stock producto
function stock($itemx) 
{
$consult="select u_disponibles from productos where codp='$itemx'";
$res=mysql_query($consult);
$row= mysql_fetch_object ($res);
$unidades=$row->u_disponibles;
return $unidades;
}
//funcion obtener stock producto inicial
function stocki($itemx) 
{
$consult="select uinicial from detalleproductos where coddp='$itemx'";
$res=mysql_query($consult);
$row= mysql_fetch_object ($res);
$unidades=$row->uinicial;
return $unidades;
}
//funcion actualizar stock
function astock($itemx,$stockn) 
{
	//actualizamos stock en productos
	$stocki=mysql_fetch_object(mysql_query("select u_inicial from productos where codp='$itemx'"));
	if($stockn<=$stocki->u_inicial){
	$act_stock="update productos set u_disponibles='$stockn' where codp='$itemx'";
	mysql_query($act_stock);
	}
}
//funcion actualizar stock inicial
function astocki($itemx,$stockn) 
{
	//actualizamos stock en productos
	$act_stock="update detalleproductos set uinicial='$stockn',unidades='$stockn' where coddp='$itemx'";
	mysql_query($act_stock);
 
}

$sqlcat=mysql_query("select * from categorias order by nom");
while($rowcat=mysql_fetch_object($sqlcat)){//vector datos categorias
$cat[$rowcat->cat]=$rowcat->nom;
}
?>
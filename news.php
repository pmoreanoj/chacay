<?php 

include_once("conect.php");
if($_SESSION['s']){
  $rs=mysql_fetch_object(mysql_query("select ids,cliente from socios where estado=1 and ids=". trim($_SESSION['s'])));
}
include("Contador/contador.php");
//paginacion 
			$numn=5;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
if($_GET['n']){
	$rp=mysql_fetch_object(mysql_query("select * from noticias where idn=". $_GET['n']));
	$tit=$rp->tit;
}else{
$sqlp=mysql_query("select * from noticias ORDER BY fecha DESC LIMIT ".$ini." , ".$numn); 
//$sqlp=mysql_query("select * from productos ORDER BY nombrep LIMIT ".$ini." , ".$numn); 
$nump=mysql_num_rows($sqlp);
$numf=mysql_fetch_object(mysql_query("select count(*) as nf from noticias"));
//$numf=mysql_fetch_object(mysql_query("select count(*) as nf from productos"));
$num_filas=$numf->nf;
$sqlc1=mysql_fetch_object(mysql_query("select nom from categorias where cat=".$op));
$tit="NEWS";
}
$mes=array("Jan.","Feb.","Mar.","Apr.","May.","Jun.","Jul.","Aug.","Sep.","Oct.","Nov.","Dec.");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="favicon.ico" />
<title><?php echo $tit; ?></title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="slides/css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
    <script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
</head>

<body>
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">
  <div class="banner_left">
  	<?php  include_once('buscar.php');?>
    </div>
      
    </div>
    <div class="textos1">
    <h1>Chacay News</h1>
    <?php if($_GET['n']){// ve detalle de noticia 
	?>
      <div style="float:left;">
            <div id="di">
            <?php 
			$datos = getimagesize("imagenes/g/".$rp->f1);
		   if($datos[0]>400){
			   $ancho=400;
		   }else{
		      $ancho=$datos[0];
		   }
			?>
          <img src="imagenes/g/<?php echo $rp->f1;?>"  class="textos_imagen" width="<?php echo $ancho; ?>" style="padding:5px" /></div></div>
          </a>
          <h2><?php echo $rp->tit; ?></h2>
      <div class="addthis_toolbox addthis_default_style" style="float:left">
<a class="addthis_button_facebook" style="cursor:pointer"></a>
<a class="addthis_button_twitter" style="cursor:pointer"></a>
<a class="addthis_button_email" style="cursor:pointer"></a>
<a class="addthis_button_google_plusone_share"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507e67b86e1b3f40"></script>
  <div class="detalles_cont" style="margin:5px;"><br /><?php echo $rp->des; ?>
      </div>
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
           <tr>
             <td style="font-size:12px; color:#003">
             <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);?>
		  <span style="color:#930; font-weight:bold">Published:</span> <?php echo $mes[$fecha[1]-1] ?> <?php echo $fecha[2] ?>, <?php echo $fecha[0] ?></td>
             <td align="right">&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td align="right"><a href="news.php" class="boton" style="float:right">Return</a></td>
           </tr>
         </table>
    
    <?php }else{ ?>
    
    <?php while($row=mysql_fetch_object($sqlp)){ ?>
    <table width="355" border="0" cellpadding="2" cellspacing="2" style="float:left">
    <tr>
      <td><h3><?php echo $row->tit ?></h3></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
    <td><img src="./imagenes/p/<?php echo $row->f1; ?>" width="132" height="132" class="imagenews"/><?php echo substr(strip_tags($row->des),0,1000); ?></td>
    <td width="10">&nbsp;</td>
    </tr>
  <tr>
    <td><span></span> <a href="news.php?n=<?php echo $row->idn; ?>" class="boton">Read More</a></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    </table>
  <?php } ?>
  
    <?php }//fin de <?php if($_GET['idn']){// ve detaññe de noticia ?> 
    <div class="vacio"></div>
  </div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
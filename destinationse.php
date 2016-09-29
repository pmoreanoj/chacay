<?php 
if (!isset($_SESSION)) {
  session_start();
}
include_once("conect.php");
include("Contador/contador.php");
$re=mysql_fetch_object(mysql_query("select * from usuarios where idus=1"));
$op=$_GET['op'];
if($_POST['cbusca']){	
$palabra=$_POST['cbusca'];
}elseif($_GET['cbusca']){
	//$pe=explode("?",$_GET['cbusca']);
     //$palabra=$pe[0];
	 $palabra=$_GET['cbusca'];
}
//tours
$sqlp=mysql_query("select * from productos where nombrep like '%".$palabra."%' or descripcion like '%".$palabra."%'");
$nump=mysql_num_rows($sqlp);

$sqlc1=mysql_fetch_object(mysql_query("select nom from categorias where cat=".$op));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />	
	<link rel="shortcut icon" href="images/favicon.ico">
    <script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
</head>

<body>

<div id="contenedor">
  <?php include_once('header.php'); ?>

    <div id="contenido">
 <?php //echo $sqlc1->nom; ?>
    <div class="animacion">    </div>
    <div id="contenido_right">
    <strong>Search &quot;<?php echo $palabra; ?>&quot; Found <?php echo $nump; ?></strong>
    <?php 
		  if($nump>0){
		  while($rp=mysql_fetch_object($sqlp)){
			  $ip=explode("+",$rp->imagenp);
		  ?>
    <div class="destinos"> 
    <div class="detalles_producto"><img src="./imagenes/p/<?php echo $ip[0]; ?>"/>
    From <span class="texto_precio">$<?php echo sprintf("%01.2f",$rp->precio); ?></span> USD<br />
    <span class="texto_dias"><?php echo $rp->adicional; ?> days</span>
    <p><a href="producto.php?p=<?php echo $rp->codp ?>&op=<?php echo $op ?>&pa=destinationse.php?cbusca=<?php echo $palabra; ?>" class="boton">Details</a></p>
    </div>
    <h1><?php echo $rp->nombrep ?> </h1>
    <?php echo substr(strip_tags($rp->descripcion),0,1000); ?>..</p>
    
    </div>
    <div class="division_inferior"></div>
    <?php } ?>
    <?php  }else{
				?>No records found
                <?php }//fin de if($nump>0){?>
    </div></div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
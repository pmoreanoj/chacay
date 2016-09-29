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
$sqlp=mysql_query("select * from testimonios ORDER BY fecha DESC LIMIT ".$ini." , ".$numn); 
//$sqlp=mysql_query("select * from productos ORDER BY nombrep LIMIT ".$ini." , ".$numn); 
$nump=mysql_num_rows($sqlp);
$numf=mysql_fetch_object(mysql_query("select count(*) as nf from testimonios"));
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
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="./favicon.ico">
    <script language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="./js/codjs.js"></script>
</head>
<body>
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">
  	

    <div class="animacion">    </div>
    <div class="textos">
    "Hola!
 Some opinions/thoughts from a student who participated in the program (Encuentros 2008):
 1. Broad. Diverse program if you want a mixture of language immersion, community service, teamwork skills, and travel.
 2. Well chosen program directors: caring, capable, and great resource for students (Lucia is awesome!)
 3. Safe. David is a responsible and intelligent director that will make sure students are taken care of Ecuadorian culture will welcome you warmly. A breath of fresh air and eye-opening experience for those who do not travel often.
 5. Overall, a great, well-rounded program for high school students who are ready to get out of their comfort zone!
 chao for now, Hannita"
    <table width="970" border="0" cellspacing="0" cellpadding="0">
    <?php while($row=mysql_fetch_object($sqlp)){ ?>
  <tr>
    <td valign="top"><img src="imagenes/g/<?php $f=explode("+",$row->foto); echo $f[0]; ?>" width="132" height="132" style="padding:5px" /></td>
    <td>
    <strong><?php echo $row->nom; ?></strong><br />
    <?php echo $row->des; ?>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <?php }//fin de while ?>
    </table>
    </div>
  </div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
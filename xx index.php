<?php 
include_once("conect.php");
include("Contador/contador.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	<link href="slides/css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
    <script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
</head>

<body>
<!--<div id="top">
  <div id="top_a">
  	Toll free number: <span id="fono">888 776 6802</span>
  </div>
</div>-->
<div id="contenedor">
  <?php include_once('header.php'); ?>
    
  <div id="banner">
  <table width="900px">
  <tr>
  <td width="25%" rowspan="6" valign="top">
  <div class="banner_left">
    <?php  include_once('buscar.php');?>
  </div>
  </td>
  <td colspan="4" valign="top">
    <div id="banner_b">
    <div class="ruta">
    
    <div id="buscar">
    <form name="buscar" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="buscar" type="text" value="search tour..."  /></td>
    <td><img src="imagenes/buscar.jpg"/></td>
  </tr>
</table> 
    </form> 
    </div>  
    <div id="sociales"><a href="http://www.facebook.com/pages/Chacay-Ecotourism-in-Ecuador/191796224253972"><img src="imagenes/facebook.png" width="30" height="31" border="0" /></a> <a href="https://twitter.com/#!/ChacayTweets"><img src="imagenes/tweet.png" width="30" height="31" border="0" /></a> <a href="http://www.flickr.com/photos/70245493@N06/"><img src="imagenes/flickricon.png" width="24" height="25" border="0" /></a><a href="http://www.facebook.com/pages/Chacay-Ecotourism-in-Ecuador/191796224253972?sk=app_57675755167"><img src="imagenes/youtubeicon.png" width="24" height="25" border="0" /></a><a href="http://www.facebook.com/pages/Chacay-Ecotourism-in-Ecuador/191796224253972?http://chacay.tumblr.com/"><img src="imagenes/tumblr.png" width="25" height="25" border="0" /></a></div>
  </div>
    
    </div>
    </td>
    </tr>
  <tr>
    <td valign="top"><img src="imagenes/plaza.jpg" class="paquetes_a"/></td>
    <td colspan="3" rowspan="4" valign="top"><div id="#banner_b_img"><?php  include_once('slideshow.php');?>  </div></td>
    </tr>
  <tr>
    <td valign="top"><img src="imagenes/tren.jpg" class="paquetes_a"/></td>
    </tr>
  <tr>
    <td valign="top"><img src="imagenes/volunteer.jpg" class="paquetes_a"/></td>
    </tr>
  <tr>
    <td valign="top"><img src="imagenes/waterfall_small2.jpg" class="paquetes_a"/></td>
    </tr>
  <tr>
    <td  valign="top"><img src="imagenes/plaza.jpg" class="paquetes_a"/></td>
    <td  valign="top"><img src="imagenes/tren.jpg" class="paquetes_a"/></td>
    <td  valign="top"><img src="imagenes/waterfall_small2.jpg" class="paquetes_a"/></td>
    <td valign="top"><img src="imagenes/volunteer.jpg" class="paquetes_a"/></td>
    </tr>
    </table>
  </div>


  <div id="contenido">
    <div id="contenido_right">
      <div class="textos">
    <div id="contenido_right_a">
      <h1>WHY CHACAY?</h1>
      <p>In Quichua, the language of the Inca, Chacay means building bridges. At Chacay, we do just that: we provide personalized, quality and affordable experiences in Ecuador. Our guides, fluent in both English and Spanish, will introduce you to local experiences and communities, allowing you to contribute to their growth and thus build bridges essential to sustainable growth in Ecuador. <br />
        <br />
        Chacay extends a cordial invitation to North Americans, Europeans, and Asians to come discover Ecuador. Our ability to customize trips to fit your expectations is unmatched - at Chacay, we provide the quality of service you are accustomed to in your home country but offer it in Ecuador, a country whose beauty is unmatched by all others!<br />
        <br />
        Upon completing your trip and retuning home, you will have the option to help polish this diamond in the rough through scholarships, investments in microenterprise, or as an enthusiastic promoter of the country. Chacay's ability to offer such meaningful and customized experiences is unmatched in Ecuador - it is our hope that you recognize this, and with our help, contribute your time and treasure to Ecuador.</p>
    </div>
    
    <div id="contenido_right_b">
      <h1>NOTICES </h1>
      <div class="noticias"><img src="noticias/MitadelMundo.jpg"/> <span>Comisión  para optimizar el turismo en Pichincha.
      Quito (16h00).- El Ministerio de Turismo y los gobiernos seccionales de Pichincha conformaron una Comisión Interinstitucional para... </span>  
      <p><a href="#">VER MAS</a></p>
      </div>
      <div class="noticias"><img src="noticias/Pedro-Vicente-Maldonado.jpg"/>  <span>Comisión  para optimizar el turismo en Pichincha.
      Quito (16h00).- El Ministerio de Turismo y los gobiernos seccionales de Pichincha conformaron una Comisión Interinstitucional para... </span>  
      <p><a href="#">VER MAS</a></p>
      </div>
      <div class="noticias"><img src="noticias/Laguna-del-Volcan-Quilotoa.jpg"/>  <span>Comisión  para optimizar el turismo en Pichincha.
      Quito (16h00).- El Ministerio de Turismo y los gobiernos seccionales de Pichincha conformaron una Comisión Interinstitucional para... </span>  
      <p><a href="#">VER MAS</a></p>
      </div>
      <div class="noticias"><img src="noticias/MitadelMundo.jpg"/> <span>Comisión  para optimizar el turismo en Pichincha.
      Quito (16h00).- El Ministerio de Turismo y los gobiernos seccionales de Pichincha conformaron una Comisión Interinstitucional para... </span>  
      <p><a href="#">VER MAS</a></p>
      </div>
      <div class="noticias"><img src="noticias/Pedro-Vicente-Maldonado.jpg"/>  <span>Comisión  para optimizar el turismo en Pichincha.
      Quito (16h00).- El Ministerio de Turismo y los gobiernos seccionales de Pichincha conformaron una Comisión Interinstitucional para... </span>  
      <p><a href="#">VER MAS</a></p>
      </div>
    </div>
    </div>
    </div>
  </div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
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
   <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="./fancybox/jquery.fancybox.js"></script>
<script language="javascript">
$(document).ready(function() {
	/* Apply fancybox to multiple items */
	//$("a.group").fancybox();
	$("a.group").fancybox({
		'transitionIn'	:	'fade',
		'transitionOut'	:	'fade',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});
function imagen(i,t){
	if(t==1){
		$(i).css({'opacity':'0.7','filter':'alpha(opacity=70)'});
	}
	if(t==2){
		$(i).css({'opacity':'1','filter':'alpha(opacity=100)'});
	}
}
</script>				
</head>

<body>
<!--<div id="top">
  <div id="top_a">
  	Toll free number: <span id="fono">888 776 6802</span>
  </div>
</div>-->
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">
        
        <!--<div id="promo"><span class="contenido_p"> <a href="#"><img src="imagenes/1-promo.jpg" class="contenido_imagen" /></a>Tour a las Islas Galápagos. Todo Incluido<br />
        <p><a href="#" class="ver">Ver más detalles</a></p><br />
       
        </span>
      </div>-->
        <div class="ruta_a1">
        <span style="color:#000; font-size:18px; font-weight:bold"><img src="imagenes/galeria.png" width="30" height="30" />Im&aacute;genes</span>
        <div class="tabs"></div></div>
                
                <div class="contenido_tabs"> 
                <?php 
				
				 //paginacion 
			$numn=10;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
				
				$sqlv=mysql_query("select * from galeria where tipo=1 and cat='1' order by fecha DESC LIMIT ".$ini." , ".$numn); 
				$num_filas= mysql_num_rows(mysql_query ("select * from galeria where tipo=1 and cat='1'"));
				
				?>
                  <div class="paquete" style="margin-left:15px">
                  <?php 
				  if(mysql_num_rows($sqlv)>0){
				  while($row=mysql_fetch_object($sqlv)){ ?>
                  <a class="group" rel="group1" href="./imagenes/g/<?php echo $row->imagen ?>"><img src="imagenes/p/<?php echo $row->imagen ?>" name="i<?php echo $row->idg ?>" width="175" height="175" border="0"  class="borde_imagenes" id="i<?php echo $row->idg ?>" onmouseover="imagen('#i<?php echo $row->idg ?>','1')" onmouseout="imagen('#i<?php echo $row->idg ?>','2')" /></a>
                  <?php }//finde while
				  }else{
				  echo 'No existen registros';
				  }
				   ?>
                   
                   <div align="center" > <span class="Est6">
                    <?php 

											 if($vpag<=7){//control para desplegar solo $numn catalogos 

											 $j=0;//inicio

											 $k=7;//final

											 }else{

											 $j=$vpag-7;//inicio

											 $k=$vpag;//final

											 }

											 $sp=$vpag+1;//siguiente pagina

											 $ap=$vpag-1;//pagina anterior

											 //desplegar numeros si hay mas numeros de pagina
											

											 if($num_filas>$numn){

											 $i=$num_filas/$numn;

											 

											 ?>
                    <?php

											 //echo 'P&Aacute;GINAS: ';

											 if($ap>0){//control para mostrar o ocultar pagina anterior

										  ?>
                    </span><a href="galery.php?pag=1" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="galery.php?pag=<?php echo $ap; ?>" class="link1">Anterior</a>
                    <?php

										    }//fin de if($ap>1)

											 while($j<$i and $j<$k){

											 $j++;

											 if($vpag==$j){//ver en que catalogo estamos

											 

											 ?>
                    | <strong><?php echo $j; ?></strong>
                    <?php

										  }else{

										  ?>
                    | <a href="galery.php?pag=<?php echo $j; ?>" class="link1"><?php echo $j; ?></a>
                    <?php

										  }//fin de if($vpag=$j)

										   }//fin While

										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina

										  ?>
                    | <a href="galery.php?pag=<?php echo $sp; ?>" class="link1">Siguiente</a> | <a href="galery.php?pag=<?php echo ceil($i); ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                    <?php

										    }//fin de if($sp<=$j)
											}

											?>
                    <br />
                  </div>
                  
                  
                  </div>
                  
                  
           <div class="ruta_a1">
        <span style="color:#000; font-size:18px; font-weight:bold"><img src="imagenes/galeria.png" width="30" height="30" />Videos</span>
        <div class="contenido_tabs"> 
                <?php $sqlv=mysql_query("select * from galeria where tipo=3 and cat='1' order by fecha DESC "); ?>
                  <div class="paquete" style="margin-left:15px">
                  <?php 
				  if(mysql_num_rows($sqlv)>0){
				  while($row=mysql_fetch_object($sqlv)){ ?>
                  <object width="300" height="250"><param name="movie" value="<?php echo str_replace("watch?v=","v/",$row->imagen); ?>"></param><param name="allowFullScreen" value="true"></param><embed src="<?php echo str_replace("watch?v=","v/",$row->imagen); ?>" type="application/x-shockwave-flash" allowfullscreen="true" width="300" height="250"></embed></object>
                  <?php }//finde while
				  }else{
				  echo 'No existen registros';
				  }
				   ?>
                  </div>
                 
    </div></div>      
    </div><div class="vacio"></div>
  </div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
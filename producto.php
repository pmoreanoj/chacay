<?php include_once("conect.php");include("Contador/contador.php");$p=sprintf("%d",$_GET['p']);$rp=mysql_fetch_object(mysql_query("select * from productos where codp=".$p));mysql_query("update productos set visto=visto+1 where codp=".$p);$c=$_GET['c'];$anterior=$_GET['pa'];$op=$_GET['op'];$sqlc1=mysql_fetch_object(mysql_query("select nom from categorias where cat=".$op));?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta property="og:image" content="<?php if($p){ $ip=explode("+",$rp->imagenp); echo "./imagenes/p/".$ip[0]; }else{ echo "imagenes/chacay.png"; }?>"/><META name="title" content="<?php if($p){ echo $rp->nombrep; }else{ ?>Chacay<?php }?>"><META name="description" content="<?php if($p){ $np_1=array("+", "<strong>", "</strong>");echo substr(str_replace($np_1,",",strip_tags($rp->descripcion)),0,100);}else{ ?>Chacay<?php }?>"><title><?php if($p){ echo $rp->nombrep; }else{ ?>Chacay<?php }?></title><link href="css/template.css" rel="stylesheet" type="text/css" /><link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>	<link rel="shortcut icon" href="images/favicon.ico">	<link href="slides/css/styles.css" type="text/css" media="all" rel="stylesheet" />	<link href="slides/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />	<link href="slides/css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />	<link href="slides/css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />    <link type="text/css" href="./fecha/css/jquery-ui-1.8.22.custom.css" rel="stylesheet" />    <script language="javascript" src="js/jquery.js"></script>   <script type="text/javascript" src="./js/codjs.js"></script>	<script src="./fecha/js/jquery.ui.core.min.js"></script>	<script src="./fecha/js/jquery.ui.widget.min.js"></script>	<script src="./fecha/js/jquery.ui.datepicker.min.js"></script>	<script src="./fecha/js/jquery.ui.datepicker-es.js"></script>    <script>	function ff(df){	 document.getElementById(df).focus();	}	$(function() {		$( "#fec" ).datepicker();		$( "#fec" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );		$( "#fec" ).datepicker();		$( "#fec" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );	});function valid(f){var msj="";var nc=0;//bucle for paso 16 para saber el total campos	for(i=0; i<f.length; i++){	//si el elemento definido en la array formulario esta vacio...		if(f.elements[i].value == "" && f.elements[i].name != "com" && f.elements[i].name != "op" && f.elements[i].name != "la"){			f.elements[i].style.backgroundColor = '#f96';			nc=1;		}else{		   f.elements[i].style.backgroundColor = '';		}	}	  if(nc>0){  alert("Incomplete Data");  }else{  f.submit();  }} 	</script> <script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.0.6"></script><link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.0.6" media="screen" /><script language="javascript">$(document).ready(function() {	$(".various").fancybox({		maxWidth	: 450,		maxHeight	: 410,		fitToView	: false,		autoSize	: false,		closeClick	: false,		openEffect	: 'none',		closeEffect	: 'none',		padding     : 0,		margin      : 0,	});}); function imagen(a,d,anchoi){	    var i='<img src="imagenes/g/' + a + '" class="textos_imagen"  width="' + anchoi + '" />';		//alert(i);		$(d).html(i);}$( document ).ready( function() {       $("a[rel='pop-up']").click(function () {           var caracteristicas = "scrollbars=yes,width=750,height=500,top=50, left=100";           nueva=window.open(this.href, 'Popup', caracteristicas);           return false;    });  $("a[rel='pop-up1']").click(function () {           var caracteristicas = "scrollbars=yes,width=520,height=550,top=50, left=100";           nueva=window.open(this.href, 'Popup', caracteristicas);           return false;    });     });  function verifica(f){	if(f.can.value<=0){	f.can.value=1;	f.valor.value=f.valor1.value;	}}function cambiap(opt){	var cpr="#pre" + opt;	$('#ref').val(opt);	$('#celadp').html("$" + $(cpr).val() + " USD");}</script>    </head><body><div id="contenedor">  <?php include_once('header.php'); ?>    <div id="contenido">    <div class="ruta_a1"><a href="<?php echo $anterior; ?>" class="boton" style="float:right">Return</a></div>        <div class="textos">     <?php $ip=explode("+",$rp->imagenp);			 $datos = getimagesize("imagenes/g/".$ip[0]);			 if($datos[0]>400){				 $ancho=400;			 }else{				$ancho=$datos[0];			 }			 ?>      <div class="destinos">       <div class="destino3">      		            <?php 			  $ni=count($ip)-1;				?>                <table width="610" style="float:right; margin-top:-3px">                <tr><td>                <script type="text/javascript">var fadeimages=new Array()//SET IMAGE PATHS. Extend or contract array as needed<?php if($ip[0]){?>fadeimages[0]=["./imagenes/g/<?php echo $ip[0]; ?>", "", ""] //imagen <?php } ?><?php if($ip[1]){?>fadeimages[1]=["./imagenes/g/<?php echo $ip[1]; ?>", "", ""] //imagen <?php } ?><?php if($ip[2]){?>fadeimages[2]=["./imagenes/g/<?php echo $ip[2]; ?>", "", ""] //imagen <?php } ?>var fadebgcolor=""////NO need to edit beyond here/////////////var fadearray=new Array() //array to cache fadeshow instancesvar fadeclear=new Array() //array to cache corresponding clearinterval pointersvar dom=(document.getElementById) //modern dom browsersvar iebrowser=document.allfunction fadeshow(theimages, fadewidth, fadeheight, borderwidth, delay, pause, displayorder){this.pausecheck=pausethis.mouseovercheck=0this.delay=delaythis.degree=10 //initial opacity degree (10%)this.curimageindex=0this.nextimageindex=1fadearray[fadearray.length]=thisthis.slideshowid=fadearray.length-1this.canvasbase="canvas"+this.slideshowidthis.curcanvas=this.canvasbase+"_0"if (typeof displayorder!="undefined")theimages.sort(function() {return 0.5 - Math.random();}) //thanks to Mike (aka Mwinter) :)this.theimages=theimagesthis.imageborder=parseInt(borderwidth)this.postimages=new Array() //preload imagesfor (p=0;p<theimages.length;p++){this.postimages[p]=new Image()this.postimages[p].src=theimages[p][0]}var fadewidth=fadewidth+this.imageborder*2var fadeheight=fadeheight+this.imageborder*2if (iebrowser&&dom||dom) //if IE5+ or modern browsers (ie: Firefox)document.write('<div id="master'+this.slideshowid+'" style="position:relative;width:'+fadewidth+'px;height:'+fadeheight+'px;overflow:hidden;"><div id="'+this.canvasbase+'_0" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);opacity:0.1;-moz-opacity:0.1;-khtml-opacity:0.1;background-color:'+fadebgcolor+'"></div><div id="'+this.canvasbase+'_1" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);opacity:0.1;-moz-opacity:0.1;-khtml-opacity:0.1;background-color:'+fadebgcolor+'"></div></div>')elsedocument.write('<div><img name="defaultslide'+this.slideshowid+'" src="'+this.postimages[0].src+'"></div>')if (iebrowser&&dom||dom) //if IE5+ or modern browsers such as Firefoxthis.startit()else{this.curimageindex++setInterval("fadearray["+this.slideshowid+"].rotateimage()", this.delay)}}function fadepic(obj){if (obj.degree<100){obj.degree+=10if (obj.tempobj.filters&&obj.tempobj.filters[0]){if (typeof obj.tempobj.filters[0].opacity=="number") //if IE6+obj.tempobj.filters[0].opacity=obj.degreeelse //else if IE5.5-obj.tempobj.style.filter="alpha(opacity="+obj.degree+")"}else if (obj.tempobj.style.MozOpacity)obj.tempobj.style.MozOpacity=obj.degree/101else if (obj.tempobj.style.KhtmlOpacity)obj.tempobj.style.KhtmlOpacity=obj.degree/100else if (obj.tempobj.style.opacity&&!obj.tempobj.filters)obj.tempobj.style.opacity=obj.degree/101}else{clearInterval(fadeclear[obj.slideshowid])obj.nextcanvas=(obj.curcanvas==obj.canvasbase+"_0")? obj.canvasbase+"_0" : obj.canvasbase+"_1"obj.tempobj=iebrowser? iebrowser[obj.nextcanvas] : document.getElementById(obj.nextcanvas)obj.populateslide(obj.tempobj, obj.nextimageindex)obj.nextimageindex=(obj.nextimageindex<obj.postimages.length-1)? obj.nextimageindex+1 : 0setTimeout("fadearray["+obj.slideshowid+"].rotateimage()", obj.delay)}}fadeshow.prototype.populateslide=function(picobj, picindex){var slideHTML=""if (this.theimages[picindex][1]!="") //if associated link exists for imageslideHTML='<a href="'+this.theimages[picindex][1]+'" target="'+this.theimages[picindex][2]+'">'slideHTML+='<img src="'+this.postimages[picindex].src+'" border="'+this.imageborder+'px">'if (this.theimages[picindex][1]!="") //if associated link exists for imageslideHTML+='</a>'picobj.innerHTML=slideHTML}fadeshow.prototype.rotateimage=function(){if (this.pausecheck==1) //if pause onMouseover enabled, cache objectvar cacheobj=thisif (this.mouseovercheck==1)setTimeout(function(){cacheobj.rotateimage()}, 100)else if (iebrowser&&dom||dom){this.resetit()var crossobj=this.tempobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)crossobj.style.zIndex++fadeclear[this.slideshowid]=setInterval("fadepic(fadearray["+this.slideshowid+"])",50)this.curcanvas=(this.curcanvas==this.canvasbase+"_0")? this.canvasbase+"_1" : this.canvasbase+"_0"}else{var ns4imgobj=document.images['defaultslide'+this.slideshowid]ns4imgobj.src=this.postimages[this.curimageindex].src}this.curimageindex=(this.curimageindex<this.postimages.length-1)? this.curimageindex+1 : 0}fadeshow.prototype.resetit=function(){this.degree=10var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)if (crossobj.filters&&crossobj.filters[0]){if (typeof crossobj.filters[0].opacity=="number") //if IE6+crossobj.filters(0).opacity=this.degreeelse //else if IE5.5-crossobj.style.filter="alpha(opacity="+this.degree+")"}else if (crossobj.style.MozOpacity)crossobj.style.MozOpacity=this.degree/101else if (crossobj.style.KhtmlOpacity)crossobj.style.KhtmlOpacity=this.degree/100else if (crossobj.style.opacity&&!crossobj.filters)crossobj.style.opacity=this.degree/101}fadeshow.prototype.startit=function(){var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)this.populateslide(crossobj, this.curimageindex)if (this.pausecheck==1){ //IF SLIDESHOW SHOULD PAUSE ONMOUSEOVERvar cacheobj=thisvar crossobjcontainer=iebrowser? iebrowser["master"+this.slideshowid] : document.getElementById("master"+this.slideshowid)crossobjcontainer.onmouseover=function(){cacheobj.mouseovercheck=1}crossobjcontainer.onmouseout=function(){cacheobj.mouseovercheck=0}}this.rotateimage()}//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause, optionalRandomOrder)new fadeshow(fadeimages, 612, 200, 0, 5000, 1, "R")</script>  </td></tr></table>        </div>    <div class="destinos_head1">        <div class="destino1">          	<table width="330" border="0" cellspacing="0" cellpadding="0">            <?php if($rp->precio>0){ ?>  <tr>    <td width="139">From</td>    </tr>  <tr>    <td class="precio1_num" >$<?php echo sprintf("%01.2f",$rp->precio); ?> USD</td>    </tr>    <?php } ?>  <tr>    <td><?php echo $rp->adicional; ?> days</td>    </tr></table>               </div>   	  <div class="destino2">         	<div class="tit" style="font-size:24px"><?php echo $rp->nombrep; ?></div>            <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook" style="cursor:pointer"></a><a class="addthis_button_twitter" style="cursor:pointer"></a><a class="addthis_button_email" style="cursor:pointer"></a><a class="addthis_button_google_plusone_share"></a><div class="destinos_head2">        <div class="destino5">         	<h2>RESERVATIONS</h2>            <?php if($_GET['in']==1){ ?>            <span class="ui-state-error-text" style="background-color:#000; padding:5px">                Reservation sent successfully             </span>            <?php } ?>        </div>   	  <div class="destino6">       <div class="moduloleft">        	<form id="fr" name="fr" method="post" action="reservar.php" >         <table border="0" align="center" cellpadding="1" cellspacing="1">        <tr>          <td>Name:            <input name="t" type="hidden" id="t" value="<?php echo $p; ?>" />            <input name="la" type="hidden" id="la" value="<?php echo $anterior; ?>" />            <input name="op" type="hidden" id="op" value="<?php echo $op; ?>" />            <br />            <input name="nom" type="text" class="cuadros" id="nom" /></td>          </tr>        <tr>          <td>City:<br />            <input name="ciu" type="text" class="cuadros" id="ciu" /></td>          </tr>        <tr>          <td>Phone: <br />            <input name="tel" type="text" class="cuadros" id="tel" /></td>          </tr>        <tr>          <td>E-Mail:<br />            <input name="ema" type="text" class="cuadros" id="ema" /></td>          </tr>        <tr>          <td>What date?:<br />            <input name="fec" type="text" class="cuadros" id="fec" readonly="readonly" /></td>          </tr>        <tr>          <td>Number of People<br />            <select name="np" class="cuadros" id="np">              <?php for($i=1;$i<=10;$i++){ ?>              <option value="<?php echo $i ?>"><?php echo $i ?></option>              <?php } ?>            </select></td>          </tr>        <tr>          <td valign="top">Comments:<br />            <textarea name="com" id="com" cols="20" rows="5"></textarea></td>          </tr>        <tr>          <td><iframe src="#" name="form-submission" id="form-submission" style="display: none;"></iframe></td>          </tr>        <tr>          <td align="center"><label>            <input type="button" name="button" id="button" value="RESERVE" class="moduloleft1_boton" onclick="valid(fr)" />          </label></td>          </tr>      </table>  	    </form>        </div>   	  </div>      <div class="destino6" style="margin-top:10px">       <?php if(file_exists('imagenes/g/'.$rp->mapa) and $rp->mapa!=''){ ?>        	<img src="imagenes/g/<?php echo $rp->mapa; ?>" />            <?php } ?>   	  </div>      	      </div></div><script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507e67b86e1b3f40"></script>                  </div>      </div>      <div class="destino4" ><?php echo $rp->descripcion; ?>   	</div>   	    </div></div>  <?php include_once('pie.php'); ?>  <div class="vacio"></div></div></div><div class="compra">Copyright 2013 EbusinessEcuador</div></body></html>
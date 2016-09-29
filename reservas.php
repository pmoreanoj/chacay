<?php 
include_once("conect.php");
include("Contador/contador.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script type="text/javascript" src="./js/codjs.js"></script>
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />


<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="slides/css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="slides/css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
    <link type="text/css" href="./fecha/css/jquery-ui-1.8.22.custom.css" rel="stylesheet" />
     <script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
	<script src="./fecha/js/jquery.ui.core.min.js"></script>
	<script src="./fecha/js/jquery.ui.widget.min.js"></script>
	<script src="./fecha/js/jquery.ui.datepicker.min.js"></script>
	<script src="./fecha/js/jquery.ui.datepicker-es.js"></script>
    <script>
	function ff(df){
	 document.getElementById(df).focus();
	}
	$(function() {
		$( "#fec" ).datepicker();
		$( "#fec" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
		$( "#fec" ).datepicker();
		$( "#fec" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
	});
function valid(f){
var msj="";
var nc=0;
//bucle for paso 16 para saber el total campos
	for(i=0; i<f.length; i++){
	//si el elemento definido en la array formulario esta vacio...
		if(f.elements[i].value == "" && f.elements[i].name != "com"){
			f.elements[i].style.backgroundColor = '#f96';
			nc=1;
		}else{
		   f.elements[i].style.backgroundColor = '';
		}
	}	
  if(nc>0){
  alert("Incomplete Data");
  }else{
  f.submit();
  }
} 
	</script>
    
    <script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</head>

<body>
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">	
   <div class="ruta_a"><a href="index.php">Home</a> &gt;</div>
    <div class="animacion">    </div>
    <div id="contenido_right">
    <div class="textos"> 
         <form id="fr" name="fr" method="post" action="reservar1.php" >
         
           <table width="500" border="0" align="center" cellpadding="1" cellspacing="1" style="border: solid 1px #333">
        <tr>
          <td colspan="2"><?php if($_GET['in']==1){ ?>
            <span class="ui-state-error-text" style="background-color:#000; padding:5px">Information sent successfully </span>
            <?php } ?></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><h2>Please complete the following information</h2></td>
          </tr>
          <?php if($_POST['des']){ ?>
          <tr>
          <td align="right"><strong>My Package:</strong></td>
          <td><?php echo $_POST['des']; ?>
            <input name="des" type="hidden" id="des" value="<?php echo $_POST['des']; ?>" /></td>
          </tr>
          <?php }else{ ?>
        <tr>
          <td align="right" valign="top"><strong>Region:</strong></td>
          <td>
          <?php 
		  for($i=1;$i<=4;$i++){
			  if($_POST['reg'.$i]){
			  $reg.=$_POST['reg'.$i].",";
			  }
		  }
		  echo $reg;?>
            <input name="reg" type="hidden" id="reg" value="<?php echo $reg; ?>" />
          <?php echo $_POST['reg']; ?></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Travel Interest:</strong></td>
          <td>
          <?php 
		  for($i=1;$i<=30;$i++){
			  if($_POST['int'.$i]){
			  $tin.=$_POST['int'.$i].",";
			  }
		  }
		  echo $tin; ?>
            <input name="tin" type="hidden" id="tin" value="<?php echo $tin; ?>" />
          </td>
        </tr>
        <tr>
          <td align="right"><strong>Price Range:</strong></td>
          <td><?php echo $_POST['prec']; ?>
            <input name="prec" type="hidden" id="prec" value="<?php echo $_POST['prec']; ?>" />
          </td>
        </tr>
        <?php }//fin de if($_POST['des']){ ?>
        <tr>
          <td align="right"><strong>Name:
            <br />
          </strong></td>
          <td><input name="nom" type="text" class="cuadros" id="nom" /></td>
          </tr>
        <tr>
          <td align="right"><strong>City:<br />
          </strong></td>
          <td><input name="ciu" type="text" class="cuadros" id="ciu" /></td>
          </tr>
          <tr>
          <td align="right"><strong>E-Mail:<br />
          </strong></td>
          <td><input name="ema" type="text" class="cuadros" id="ema" /></td>
          </tr>
        <tr>
          <td align="right"><strong>Phone: <br />
          </strong></td>
          <td><input name="tel" type="text" class="cuadros" id="tel" /></td>
          </tr>
        
        <tr>
          <td align="right"><strong>What date?
          </strong></td>
          <td><?php echo $_POST['fec']; ?><input name="fec" type="hidden" id="fec" value="<?php echo $_POST['fec']; ?>" /></td>
          </tr>
        <tr>
          <td align="right" nowrap="nowrap"><strong>Number of People
          </strong></td>
          <td><?php echo $_POST['np']; ?><input name="np" type="hidden" id="np" value="<?php echo $_POST['np']; ?>" /></td>
          </tr>
        <tr>
          <td align="right" valign="top"><strong>Number of days</strong></td>
          <td valign="top"><?php echo $_POST['dias']; ?><input name="dias" type="hidden" id="dias" value="<?php echo $_POST['dias']; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Comments:
          </strong></td>
          <td valign="top"><textarea name="com" id="com" cols="20" rows="5"></textarea></td>
          </tr>
        <tr>
          <td align="right"><iframe src="#" name="form-submission" id="form-submission" style="display: none;"></iframe></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input type="button" name="button" id="button" value="SEND" class="moduloleft1_boton" onclick="valid(fr)" />
          </label></td>
          </tr>
      </table>
  	    </form>

      </div>
    </div></div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>
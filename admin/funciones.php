<?php
include_once("../conect.php");
$vop=$_POST['op'];
$vid=$_POST['id'];
$mes=array("Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic.");
if($vop==1){//formulario de fechas
 if($vid>0){//si  tiene fechas
 for($i=1;$i<=$vid;$i++){
?>
<script language="javascript">
$(function() {
		$( "#fs<?php echo $i; ?>" ).datepicker();
		$( "#fs<?php echo $i; ?>" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
		$( "#fr<?php echo $i; ?>" ).datepicker();
		$( "#fr<?php echo $i; ?>" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
	});
</script>
<table border="0" align="center" cellpadding="2" cellspacing="2" style="margin-bottom:5px; background-color:#CCC">
              <tr>
                <td><strong>Fecha Salida <?php echo $i; ?>:</strong></td>
                <td><label>
                  <input name="fs<?php echo $i; ?>" type="text" id="fs<?php echo $i; ?>" size="20" maxlength="20" readonly="readonly"><a href="Javascript:ff('fs<?php echo $i; ?>')"><img src="../imagenes/calendar.png" border="0" align="absmiddle"></a>
                </label></td>
                <td><strong>Fecha de Retorno <?php echo $i; ?>:</strong></td>
                <td><label>
                  <input name="fr<?php echo $i; ?>" type="text" id="fr<?php echo $i; ?>" size="20" maxlength="20" readonly="readonly">
                 <a href="Javascript:ff('fr<?php echo $i; ?>')"><img src="../imagenes/calendar.png" border="0" align="absmiddle"></a> </label>
                </td>
                </tr>
                <tr>
                <td colspan="2" align="right"><strong>N&uacute;mero de Hoteles</strong></td>
                <td colspan="2"><select name="nh<?php echo $i; ?>" id="nh<?php echo $i; ?>" onchange="hoteles(this.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>')">
                <option value="">---</option>
                  <?php 
			  for($j=1;$j<=5;$j++){
			  ?>
                  <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                  <?php } ?>
                </select></td>
                </tr>
              <tr>
                <td colspan="4"><div id="dh<?php echo $i ?>"></div>
                </td>
                </tr>
            </table>
            <?php }//find e for for($i=0;$i<=$vid;$i++){ 
			}elseif($vid=='0'){////si NO tiene fechas
				$i=1;
			?>
<table border="0" align="center" cellpadding="2" cellspacing="2" style="margin-bottom:5px; background-color:#CCC">
                <tr>
                <td align="right"><strong>N&uacute;mero de Hoteles</strong></td>
                <td colspan="2"><select name="nh<?php echo $i; ?>" id="nh<?php echo $i; ?>" onchange="hoteles(this.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>')">
                <option value="">---</option>
                  <?php 
			  for($j=1;$j<=5;$j++){
			  ?>
                  <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                  <?php } ?>
                </select></td>
                </tr>
              <tr>
                <td colspan="3"><div id="dh<?php echo $i ?>"></div>
                </td>
                </tr>
            </table>
            <?php }//fin de if($vid==0){//si tiene fechas ?>
            
<?php }elseif($vop==2){//datos de hoteles 
$vnf=$_POST['idf'];//identificador de fecha para hoteles
 for($i=1;$i<=$vid;$i++){
?>
<table border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#666666" style="margin-bottom:5px">
                  <tr>
                    <td colspan="4" bgcolor="#F4F4F4"><strong>Hotel <?php echo $i; ?></strong>:
<label>
                        <input name="hot<?php echo $i; ?>_<?php echo $vnf ?>" type="text" id="hot<?php echo $i; ?>_<?php echo $vnf ?>" size="40" maxlength="50">
                      </label>
</td>
                    </tr>
                  <tr>
                    <td bgcolor="#F4F4F4"><strong>Habitaci&oacute;n</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Precio Adultos</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Precio Ni&ntilde;os</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Disponibles</strong></td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4"><strong><input name="hs<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="hs<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos(this,'#cpas<?php echo $i; ?>_<?php echo $vnf ?>','pas<?php echo $i; ?>_<?php echo $vnf ?>','#cpns<?php echo $i; ?>_<?php echo $vnf ?>','pns<?php echo $i; ?>_<?php echo $vnf ?>','#cdis<?php echo $i; ?>_<?php echo $vnf ?>','dis<?php echo $i; ?>_<?php echo $vnf ?>')">
                      <em>Simple</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpas<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cpns<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cdis<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4"><strong><input name="hd<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="hd<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos(this,'#cpad<?php echo $i; ?>_<?php echo $vnf ?>','pad<?php echo $i; ?>_<?php echo $vnf ?>','#cpnd<?php echo $i; ?>_<?php echo $vnf ?>','pnd<?php echo $i; ?>_<?php echo $vnf ?>','#cdid<?php echo $i; ?>_<?php echo $vnf ?>','did<?php echo $i; ?>_<?php echo $vnf ?>')">
                      <em>Doble</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpad<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cpnd<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cdid<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4"><strong><input name="ht<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="ht<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos(this,'#cpat<?php echo $i; ?>_<?php echo $vnf ?>','pat<?php echo $i; ?>_<?php echo $vnf ?>','#cpnt<?php echo $i; ?>_<?php echo $vnf ?>','pnt<?php echo $i; ?>_<?php echo $vnf ?>','#cdit<?php echo $i; ?>_<?php echo $vnf ?>','dit<?php echo $i; ?>_<?php echo $vnf ?>')">
                      <em>Triple</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpat<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cpnt<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                    <td align="center" bgcolor="#F4F4F4" id="cdit<?php echo $i; ?>_<?php echo $vnf ?>">&nbsp;</td>
                  </tr>
                </table>
              <?php }//fin de for ?>  
<?php
}elseif($vop==3){//hoteles para cotizador
$vf=$_POST['f'];
$sql=mysql_query("SELECT distinct(hotel) from detalleproductos where fechas='".$vf."' and codp=".$vid." and unidades>0 and otros=0");
//echo utf8_encode($rr->regreso); 
?>
<select name="chotel" id="chotel" class="cuadro1" onchange="choteles('<?php echo $vid; ?>','#dchabi','<?php echo $vf; ?>',this.value)">
<option value="">--------</option>
   <?php while($rr=mysql_fetch_object($sql)){ ?>
    <option value="<?php echo $rr->hotel; ?>"><?php echo $rr->hotel; ?></option>
    <?php } ?>
    </select>
<?php  }elseif($vop==4){//datos habitaciones hotel 
  $vf=$_POST['f'];
  $vh=$_POST['h'];
$sql=mysql_query("SELECT coddp,habitacion from detalleproductos where fechas='".$vf."' and hotel='".$vh."' and codp=".$vid." and unidades>0 and otros=0");
//echo utf8_encode($rr->regreso); 
?>
<select name="chabi" id="chabi" class="cuadro1" onchange="cprecios(this.value,'#dprecio')">
<option value="">--------</option>
   <?php while($rr=mysql_fetch_object($sql)){ ?>
    <option value="<?php echo $rr->coddp; ?>"><?php echo $rr->habitacion; ?></option>
    <?php } ?>
    </select>
<?php }elseif($vop==5){//precios 
$sql=mysql_query("SELECT * from detalleproductos where coddp=".$vid);
$rr=mysql_fetch_object($sql);
//echo utf8_encode($rr->regreso); 
?>
<br />Adultos:<select name="cadu" id="cadu" class="cuadro1" onchange="bcalcula()" style="width:40px">
    <option value="">--------</option>
    <?php 
	if($rr){
	for($i=1;$i<=10;$i++){ ?>
    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php } 
	}// fin de if($rr){?>
    </select>Ni&ntilde;os<select name="cni" id="cni" class="cuadro1" onchange="bcalcula()" style="width:40px">
    <option value="">--------</option>
    <?php 
	if($rr){
	for($i=1;$i<=10;$i++){ ?>
    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php }
	}// fin de if($rr){
	 ?>
    </select>
    <input name="precioa" id="precioa" type="hidden" value="<?php echo $rr->precioa; ?>" />
    <input name="precion" id="precion" type="hidden" value="<?php echo $rr->precion; ?>" />
    <input name="paquete" id="paquete" type="hidden" value="<?php echo $vid; ?>" />
<?php 
}elseif($vop==6){//fechas en actualizacion 
$idp=$_POST['vp'];
$sqlf=mysql_query("SELECT distinct(fechas),fechar from detalleproductos where codp=".$idp." order by coddp");
$j=1;
while($rf=mysql_fetch_object($sqlf)){
	$f[$j]=$rf;
	$j=$j+1;
}
if($vid>0){//si  tiene fechas
for($i=1;$i<=$vid;$i++){
?>

<script language="javascript">
$(function() {
		$( "#fs<?php echo $i; ?>" ).datepicker();
		$( "#fs<?php echo $i; ?>" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
		$( "#fr<?php echo $i; ?>" ).datepicker();
		$( "#fr<?php echo $i; ?>" ).datepicker( "option", "minDate", '<?php echo date('d/m/Y'); ?>' );
	});
</script>
<table border="0" align="center" cellpadding="2" cellspacing="2" style="margin-bottom:5px; background-color:#CCC">
              <tr>
                <td><strong>Fecha Salida <?php echo $i; ?>:</strong></td>
                <td><label>
                  <input name="fs<?php echo $i; ?>" type="text" id="fs<?php echo $i; ?>" value="<?php echo $f[$i]->fechas; ?>" size="20" maxlength="20" readonly="readonly"><a href="Javascript:ff('fs<?php echo $i; ?>')"><img src="../imagenes/calendar.png" border="0" align="absmiddle"></a>
                </label></td>
                <td><strong>Fecha de Retorno <?php echo $i; ?>:</strong></td>
                <td><label>
                  <input name="fr<?php echo $i; ?>" type="text" id="fr<?php echo $i; ?>" size="20" maxlength="20" value="<?php echo $f[$i]->fechar; ?>" readonly="readonly">
                 <a href="Javascript:ff('fr<?php echo $i; ?>')"><img src="../imagenes/calendar.png" border="0" align="absmiddle"></a> </label>
                </td>
                </tr>
                <tr>
                <td colspan="2" align="right"><strong>N&uacute;mero de Hoteles</strong></td>
                <td colspan="2">
                <?php 
$nh=mysql_num_rows(mysql_query("SELECT distinct(hotel) from detalleproductos where fechas='".$f[$i]->fechas."' and codp=".$idp." order by coddp")); ?>
                <select name="nh<?php echo $i; ?>" id="nh<?php echo $i; ?>" onchange="hoteles_a(this.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>','<?php echo $idp; ?>','<?php echo $f[$i]->fechas; ?>')">
                <option value="">---</option>
                  <?php 
			  for($j=1;$j<=5;$j++){
			  ?>
                  <option value="<?php echo $j; ?>" <?php if($nh==$j){?>selected<?php } ?>><?php echo $j; ?></option>
                  <?php } ?>
                </select></td>
                </tr>
              <tr>
                <td colspan="4"><div id="dh<?php echo $i ?>"></div>
                <script language="javascript">
				hoteles_a(document.form1.nh<?php echo $i; ?>.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>','<?php echo $idp; ?>','<?php echo $f[$i]->fechas; ?>')
				</script>
                </td>
                </tr>
            </table>
            <?php }//find e for for($i=0;$i<=$vid;$i++){ 
			}elseif($vid=='0'){//No  tiene fechas
			$i=1;
			?>
            <table border="0" align="center" cellpadding="2" cellspacing="2" style="margin-bottom:5px; background-color:#CCC">
                <tr>
                <td align="right"><strong>N&uacute;mero de Hoteles</strong></td>
                <td colspan="2">
                <?php 
$nh=mysql_num_rows(mysql_query("SELECT distinct(hotel) from detalleproductos where fechas='".$f[$i]->fechas."' and codp=".$idp." order by coddp")); ?>
                <select name="nh<?php echo $i; ?>" id="nh<?php echo $i; ?>" onchange="hoteles_a(this.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>','<?php echo $idp; ?>','<?php echo $f[$i]->fechas; ?>')">
                <option value="">---</option>
                  <?php 
			  for($j=1;$j<=5;$j++){
			  ?>
                  <option value="<?php echo $j; ?>" <?php if($nh==$j){?>selected<?php } ?>><?php echo $j; ?></option>
                  <?php } ?>
                </select></td>
                </tr>
              <tr>
                <td colspan="3"><div id="dh<?php echo $i ?>"></div>
                <script language="javascript">
				hoteles_a(document.form1.nh<?php echo $i; ?>.value,'#dh<?php echo $i; ?>','<?php echo $i; ?>','<?php echo $idp; ?>','<?php echo $f[$i]->fechas; ?>')
				</script>
                </td>
                </tr>
            </table>
            
            <?php }//fin de if($vid>0){//si  tiene fechas ?>

<?php 
}elseif($vop==7){//hoteles en actualizacion
$vnf=$_POST['idf'];//identificador de fecha para hoteles
$idp=$_POST['vp'];//identificador paquete
$vf=$_POST['vf'];//fecha para recuperar datos de hoteles actualizacion
$sqlh=mysql_query("SELECT distinct(hotel) from detalleproductos where fechas='".$vf."' and codp=".$idp." order by coddp");
$j=1;
while($rh=mysql_fetch_object($sqlh)){
	$h[$j]=$rh;
	$j=$j+1;
}
 for($i=1;$i<=$vid;$i++){
?>
<table border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#666666" style="margin-bottom:5px">
                  <tr>
                    <td colspan="4" bgcolor="#F4F4F4"><strong>Hotel <?php echo $i; ?></strong>:
<label>
                        <input name="hot<?php echo $i; ?>_<?php echo $vnf ?>" type="text" id="hot<?php echo $i; ?>_<?php echo $vnf ?>" size="40" maxlength="50" value="<?php echo $h[$i]->hotel; ?>">
                      </label>
</td>
                    </tr>
                  <tr>
                    <td bgcolor="#F4F4F4"><strong>Habitaci&oacute;n</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Precio Adultos</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Precio Ni&ntilde;os</strong></td>
                    <td bgcolor="#F4F4F4"><strong>Disponibles</strong></td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4">
                    <?php $sqlhs=mysql_fetch_object(mysql_query("SELECT coddp,precioa,precion,unidades from detalleproductos where fechas='".$vf."' and hotel='".$h[$i]->hotel."' and codp=".$idp." and habitacion='Simple'")); ?>
                    <strong><input name="hs<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="hs<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos_a(this,'#cpas<?php echo $i; ?>_<?php echo $vnf ?>','pas<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhs->precioa; ?>','#cpns<?php echo $i; ?>_<?php echo $vnf ?>','pns<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhs->precion; ?>','#cdis<?php echo $i; ?>_<?php echo $vnf ?>','dis<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhs->unidades; ?>')" <?php if($sqlhs->coddp){ ?>checked="checked"<?php } ?>>
                      <em>Simple</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpas<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlhs->coddp){ ?>
                    <input type="text" id="pas<?php echo $i; ?>_<?php echo $vnf ?>"  name="pas<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhs->precioa; ?>"  />
                    <?php } ?>
                    </td>
                    <td align="center" bgcolor="#F4F4F4" id="cpns<?php echo $i; ?>_<?php echo $vnf ?>">
					<?php if($sqlhs->coddp){ ?>
                    <input type="text" id="pns<?php echo $i; ?>_<?php echo $vnf ?>"  name="pns<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhs->precion; ?>"  />
                    <?php } ?></td>
                    <td align="center" bgcolor="#F4F4F4" id="cdis<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlhs->coddp){ ?>
                    <input type="text" id="dis<?php echo $i; ?>_<?php echo $vnf ?>"  name="dis<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhs->unidades; ?>"  />
                    <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4">
                     <?php $sqlhd=mysql_fetch_object(mysql_query("SELECT coddp,precioa,precion,unidades from detalleproductos where fechas='".$vf."' and hotel='".$h[$i]->hotel."' and codp=".$idp." and habitacion='Doble'")); ?>
                    <strong><input name="hd<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="hd<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos_a(this,'#cpad<?php echo $i; ?>_<?php echo $vnf ?>','pad<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhd->precioa; ?>','#cpnd<?php echo $i; ?>_<?php echo $vnf ?>','pnd<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhd->precion; ?>','#cdid<?php echo $i; ?>_<?php echo $vnf ?>','did<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlhd->unidades; ?>')" <?php if($sqlhd->coddp){ ?>checked="checked"<?php } ?>>
                      <em>Doble</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpad<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlhd->coddp){ ?>
                    <input type="text" id="pad<?php echo $i; ?>_<?php echo $vnf ?>"  name="pad<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhd->precioa; ?>"  />
                    <?php } ?>
                    </td>
                    <td align="center" bgcolor="#F4F4F4" id="cpnd<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlhd->coddp){ ?>
                    <input type="text" id="pnd<?php echo $i; ?>_<?php echo $vnf ?>"  name="pnd<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhd->precion; ?>"  />
                    <?php } ?>
                    </td>
                    <td align="center" bgcolor="#F4F4F4" id="cdid<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlhd->coddp){ ?>
                    <input type="text" id="did<?php echo $i; ?>_<?php echo $vnf ?>"  name="did<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlhd->unidades; ?>"  />
                    <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#F4F4F4">
                    <?php $sqlht=mysql_fetch_object(mysql_query("SELECT coddp,precioa,precion,unidades from detalleproductos where fechas='".$vf."' and hotel='".$h[$i]->hotel."' and codp=".$idp." and habitacion='Triple'")); ?>
                    <strong><input name="ht<?php echo $i; ?>_<?php echo $vnf ?>" type="checkbox" id="ht<?php echo $i; ?>_<?php echo $vnf ?>" value="1" onClick="AgregarCampos_a(this,'#cpat<?php echo $i; ?>_<?php echo $vnf ?>','pat<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlht->precioa; ?>','#cpnt<?php echo $i; ?>_<?php echo $vnf ?>','pnt<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlht->precion; ?>','#cdit<?php echo $i; ?>_<?php echo $vnf ?>','dit<?php echo $i; ?>_<?php echo $vnf ?>','<?php echo $sqlht->unidades; ?>')" <?php if($sqlht->coddp){ ?>checked="checked"<?php } ?>>
                      <em>Triple</em></strong></td>
                    <td align="center" bgcolor="#F4F4F4" id="cpat<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlht->coddp){ ?>
                    <input type="text" id="pat<?php echo $i; ?>_<?php echo $vnf ?>"  name="pat<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlht->precioa; ?>"  />
                    <?php } ?>
                    </td>
                    <td align="center" bgcolor="#F4F4F4" id="cpnt<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlht->coddp){ ?>
                    <input type="text" id="pnt<?php echo $i; ?>_<?php echo $vnf ?>"  name="pnt<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlht->precion; ?>"  />
                    <?php } ?>
                    </td>
                    <td align="center" bgcolor="#F4F4F4" id="cdit<?php echo $i; ?>_<?php echo $vnf ?>">
                    <?php if($sqlht->coddp){ ?>
                    <input type="text" id="dit<?php echo $i; ?>_<?php echo $vnf ?>"  name="dit<?php echo $i; ?>_<?php echo $vnf ?>" size="5" maxlength="10" value="<?php echo $sqlht->unidades; ?>"  />
                    <?php } ?>
                    </td>
                  </tr>
                </table>
              <?php }//fin de for ?>  
 <?php 
}elseif($vop==8){//enviar mail de cotizacion y guardar en bd
$va=$_POST['va'];//adultos
$vn=$_POST['vn'];//ni�os
$vno=$_POST['vno'];//cliente
$ve=$_POST['ve'];//email
$vc=$_POST['vc'];//ciudad
$vt=$_POST['vt'];//telefono
$rp=mysql_fetch_object(mysql_query("select * from productos p, detalleproductos dp where dp.coddp=".$vid." and dp.codp=p.codp"));
$valor=round(($va*$rp->precioa + $vn*$rp->precion),2);
$fs=explode("/",$rp->fechas);
$fr=explode("/",$rp->fechar);
    //mail de cotizacion
	$cuerpo='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gift Viajes</title>
</head>
<body>
<table width="400" border="0" align="center" cellpadding="3" cellspacing="0" style="border:solid 1px #000066; text-align: center;">
  <tr>
    <td width="120" bgcolor="#BDDDF0"><img src="http://www.comprasegura.com.ec/maxitravel/imagenes/logo.png" width="112" height="56" /></td>
  </tr>
  <tr>
    <td><table width="350" border="0" align="center" cellpadding="1" cellspacing="2">
      <tr>
        <td colspan="2">Cotizaci&oacute;n realizada:</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="120" style="text-align: right; font-weight: bold;">Nombre:</td>
        <td style="text-align: left">'.$vno.'</td>
      </tr>
	  <tr>
        <td width="120" style="text-align: right; font-weight: bold;">Ciudad:</td>
        <td style="text-align: left">'.$vc.'</td>
      </tr>
	  <tr>
        <td width="120" style="text-align: right; font-weight: bold;">Tel&eacute;fono:</td>
        <td style="text-align: left">'.$vt.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">E-Mail:</td>
        <td style="text-align: left">'.$ve.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">Paquete</td>
        <td style="text-align: left">'.$rp->nombrep.'</td>
      </tr>';
	  if($rp->fechas!=''){
      $cuerpo.='<tr>
        <td style="text-align: right; font-weight: bold;">Fecha de Salida</td>
        <td style="text-align: left">'.$mes[$fs[1]-1].' '.$fs[0].' - '.$mes[$fr[1]-1].' '.$fr[0].'</td>
      </tr>';
	  }
      $cuerpo.='<tr>
        <td style="text-align: right; font-weight: bold;">Hotel</td>
        <td style="text-align: left">'.$rp->hotel.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">Habitaci&oacute;n</td>
        <td style="text-align: left">'.$rp->habitacion.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">No. Adultos</td>
        <td style="text-align: left">'.$va.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">No. Ni&ntilde;os</td>
        <td style="text-align: left">'.$vn.'</td>
      </tr>
      <tr>
        <td style="text-align: right; font-weight: bold;">Valor Cotizado</td>
        <td bgcolor="#BDDDF0" style="text-align: left">$'.$valor.' USD</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#003"><em>www.giftviajes.com</em></td>
  </tr>
</table>
</body>
</html>';
	// Para enviar correo HTML, la cabecera Content-type debe definirse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
		   $cabeceras .= 'From: Gift Viajes <info@giftviajes.com>' . "\r\n";
		 // Enviamos el mensaje por e-mail
			@mail($ve, 'Cotizacion Gift Viajes', $cuerpo,$cabeceras);
			@mail('ivan@giftviajes.com', 'Cotizacion Gift Viajes Realizada', $cuerpo,$cabeceras);
	mysql_query("insert into cotizaciones values('','$vno','$vc','$vt','$ve','".$rp->nombrep."','".$mes[$fs[1]-1].' '.$fs[0].' - '.$mes[$fr[1]-1].' '.$fr[0]."','".$rp->hotel."','".$rp->habitacion."','$va','$vn','$valor',Now())");		
	//echo "Aprobado:". $valor;
 ?> 
 <?php }elseif($vop==9){//actualiza bloqueo de paquete
  $rowp=mysql_fetch_object(mysql_query("select * from detalleproductos where coddp=".$vid));
  if($rowp->otros==0){//bloquear
	  mysql_query("update detalleproductos set otros=1 where coddp=".$vid);
	  echo '<a href="Javascript:bloqueo(\'#db'.$vid.'\',\''.$vid.'\')" class="link1"><img src="../imagenes/accept_green.png" alt="Desbloquear Paquete" border="0" title="Desbloquear Paquete">Desbloquear</a>';
  }
  if($rowp->otros==1){//desbloquear
	  mysql_query("update detalleproductos set otros=0 where coddp=".$vid);
	  echo '<a href="Javascript:bloqueo(\'#db'.$vid.'\',\''.$vid.'\')" class="link1"><img src="../imagenes/delete.gif" alt="Bloquear" border="0" title="Bloquear Paquete">Bloquear</a>';
  }
 ?>
<?php }elseif($vop==10){//carga formulario nuevo cliente en creacion campa�a 
		 if($vid==0){ ?>
         <table border="0" cellpadding="1" cellspacing="1">
                            <tr>
                              <td class="col_iz"><strong>RUC:</strong></td>
                              <td><input name="cruc" type="text" class="fila_a" id="cruc" size="20" maxlength="20" />
                                *</td>
                            </tr>
                            <tr>
                              <td class="col_iz"><strong>Empresa:</strong></td>
                              <td><input name="cemp" type="text" class="fila_a" id="cemp" size="50" maxlength="100" />
                                *</td>
                            </tr>
                            <tr>
                              <td class="col_iz"><strong>Personer&iacute;a:</strong></td>
                              <td><select name="ctip" class="fila_a" id="ctip">
                                <option value="">-----</option>
                                <option value="Juridica">Juridica</option>
                                <option value="Natural">Natural</option>
                              </select>
                                * </td>
                            </tr>
                            <tr>
                              <td class="col_iz"><strong>Ciudad:</strong></td>
                              <td><input name="cciu" type="text" class="fila_a" id="cciu" size="20" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td class="col_iz"><strong>Direcci&oacute;n:</strong></td>
                              <td><input name="cdir" type="text" class="fila_a" id="cdir" size="50" maxlength="100" />
                                *</td>
                            </tr>
                            <tr>
                              <td class="col_iz"><strong>Tel&eacute;fono:</strong></td>
                              <td><input name="ctel" type="text" class="fila_a" id="ctel" size="50" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td valign="top" class="col_iz">Nombre Representante:</td>
                              <td><input name="cnomr" type="text" class="fila_a" id="cnomr" size="50" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td valign="top" class="col_iz"><strong>E-Mail Representante:</strong></td>
                              <td><input name="cemar" type="text" class="fila_a" id="cemar" size="50" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td valign="top" class="col_iz">Nombre Contacto</td>
                              <td><input name="cnomc" type="text" class="fila_a" id="cnomc" size="50" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td valign="top" class="col_iz">E-Mail Contacto</td>
                              <td><input name="cemac" type="text" class="fila_a" id="cemac" size="50" maxlength="50" />
                                *</td>
                            </tr>
                            <tr>
                              <td valign="top" class="col_iz"><strong>Observaciones:</strong></td>
                              <td><textarea name="cobs" cols="40" rows="3" class="fila_a" id="cobs"></textarea></td>
                            </tr>
                          </table>
			 
             
<?php	  }else{
	      echo '';
          }//fin de if($vid==0){
?>
<?php }elseif($vop==11){//carga formulario viaticos de actualizacion
		 ?>
         <?php if($vid=='Si'){ 
		 $rv=mysql_fetch_object(mysql_query("select * from viaticos where idca=".$_POST['c']));
		 ?>
  <table border="0" cellspacing="0" cellpadding="1">
    <tr>
      <td><strong>Numero de D&iacute;as:</strong></td>
      <td><input name="ndi" type="text" class="fila_a" id="ndi" value="<?php echo $rv->dias; ?>" size="10" maxlength="10" />
      *</td>
    </tr>
    <tr>
      <td><strong>Lugar:</strong></td>
      <td><input name="lug" type="text" class="fila_a" id="lug" value="<?php echo $rv->lugar; ?>" size="30" maxlength="100" />
      *</td>
    </tr>
    <tr>
      <td><strong>Valor Transporte:</strong></td>
      <td><input name="vtr" type="text" class="fila_a" id="vtr" value="<?php echo $rv->transporte; ?>" size="10" maxlength="10" />
      *</td>
    </tr>
    <tr>
      <td><strong>Valor Movilizaci&oacute;n:</strong></td>
      <td><input name="vmo" type="text" class="fila_a" id="vmo" value="<?php echo $rv->movilizacion; ?>" size="10" maxlength="10" />
      *</td>
    </tr>
    <tr>
      <td><strong>Valor Hospedaje:</strong></td>
      <td><input name="vho" type="text" class="fila_a" id="vho" value="<?php echo $rv->hospedaje; ?>" size="10" maxlength="10" />
      *</td>
    </tr>
    <tr>
      <td><strong>Valor Alimentaci&oacute;n:</strong></td>
      <td><input name="val" type="text" class="fila_a" id="val" value="<?php echo $rv->alimentacion; ?>" size="10" maxlength="10" />
      *</td>
    </tr>
    <tr>
      <td><strong>Extras:</strong></td>
      <td><input name="ext" type="text" class="fila_a" id="ext" value="<?php echo $rv->extra; ?>" size="10" maxlength="10" /></td>
    </tr>
  </table>
  <?php }else{
							echo "";
						} ?>
<?php }else{ ?>
<?php } ?>
<div class="moduloleft">
<h2>WHERE DO YOU WANT TO GO?</h2>
            <form action="reservas.php" method="post" name="fpedido" id="fpedido"  >
              <table width="230" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="150" height="30">Regions</td>
                        <td width="161" height="30"><input name="r" type="hidden" id="r" value="0" /></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2"><table width="97%" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr>
                              <td><label>
                                <input name="reg1" type="checkbox" id="reg1" value="Amazon&iacute;a" onclick="cuenta(this,'#r')" />
                                Amazon&iacute;a</label></td>
                          </tr>
                            <tr>
                              <td><label>
                                <input name="reg2" type="checkbox" id="reg2" value="Gal&aacute;pagos" />
                                Gal&aacute;pagos</label></td>
                            </tr>
                            
                            <tr>
                              <td><label>
                                <input name="reg3" type="checkbox" id="reg3" value="Sierra" />
                                Sierra</label></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2">Travel Interest</td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2"><table width="97%" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><label>
                              <input name="int1" type="checkbox" id="int1" value="Adventure" onclick="muestra_sb('#sm1','#int1')" />
                            Adventure</label>
                            <div id="sm1"></div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int5" type="checkbox" id="int5" value="Bird watching" />
                            Bird watching</label></td>
                          </tr>
                          
                          <tr>
                            <td><label><input name="int6" type="checkbox" id="int6" value="Connoisseur by Interest" onclick="muestra_sb('#sm2','#int6')" />
                            Connoisseur by Interest</label><div id="sm2"></div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int10" type="checkbox" id="int10" value="Encuentros 2013" onclick="muestra_sb('#sm3','#int10')" />
                            Encuentros 2013</label><div id="sm3"> </div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int13" type="checkbox" id="int13" value="Enchanted Isles" onclick="muestra_sb('#sm4','#int13')" />
                            Enchanted Isles</label><div id="sm4"></div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int16" type="checkbox" id="int16" value="Andes" onclick="muestra_sb('#sm5','#int16')" />
                            Andes</label><div id="sm5"></div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int19" type="checkbox" id="int19" value="Oriente: Amazonia" onclick="muestra_sb('#sm6','#int19')" />
Oriente: Amazonia</label><div id="sm6"></div></td>
                          </tr>
                          <tr>
                            <td><label><input name="int22" type="checkbox" id="int22" value="Volunteers and Entrepreneurs" />
                            Volunteers and Entrepreneurs</label></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="25">Price Range</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="25"colspan="2"><select name="prec" id="prec" style="width:210px">
                        <option value=""><--select--></option>
                        <option name="$200 or less per day">$200 or less per day</option>
                        <option name="$200 to $300 per day">$200 to $300 per day</option>
                        <option name="$300 to $400 per day">$300 to $400 per day</option>
                        <option name="$400 or more per da">$400 or more per day</option>
                        </select>
                        </td>
                      </tr>
                      <tr>
                      <td>What date?</td>
          <td><input name="fec" type="text" class="cuadros" id="fec" size="10" readonly="readonly" /></td>
          </tr>
          <tr>
                        <td>Number of days</td>
                        <td><label>
                          <select name="dias" class="cuadros" id="dias">
                            <?php for($i=1;$i<=30;$i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                          </select>
        </label></td>
                </tr>
                <tr>
          <td>Number of People</td>
          <td><select name="np" class="cuadros" id="np">
            <?php for($i=1;$i<=10;$i++){ ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php } ?>
          </select></td>
                      </tr>
                      <tr>
                        <td height="25"colspan="2" align="center">
                        	<input name="botonbuscar" type="button" class="moduloleft1_boton" value="Request" size="35px" onclick="valid(fpedido)" />
                        </td>
                        	
                   </tr>
              </table>
</form>
<script language="javascript">
function validfp(f){
	if(f.name=='fpedido'){
	  if(f.reg.value=='' || f.prec.value==''){
		  alert('Incomplete Information');
	  }else{
		  f.submit();
	  }
	}else if(f.name=='fpedido1'){
		if(f.des.value==''){
			alert('Incomplete Information');
		}else{
			f.submit();
		}
	}
}
function muestra_sb(d,op){
 if($(op).is(':checked')){
   if(op=='#int1'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int2" type="checkbox" id="int2" value="Biking" />Biking</label></td></tr><tr><td><label><input name="int3" type="checkbox" id="int3" value="Hiking and trekking" />Hiking and trekking</label></td></tr><tr><td><label><input name="int4" type="checkbox" id="int4" value="Rafting" />Rafting</label></td></tr></table>');
   }
   if(op=='#int6'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int7" type="checkbox" id="int7" value="Cacao, Coffee and Roses" />Cacao, Coffee and Roses</label></td></tr><tr><td><label><input name="int8" type="checkbox" id="int8" value="Gastronomy" />Gastronomy</label></td></tr><tr><td><label><input name="int9" type="checkbox" id="int9" value="Handicrafts" />Handicrafts</label></td></tr></table>');
   }
   if(op=='#int10'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int11" type="checkbox" id="int11" value="High School Community Service and Cultural Immersion" />High School Community Service and Cultural Immersion</label></td></tr><tr><td><label><input name="int12" type="checkbox" id="int12" value="University Research and Gap Year" />University Research and Gap Year</label></td></tr></table>');
   }
   if(op=='#int13'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int14" type="checkbox" id="int14" value="Island Hopping" />Island Hopping</label></td></tr><tr><td><label><input name="int15" type="checkbox" id="int17" value="Cruise" />Cruise</label></td></tr></table>');
   }
   if(op=='#int16'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int17" type="checkbox" id="int17" value="Culture and History" />Culture and History</label></td></tr><tr><td><label><input name="int18" type="checkbox" id="int18" value="Trekking and mountain climbing" />Trekking and mountain climbing</label></td></tr></table>');
   }
   if(op=='#int19'){
      $(d).html('<table border="0" cellpadding="1" cellspacing="1" class="subm"><tr><td><label><input name="int20" type="checkbox" id="int20" value="Floating Tour" />Floating Tour</label></td></tr><tr><td><label><input name="int21" type="checkbox" id="int21" value="Nature Lodges" />Nature Lodges</label></td></tr></table>');
   }
 }else{
 $(d).html('');
 }
}
</script>
          </div>
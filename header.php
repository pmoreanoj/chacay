


<div id="header1">
  	<div id="logo"> 
    <img src="imagenes/banner_top.jpg" width="990" height="137" /></div>
    

<?php 
$paa=$_SERVER['PHP_SELF'];
?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
			<td><a href="index.php" <?php if( strstr($paa,'index')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>Home</a> <span class="division"></span></td>
  <td><a href="ourdream.php" <?php if(strstr($paa,'ourdream')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?> onmouseover="pocision('2')">Our Dream</a> <span class="division"></span></td>
           <td> <a href="#" onmouseover="pocision('1')" <?php if(strstr($paa,'destinations') or strstr($paa,'producto')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>Top Picks</a><span class="division"></span></td>
           <td> <a href="testimonies.php" <?php if(strstr($paa,'testimonies')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?> onmouseover="pocision('2')">Testimonies</a>  <span class="division"></span></td>
           <td><a href="news.php" <?php if(strstr($paa,'news')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>News</a> <span class="division"></span></td>
           <td> <a href="#" <?php if(strstr($paa,'#')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?> style="width:150px">Chasqui Community</a><span class="division"></span></td>
           <td> <a href="galery.php" <?php if(strstr($paa,'galery')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>Gallery</a><span class="division"></span></td>
           <td><a href="about.php" <?php if(strstr($paa,'about')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>About Us</a><span class="division"></span></td>
           <td> <a href="contact.php" <?php if(strstr($paa,'contact')){ ?>class="bactual"<?php }else{?>class="baa"<?php }?>>Contact Us</a></td>
           </tr>
<tr >
  <td></td>
  <td></td>
  <td><div id="Layer3" style="position:relative; width:1px; height:1px; z-index:500"><div id="flotante" onmouseout="this.style.display='none'"  onclick="this.style.display='none'"  onmouseover="this.style.display='block'">
    <?php 
			  $sqlc=mysql_query("select * from categorias where cat>2 order by nom");
		         while($rowc=mysql_fetch_object($sqlc)){
				?>
    <a href="destinations.php?c=<?php echo $rowc->cat; ?>" class="baa1"><?php echo $rowc->nom; ?></a>
    <?php } ?>
  </div></div></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
           </table>

</div>

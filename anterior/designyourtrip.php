<?php
$aviso = "";
// check form  
if ($_POST['email'] != "") {
	// email de destino
	$email = "pablo@chacay.com";
	
	// asunto del email
	$subject = "Contact about More information";
	
	// Cuerpo del mensaje
	$mensaje = "-------------------------------------------------------------------- \n";
	$mensaje.= "                      Contact Form               \n";
	$mensaje.= "-------------------------------------------------------------------- \n";
	$mensaje.= "Full Name:            ".$_POST['name']."\n";
	$mensaje.= "E-mail:               ".$_POST['email']."\n";	
	$mensaje.= "Phone:                ".$_POST['phone']."\n";
	$mensaje.= "City, State:          ".$_POST['citystate']."\n";
	$mensaje.= "Destination:          ".$_POST['destination']."\n";
	$mensaje.= "Time Frame:           ".$_POST['timeframe']."\n";
	$mensaje.= "Budget:               ".$_POST['budget']."\n";
	$mensaje.= "Number of Passengers: ".$_POST['passengers']."\n";
	$mensaje.= "-------------------------------------------------------------------- \n\n";
	$mensaje.= "MESSAGE:\n\n";	
	$mensaje.= $_POST['message']."\n\n";
	$mensaje.= "-------------------------------------------------------------------- \n";
	$mensaje.= "Sent from http://www.chacay.org \n";
	
	// headers del email
	$headers = "From: ".$_POST['email']."\r\n";

	// Enviamos el mensaje
	if (mail($email, $subject, $mensaje, $headers)) {
		$aviso = "Your message was successfully sent";
	} else {
		$aviso = "Sending error";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<meta name="description" content="Chacay focuses on ecotourism in Ecuador, sustainable tourism in Ecuador and green tourism in Ecuador." /> 
	<meta name="keywords" content="Ecuador Tours, Tours Ecuador, Ecotourism in Ecuador, Green Tourism in Ecuador, Amazon Tours, Voluntorism in Ecuador" />
	
	<title>Chacay - Ecotourism in Ecuador</title>
	
	<link rel='stylesheet' href='css/style.css' />
	<link rel='stylesheet' href='css/secciones.css' /> 
	<link rel='stylesheet' href='css/bootstrap.min.css' />
    <link rel="stylesheet" type="text/css" href="css/style1.css" /> <!-- Estilos para el banner principal -->
	<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<style type="text/css">
<!--
form {
	border: solid 1px #CCC;
	background: #efefef;
	padding: 16px;
	width: 380px;
}
label {
	float: left;
	width: 100px;
}
button {
	width: 80px;
	background: #333;
	color: #FFF;
	padding: 3px 8px;
}
input {
	float: left;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #333;
	padding: 2px;
	width: 250px;
	margin-bottom: 4px;
}
select {
	float: left;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #333;
	padding: 2px;
	width: 260px;
	margin-bottom: 4px;
}
textarea{
	float: left;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #333;
	padding: 2px;
	width: 255px;
	margin-bottom: 4px;
	resize: none;
}

-->
</style>

<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
	
</head>

<body>

    <div id="page-wrap">
	
		<header>

			
			
			<div id="flags">
				
				<ul>
					<li><a href="contactus.html">Contact us &nbsp;&nbsp;</a></li>
				</ul>	
				
				<ul style="margin-top:10px;">
    	
    					<li><a href="http://www.facebook.com/pages/Chacay-Building-Bridges-Touching-Lives/191796224253972" target="_blank"><img src="images/facebookicon.png" /></a></li>
    					<li><a href="https://twitter.com/#!/ChacayTweets" target="_blank"><img src="images/twittericon.png" /></a></li>
    					<li><a href="http://www.flickr.com/photos/70245493@N06/" target="_blank"><img src="images/flickricon.png" /></a></li>
    					<li><a href="http://www.facebook.com/pages/Chacay-Building-Bridges-Touching-Lives/191796224253972?sk=app_57675755167" target="_blank"><img src="images/youtubeicon.png" /></a></li>
    					<li><a href="http://www.chacay.tumblr.com" target="_blank"><img src="images/tumblr.png" /></a></li>
    	
    			</ul>
				
			</div>   <!-- END flags -->
			
       
            
			<div id="menu-superior">
				
				<ul>
					
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About Chacay</a></li>
					<li><a href="destinations.html">Destinations</a></li>
					<li><a href="whychacay.html">Why Chacay?</a></li>	
					<li><a href="designyourtrip.php">Apply</a></li>				
					
				</ul>
				
			</div> <!-- END menu-superior -->
			
           <div id="logochacay">
	            <a href="index.html">
	            	<img src="images/logochacay.png" alt="Chacay - Ecotourism in Ecuador"  />
	            </a>
            </div>
            
		</header>
	
		<div id="banner-secciones">
			
            <img src="images/bannersecciones/applicationform.jpg" alt="Sierra" />
            
            <!-- <h1> Galapagos </h1>
            
            <p> Lorem Ipsum dolor sit amet<br>
				in consectetuer adipscim unum
        	</p> -->
            
		</div> <!-- END banner secciones  -->
		
		<div id="main-secciones">
        	<aside>
				<h2>Tour destinations</h2> 
            	<nav>
                	<ul>
						<li><a href="galapagos.html">Galapagos</a></li>
                        <li><a href="coast.html">Coast</a></li>
                        <li><a href="sierra.html">Sierra</a></li>
                        <li><a href="amazon.html">Amazon</a></li>
                        <li><a href="machupicchu.html">Machu Picchu</a></li>
                        <li><a href="encuentrosest.html">Encuentros: Students</a></li>
                        <li><a href="universityexpeditions.html">University Expeditions</a></li>
                        <li><a href="familiesfocus.html">Family Focus Expeditions</a></li>
                        <li><a href="goldenage.html">Golden Age Expeditions</a></li>
                        <li><a href="corporatetravel.html">Corporate Responsible Experiences</a></li>
                  	</ul>
                </nav>

            </aside>

            <div id="content">
        <h1>Design your trip</h1>
        
		
			<div style="font-family: Verdana, Geneva, sans-serif;">	
				
				<?php if ($aviso != "") { ?>
                <p><em><?php echo $aviso; ?></em></p><br><br>
                <?php } ?>
                
				
				<form class="well" action="" method="post">
                            
                              <label for="names">Full Name:</label>
                              <input name="name" id="name" type="text" />
                              <br />
                              
                              <label for="email">E-mail:</label>
                              <input name="email" id="email" type="text" />
                              <br />
                              
                              <label for="phone">Phone:</label>
                              <input name="phone" id="phone" type="text" />
                              <br />
                              
                              <label for="citystate">City, State:</label>
                              <input name="citystate" id="citystate" type="text" />
                              <br />
                              
                              
                              <label for="destination">Destination:</label>
                              	<select name="destination" id="destination">
                                   	<option>Sierra (Quito), Galapagos</option>
                                   	<option>Sierra (Quito), Avenue of the Volcanoes, Amazon</option>
                                   	<option>Sierra (Quito), Galapagos, Amazon</option>
                                   	<option>Sierra (Quito), Galapagos, Machu Picchu</option>
                                  	<option>Sierra (Quito), Amazon, Costa</option>
                                </select>
                              <br />
                              <br />
                              
                              <label for="timeframe">Time frame:</label>
                              <input name="timeframe" id="timeframe" type="text" />
                              <br />
                              
                              <label for="budget">Budget:</label>
                              <input name="budget" id="budget" type="text" />
                              <br />
                              
                              <label for="passengers">Number of passengers:</label>
                              <input name="passengers" id="passengers" type="text" />
                              <br />
                              <br />
                              <br />
                              <br />
                              <br class="clearfloat" />
                                                                                       
                              
                  			  <label for="message">Message:</label>
                              <textarea name="message" cols="30" rows="6" id="message"></textarea>
                              <br />
                              
                    <label for="btsend">&nbsp;</label>
                            
                            <button name="btsend" class="btn btn-primary" type="submit" id="btsend" onclick="MM_validateForm('name','','R','email','','RisEmail','mensaje','','R');return document.MM_returnValue">Send</button>
              </form> 
			</div>				
						
<br class="clearfloat">
					
						
						
				
</div>
        </div>
		
	</div> <!-- END page-wrap -->
	<br class="clearfloat">
    <footer>
    	
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="about.html">About Us</a></li>
				<li><a href="whychacay.html">Why Chacay</a></li>
				<li><a href="#">Gallery</a></li>
				<li><a href="testimonials.html">Testimonies</a></li>
				<li><a href="index.html">Our Partners</a></li>
				<li><a href="contactus.html">Contact Us</a></li>
			</ul>
		
	</footer>

</body>

</html>
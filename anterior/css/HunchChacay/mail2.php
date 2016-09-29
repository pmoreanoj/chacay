<?php
	$mail = $_POST['mailsaved'];
	$name = $_POST['namesaved'];
	$step = $_POST['step'];
	
 $to = "carlos_cano45@yahoo.com";
 $message =" You received  a mail from ".$name."-".$mail;
 $message .=" Text of the message : ".$step;

 if(mail($to, $subject,$message)){
	echo "mail successful send";
} 
else{ 
	echo "there's some errors to send the mail, verify your server options";
}
?>
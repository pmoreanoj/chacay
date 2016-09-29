var namesaved = "";
var mailsaved = "";

$(document).ready(function(){
	$("#sendmail").click(function(){
		var valid = '';
		var isr = ' is required.';
		var name = $("#name").val();
		var mail = $("#mail").val();
		var step = $("#Step1").val();
		
		if (name.length<1) {
			valid += '<br />Name'+isr;
		}
		if (!mail.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {
			valid += '<br />A valid Email'+isr;
		}
		
		if (valid!='') {
			$("#response").fadeIn("slow");
			$("#response").html("Error:"+valid);
		}
		else {
			var datastr ='name=' + name + '&mail=' + mail + '&step=' + step ;
			alert(datastr);
			$("#response").css("display", "block");
			$("#response").html("Sending message .... ");
			$("#response").fadeIn("slow");
			setTimeout("send('"+datastr+"')",2000);
			namesaved = name;
			mailsaved = mail;
		alert(namesaved);
		
		}
		return false;
	});
});

 $(document).ready(function(){
	$("#sendmail2").click(function(){
		
		alert(namesaved);
		var valid = '';
		var isr = ' is required.';

		var name = namesaved;
		var mail = mailsaved;
		var step = $("#Step2").val();

		if (name.length<1) {
			valid += '<br />Name'+isr;
		}
		if (!mail.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {
			valid += '<br />A valid Email'+isr;
		}
		
		if (valid!='') {
			$("#response2").fadeIn("slow");
			$("#response2").html("Error:"+valid);
		}
		else {
			var datastr ='name=' + name + '&mail=' + mail + '&step=' + step ;
			alert(datastr);
			$("#response2").css("display", "block");
			$("#response2").html("Sending message .... ");
			$("#response2").fadeIn("slow");
			setTimeout("send2('"+datastr+"')",2000);
		}
		return false;
	});
});

function send(datastr){
	$.ajax({	
		type: "POST",
		url: "mail.php",
		data: datastr,
		cache: false,
		success: function(html){
		$("#response").fadeIn("slow");
		$("#response").html(html);
		setTimeout('$("#response").fadeOut("slow")',2000);
	}
	});
}

function send2(datastr){
	$.ajax({	
		type: "POST",
		url: "mail2.php",
		data: datastr,
		cache: false,
		success: function(html){
		$("#response2").fadeIn("slow");
		$("#response2").html(html);
		setTimeout('$("#response2").fadeOut("slow")',2000);
	}
	});
}

$(document).ready(function(){
	$("#sendmail3").click(function(){
		
		alert(namesaved);
		var valid = '';
		var isr = ' is required.';

		var name = namesaved;
		var mail = mailsaved;
		var step = $("#Step3").val();

		if (name.length<1) {
			valid += '<br />Name'+isr;
		}
		if (!mail.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {
			valid += '<br />A valid Email'+isr;
		}
		
		if (valid!='') {
			$("#response3").fadeIn("slow");
			$("#response3").html("Error:"+valid);
		}
		else {
			var datastr ='name=' + name + '&mail=' + mail + '&step=' + step ;
			alert(datastr);
			$("#response3").css("display", "block");
			$("#response3").html("Sending message .... ");
			$("#response3").fadeIn("slow");
			setTimeout("send3('"+datastr+"')",2000);
		}
		return false;
	});
});


function send3(datastr){
	$.ajax({	
		type: "POST",
		url: "mail3.php",
		data: datastr,
		cache: false,
		success: function(html){
		$("#response3").fadeIn("slow");
		$("#response3").html(html);
		setTimeout('$("#response3").fadeOut("slow")',2000);
	}
	});
}



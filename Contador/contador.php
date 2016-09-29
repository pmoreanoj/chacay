<?php
////no registrar estadisticas si es es un robot de buscador
if( stripos( $_SERVER["HTTP_USER_AGENT"], "Google" ) !== false or stripos( $_SERVER["HTTP_USER_AGENT"], "MSNBot" ) !== false){
	//mail( "direccion@mail.com", "Alerta de GoogleBot", "Página visitada: " . $_SERVER["REQUEST_URI"] );
	$da= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
	mysql_query("insert into visita_buscador values('','". $_SERVER["HTTP_USER_AGENT"] ."','". $_SERVER["REQUEST_URI"] ."','". $da['geoplugin_countryName'] ."',NOW())");
	//contador de hits
	mysql_query("update visitast set cont=cont+1");

}else{
    //tiempo de refresco en minutos $tiempo 
    $tiempo=5; 

    //miramos primero si el usuario está activo o no según el tiempo de refresco $tiempo 
	//$_SERVER["REMOTE_ADDR"];
    $ahora = time(); 
    $limite = $ahora-$tiempo*60; 
    //eliminamos todos los usuarios cuyo tiempo de $tiempo está rebasado y no se considera activo 
    mysql_query("DELETE FROM visitantes_activos WHERE fecha < ". $limite); 

    //Si no hay nada en la tabla principal, metemos datos iniciales. 
    $a=mysql_query("SELECT * FROM visitas"); 
    $b=mysql_fetch_row($a); 
    if (!$b[0]) { mysql_query("INSERT INTO visitas values ('$h[0]','0','0','0')"); $b[3]=0; } 
    $b[3]++; 
    mysql_query("UPDATE visitas set impresiones='$b[3]'"); 

    //donde anotamos las IPs, seleccionamos el individuo que tiene la IP aun activa, si esque lo está 
    $a=mysql_query("SELECT * FROM visitantes_activos WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'"); 
    $b=mysql_fetch_row($a);  

    //si está activo, le renovamos su tiempo y se le pone el contador de nuevo a 0 
    if ($b[0]) { 
           mysql_query("UPDATE visitantes_activos SET fecha = '$ahora' where ip = '".$_SERVER["REMOTE_ADDR"]."'"); 
    } 
 //si el individuo no se considera activo añadiremos como visita diaria, visita activa y visita total 
    else { 
        //aqui le añadimos su ip para poder reconocer si es activo o no 
        mysql_query("INSERT INTO visitantes_activos values ('".$_SERVER["REMOTE_ADDR"]."','$ahora')"); 
		///////////contador de visitas por paises
		$da= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		mysql_query("update paises set visita=visita+1 where nombre like '".$da['geoplugin_countryName']."' or nombrei like '".$da['geoplugin_countryName']."'");
		 //contador por dia y  paises
		 $codpai=mysql_fetch_object(mysql_query("select nombre from paises where nombre like '".$da['geoplugin_countryName']."' or nombrei like '".$da['geoplugin_countryName']."'"));
		if(mysql_num_rows(mysql_query("select * from visita_pais where date(fecha)=date('". date('Y-m-d') ."') and nombre like '".$codpai->nombre."'"))>0){
		  mysql_query("update visita_pais set visita=visita+1 where date(fecha)=date('". date('Y-m-d') ."') and nombre like '".$codpai->nombre."'");
		}else{
		 mysql_query("insert into visita_pais values('".$codpai->nombre."','". date('Y-m-d') ."','1','0')");
		}

        //ahora le sumamos uno en totales 
        $c01 = mysql_query("SELECT totales FROM visitas"); 
        $d = mysql_fetch_row($c01); 
        $g = mysql_query("SELECT curdate()"); 
        $h = mysql_fetch_row($g); 

        $d[0]++; 
        mysql_query("UPDATE visitas SET totales = '$d[0]'"); 

        //ahora tocaremos el visitas diarias 
        $i01 = mysql_query("SELECT fecha,hoy FROM visitas"); 
        $j01 = mysql_fetch_row($i01); 

        //si el individuo hace la visita el mismo dia 
        if ($h[0]==$j01[0]) { 
            //añadimos uno en visita de hoy 
            $j01[1]++; 
        } 

        //si el individuo hace la primera visita del dia, osea que lo de ayer ya no sirve pq era otro dia ayer 
        else { 
            $j01[1]=1; 
            mysql_query("UPDATE visitas SET fecha = '$h[0]'"); 
        } 
        mysql_query("UPDATE visitas set hoy='$j01[1]'"); 
    } 
    //ahora mostramos los datos finales tomando unas variables para almacenar datos temporalmente 
    $z = mysql_query("SELECT totales,hoy,impresiones FROM visitas"); 
    $visitas = mysql_fetch_row($z); 
    $x = $a=mysql_query("SELECT COUNT(*) FROM visitantes_activos"); 
    $activos = mysql_fetch_row($x);  
	//contador de hits
	mysql_query("update visitast set cont=cont+1");
	$fa=date("Y-m-d");
	$hoy=mysql_fetch_object(mysql_query("select fecha, hoy, max_activo from visitast"));
	if($hoy->fecha==$fa){
	 mysql_query("update visitast set hoy=hoy+1");
	  if($activos[0]>$hoy->max_activo){//colocar maximo activo del dia
	    mysql_query("update visitast set max_activo=".$activos[0]);
	  }
	  
	  if($codpai->nombre){//contador hits pais y diario-pais
			  mysql_query("update visita_pais set hit=hit+1 where date(fecha)=date('". date('Y-m-d') ."') and nombre like '".$codpai->nombre."'");
			  mysql_query("update paises set hit=hit+1 where nombre like '".$codpai->nombre."'");
	    }else{
		  $da= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		mysql_query("update paises set hit=hit+1 where nombre like '".$da['geoplugin_countryName']."' or nombrei like '".$da['geoplugin_countryName']."'");
		 $codpai=mysql_fetch_object(mysql_query("select nombre from paises where nombre like '".$da['geoplugin_countryName']."' or nombrei like '".$da['geoplugin_countryName']."'"));	  
		  mysql_query("update visita_pais set hit=hit+1 where date(fecha)=date('". date('Y-m-d') ."') and nombre like '".$codpai->nombre."'");
		}//fin de if($codpai->nombre){
	}else{
	 mysql_query("update visitast set hoy=1,fecha='$fa',max_activo=1");
	}
}//if( strpos( $_SERVER["HTTP_USER_AGENT"], "Googlebot" ) !== false ){		
?>
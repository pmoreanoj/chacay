<?php 
///confirmacion de pago
include_once("../conexion.php");
/////////////codigo que guardar las estadisticas del dia
		$vis=mysql_fetch_object(mysql_query("select * from visitas"));//sacamos vistitas y fecha
		$vis1=mysql_fetch_object(mysql_query("select * from visitast"));//sacam hits y max_activos
		$nhb=mysql_fetch_object(mysql_query("select count(*) as hb from visita_buscador where date(fecha)=date('".$vis->fecha."')"));
		$hvb=$nhb->hb+$vis1->hoy;
		mysql_query("insert into estadistica values('','".$vis->fecha."','".$vis1->hoy."','".$nhb->hb."','$hvb','".$vis->hoy."','".$vis1->max_activo."','$nv','$vv')");
		mysql_query("delete from visita_buscador where date(fecha)=date('".$vis->fecha."'");
			////////////fin de codigo estadisticas/////////////////
?>
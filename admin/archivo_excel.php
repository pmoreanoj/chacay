<?php 
if (!isset($_SESSION)) {
  session_start();
}
include_once("../conect.php");
if($_SESSION['id_us']){
$idop=$_SESSION['id_us'];
$du=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$idop));
}else{
header("Location:index.php");
}//fin de if($_SESSION['cod_e']){
$fecha_reporte=date('Y-m-d')."_".date("Hms");

// Generamos el Excel  
//$vendidos=$_SESSION['datos_vendidos'];
//$vexport=sprintf("%d",$_GET['export']);
//unset($_SESSION['datos_vendidos']);
// Creamos el array con los datos
$sql=$_SESSION['print'];
$ini=$_GET['ini'];
$sqli=mysql_query($sql);
$numpe=mysql_num_rows($sqli);
$mes=array("Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic.");
$archivo="Listado_Cotizaciones_".$fecha_reporte.".xls";
$tabla= '<table border="1">
<tr><td colspan="13" height="30"><strong>Listado de Cotizaciones Gift Viajes</strong></td></tr>
<tr bgcolor="#CAE2A5">
    <th  bgcolor="#CCCCCC">N&ordm;</th>
    <th  bgcolor="#CCCCCC">Nombre</th>
    <th  bgcolor="#CCCCCC">Ciudad</th>
    <th  bgcolor="#CCCCCC">Tel&eacute;fono</th>
    <th  bgcolor="#CCCCCC">E-Mail</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Paquete</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Salida</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Hotel</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Habitaci&oacute;n</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Adultos</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Ni&ntilde;os</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Valor</th>
    <th  nowrap="nowrap" bgcolor="#CCCCCC">Fecha </th>
  </tr>';
   $i=$ini;
		while($row=mysql_fetch_object($sqli)){
		$i=$i+1;
  $tabla.='<tr style="background-color:#F5F5F5">
    <td><div align="center"><strong>'.$i.'</strong></div></td>
    <td>'.$row->cliente.'</td>
    <td nowrap="nowrap">'.$row->ciudad.'</td>
    <td nowrap="nowrap">'.$row->telefono.'</td>
    <td nowrap="nowrap">'.$row->email.'</td>
    <td>'.$row->paquete.'</td>
    <td>'.$row->fechas.'</td>
    <td>'.$row->hotel.'</td>
    <td>'.$row->habitacion.'</td>
    <td>'.$row->adultos.'</td>
    <td>'.$row->menores.'</td>
    <td>$'.$row->valor.'</td>
    <td><div align="center">';
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  $tabla.=$mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0].'</div></td>
  </tr>';
		}//fin while
$tabla.="</table>";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=".$archivo);
header("Pragma: no-cache");
header("Expires: 0");
echo $tabla;
?>
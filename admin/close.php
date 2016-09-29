<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once("../conect.php");
$ida=$_SESSION['id_a'];
//codigo para cerrar sesion del administrador de productis
session_unset();
// Finalmente, destruye la sesi&oacute;n
session_destroy();
//***************************************************
//actualizamos fecha de salida en acceso empresa
mysql_query("update acceso set fecha_s=Now() where coda='$ida'");
header("Location:../index.php");
?>
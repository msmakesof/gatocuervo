<?php
include_once 'config/db.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
session_start();
//$idusuario = $_SESSION['id'] ;

if(isset($_SESSION['id']) && $_SESSION['id'] != "")
{
	$idusuario = $_SESSION['id'] ;

	// 1. Actualizar Registro
	$param = "idusuario=".$idusuario."&tipocierre=2" ;
	$url = $urlServicios."api/accesousuario/update.php?$param";				
	include 'curl/curl.inc.php';

	$mestado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$data = json_decode($mestado, true);

	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);

	session_destroy();
}
header("Location: index.html");
exit();
?>
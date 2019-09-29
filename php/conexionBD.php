<?php 
$usuario = "root";
$contraseña= "";
$servidor= "localhost";
$basededatos= "ssy";

$conexion= mysqli_connect($servidor,$usuario,$contraseña) or die("No se ha podido conectar a la BD del Servidor");

$db= mysqli_select_db($conexion,$basededatos) or die("No se ha podido conectar a ".$basededatos);
?>
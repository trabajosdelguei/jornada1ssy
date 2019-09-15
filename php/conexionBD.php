<?php 
$usuario = "root";
$contraseña= "";
$servidor= "localhost";
$basededatos= "jornadassy";

$conexion= mysqli_connect($servidor,$usuario,$contraseña) or die("No se ha podido conectar a la BD del Servidor");

$db= mysqli_select_db($conexion,$basededatos) or die("No se ha podido conectar a ".$basededatos);

	
$consulta = "SELECT * FROM inscritos";

	
$resultado = mysqli_query( $conexion, $consulta ) or die("Consulta fallida");



while ($columna = mysqli_fetch_array( $resultado ))
{
 echo $columna['nombre'] . " " . $columna['email'] .  " " . $columna['institucion'],  " " . $columna['confimacion'] .  " " . $columna['asistencia'];
}

mysqli_close( $conexion );
?>
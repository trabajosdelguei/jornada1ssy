<?php
require("conexionBD.php");

$consulta = "SELECT * FROM inscritos";
	
$resultado = mysqli_query( $conexion, $consulta ) or die("Consulta fallida");

$inscritos = array();

while ($columna = mysqli_fetch_array( $resultado, MYSQLI_ASSOC ))
{
    $inscritos[]=json_encode($columna,JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT);
}
/*
if($inscritos!=null){
    foreach ($inscritos as &$valor) {
        echo $valor;
    }
}
else{
    echo 'Sin inscritos';
}
*/

mysqli_close( $conexion );
?>
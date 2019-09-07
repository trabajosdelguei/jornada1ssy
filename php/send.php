<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header('Content-Type: application/json');
header("Allow: GET, POST");

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$institucion = $_POST["institucion"];
$valido = false;

$respuesta = array(
	'name' => $nombre,
	'email' => $email,
	'institution' => $institucion,
	'validated' => $valido
);

echo json_encode($respuesta, JSON_FORCE_OBJECT);
//echo 'La consulta ha sido recibida correctamente!';
?>
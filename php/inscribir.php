<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header('Content-Type: application/json');
header("Allow: POST");

require "conexionBD.php";

$nombre = mysqli_real_escape_string($conexion,$_POST["nombre"]);
$email = mysqli_real_escape_string($conexion,$_POST["email"]);
$institucion = mysqli_real_escape_string($conexion,$_POST["institucion"]);
$rfc = mysqli_real_escape_string($conexion,$_POST["rfc"]);


$consulta = "SELECT * FROM inscripcion WHERE email='$email'";
$resultado = mysqli_query($conexion, $consulta) or die("Consulta fallida");


if(mysqli_num_rows($resultado)>0){
    echo json_encode(array('msg' => 'Ya existe un registro con ese email'),JSON_FORCE_OBJECT);
}

else{
    $nombreN = $nombre;
    $emailN = $email;
    $institucionN = $institucion;
    $rfcN = $rfc;
    $valido =0;
    $asistencia =0;
    $nuevaConsulta= "INSERT INTO inscripcion (idinscripcion, nombre, email, institucion, rfc) VALUES (NULL,'$nombreN','$emailN','$institucionN',$rfcN)"; 
    if (mysqli_query($conexion, $nuevaConsulta)) {
        echo json_encode(array('msg' => 'Registro exitoso, confirme su registro en su dirección email'),JSON_FORCE_OBJECT);
    }
    else {
        echo json_encode(array('msg' => 'Error: '. mysqli_error($conexion)),JSON_FORCE_OBJECT);
    }
}
mysqli_close($conexion);
?>
<?php
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

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

$consulta = "SELECT * FROM inscritos WHERE email='$email'";

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

    $nuevaConsulta= "INSERT INTO inscritos (id, nombre, email, institucion, rfc, confimacion, asistencia) VALUES (NULL,'$nombreN','$emailN','$institucionN',$rfcN,'$valido','$asistencia')"; 

    if (mysqli_query($conexion, $nuevaConsulta)) {
        //echo json_encode(array('msg' => 'Registro exitoso, confirme su registro en su dirección email'),JSON_FORCE_OBJECT);
        /*
        $nuevaConsulta2   = "SELECT * FROM inscritos WHERE email='$emailN'";
        $result = mysqli_query($conexion, $nuevaConsulta2) or die ( mysqli_error($conexion) );
        $row   = mysql_fetch_array($result);
        $path="http://localhost/php/"; //creamos nuestra direccion, con las carpetas que sean si hay armamos nuestro link para enviar por mail en la variable $activateLink
        $activateLink = $path."activarRegistro.php?id=".$row['id']."&email=".$row['email']."";
        */
        // Datos del email

        $mail  = new PHPMailer();

        //asigna a $body el contenido del correo electrónico
        $body = "Contenido del cuerpo del correo"; 

        // Indica que se usará SMTP para enviar el correo
        $mail->IsSMTP(); 

        $mail->SMTPDebug  = 3;                     
        // Activar los mensajes de depuración, 
        // muy útil para saber el motivo si algo sale mal
        // 1 = errores y mensajes
        // 2 = solo mensajes entre el servidor u la clase PHPMailer

        $mail->SMTPAuth = true;
        // Activar autenticación segura a traves de SMTP, necesario para gmail

        $mail->SMTPSecure = "tls";
        // Indica que la conexión segura se realizará mediante TLS

        $mail->Host = "smtp.gmail.com";
        // Asigna la dirección del servidor smtp de GMail

        $mail->Port = 587;
        // Asigna el puerto usado por GMail para conexion con su servidor SMTP

        $mail->Username = "huruz9703@gmail.com";  
        // Indica el usuario de gmail a traves del cual se enviará el correo

        $mail->Password = "N@n00302";
        // GMAIL password

        $mail->SetFrom('huruz9703@gmail.com', 'First Last'); 
        //Asignar la dirección de correo y el nombre del contacto que aparecerá cuando llegue el correo

        $mail->Subject = "Probando enviar un correo con PHPMailer y GMail"; 
        //Asignar el asunto del correo

        //$mail->MsgHTML($body); 
        //Si deseas enviar un correo con formato HTML debes descomentar la linea anterior

        $mail->AddAddress("huruz9703@gmail.com"); 
        //Indica aquí la dirección que recibirá el correo que será enviado

        if(!$mail->Send()) {
            echo json_encode(array('msg' => 'Error enviando correo: '. $mail->ErrorInfo),JSON_FORCE_OBJECT);
            //echo "Error enviando correo: " . $mail->ErrorInfo;
        } 
        else {
            echo json_encode(array('msg' => 'Correo enviado'),JSON_FORCE_OBJECT);
            //echo "Correo enviado!!!";
        } 
    }
    else {
        echo json_encode(array('msg' => 'Error: '. mysqli_error($conexion)),JSON_FORCE_OBJECT);
        //echo "Error: ". mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

<?php
require("conexionBD.php");

//recogemos los valores enviados por el link de activacion que mandamos por mail
if (isset($_GET['id'])) {

    $idval = $_GET['id'];
    $email = $_GET['email'];

    $query = "UPDATE inscripcion SET confimacion = '1' WHERE id = '$idval' AND email ='$email'";
    mysqli_query($conexion,$query) or die(mysql_error());
?>
<SCRIPT LANGUAGE="javascript">
    location.href = "index.php";
</SCRIPT>

<?php

} else {
    echo json_encode(array('msg'=>'Activación incompleta'), JSON_FORCE_OBJECT);

}
mysqli_close($conexion);
?>
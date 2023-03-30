<html>
    <head>
        <meta http-equiv="refresh" content="0;url=historias.php" />
    </head>
    <?php
        session_start();
        #SE COGE EL NOMBRE DE USUARIO DEL USUARIO QUE HA INICIADO SESIÓN
        $user = $_SESSION["nombreUsuario"];
        include "../conexiones.php";
        #SE COGEN LOS VALORES DEL FORM
        $privada = $_POST["priv"];
       
        if($privada == "0"){
            $privada = false;
        }
        else if($privada == "1"){
            $privada = true;
        }
        #SE COGEN LOS VALORES DEL FORM
        $descripcion = $_POST["desc"];
        #LA FECHA SE COGE LA ACTUAL
        date_default_timezone_set('Europe/Madrid');
        $fechaHistoria = date('Y-m-d H:i:s');

        $string= "INSERT into historia set privada= \"$privada\", descripcion= \"$descripcion\", fechaHistoria=\"$fechaHistoria\", nombreUsuario=\"$user\"";
        $insert = mysqli_query($conexio,$string);
    ?>
</html>
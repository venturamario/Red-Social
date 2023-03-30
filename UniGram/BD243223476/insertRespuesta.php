<html>
    <?php
        # Obtener datos de la tabla para insert
        session_start();
        $nombreUsuario = $_SESSION["nombreUsuario"];
        include "../conexiones.php";
        $respuesta = $_POST["respuesta"];
        $id = $_POST["idPublicacion"];
        date_default_timezone_set('Europe/Madrid');
        $fechaRespuesta = date('Y-m-d H:i:s');
        
        # Generar string para insert
        $string = "INSERT into respuesta set respuesta = \"$respuesta\", fechaRespuesta = \"$fechaRespuesta\", nombreUsuario = \"$nombreUsuario\", idPublicacion = \"$id\"";
        $insert = mysqli_query($conexio,$string);
    ?>
    <head>
        <meta http-equiv="refresh" content="0;url=verRespuestas.php?id=<?php echo $id ?>" />
    </head>
</html>
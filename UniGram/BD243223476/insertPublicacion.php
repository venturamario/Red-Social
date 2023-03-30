<html>
    <!-- INSERTA EN LA BASE DE DATOS (CON SQL) LOS DATOS QUE ENCUENTRA EN EL FORM-->
    <head>
        <meta http-equiv="refresh" content="0;url=../principal.php" />
    </head>
    <?php
        session_start();
        $nombreUsuario = $_SESSION["nombreUsuario"];
        include "../conexiones.php";

        $descripcion = $_POST["publicacion"];
        date_default_timezone_set('Europe/Madrid');
        $fechaCreacion = date('Y-m-d H:i:s');
        $idHistoria = $_POST["elegirhist"];

        # Si se ha elegido una historia, haremos un INSERT con el idHistoria elegido
        if($idHistoria != "NULL"){
            $stringHist = "INSERT INTO publicacion set descripcion = \"$descripcion\", fechaCreacion = \"$fechaCreacion\", nombreUsuario = \"$nombreUsuario\", idHistoria = \"$idHistoria\"";
            $insertHist = mysqli_query($conexio,$stringHist);
        } else {
            $string="INSERT into publicacion set descripcion = \"$descripcion\", fechaCreacion = \"$fechaCreacion\", nombreUsuario = \"$nombreUsuario\"";
            $insert=mysqli_query($conexio,$string);
        }
    ?>
</html>

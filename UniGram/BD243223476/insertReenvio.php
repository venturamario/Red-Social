<html>
    <!-- SE EJECUTA SI SE PULSA LA IMAGEN CON BOTÓN DE REENVÍO-->
    <head>
        <meta http-equiv="refresh" content="0;url=../principal.php" />
    </head>
    <?php
        session_start();
        $nombreUsuario = $_SESSION["nombreUsuario"];
        include "../conexiones.php";
        $idPubli = $_GET["id1"];
        $desc = $_GET["id2"];
        date_default_timezone_set('Europe/Madrid');
        $fechaCreacion = date('Y-m-d H:i:s');

        $string = "INSERT INTO publicacion set descripcion = \"$desc\", fechaCreacion = \"$fechaCreacion\", nombreUsuario = \"$nombreUsuario\", idPublicacion2 = \"$idPubli\"";
        $insert = mysqli_query($conexio,$string);
    ?>
</html>
<html>
    <?php
        #SE BORRA LA HISTORIA CON EL ID PASAADO POR PARÁMETRO
        $idHistoria=$_GET['id'];
        $string="DELETE from historia WHERE idHistoria='$idHistoria'";
        include "../conexiones.php";
        $insert=mysqli_query($conexio,$string);
    ?>
    <head>
        <meta http-equiv="refresh" content="0;url=../principal.php" />
    </head>
</html>
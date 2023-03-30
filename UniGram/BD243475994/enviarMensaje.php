<html>

<?php
    #INSERT EN MENSAJE CON LOS DATOS QUE COGE DEL TEXTAREA Y LOS QUE SE ENVÍAN EN FORMA DE FORM (EMISOR Y RECEPTOR)
    $contenido=$_POST["mensaje"];
    $receptor=$_POST["receptor"];
    $emisor=$_POST["emisor"];

    $query="INSERT into mensaje set contenido = \"$contenido\", leido = false, nombreEmisor = \"$emisor\", nombreReceptor = \"$receptor\"";

    include "../conexiones.php";
    $insert=mysqli_query($conexio,$query);

?>

    <head>
        <meta http-equiv="refresh" content="0;url=verMensajes.php?receptor=<?php echo $receptor?>" />
    </head>

</html>
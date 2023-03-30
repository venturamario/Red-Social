<?php
    //DESDE AQUÍ SE REALIZA LA CONEXIÓN BÁSICA CON LA BASE DE DATOS
    $conexio=mysqli_connect("localhost","root","")
    or die("Fatal error 404: Localhost conection error");
    $bd=mysqli_select_db($conexio,"bd203")
    or die("Fatal error 015: DB error");
?>
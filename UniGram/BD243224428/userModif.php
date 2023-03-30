<html>
        <?php
            session_start();
            $nombreUsuario=$_SESSION["nombreUsuario"];
            //HACE UPDATE EN LA BASE DE DATOS CON LOS DATOS QUE SE HAYAN INTRODUCIDO EN EL FORM
            $password=$_POST["password"];
            $nombre=$_POST["nombre"];
            $apellidos=$_POST["apellidos"];
            $genero=$_POST["genero"];
            $edad=$_POST["edad"];
            $biografia=$_POST["biografia"];

            $string="UPDATE usuario set password = \"$password\", nombre = \"$nombre\", apellidos = \"$apellidos\", genero = \"$genero\", edad = \"$edad\", biografia = \"$biografia\" WHERE nombreUsuario = \"$nombreUsuario\"";
            
            include "../conexiones.php";
            $update=mysqli_query($conexio,$string);
            ?>
            <head>
                <meta http-equiv="refresh" content="0;url=verPerfil.php?nombredeusuario=<?php echo $nombreUsuario ?>"/>
            </head>
</html>
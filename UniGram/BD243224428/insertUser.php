<html>
    <!-- INSERTA EN LA BASE DE DATOS (CON SQL) LOS DATOS QUE ENCUENTRA EN EL FORM-->
    <head>
        <meta http-equiv="refresh" content="0;url=../index.html" />
    </head>
    <?php
        $nombreUsuario=$_POST["nombreUsuario"];
        $password=$_POST["password"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $genero= $_POST["genero"];
        $edad= $_POST["edad"];
        $biografia= $_POST["biografia"];

        $string="INSERT into usuario set nombreUsuario = \"$nombreUsuario\", password = \"$password\", nombre = \"$nombre\", apellidos = \"$apellidos\", genero = \"$genero\", edad = \"$edad\", biografia = \"$biografia\"";

        include "../conexiones.php";
        $string2="SELECT * FROM usuario WHERE nombreUsuario='$nombreUsuario'";
        $consulta=mysqli_query($conexio,$string2);

        if (mysqli_num_rows($consulta)!=0) {
            echo "EL NOMBRE DE USUARIO YA EXISTE. VUELVE A INTENTARLO CON UN NUEVO NOMBRE DE USUARIO";?>
            <head>
                <meta http-equiv="refresh" content="2;url=createAccountForm.html" />
            </head>
        <?php
        }
        else {
            $insert=mysqli_query($conexio,$string);
        }
    ?>
</html>

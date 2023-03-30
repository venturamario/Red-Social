<html>
    <?php
        include "../conexiones.php";

        $nomusuari=$_POST["nombreUsuario"];
        $contrasenya=$_POST["password"];
        $query = mysqli_query($conexio,"SELECT * from usuario where nombreUsuario = '$nomusuari' and password = '$contrasenya'");

        // Verificar si el usuario existe en la base de datos
        $num_rows = mysqli_num_rows($query);
        if($num_rows == 1){
            session_start();
            $_SESSION["nombreUsuario"] = $nomusuari;
            $_SESSION["password"] = $contrasenya;
            header("Location:../principal.php");
        }
        else{
            echo "<h1>Nombre de usuario o contrasena invalido!</h1>";
            echo "<h2>Volviendo al inicio de sesion</h2>"
    ?>

    <head>
        <meta http-equiv="refresh" content="1;url=../index.html" />
    </head>

    <?php
        }
    ?>
</html>
<html>
    <head>
        <title>Usuarios</title>
        <link rel="stylesheet" type="text/css" href="profileStyle.css">
    </head>
    <body style="background-color:lightsteelblue;">
<?php
    #SIMPLEMENTE SE MUESTRAN TODOS LOS USUARIOS EN LA BASE DE DATOS CON UN ENLACE A SUS PERFILES
    include "../conexiones.php";
    session_start();
    $nombreUsuario=$_SESSION['nombreUsuario'];
    $query="SELECT nombreUsuario FROM usuario WHERE nombreUsuario != '$nombreUsuario'";
    $consulta=mysqli_query($conexio,$query);?>
    <button onclick="location.href = '../principal.php';"><img src="home.png" height="50px" style="position:absolute;"></img></button>
    <center><h1 style="color:#0E0E52;padding:20px;">Lista de Usuarios</h1>
    <?php
    while($reg=mysqli_fetch_array($consulta)) {
        ?>
            <?php
                $nusuario=$reg["nombreUsuario"];
                #ENLACE A PERFIL?>
                <button id="userbox">
                    <a href="verPerfil.php?nombredeusuario=<?php echo $nusuario ?>" class="linksusers"><?php echo $nusuario ?></a>
                </button>
                <br>
        <?php
            }
    ?>
    </center>
    </body>
</html>
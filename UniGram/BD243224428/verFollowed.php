<html>
    <head>
        <title>Gente que sigo</title>
        <link rel="stylesheet" type="text/css" href="profileStyle.css">
    </head>
    <body style="background-color:lightsteelblue;">
<?php
    #SIMPLEMENTE SE MUESTRA LA GENTE QUE SIGUE EL USUARIO QUE INICIA SESIÓN CON UN ENLACE A CADA PERFIL
    include "../conexiones.php";
    session_start();
    $nombreUsuario=$_SESSION['nombreUsuario'];
    $query="SELECT nombreUsuario2 FROM r_follower WHERE nombreUsuario1='$nombreUsuario'";
    $consulta=mysqli_query($conexio,$query);?>
    <button onclick="location.href = '../principal.php';"><img src="home.png" height="50px" style="position:absolute;"></img></button>
    <center><h1 style="color:#0E0E52;padding:20px;">Gente a la que sigo</h1>
    <?php
    while($reg=mysqli_fetch_array($consulta)) {
        ?>
            <?php
                $nusuario=$reg["nombreUsuario2"];
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
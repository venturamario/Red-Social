<html>
    <head>
        <title>Mis followers</title>
        <link rel="stylesheet" type="text/css" href="profileStyle.css">
    </head>
    <body style="background-color:lightsteelblue;">
<?php
    #SIMPLEMENTE SE MUESTRAN LOS SEGUIDORES DEL USUARIO QUE INICIA SESIÓN CON UN ENLACE A CADA PERFIL
    include "../conexiones.php";
    session_start();
    $nombreUsuario=$_SESSION['nombreUsuario'];
    $query="SELECT nombreUsuario1 FROM r_follower WHERE nombreUsuario2='$nombreUsuario'";
    $consulta=mysqli_query($conexio,$query);?>
    <button onclick="location.href = '../principal.php';"><img src="home.png" height="50px" style="position:absolute;"></img></button>
    <center><h1 style="color:#0E0E52;padding:20px;">Mis followers</h1>
    <?php
    while($reg=mysqli_fetch_array($consulta)) {
        ?>
            <?php
                $nusuario=$reg["nombreUsuario1"];
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
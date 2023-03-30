<html>
    <head>
        <title>Mis Respuestas</title>
        <link rel="stylesheet" type="text/css" href="respuestasstyle.css">
    </head>

    <?php
    # Generar String para la consulta
    include "../conexiones.php";
    session_start();
    $idPubli = $_GET["id"];
    $query = "SELECT * FROM respuesta WHERE idPublicacion='$idPubli' ORDER BY fechaRespuesta ASC";
    $consulta = mysqli_query($conexio,$query);

    # Ver si en la publicacion hay respuestas o no
    $numrows = mysqli_num_rows($consulta);
    if($numrows == 0){
    ?>
    <div class="norepliesmessage">
        <div class ="center">
            <h1>¡Vaya! No hay respuestas a esta publicacion aun</h1><br>
            <center>
                <button id="norepliesreturn" onclick="location.href = '../principal.php';">Volver a Pagina Principal</button>
            </center>
        </div>
    </div>
    <?php }
        else{ #SE MUESTRAN LAS RESPUESTAS DE LA PUBLICACIÓN
    ?>
    <center><div class="repliestitle"><h1>Respuestas</h1></div></center>
    <?php
            while($reg=mysqli_fetch_array($consulta)) {
    ?>
    <div class="replybox">
            <?php
                $nusuario=$reg["nombreUsuario"];
                #ENLACE A PERFIL?>
                <a href="../BD243224428/verPerfil.php?nombredeusuario=<?php echo $nusuario ?>" class="linksposts"><?php echo $nusuario ?></a><br><br>
                <?php echo $reg["respuesta"];?>
                <div class="date">
                    <?php echo $reg["fechaRespuesta"];?>
                </div>
        </div>
    <?php
         }
    ?>
    <center>
        <button id="returnbutton" onclick="location.href = '../principal.php';">Volver a Pagina principal</button>
    </center>
    <?php
        }
    ?>
</html>
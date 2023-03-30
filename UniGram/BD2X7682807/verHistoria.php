<!DOCTYPE html>
<html>
    <head>
        <title>Publicaciones de la historia</title>
        <link rel="stylesheet" type="text/css" href="storystyle.css">
    </head>
    <?php
        include "../conexiones.php";
        // Obtenemos el id pasado por enlace tras clickar el boton de "Ver publicaciones"
        session_start();
        $usuariosesion= $_SESSION["nombreUsuario"];
        $id = $_GET["id"];
        $nom=mysqli_query($conexio,"SELECT nombreUsuario FROM historia WHERE idHistoria= $id");
        $nombreusuario=mysqli_fetch_array($nom);
        $stringPosts = "SELECT * FROM publicacion WHERE idHistoria = $id ORDER BY fechaCreacion DESC";
        $posts = mysqli_query($conexio,$stringPosts);
        
        // Vemos si la historia tiene publicaciones o no
        $numrows = mysqli_num_rows($posts);
        if($numrows == 0){
    ?>
    <div class="nopostsmessage">
        <div class="center">
            <h1>¡Vaya! Esta historia no tiene publicaciones aun</h1><br>
            <center>
                <button id="createbutton" onclick="location.href = '../principal.php';">Volver a Pagina Principal</button>
            </center>
        </div>
    </div>
    <?php }
        else{
        // Mostrar las publicaciones
        while($reg = mysqli_fetch_array($posts)){
    ?>     
    <div class="poststorybox">
        <div class="user">
            <h2><a href="../BD243224428/verPerfil.php?nombredeusuario=<?php echo $reg["nombreUsuario"] ?>" 
            class="linksposts"><?php echo $reg["nombreUsuario"]?></a></h2>
        </div>
        <div class="desc">
            <?php echo $reg["descripcion"];?>
        </div>
        <?php
        if ($usuariosesion == $nombreusuario["nombreUsuario"]) {
            ?>
            <a href="../BD243223476/deletePublicacion.php?id=<?php echo $reg["idPublicacion"];?>">
                <button id="erasebutton" style="bottom:70px;"></button>
            </a>
        <?php
        }
        ?>
        <div class="date">
            <?php echo $reg["fechaCreacion"];?>
        </div>
        <button id="seerepliesbutton"><a href="../BD243223476/verRespuestas.php?id=<?php echo $reg["idPublicacion"];?>"
                                class="replylink">Ver Respuestas</a></button>
        <div class="replybox">
            <form method="post" action="../BD243223476/insertRespuesta.php">
            <textarea id="replytextarea" name = "respuesta" placeholder="Redacta tu respuesta" required maxlength="255"></textarea><br>
            <input type="hidden" name="idPublicacion" value=<?php echo $reg["idPublicacion"] ?>>
            <div class ="replybutton">
                <input type="submit" value="Responder" class="roundborder">
            </div>
            </form>
            <!-- NO SE PUEDEN REENVIAR PUBLICACIONES DE HISTORIAS PORQUE SINO SALDRÍAN EN LA FEED PRINCIPAL Y ESO NO SE PUEDE. POR ESO NO PONEMOS BOTÓN DE REENVÍO -->
        </div>
    </div>
    <?php
        // End WHILE
        }
    ?>
    <center>
        <button id="returnbutton" onclick="location.href = '../principal.php';">Volver a Pagina principal</button>
    </center>
    <?php
        // End ELSE
        }
    ?>    
    
   
</html>
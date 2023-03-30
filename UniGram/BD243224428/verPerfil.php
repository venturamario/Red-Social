<html>
    <head>
        <title><?php
            $x=$_GET['nombredeusuario'];
            echo $x;
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="profileStyle.css">
    </head>

    <?php
        include "../conexiones.php";
        session_start();
        $a=$_SESSION['nombreUsuario'];
        $query1 = mysqli_query($conexio,"SELECT COUNT(nombreUsuario) FROM publicacion WHERE nombreUsuario='$x' AND idHistoria IS NULL");
        $query2 = mysqli_query($conexio,"SELECT COUNT(nombreUsuario2) FROM r_follower WHERE nombreUsuario2='$x'");
        $query3 = mysqli_query($conexio,"SELECT COUNT(nombreUsuario1) FROM r_follower WHERE nombreUsuario1='$x'");
        $query4 = mysqli_query($conexio,"SELECT * FROM usuario WHERE nombreUsuario='$x'");
        $query5 = mysqli_query($conexio,"SELECT * FROM r_follower WHERE nombreUsuario1='$a'");
        $numPublicaciones = mysqli_fetch_array($query1);
        $numFollowers= mysqli_fetch_array($query2);
        $numFollowed= mysqli_fetch_array($query3);
        $datos= mysqli_fetch_array($query4);
    ?>
    <button onclick="location.href = '../principal.php';"><img src="home.png" height="50px" style="position:absolute;"></img></button>
    <div class="profileBox">
        <center>
            <img src="user.png" height="150px"></img>
            <hr class="round">
            <div class="profileinfo">
                <?php echo "<h1> $x </h1>";?><br>
                <?php
                    #USUARIO PASADO POR PARÁMETRO ES IGUAL AL USUARIO DE LA SESIÓN. SI LO ES, SALE BOTÓN DE MODIFICAR PERFIL
                    if ($x == $a) {
                    ?>
                    <a href="modificarPerfil.php?passwordoriginal=<?php echo $datos["password"]?>&nombreoriginal=<?php echo $datos["nombre"]?>&apellidosoriginales=<?php echo $datos["apellidos"]?>&generoriginal=<?php echo $datos["genero"]?>&edadoriginal=<?php echo $datos["edad"]?>&biografiaoriginal=<?php echo $datos["biografia"]?>">
                            <button id="profileButton">
                                MODIFICAR PERFIL
                            </button>
                        </a>
                    <?php
                    }
                    #SI NO LO ES, SE MUESTRA BOTÓN DE SEGUIR (O SIGUIENDO SI YA LE SIGUE)
                    else {
                        $lesigue=FALSE;
                        while ($listaseguidos=mysqli_fetch_array($query5)) {
                            if ($listaseguidos["nombreUsuario2"]==$x) {
                                $lesigue=TRUE;
                                break;
                        }
                        }
                        if ($lesigue==FALSE) {
                        ?>
                            <a href="follow.php?nombredeusuario1=<?php echo $a ?>&nombredeusuario2=<?php echo $x ?>">
                                <button id="profileButton">
                                    SEGUIR
                                </button>
                            </a>
                        <?php
                        }
                        else {
                        ?>
                            <a href="unfollow.php?nombredeusuario1=<?php echo $a ?>&nombredeusuario2=<?php echo $x ?>">
                                <button id="profileButtonFollowing">
                                    SIGUIENDO
                                </button>
                            </a>
                        <?php
                        }
                    }
                ?>
                <!-- SE IMPRIMEN DATOS BÁSICOS DEL PERFIL -->
                <br><br>
                <?php echo $numPublicaciones["COUNT(nombreUsuario)"] ?> publicacion/es&emsp;●&emsp;
                <?php echo $numFollowers["COUNT(nombreUsuario2)"] ?> seguidores&emsp;●&emsp;
                <?php echo $numFollowed["COUNT(nombreUsuario1)"] ?> seguidos
                <br><br>
                </div>
                <div class="profileinfo2">
                <?php echo $datos["nombre"].' '.$datos["apellidos"] ?>&emsp;●&emsp;
                <?php echo $datos["genero"] ?>&emsp;●&emsp;
                <?php echo $datos["edad"] ?> años
                <?php echo "<br><br> <h2>Acerca de mi</h2>"?>
                </div>
                <p class="biografia"><?php echo $datos["biografia"]?></p>
            </div>
        </center>
    </div>
    
    <!-- SE MUESTRA UNA FEED DE PUBLICACIONES Y DE HISTORIAS DEL USUARIO DEL PERFIL -->
    <div class="feed">
        <center>
        <div class="feedtitle">Feed</div>
        </center>
        <div class="postsfeed">
            <center>
            <h3>Publicaciones</h3>
            </center>
            <?php
                # Mostrar PUBLICACIONES
                $stringPublicacion="SELECT * FROM publicacion WHERE nombreUsuario='$x' AND idHistoria IS NULL ORDER BY fechaCreacion DESC";
                $publicaciones=mysqli_query($conexio,$stringPublicacion);
                while($reg=mysqli_fetch_array($publicaciones)){
            ?>
                <div class="post">
                    <?php
                        $nusuario=$reg["nombreUsuario"];
                        #ENLACE A PERFIL, Si es un reenvio sale "Reenviado por"?>
                        <?php if($reg["idPublicacion2"] != ""){
                        ?>
                        <div class="postuser">
                            <b>Reenviado por <?php echo $nusuario ?></b><br><br>
                        </div>
                        <?php 
                            }
                            else{
                        ?>
                        <div class="postuser">
                            <b><?php echo $nusuario ?></b><br><br>
                        </div>
                        <?php
                            }
                        if ($x == $a) {
                            ?>
                            <a href="../BD243223476/deletePublicacion.php?id=<?php echo $reg["idPublicacion"];?>">
                                <button id="erasebutton"></button>
                            </a>
                        <?php
                        }
                        ?>

                        <div class="postdesc">
                            <?php echo $reg["descripcion"];?>
                        </div>
                        <div class="date">
                            <?php echo $reg["fechaCreacion"];?>
                        </div>
                        <!-- BOTÓN QUE MUESTRA LAS RESPUESTAS DE LA PUBLICACIÓN -->
                        <button id="seerepliesbutton"><a href="../BD243223476/verRespuestas.php?id=<?php echo $reg["idPublicacion"];?>"
                                class="linksnavbar">Ver Respuestas</a></button>
                        <!-- TEXTAREA PARA ESCRIBIR UNA RESPUESTA O PARA REENVIAR LA PUBLICACIÓN -->
                        <div class="replybox">
                            <form method="post" action="../BD243223476/insertRespuesta.php">
                                <textarea id="replytextarea" name = "respuesta" placeholder="Redacta tu respuesta" required maxlength="255"></textarea><br>
                                <input type="hidden" name="idPublicacion" value=<?php echo $reg["idPublicacion"] ?>>
                                <div class ="replybutton">
                                    <input type="submit" value="Responder" class="roundborder">
                                </div>
                            </form>
                            <!-- SI LA PUBLICACIÓN ES UN REENVÍO, SALE EL BOTÓN DE REENVÍO NORMAL Y SE PUEDE PULSAR. SINO, SALE EN VERDE Y NO SE PUEDE PULSAR. NO HACE NADA -->
                            <?php if($reg["idPublicacion2"] == ""){
                            ?>
                            <div class="reenvio">
                                <a href="../BD243223476/insertReenvio.php?id1=<?php echo $reg["idPublicacion"]?>&id2=<?php echo $reg["descripcion"]?>">   
                                    <button id="reenviarbutton"></button>
                                </a>
                            </div>
                            <?php
                                }
                                else {?>
                                <div class="reenvio">
                                    <button id="reenviadobutton"></button>
                                </div>
                                <?php
                                }
                            ?>               
                        </div>
                </div>
                <?php
                    }
                ?>
            </div>
        <div class="storiesfeed">
            <center>
            <h3>Historias</h3>
            </center>
            <?php
                # Mostrar HISTORIAS de la gente que sigue
                $stringF="SELECT * FROM r_follower WHERE nombreUsuario1='$a' AND nombreUsuario2='$x'";
                $sesiguen=mysqli_query($conexio,$stringF);
                #LE SIGUE O ES ÉL MISMO, ASÍ QUE SACA TODAS LAS HISTORIAS
                if (mysqli_num_rows($sesiguen)!=0 or $x==$a) {
                    $stringH="SELECT * FROM historia WHERE nombreUsuario='$x' ORDER BY fechaHistoria DESC";
                    $historias1=mysqli_query($conexio,$stringH);
                }
                #NO LE SIGUE, ASÍ QUE SOLO SACA LAS HISTORIAS PÚBLICAS
                else {
                    $stringH="SELECT * FROM historia WHERE nombreUsuario='$x' AND privada=FALSE ORDER BY fechaHistoria DESC";
                    $historias1=mysqli_query($conexio,$stringH);
                }

                while ($reg1=mysqli_fetch_array($historias1)) {
            ?>
                    <div class="story">
                        <?php
                            $storyuser=$reg1["nombreUsuario"];
                        ?>
                        <h3 style="color:black;">Historia #<?php echo $reg1["idHistoria"] ?> de <?php echo $storyuser ?></h3>
                        <?php
                        if ($x == $a) {
                            ?>
                            <a href="../BD243223476/deleteHistoria.php?id=<?php echo $reg1["idHistoria"];?>">
                                <button id="erasebutton" style="bottom:40px;"></button>
                            </a>
                        <?php
                        }
                        ?>
                        <div class="desc">
                            <?php echo $reg1["descripcion"]?>
                        </div>
                        <div class="storydate">
                            <?php echo $reg1["fechaHistoria"]?>
                        </div>
                        <button id="seepostsbutton"><a href="../BD2X7682807/verHistoria.php?id=<?php echo $reg1["idHistoria"];?>"
                            class="linksnavbar">Ver publicaciones</a></button>
                    </div>
                <?php
                    }
                ?>
        </div>
    </div>
    <!-- SE RECARGA LA PÁGINA CADA 30 SEGUNDOS -->
    <head>
        <meta http-equiv="refresh" content="30;url=verPerfil.php?nombredeusuario=<?php echo $x ?>" />
    </head>
</html>

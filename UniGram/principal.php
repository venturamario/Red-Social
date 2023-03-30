<!DOCTYPE html>
<html>
    <head>
        <title>Pagina principal</title>
        <link rel="stylesheet" type="text/css" href="principalstyle.css">
        <!-- SE RECARGA LA PÁGINA CADA 30 SEGUNDOS -->
        <meta http-equiv="refresh" content="30;url=principal.php"/>
    </head>


    <?php
        session_start();
        $user = $_SESSION["nombreUsuario"];
        include "conexiones.php";
    ?>

    <body>
        <div class="headerbox">
            <div class="headerlogo">  
                <img src="unigram.png"></img>
            </div>
            <div class="headerwelcome">  
                <?php
                    echo "<h1>Bienvenido, $user</h1>";
                ?>
            </div>
            <?php
                #MIRA SI HAY MENSAJES SIN LEER
                $stringMsj="SELECT COUNT(nombreReceptor) FROM mensaje WHERE nombreReceptor= '$user' AND leido= FALSE";
                $consultaMsj= mysqli_query($conexio, $stringMsj);
                $consultaArr = mysqli_fetch_array($consultaMsj);
            ?>

            <div class="navbar">
                <ul>
                    <li><a href="BD243224428/verPerfil.php?nombredeusuario=<?php echo $user ?>" class="linksnavbar">Ver mi perfil</a></li>
                    <li><a href="BD2X7682807/historias.php" class="linksnavbar">Mis historias</a></li>
                    <li><a href="BD243224428/verMisFollowers.php" class="linksnavbar">Mis followers</a></li>
                    <li><a href="BD243224428/verFollowed.php" class="linksnavbar">Gente que sigo</a></li>
                    <li><a href="BD243224428/verUsuarios.php" class="linksnavbar">Usuarios</a></li>
                    <li>
                        <?php
                        #EN CASO DE HABER MENSAJES SIN LEER, EL ELEMENTO DE LA NAVBAR DE MENSAJES SALE EN ROJO Y SE MUESTRA EL NÚMERO DE MENSAJES SIN LEER. SINO SALE NORMAL
                            if ($consultaArr["COUNT(nombreReceptor)"]>0) {?>
                                <a href="BD243475994/mensajes.php"class="linksnavbarunread">Mensajes (<?php echo $consultaArr["COUNT(nombreReceptor)"].' '."sin leer)"?></a>
                            <?php
                            }
                            else {?>
                                <a href="BD243475994/mensajes.php"class="linksnavbar">Mensajes</a>
                            <?php
                            }
                            ?>
                    </li>
                    <div class="cerrarsesionli">
                        <li><a href="BD2X7682807/cierresesion.php" class="linksnavbar">Cerrar sesion</a></li>
                    </div> 
            </div>  
        </div>
        
        <!-- TEXTAREA PARA HACER UNA PUBLICACIÓN -->
        <div class="postbox">
            <div class="center">
                <center>
                    <h1>Crear publicacion</h1>
                </center>
                <form method="post" action="BD243223476/insertPublicacion.php">
                    <textarea id="posttextarea" name = "publicacion" placeholder="Redacta tu publicacion" required maxlength="255"></textarea><br>
                    <center>
                        <?php
                        $stringElegirHist="SELECT * FROM historia WHERE nombreUsuario=\"$user\"";
                        $stories=mysqli_query($conexio,$stringElegirHist);
                        ?>
                        <br><label><h3>Añádela a una historia</h3></label>
                        <!-- SELECT DEBAJO POR SI QUIERES METER LA PUBLICACIÓN EN UNA HISTORIA -->
                        <select name="elegirhist">
                            <option value="NULL">Sin historia</option>
                            <?php while($regH=mysqli_fetch_array($stories)){
                            ?>
                            <option value="<?php echo $regH["idHistoria"];?>">
                                <?php echo "Historia #",$regH["idHistoria"];?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                        <br><br><input type="submit" value="Publicar" class="roundborder">
                    </center>
                </form>
            </div>
        </div>
        
        <!-- FEED DE TANTO PUBLICACIONES QUE NO PERTENECEN A HISTORIAS COMO HISTORIAS -->
        <div class="feed">
            <center>
                <div class="feedtitle">Mi feed</div>
            </center>
            <div class="postsfeed">
                <center>
                <h3>Publicaciones</h3>
                </center>
                <?php
                    # Mostrar PUBLICACIONES que no pertenecen a HISTORIAS. ADEMÁS SOLO SALEN LAS PUBLICACIONES DE LA GENTE QUE SIGUE EL USUARIO Y LAS DEL PROPIO USUARIO. ESTO PUEDE HACERSE CON UN UNION
                    $stringPublicacion="SELECT * FROM publicacion JOIN r_follower WHERE nombreUsuario='$user' AND idHistoria IS NULL GROUP BY idPublicacion
                    UNION
                    SELECT * FROM publicacion JOIN r_follower ON nombreUsuario1='$user' AND nombreUsuario=nombreUsuario2 AND idHistoria IS NULL ORDER BY fechaCreacion DESC";
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
                            <b>Reenviado por </b><a href="BD243224428/verPerfil.php?nombredeusuario=<?php echo $nusuario ?>" class="linksposts"><?php echo $nusuario ?></a><br><br>
                        </div>
                        <?php
                            }
                            else{
                        ?>
                        <div class="postuser">
                            <a href="BD243224428/verPerfil.php?nombredeusuario=<?php echo $nusuario ?>" class="linksposts"><?php echo $nusuario ?></a><br><br>
                        </div>
                        
                        <?php
                            }
                        ?>
                        <?php
                        if ($nusuario == $user) {
                            ?>
                            <a href="BD243223476/deletePublicacion.php?id=<?php echo $reg["idPublicacion"];?>">
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
                        <button id="seerepliesbutton"><a href="BD243223476/verRespuestas.php?id=<?php echo $reg["idPublicacion"];?>"
                                class="linksnavbar">Ver Respuestas</a></button>
                        
                        <div class="replybox">
                            <form method="post" action="BD243223476/insertRespuesta.php">
                                <textarea id="replytextarea" name = "respuesta" placeholder="Redacta tu respuesta" required maxlength="255"></textarea><br>
                                <input type="hidden" name="idPublicacion" value=<?php echo $reg["idPublicacion"] ?>>
                                <div class ="replybutton">
                                    <input type="submit" value="Responder" class="roundborder">
                                </div>
                            </form>
                            <?php if($reg["idPublicacion2"] == ""){
                            ?>
                            <div class="reenvio">
                                <a href="BD243223476/insertReenvio.php?id1=<?php echo $reg["idPublicacion"]?>&id2=<?php echo $reg["descripcion"]?>">   
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
                    # Mostrar HISTORIAS de la gente que sigue Y LAS DEL PROPIO USUARIO. TAMBIÉN SE HACE CON UNION
                    $stringHistoria="SELECT * FROM historia JOIN r_follower WHERE nombreUsuario='$user' GROUP BY idHistoria
                    UNION
                    SELECT * FROM historia JOIN r_follower ON nombreUsuario1='$user'AND nombreUsuario=nombreUsuario2 ORDER BY fechaHistoria DESC";
                    $historias=mysqli_query($conexio,$stringHistoria);
                    while($reg1=mysqli_fetch_array($historias)){
                ?>
                <div class="story">
                    <?php
                        $storyuser=$reg1["nombreUsuario"];
                    ?>
                    <h3>Historia #<?php echo $reg1["idHistoria"] ?> de <a href="BD243224428/verPerfil.php?nombredeusuario=<?php echo $storyuser ?>" class="linksposts"><?php echo $storyuser ?></a></h3>
                    <?php 
                        if ($storyuser == $user) {
                            ?>
                            <a href="BD243223476/deleteHistoria.php?id=<?php echo $reg1["idHistoria"];?>">
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
                    <button id="seepostsbutton"><a href="BD2X7682807/verHistoria.php?id=<?php echo $reg1["idHistoria"];?>"
                        class="linksnavbar">Ver publicaciones</a></button>
                </div>
                <?php
                    } 
                ?>
            </div>
        </div>
    </body>
</html>

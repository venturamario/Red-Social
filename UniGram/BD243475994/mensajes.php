<!DOCTYPE html>
<html>
    <head>
        <title>Mensajes</title>
        <link rel="stylesheet" type="text/css" href="mensajesstyle.css">
    </head>
    
    <body>
        <div class = "usersbox">
            <div class = "messagetitle"><h1>Mis mensajes</h1>
                <a href="../principal.php">
                    <button id="homebutton">
                    </button>
                </a>
            </div>
            <?php
                session_start();
                $nombreusuario = $_SESSION['nombreUsuario'];
                include "../conexiones.php";
                #SE MUESTRAN TODOS LOS USUARIOS DE LA BASE DE DATOS MENOS EL QUE INICIA SESIÓN A UNA ESQUINA
                $stringUsuario="SELECT nombreUsuario FROM usuario WHERE nombreUsuario!='$nombreusuario' ORDER BY nombreusuario ASC";
                #SE SELECCIONAN AQUÍ TODOS LOS USUARIOS QUE HAYAN MANDADO UN MENSAJE AL QUE INICIA SESIÓN Y AÚN NO SE HAYA LEÍDO
                $stringNoLeido="SELECT DISTINCT(nombreUsuario) FROM usuario JOIN mensaje ON nombreReceptor='$nombreusuario' AND leido=FALSE AND nombreEmisor=nombreUsuario ORDER BY nombreusuario ASC";
                $nombresUsuariosnoleidos=mysqli_query($conexio,$stringNoLeido);
                $nombresusuarios=mysqli_query($conexio,$stringUsuario);
                $seguirenArray=TRUE;
                #SE RECORREN TODOS LOS USUARIOS Y DEPENDIENDO DE SI UNO DE LOS USUARIOS LE HA MANDADO UN MENSAJE AL QUE INICIA SESIÓN O NO, SALDRÁ SU NOMBRE EN ROJO
                while($reg=mysqli_fetch_array($nombresusuarios)){
                    if($seguirenArray==TRUE) {
                        $reg2=mysqli_fetch_array($nombresUsuariosnoleidos);
                        $seguirenArray=FALSE;
                    }
                    if ($reg2!=NULL) {
                        if ($reg["nombreUsuario"]==$reg2["nombreUsuario"]) {
                            $seguirenArray=TRUE;?>
                            <button id="userbox">
                                <a href="verMensajes.php?receptor=<?php echo $reg["nombreUsuario"] ?>" class="linksmessageUnread"><?php echo $reg["nombreUsuario"] ?></a>
                            </button>
                        <?php
                        }
                        else {?>
                            <button id="userbox">
                                <a href="verMensajes.php?receptor=<?php echo $reg["nombreUsuario"] ?>" class="linksmessage"><?php echo $reg["nombreUsuario"] ?></a>
                            </button>
                        <?php
                        }
                    }
                    else {
                        ?>
                            <button id="userbox">
                                <a href="verMensajes.php?receptor=<?php echo $reg["nombreUsuario"] ?>" class="linksmessage"><?php echo $reg["nombreUsuario"] ?></a>
                            </button>
                        <?php
                    }
                }
            ?>
        </div>
    </body>    

</html>



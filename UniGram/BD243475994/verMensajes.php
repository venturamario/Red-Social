<!DOCTYPE html>
<html>
    <body>
        <?php
            #SE INCLUYE MENSAJES.PHP PARA MANTENER LA USERBOX CON TODOS LOS USUARIOS A UN LADO CUANDO SE ABRE UN CHAT
            include "mensajes.php";
            include "../conexiones.php";
            $receptor=$_GET['receptor'];
            #SE COGEN TODOS LOS MENSAJES ENTRE LOS DOS USUARIOS Y SE ORDENAN POR ID PARA QUE ESTÉN POR ORDEN
            $query="SELECT * FROM mensaje WHERE (nombreEmisor='$nombreusuario' OR nombreEmisor='$receptor') AND (nombreReceptor='$nombreusuario' OR nombreReceptor='$receptor') ORDER BY idMensaje ASC";
            $stringLeer="UPDATE mensaje SET leido=TRUE WHERE nombreReceptor='$nombreusuario' AND nombreEmisor='$receptor'";
            $update=mysqli_query($conexio,$stringLeer);
            $mensajes=mysqli_query($conexio,$query);
        ?>
        <div class = "chatmessagesbox">
            <center>
            <div class= "chattitle"><h1>Chat con <a href="../BD243224428/verPerfil.php?nombredeusuario=<?php echo $receptor ?>" class="linkchat"><?php echo $receptor ?></a><hr></h1>
            </div>
            <br><br><br><br>
                    <?php
                        while ($reg=mysqli_fetch_array($mensajes)) {
                            #SI UN MENSAJE LO MANDA EL EMISOR SALE A LA DERECHA. SINO A LA IZQUIERDA.
                            if ($reg["nombreEmisor"]==$nombreusuario) {?>
                                <p id="boxTransmitter">
                                    <?php 
                                    if ($reg["leido"]==0){
                                        echo "✓ ";
                                    }
                                    else {
                                        echo "✓✓ ";
                                    } 
                                    echo $reg["contenido"];
                                    ?>
                                </p>
                            <?php
                            }
                            elseif ($reg["nombreEmisor"]==$receptor) {?>
                                <p id="boxReceiver">
                                    <?php echo $reg["contenido"] ?>
                                </p>
                            <?php
                            }
                        }
                    ?>
            </center>
        </div>
        <div class="insertmessagebox">
            <form method="post" action="enviarMensaje.php">
                <textarea  name = "mensaje" required maxlength="180" placeholder="Inserte un mensaje"></textarea>
                <input type="hidden" name="receptor" value=<?php echo $receptor ?>>
                <input type="hidden" name="emisor" value=<?php echo $nombreusuario ?>>
                <input type="image" src="send.png" alt="Submit">
            </form>   
        </div>

    </body>      

</html>

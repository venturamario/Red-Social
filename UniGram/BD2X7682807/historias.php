<!DOCTYPE html>
<html>
    <head>
        <title>Historias</title>
        <link rel="stylesheet" type="text/css" href="storystyle.css">
    </head>

    <?php
        session_start();
        #SE COGE EL USUARIO QUE INICIÓ SESIÓN
        $user = $_SESSION["nombreUsuario"];
        include "../conexiones.php"; 
    ?>

    <body>
        <div class="headerbox">
            <div class="headertitle"><h1>Mis historias</h1></div>
            <a href="../principal.php">
                <button id="homebutton">
                </button>
            </a>
        </div>

        <div class="createstorybox">
            <!-- SI SE PULSA ESTE BOTÓN, TE LLEVA A UN FORM PARA CREAR UNA HISTORIA -->
            <div class="storytitle"><h1>Crea aqui tu historia</h1></div>
            <center>
                <button id="createbutton" onclick="location.href = 'crearHistoriaForm.html';">CREAR</button>
            </center>
        </div>
        <!-- AQUÍ SIMPLEMENTE SE MUESTRAN TODAS LAS HISTORIAS DEL USUARIO CON SU INFORMACIÓN BÁSICA -->
        <div class="storyfeedbox">
            <?php
                $stringStories = "SELECT * FROM historia WHERE nombreUsuario = \"$user\" ORDER BY fechaHistoria DESC";
                $stories = mysqli_query($conexio,$stringStories);
                while($reg = mysqli_fetch_array($stories)){
            ?>
            <div class="storybox">
                <?php
                    if($reg["privada"] == 1){
                        $estado = "<p class='privatestory'>[Privada]</p>";
                    }
                    else{
                        $estado = "<p class='publicstory'>[Publica]</p>";
                    }
                    #EL NÚMERO DE LA HISTORIA REPRESENTA EL ID DENTRO DE LA BASE DE DATOS, NO SIGNIFICA QUE ES LA HISTORIA #X DE UN USUARIO
                    echo "<h2>Historia #",$reg["idHistoria"],"<h3>",$estado,"</h3>","</h2>";
                ?>
                <div class="desc">
                    <?php echo $reg["descripcion"]?>
                </div>
                <div class="date">
                    <?php echo $reg["fechaHistoria"]?>
                </div>
                <!-- SI SE PULSA ESTE BOTÓN, SE MUESTRAN LAS PUBLICACIONES ASOCIADAS A LA HISTORIA -->
                <button id="seepostsbutton"><a href="verHistoria.php?id=<?php echo $reg["idHistoria"];?>">Ver publicaciones</a></button>
            </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>
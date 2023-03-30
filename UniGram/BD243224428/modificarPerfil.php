<html>
    <head>
        <title>Modifica tu cuenta</title>
        <link rel="stylesheet" type="text/css" href="createAccstyle.css">
    </head>
    <?php
        session_start();
        #SE COGEN LOS DATOS ORIGINALES DESDE EL PERFIL GENERADO POR SI EL USUARIO NO DESEA MODIFICARLOS
        #DE ESTA FORMA, LOS DEJAMOS PUESTOS UNA VEZ SE ABRE EL FORM DE MODIFICAR PERFIL
        $nombreusuarioriginal=$_SESSION["nombreUsuario"];
        $passwordoriginal=$_GET['passwordoriginal'];
        $nombreoriginal=$_GET['nombreoriginal'];
        $apellidosoriginales=$_GET['apellidosoriginales'];
        $generoriginal=$_GET['generoriginal'];
        $edadoriginal=$_GET['edadoriginal'];
        $biografiaoriginal=$_GET['biografiaoriginal'];
    ?>
    <body>
        <div class="accountformbox">
            <div class="center">
                <form method="post" action="userModif.php">
                        <center>
                            <h2>MODIFICA TU CUENTA</h2><br>
                        </center>
                        <label>Nombre de Usuario (NO MODIFICABLE)</label>
                        <input type="text" value="<?php echo $nombreusuarioriginal?>", name="nombreUsuario" placeholder="Introduzca su nombre de usuario" class="roundborder" required maxlength="20" readonly>

                        <label>Password</label>
                        <input type="password" value="<?php echo $passwordoriginal?>", name="password" placeholder="Introduzca su password" class="roundborder" required maxlength="20">

                        <label>Nombre</label>
                        <input type="text" value="<?php echo $nombreoriginal?>", name="nombre" placeholder="Introduzca su nombre" class="roundborder" required maxlength="15">

                        <label>Apellidos</label> 
                        <input type="text" value="<?php echo $apellidosoriginales?>", name="apellidos"  placeholder="Introduzca sus apellidos (opcional)" class="roundborder" maxlength="25">

                        <label>Genero</label>
                            <select name="genero">
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                                <option value=NULL>Prefiero no especificar</option>
                            </select>

                        <br><br><label>Edad</label>
                        <input type="number" value="<?php echo $edadoriginal?>", name="edad"  placeholder="Introduzca su edad" class="roundborder" required="required">

                        <label>Biografia</label>
                        <input type="text" value="<?php echo $biografiaoriginal?>", name="biografia" placeholder="Introduzca una biografia (opcional)" class="roundborder" maxlength="150">
                    <input type="submit" value="Actualizar">
                    <form action="verPerfil.php?nombredeusuario=<?php echo $nombreusuarioriginal?>">
                        <input type="submit" value="Volver Atras">
                    </form>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
    #SIMPLEMENTE SE DESTRUYE LA SESIÓN EN CASO DE CERRAR SESIÓN Y SE VUELVE A LA PANTALLA DE LOGIN
    session_start();

    session_destroy();

    header("Location:../index.html");
?>
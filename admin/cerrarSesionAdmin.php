<?php

    //iniciamos la sesion para poder trabajar con ella
    if (!isset($_SESSION['on'])) {
        session_start();
        $_SESSION['on']=true;
    }

    //borramos la sesion haciendo unset de todas las variables de la misma y destruyendola
    session_unset();
    session_destroy();

    //llevamos al usuario de vuelta
    header('Location: formSesion.php');

<?php
    require_once('../clases/includesAdmin.php');

    //si la contraseña es correcta empezamos la sesion y llevamos al admin a la pagina de inicio
    if ($_POST['pass']==$adminPass) {
        if (!isset($_SESSION['on'])) {
            session_start();
            $_SESSION['on']=true;
            $_SESSION['admin']=true;
        }
        header('Location: ../admin/index.php');
    }

    //si es incorrecta llevamos al usuario de vuela a la pagina del login con un dato extra para marcar el fallo
    else{
        header('Location: formSesion.php?no=true');
    }

<?php
    //empezamos la sesion
    session_start();

    require_once('clases/includes.php');

    //creamos un objeto usuario con los datos recibidos para luego llamar a la funcion que lo inserta en base de datos y devuelve el id
    $user = new Usuario($_POST['nombre'],$_POST['tlf'],$_POST['dir']);
    $idUser = $user->crearUser();
    
    //lo mismo con la reserva
    $reserva = new Reserva(str_replace('T',' ',$_POST['fecha']).":00", 'pendiente', $idUser);
    $idRes = $reserva->crearRes();

    //guardamos los ids en una sesion para luego usarlos al enseñar la reserva
    $_SESSION['idUser'] = $idUser;
    $_SESSION['idRes'] = $idRes;

    //llevamos al usuario a ver la reserva
    header('Location: verReservaC.php');

?>
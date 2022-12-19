<?php
    //empezamos la sesion e importamos los archivos pertinentes
    require_once('clases/includes.php');
    session_start();

    //recibimos la informacion que necesitamos de la sesion
    $idRes = $_SESSION['idRes'];
    $idUser = $_SESSION['idUser']; 
    
    //recibimos toda la info que necesitamos enviando a funciones la informacion de antes
    $estado = Reserva::verEstado($idRes);
    $fecha = Reserva::verFecha($idRes);
    $user = Usuario::verUsxId($idUser);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su pedido</title>
    <link href="estilos/universal.css" rel="stylesheet">
    <link href="estilos/header.css" rel="stylesheet">
    <link href="estilos/stylesVerR.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<body>
    <header id="header" style="left: 100%;">
        <div class="logo logoP" onclick="location.href='./'">
            <img src="images/logo.png" alt="Logo" class="logoIcon">
            <p class="display">MÕ Sushi Wok Fusion</p>
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="./pedido.php">Pedir</a>
            <a href="reserva.php">Reservar</a>
            <a href="checkPedido.php">Comprobar pedido</a>
            <a href="checkReserva.php">Comprobar reserva</a>
        </nav>
    </header>
    <main>
        <!-- Div para header del movil -->
        <div class="divEncima" id="divEncima"></div>
        <div id="navB" class="navB menosOscuro nav-icon1">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="arriba">
            <div class="logo logo2" onclick="location.href='./'">
                <img src="images/logo.png" alt="Logo" class="logoIcon">
                <p class="display">MÕ Sushi Wok Fusion</p>
            </div>
        </div>
        <!-- div donde se ve la info del pedido -->
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de reserva: <?php echo $idRes.' ('. $fecha.')';?></div>
                <div class="info"><?php  echo $user;  ?></div>
            </div>
            <div class="info2"> 
                <div class="estado"><?php echo ucfirst($estado);?></div>
                <!-- div para usar ajax -->
                <div id="ajaxDiv"></div>
                <div class="mensaje">
                <?php
                    //sacamos las opciones segun el estado actual del pedido
                    if ($estado == 'pendiente') {
                        ?>
                            <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`confirmada`'?>,<?php echo $user->getTlf()?>); location.reload();">Confirmar reserva</button>
                            <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`cancelada`'?>,<?php echo $user->getTlf()?>); location.reload();">Cancelar reserva</button>
                        <?php
                    }
                    elseif ($estado == 'confirmada') {
                        ?>
                            <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`cancelado`'?>,<?php echo $user->getTlf()?>); location.reload();">Cancelar reserva</button>
                        <?php
                    }
                    elseif($estado == 'cancelada'){
                        echo 'Reserva cancelada por el cliente.';
                    }

                    elseif ($estado == 'rechazada') {
                        echo 'Reserva rechazada por el establecimiento';
                    }

                    else{
                        echo 'No se puede cancelar la reserva al estar en preparación. Para mas información llame directamente al establecimiento.';
                    }
                ?>
                </div>
            </div>
        </div>
        <?php
        ?>
    </main>
    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>
    <script src="javaScript/ajax/ajaxRes.js"></script>
</body>
</html>
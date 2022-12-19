<?php
    //empezamos la sesion e importamos los archivos pertinentes
    require_once('clases/includes.php');
    session_start();

    //recibimos la informacion que necesitamos de la sesion
    $idPed = $_SESSION['idPed'];
    $idUser = $_SESSION['idUser']; 
    
    //recibimos toda la info que necesitamos enviando a funciones la informacion de antes
    $estado = Pedido::verEstado($idPed);
    $fecha = Pedido::verFecha($idPed);
    $lineas = Linea::verLineaxPedido($idPed);
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
    <link href="estilos/stylesVerP.css" rel="stylesheet">
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
        <!-- Divs para header del movil -->
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

        <!-- div donde se muestra la info del pedido -->
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de pedido: <?php echo $idPed.' ('. $fecha.')';?></div>
                <div class="info"><?php echo $user; ?></div>
            </div>
            <div class="lineas">
                <?php
                    //recorremos el array que contiene las lineas de pedido y las sacamos
                    if (!empty($lineas)) {
                        $i = 0;
                        $total = 0;
                        foreach ($lineas as $key => $value) {
                            echo '<div class="linea linea'.$i.'">';
                            echo '<div class="prodData nombreProd">'.$value->getIdProd().' x'.$value->getCant().'</div>';
                            echo '<div class="prodData precioProd">'.$value->getPrecioT().'€</div>';
                            echo '</div>';
                            $i++;
                            $total += $value->getPrecioT();
                        }
                    }
                    else{
                        $total = 0;
                        echo 'Ningun producto seleccionado.';
                    }
                ?>
            </div>
            <!-- div precio total -->
            <div class="total">
                <div class="estado"><?php echo ucfirst($estado);?></div>
                <div class="subtotal">
                    <p><?php echo $total;?>€</p>
                    <p class="lineaAbajo">Servicio a domicilio: <?php echo $servicio;?>€</p>
                    <p><?php echo $total + $servicio;?>€</p>
                </div>
            </div>
            <!-- div para usar ajax -->
            <div id="ajaxDiv"></div>
            <?php
                //sacamos las opciones segun el estado actual del pedido
                if ($estado == 'pendiente') {
                    ?>
                        <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`confirmado`'?>,'<?php echo $user->getTlf()?>'); location.reload();">Confirmar pedido</button>
                        <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`cancelado`'?>,'<?php echo $user->getTlf()?>'); location.reload();">Cancelar pedido</button>
                    <?php
                }
                elseif ($estado == 'confirmado') {
                    ?>
                        <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`cancelado`'?>,'<?php echo $user->getTlf()?>'); location.reload();">Cancelar pedido</button>
                    <?php
                }
                elseif($estado == 'cancelado'){
                    echo 'Pedido cancelado por el cliente.';
                }

                elseif ($estado == 'rechazado') {
                    echo 'Pedido rechazado por el establecimiento';
                }

                else{
                    echo 'No se puede cancelar el pedido al estar en preparación. Para mas información llame directamente al establecimiento.';
                }

            ?>
        </div>
        <?php
        ?>
    </main>
    <script src="javaScript/ajax/ajaxPed.js"></script>
    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>
</body>
</html>
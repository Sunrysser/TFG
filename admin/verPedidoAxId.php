<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su pedido</title>
    <link href="../estilos/universal.css" rel="stylesheet">
    <link href="../estilos/adminNav.css" rel="stylesheet">
    <link href="../estilos/adminVerP.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9e4d7c4912.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        //iniciamos la sesion para poder trabajar con ella
        if (!isset($_SESSION['on'])) {
            session_start();
            $_SESSION['on']=true;
        }

        //si el admin aun no ha iniciado sesion no permitimos el acceso a la pagina llevandolo al login
        if ($_SESSION['admin'] != true) {
            header('Location: formSesion.php');
        }
    ?>
    <header id="header" style="right: 100%;">
        <div class="logo" onclick="location.href='../'">
            <img src="../images/logo.png" alt="Logo" class="logoIcon">
            <p class="display">MÕ SUSHI WOK FUSION</p>
        </div>
        <nav>
            <ul>
                <li><a class="firstLink" href="./">Admin</a></li>
                <li class="pedidosL"><i class="fa-solid fa-chevron-down"></i><p class="lvl1 noSalto">Pedidos</p>
                    <ul class="lvl2 pedidos">
                        <li><a href="verPedidos.php">Ver pedidos</a></li>
                        <li><a href="historialPeds.php">Historial pedidos</a></li>
                    </ul>
                </li>
                <li class="reservasL"><i class="fa-solid fa-chevron-down"></i><p class="lvl1 noSalto">Reservas</p>
                    <ul class="lvl2 reservas">
                        <li><a href="verReservas.php">Ver reservas</a></li>
                        <li><a href="historialRes.php">Historial reservas</a></li>
                    </ul>
                </li>
                <li class="pedidosL"><i class="fa-solid fa-chevron-down"></i><p class="lvl1 noSalto">Productos</p>
                    <ul class="lvl2 pedidos">
                        <li><a href="ensenarProds.php">Ver productos</a></li>
                        <li><a href="ensenarCats.php">Ver categorias</a></li>
                        <li><a href="insertarProds.php">Insertar nuevos</a></li>
                    </ul>
                </li>
                <li><a class="firstLink" href="historialUsers.php">Usuarios</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Divs para header del movil -->
        <div class="divEncima" id="divEncima"></div>
        <div class="arriba">
            <div id="navB" class="navB nav-icon1">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <form class="closeSes" action="./cerrarSesionAdmin.php" method="POST">
                <input type="submit" value="Cerrar sesión"> 
            </form>
        </div>
        <?php
            require_once('../clases/includesAdmin.php');

            //recibimos por post el id del pedido y sacamos toda la info del mismo
            $idPed = $_POST['idPed'];
            $info = Pedido::verInfoxId($idPed);
            
            //si esta vacia la info signiofica que no hay tal pedido
            if(empty($info)){
                echo 'PEDIDO NO ENCONTRADO. Pruebe otro ID.';
            }

            //en el caso contrario
            else{
                $user = new Usuario($info['nombreU'], $info['tlfU'], $info['dirU']);
                $estado = $info['estadoP'];
                $fecha = $info['fechaP'];
                $lineas = Linea::verLineaxPedido($idPed);
            
        ?>
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de pedido: <?php echo $idPed.' ('. $fecha.')';?></div>
                <div class="info"><?php echo $user; ?></div>
            </div>
            <div class="lineas">
                <?php
                    //sacamos cada una de las lineas usando el array que creamos antes
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
                ?>
            </div>
            <div class="total">
                <div class="estado"><?php echo ucfirst($estado);?></div>
                <div class="subtotal">
                    <p><?php echo $total;?>€</p>
                    <p class="lineaAbajo">Servicio a domicilio: <?php echo $servicio;?>€</p>
                    <p><?php echo $total + $servicio;?>€</p>
                </div>
            </div>
            <div id="ajaxDiv"></div>
            <div class="botones">
                <?php

                    //vamos sacando las opciones del usuario segun el estado del pedido
                    if ($estado == 'pendiente') {
                        ?>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`rechazado`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">Rechazar pedido</button>
                        <?php
                    }
                    elseif ($estado == 'confirmado') {
                        ?>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`rechazado`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">Rechazar pedido</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`en preparacion`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">En preparación</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`en reparto`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">En reparto</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`entregado`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">Entregado</button>

                        <?php
                    }
                    elseif($estado == 'cancelado'){
                        echo 'Pedido cancelado por el cliente.';
                    }

                    elseif ($estado == 'rechazado') {
                        echo 'Pedido rechazado por el establecimiento';
                    }

                    else{
                        ?>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`rechazado`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">Rechazar pedido</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`en preparacion`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">En preparación</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`en reparto`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">En reparto</button>
                            <button type="button" onclick="cambEst(<?php echo $idPed?>,<?php echo '`entregado`'?>,<?php echo '`'.$user->getTlf().'`'?>); location.reload();">Entregado</button>
                        <?php
                    }
                ?>
            </div>
            
            <button type="button" onclick="location.href='./verPedidos.php'">Ver todos los pedidos</button>
        </div>
        <?php
            }
        ?>
    </main>

    <script src="javaScript/ajax/ajaxPed.js"></script>
    <script src="javaScript/varsAdmin.js"></script>
    <script src="javaScript/admin.js"></script>
</body>
</html>
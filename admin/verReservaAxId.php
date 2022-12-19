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
    <link href="../estilos/adminVerR.css" rel="stylesheet">
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

            $idRes = $_POST['idRes'];
            $info = Reserva::verInfoxId($idRes);

            if(empty($info['nombreU'])){
                echo 'RESERVA NO ENCONTRADA. Pruebe otro ID.';
            }

            else{
                $user = new Usuario($info['nombreU'], $info['tlfU'], $info['dirU']);
                $estado = $info['estadoR'];
                $fecha = $info['fechaR'];

        ?>
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de reserva: <?php echo $idRes.' ('. $fecha.')';?></div>
                <div class="info"><?php echo $user; ?></div>
            </div>
            <div class="info2"> 
                <div class="estado"><?php echo ucfirst($estado);?></div>
                <div id="ajaxDiv"></div>
                <div class="mensaje">
                    <?php
                        if ($estado == 'pendiente') {
                            ?>
                                <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`rechazada`'?>,<?php echo $user->getTlf()?>); location.reload();">Rechazar reserva</button>
                            <?php
                        }
                        elseif ($estado == 'confirmada') {
                            ?>
                                <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`rechazada`'?>,<?php echo $user->getTlf()?>); location.reload();">Rechazar reserva</button>
                                <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`aceptada`'?>,<?php echo $user->getTlf()?>); location.reload();">Aceptar reserva</button>
                            <?php
                        }
                        elseif($estado == 'cancelada'){
                            echo 'Reserva cancelada por el cliente.';
                        }

                        elseif ($estado == 'rechazada') {
                            echo 'Reserva rechazada por el establecimiento';
                        }

                        else{
                            ?>
                                <button type="button" onclick="cambEst(<?php echo $idRes?>,<?php echo '`rechazada`'?>,<?php echo $user->getTlf()?>); location.reload();">Rechazar reserva</button>
                            <?php
                        }
                    ?>
                </div>
            <button type="button" onclick="location.href='./verReservas.php'">Ver todas las reservas</button>

            </div>
        </div>
        <?php
            }
        ?>
    </main>

    <script src="javaScript/ajax/ajaxRes.js"></script>
    <script src="javaScript/varsAdmin.js"></script>
    <script src="javaScript/admin.js"></script>
</body>
</html>
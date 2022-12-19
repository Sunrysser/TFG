<!DOCTYPE html>
<html id="html" lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link href="../estilos/universal.css" rel="stylesheet">
    <link href="../estilos/adminNav.css" rel="stylesheet">
    <link href="../estilos/admin.css" rel="stylesheet">    
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

            //obtenemos toda la informacion que requerimos
            $peds = Pedido::verInfoxIdTODO();
            ?>
            <div class="pedsDiv" id="pedsDiv">
                <p class="titulin">PEDIDOS</p>
        <?php
                //misma logica de siempre para comprobar la informacion que nos llega e ir sacandola
                if (!empty($peds)) {
                    echo '<table cellspacing="0" class="peds" id="peds">';
                    echo '<tr><th>ID</th><th>Estado</th><th>Info. cliente</th><th>Fecha</th><th>Opciones</th></tr>';
                    foreach ($peds as $id => $ped) {
                        echo '<tr class="ped">';
                        echo '<td class="idTd">'.$id.'</td><td class="estadoTd">'.ucfirst($ped['estadoP']).'</td><td class="userTd">'.$ped['nombreU'].' '.$ped['tlfU'].' '.$ped['dirU'].'</td><td class="fechaTd">'.$ped['fechaP'].'</td>';
                        echo '<td>';
                        echo '<form action="verPedidoAxId.php" method="POST">';
                        echo '<input type="hidden" value="'.$id.'" name="idPed">';
                        echo '<input type="submit" value="Administrar" name="Go">';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr class="separador"><td colspan="5"></td></tr>';
                    }
                    echo '</table>';
                    echo '</div>';
                }
        
                else {
                    echo '<p class="noHay">No hay pedidos</p>';
                }
        
        ?>
    </main>
    <script src="javaScript/varsAdmin.js"></script>
    <script src="javaScript/admin.js"></script>
    <script src="javaScript/ajax/ajax.js"></script>
</body>
</html>
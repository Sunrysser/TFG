<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link href="../estilos/universal.css" rel="stylesheet">
    <link href="../estilos/adminNav.css" rel="stylesheet">
    <link href="../estilos/adminCats.css" rel="stylesheet">
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
        ?>
        <div class="tools">
        <p class="titulin">CATEGORIAS</p>

            <div class="options">
                <form action="insertarProds.php" method="POST">
                    <input type="submit" value="Insertar nuevos">
                </form>

                <form action="ensenarProds.php" method="POST">
                    <input type="submit" value="Gestionar productos">
                </form>
            </div>

        </div>
        <div class="catsDiv" id="catsDiv">
        
        <?php
            //recibimos la informacion de las categorias haciendo uso de una funcion
            $cats = Categoria::verCats();
            //si el array esta vacio significa que no se obtuvo informacion por que no hay categorias
            if (!empty($cats)) {
                echo '<table cellspacing="0" class="cats" id="cats">';
                echo '<tr><th>ID</th><th>Nombre</th><th>Opciones</th></tr>';
                //recorremos todas las categorias enseñandolas una a una
                foreach ($cats as $id => $cat) {
                    echo '<tr class="cat">';
                    echo '<td>'.$cat->getId().'</td>';
                    echo '<td>'.$cat->getNombre().'</td>';
                    echo '<td><div class="optionTd">';
                    echo '<form action="editCat.php" method="post">';
                    echo '<input type="hidden" value="'.$cat->getId().'" name="idCat">';
                    echo '<input class="submit" type="submit" value="Actualizar" name="yes">';
                    echo '</form>';
                    echo '<form action="eliminarCat.php" method="post">';
                    echo '<input type="hidden" value="'.$cat->getId().'" name="idCat">';
                    echo '<input class="submit" type="submit" value="Eliminar" name="yes">';
                    echo '</form>';
                    echo '</div></td>';
                    echo '</tr>';
                    echo '<tr class="separador"><td colspan="5"></td></tr>';
                }

                echo '</table>';
            }

            else{
                echo '<p>No hay categorias.</p>';
            }
            echo '</div>';
        ?>
    </main>
    <script src="javaScript/varsAdmin.js"></script>
    <script src="javaScript/admin.js"></script>
    <script src="javaScript/ajax/ajax.js"></script>
</body>
</html>
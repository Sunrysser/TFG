<!DOCTYPE html>
<html id="html" lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="../estilos/adminNav.css" rel="stylesheet">
    <link href="../estilos/universal.css" rel="stylesheet">
    <link href="../estilos/adminForm.css" rel="stylesheet">
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
                <input class="boton" type="submit" value="Cerrar sesión"> 
            </form>
        </div>
		<p class="titulin">INSERTAR NUEVOS</p>
        <?php 
            require_once('../clases/includesAdmin.php');
        ?>
        <form id="catForm" class="catForm forms" action="../insertCat.php" method="post">
		    <p class="titulin">NUEVA CATEGORÍA</p>

            <input type="text" name="nombreCat" id="nombreCat" required placeholder="Inserte nueva categoria.">
            <div class="botones">
                <input type="submit" value="Confirmar" name="yes" class="boton">
                <input type="button" value="Cancelar" name="no" onclick="location.assign('ensenarProds.php');" class="boton">
            </div>
        </form>

        <form id="prodForm" class="prodForm forms" action="../insertProd.php" method="post">
		    <p class="titulin">NUEVO PRODUCTO</p>

            <input type="text" name="nombreProd" id="nombreProd" required placeholder="Nombre del producto.">
            <input type="text" name="desc" id="desc" required placeholder="Descripción del producto.">
            <input type="number" step="0.01" min="0" name="precio" id="precio" required placeholder="Precio del producto.">
        
            <?php
                //sacamos las categorias de base de datos para ponerlas de input a la hora de crear el nuevo producto
                echo '<select name="cat" required>';
                echo '<option selected="true" disabled="disabled">Elija categoría</option>';    

                $cats = Categoria::verCats();

                foreach ($cats as $id => $cat) {
                    echo '<option value="'.$cat->getId().'">'.$cat->getNombre().'</option>';
                }

                echo '</select>';
                ?>
            <div class="botones">
                <input type="submit" value="Confirmar" name="yes" class="boton">
                <input type="button" value="Cancelar" name="no" onclick="location.assign('ensenarProds.php');" class="boton">
            </div>
        </form>
        <div id="botones" class="botones options">
            <button type="button" id="cat" class="boton buttonCat" onclick="printForm(this.id);">INSERTAR NUEVA CATEGORÍA</button>
            <button type="button" id="prod" class="boton" onclick="printForm(this.id);">INSERTAR NUEVO PRODUCTO</button>
        </div>
    </main>
<script src="../javaScript/twoFormsInserts.js"></script>
<script src="../javaScript/varsInserts.js"></script>
<script src="javaScript/varsAdmin.js"></script>
<script src="javaScript/admin.js"></script>
</body>
</html>
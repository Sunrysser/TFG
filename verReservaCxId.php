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
        <?php
            require_once('clases/includes.php');

            //recibimos el id de la resevra y llamamos a la funcion para recibir toda la informacion al respecto de esa reserva
            $idRes = $_POST['idRes'];
            $info = Reserva::verInfoxId($idRes);

            //si el array esta vacio significa que no existe reserva alguna por ese id
            if(empty($info)){
                echo 'RESERVA NO ENCONTRADA. Pruebe otro ID.';
            }

            //en el caso contrario creamos un objeto usuario con los datos recibidos y guardamos mas informacion en variables para un acceso mas facil y legible
            else{
                $user = new Usuario($info['nombreU'], $info['tlfU'], $info['dirU']);
                $estado = $info['estadoR'];
                $fecha = $info['fechaR'];

        ?>
        <!-- div donde se muestra la info del pedido -->
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de reserva: <?php echo $idRes.' ('. $fecha.')';?></div>
                <div class="info"><?php echo 'Reserva a nombre de: '.$user->getNombre(); ?></div>
            </div>
            <div class="info2"> 
                <div class="estado"><?php echo ucfirst($estado);?></div>
                <div id="ajaxDiv"></div>
                <div class="mensaje">
            </div>
        </div>
        </div>
        <?php
            }
        ?>
    </main>
    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>
    <script src="javaScript/ajax/ajaxRes.js"></script>

</body>
</html>
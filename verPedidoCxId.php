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

            //recibimos el id y con él recibimos toda la informacion que nos hace falta
            $idPed = $_POST['idPed'];
            $info = Pedido::verInfoxId($idPed);

            //si el array esta vacio significa que no existe reserva alguna por ese id
            if(empty($info['nombreU'])){
                echo 'PEDIDO NO ENCONTRADO. Pruebe otro ID.';
            }

            //en el caso contrario creamos un objeto usuario con los datos recibidos y guardamos mas informacion en variables para un acceso mas facil y legible
            else{
                $user = new Usuario($info['nombreU'], $info['tlfU'], $info['dirU']);
                $estado = $info['estadoP'];
                $fecha = $info['fechaP'];
                //sacamos las lineas del pedido con su id haciendo uso de una funcion
                $lineas = Linea::verLineaxPedido($idPed);
            
        ?>
        <!-- div donde se muestra la info del pedido -->
        <div class='pedido'>
            <div class='cliente'>
                <div class="titulin">Número de pedido: <?php echo $idPed.' ('. $fecha.')';?></div>
                <div class="info"><?php echo 'Pedido a nombre de: '.$user->getNombre(); ?></div>
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
        </div>
        <?php
            }
        ?>
    </main>
    <script src="javaScript/ajax/ajaxPed.js"></script>
    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>
</body>
</html>

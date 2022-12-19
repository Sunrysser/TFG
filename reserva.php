<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <link href="estilos/universal.css" rel="stylesheet">
    <link href="estilos/header.css" rel="stylesheet">
    <link href="estilos/stylesR.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        require_once('clases/includes.php');
    ?>
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
        <!-- div que contiene el/los formularios -->
        <div class="forms">
            <form action="insertReserva.php" method="post" id="formR" class="formR">
                <fieldset class="userPartR" id="userPartR">
                    <legend class="legends">Datos personales</legend>
                        <p>
                            <input type="text" name="nombre" id="nombreR" maxlength="15" pattern="[a-zA-Z]{4,10}" placeholder="Nombre (mínimo 4 letras)" autofocus required>
                        
                            <input type="text" name="tlf" id="tlfR" pattern="(\+[\d]{1,5})?[\d]{4,15}" maxlength="30" placeholder="Teléfono" required>
                        </p>
                            <input type="hidden" name="dir" id="dirR" value="Reserva">

                        <div class="labels" id="fechaLabelR"><label for="nombre">Fecha y hora:</label></div>
                        <input type="datetime-local" id="fecha" name="fecha" value="">
                        <script>
                            //uso de una funcion js para sacar el dia actual y ponerlo de dato orientativo en el tipo date
                            let fecha = new Date().toJSON().slice(0,16);
                            document.getElementById('fecha').value = fecha;
                        </script>
                        <div class="buttons">
                            <input class="botone" type="submit" value="RESERVAR" name="allInfo">
                        </div>
                </fieldset>
            </form>   
        </div>
    </main>

    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>    
</body>
</html>
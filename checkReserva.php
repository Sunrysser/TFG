<!DOCTYPE html>
<html id="html" lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Restaurant WebPage">
    <meta name="keywords" content="food, sushi">
    <meta name="author" content="Ahmed M.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link href="estilos/universal.css" rel="stylesheet">
    <link href="estilos/header.css" rel="stylesheet">
    <link href="estilos/forms.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<body>
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
        <form action="verReservaCxId.php" method="post" class="formPedido">
            <div class="iconForm"></div>
            <div class="inputs">
                <label for="idRes">COMPROBAR RESERVA</label>
                <input type="text" name="idRes" id="idRes" maxlength="15" pattern="[0-9]+" placeholder="Id de la reserva." autofocus required>
                <input type="submit" name="go" value="Comprobar"> 
            </div>
        </form>
    </main>
    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>
</body>
</html>
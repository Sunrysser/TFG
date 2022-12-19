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
    <link href="estilos/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9e4d7c4912.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
        <div class="heroDiv">
            <div class="heroImg">
                <div class="textbuttons">
                    <div class="textito">Un nuevo sabor</div>
                    <p>
                        <span class="tittle display">Bienvenidos a <br> la cocina de MÕ</span>
                        <br>
                        Disfrutad del viaje.
                    </p>

                    <div class="buttonsHero">
                        <span class="buttonAni buttonPed"><a href="pedido.php"></a></span>
                        <span class="buttonAni buttonRes"><a href="reserva.php"></a></span>
                        <button type="button" class="boton" onclick="location.href = 'pedido.php'">PEDIR</button>
                        <button type="button" class="boton" onclick="location.href = 'reserva.php'">RESERVAR</button>
                    </div>
                </div>
                <div class="imageDiv">
                    <img src="images/hero.png" alt="Hero Image" class="image">
                </div>
            </div>

            
        </div>
        <div class="usContainer">
            <div class="us">
                <h3 class="sobUs display">Sobre nosotros</h3>

                <div class="usImages">
                        <img src="images/us0.jpg" alt="us0">
                        <img src="images/us1.jpg" alt="us1">
                        <img src="images/us3.jpg" alt="us3">
                </div>
                <div class="usText">
                    <p>
                        Aspiramos a crear algo diferente y divertido 
                        adaptado a los gustos de hoy y precios asequibles.
                        Desde aqui te invitamos a recorrer los sabores 
                        autenticos de Japon dentro de nuestra cocina 
                        Mediterránea.
                    </p>
                </div>
            </div>
        </div>

        <div class="menuDiv">
            <h3 class="menuText display">Nuestro Menú</h3>
            <div class="menu">
                <img class="pagMenu" id="pagMenu" src="images/menu/1.jpg" alt="Menu Page" onclick="showMenuB();">
                <input disabled class="pageDisplay" id="pageDisplay" type="text" value="1/7">
                <div class="menuButtons">
                    <button class="nextPrev" id="prev" onclick="prevPage();"><i class="fa-regular fa-circle-left"></i></button>
                    <button class="nextPrev" id="next" onclick="nextPage();"><i class="fa-regular fa-circle-right"></i></button>
                </div>
                <div class="buttonsHero secondButtons">
                    <span class="buttonAni buttonPed"><a href="pedido.php"></a></span>
                    <span class="buttonAni buttonRes"><a href="reserva.php"></a></span>
                    <button type="button" class="boton" onclick="location.href = 'pedido.php'">PEDIR</button>
                    <button type="button" class="boton" onclick="location.href = 'reserva.php'">RESERVAR</button>
                </div>
            </div>
        </div>
        <div id="menuBig" class="menuBig" style="display: none;">
            <img class="pagMenu" id="pagMenuB" src="images/menu/1.jpg" alt="Menu Page" onclick="showMenuB();">
            <input disabled class="pageDisplay" id="pageDisplayB" type="text" value="1/7">
            <div class="menuButtons">
                <button class="nextPrev" id="prevB" onclick="prevPageB();"><i class="fa-regular fa-circle-left"></i></button>
                <button class="nextPrev" id="nextB" onclick="nextPageB();"><i class="fa-regular fa-circle-right"></i></button>
            </div>
        </div>
    </main>
    <footer>
    </footer>

    <script src="javaScript/varsIndex.js"></script>
    <script src="javaScript/pages.js"></script>

    

</body>
</html>
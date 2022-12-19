<?php
    //creamos la sesion
    session_start();

    require_once('clases/includes.php');

    //creamos un usuario con los datos recibidos por el formulario
    $user = new Usuario($_POST['nombre'],$_POST['tlf'],$_POST['dir']);

    //llamamos a la funcion que lo inserta en base de datos y guardamos el id creado en base de datos
    $idUser = $user->crearUser();

    //segun el metodo de pago que elige el usuario creamos el pedido
    if (isset($_POST['card'])) {
        $pedido = new Pedido(1, 0, 'pendiente', $idUser);
    }

    elseif (isset($_POST['camb'])) {
        $pedido = new Pedido(0, 1, 'pendiente', $idUser);
    }

    else {
        $pedido = new Pedido(0, 0, 'pendiente', $idUser);
    }

    //llamamos a la funcion que inserta el pedido en base de datos y devuelve el id
    $idPed = $pedido->crearPed();

    //aqui recorremos el array POST entero
    foreach ($_POST as $key => $value) {
        //si la palabra Cant esta en cualquiera de las claves(id del producto) de este array creamos un array cuya clave
        //es la clave que contiene la palabra Cant sin la misma y como valor el valor de la posicion en cuestion del array anterior 
        //sustituyo el guion bajo que ya traia la clave por un espacio y la palabra cant la elimino al sustituirla por nada
        //de esta manera cada vez que en POST nos encontramos con un producto lo vamos insertando en otro ray obteniendo asi todos los productos del pedido
        if (strpos($key, 'Cant')) {
            $prods[str_replace('_',' ',str_replace('Cant', '', $key))] = $value;
        }
    }

    //por cada producto creamos una linea de pedido sacando su precio de base de datos y calculando el precio total
    $i = 0;
    foreach ($prods as $key => $value) {
        $precioP = Producto::verPrecioProd($key);
        $lineas[$i] = new Linea($i, $idPed, $key, $value,$precioP*$value);
        $i++;
    }

    //insertamos cada linea de pedido en base de datos
    foreach ($lineas as $key => $value) {
        $value->crearLinea();
    }
    
    //guardamos los ids pertinentes en la sesion creada antes para luego usarlos al ver el pedido
    $_SESSION['idUser'] = $idUser;
    $_SESSION['idPed'] = $idPed;

    //llevamos al usuario a ver el pedido
    header('Location: verPedidoC.php');
?>
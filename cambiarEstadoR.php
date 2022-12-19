<?php
    require_once('clases/includes.php');
    require_once('./esendex/vendor/autoload.php');

    //obtenemos la informacion necesaria para la logica siguiente
    $estado = $_GET['estado'];
    $tlf = strval($_GET['tlf']);
    //eso es por si el numero llega con un prefijo, por problemas de las urls con el simobolo '+'
    $tlf = str_replace('P','+',$tlf);
    $id = $_GET['id'];
    
    //obtenemos el resto de informacion necesaria haciendo uso de la informacion que recibimos antes y una función
    Reserva::actEstado($id, $estado);
    $estado = strtoupper($estado);

    //toda la logica de la api
    //creamos el mensaje haciendo uso de los objetos y funciones de la propia api
    $message = new \Esendex\Model\DispatchMessage(
        "MOSUSHI", // Send from
        $tlf, // Send to any valid number
        "-MOSUSHI- *RESERVA NÚMERO: $id. Su reserva esta ahora en estado: $estado",
        \Esendex\Model\Message::SmsType
    );

    //nos atentificamos para poder enviar la peticion a la api
    $authentication = new \Esendex\Authentication\LoginAuthentication(
        $esendexAccRef, // Your Esendex Account Reference
        $essendexEmail, // Your login email address
        $essendexPass // Your password
    );

    //enviamos la peticion a la api y obtenemos el resultado
    $service = new \Esendex\DispatchService($authentication);
    $result = $service->send($message);
?>
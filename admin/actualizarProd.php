<?php 
    require_once('../clases/includesAdmin.php');
    //echo "<script>console.log('hola')</script>";//

    //comprobamos que el administrador ha enviado los datos por el formulario
    if (isset($_POST['yes'])) {
        //recibimos los datos
        $name = $_POST['nombre'];
        $desc = $_POST['desc'] ?? 'Sin descripcion';
        $pvp = $_POST['precio'] ?? 0.00;
    //echo "<script>console.log('".$name.$desc.$pvp."')</script>";

        //actualizamos el producto en base de datos proporcionando el id del producto a actualizar y los datos nuevos a una funcion
        Producto::actProd($desc, $pvp, $name);
    }

    //llevamos al usuario de vuelta
    header('Location: ensenarProds.php');

?>
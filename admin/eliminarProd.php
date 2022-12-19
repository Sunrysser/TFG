<?php 
    require_once('../clases/includesAdmin.php');
    //echo "<script>console.log('hola')</script>";//
    //echo "<script>console.log('".$name."')</script>";

    //comprobamos que el usuario ha mandado los datos por el formulario
    if (isset($_POST['yes'])) {
        $name = $_POST['idProd'];
        //echo "<script>console.log('".$name."')</script>";
        //borramos el producto de base de datos haciendo uso de una funcion por su id
        Producto::BorProd($name);
    }
    
    //devolvemos al usuario
    header('Location: ensenarProds.php');
?>
<?php 
    require_once('../clases/includesAdmin.php');

    //echo "<script>console.log('hola')</script>";//".$name.$desc.$pvp."
    //echo "<script>console.log('".$name."')</script>";

    //comprobamos que el administrador ha enviado los datos por el formulario
    if (isset($_POST['yes'])) {
        //recibimos los datos
        $name = $_POST['nombre'];
        $idCat = $_POST['idCat'];

    //echo "<script>console.log('".$name.$desc.$pvp."')</script>";

        //actualizamos la categoria en bease de datos proporcionando el id de la categoria a actualizar y los datos nuevos a una funcion
        Categoria::actCat($idCat, $name);
    }

    //llevamos al usuario de vuelta
    header('Location: ensenarCats.php');

?>
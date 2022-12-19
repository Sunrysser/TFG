<?php 
    require_once('../clases/includesAdmin.php');
    //echo "<script>console.log('hola')</script>";//".$name."
    //echo "<script>console.log('".$name."')</script>";

    //comprobamos que el usuario ha mandado los datos por el formulario
    if (isset($_POST['yes'])) {
        $idCat = $_POST['idCat'];
        //echo "<script>console.log('".$name."')</script>";
        //borramos la categoria de base de datos haciendo uso de una funcion por su id
        Categoria::BorCat($idCat);
    }

    //devolvemos al usuario
    header('Location: ensenarCats.php');

?>

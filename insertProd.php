<?php 
    require_once('clases/includes.php');

    //comprobamos que el administrador ha enviado los datos por el formulario
    if (isset($_POST['yes'])) {
        //recibimos todos los datos por post y en el caso de que no se pase alguno, lo cual seria imposible ya que controlamos que todos 
        //se pasan por otros medios, ponemos datos por defectos
        $name = $_POST['nombreProd'] ?? 'Sin nombre';
        $desc = $_POST['desc'] ?? 'Sin descripcion';
        $pvp = $_POST['precio'] ?? 'Sin PVP';
        $cat = $_POST['cat'] ?? 'NULL';
        //echo "<script>console.log('".$name.$desc.$pvp.$cat."')</script>";

        //insertamos el producto creando un objeto y llamando a una funcion que lo inserta en base de datos
        $prod= new Producto($name, $desc, $pvp, $cat);
        $prod->crearProd();
    }

    //llevamos al administrador que inserta el producto de vuelta a la vista de los mismos
    header('Location: admin/ensenarProds.php');
?>
<?php
    require_once('clases/includes.php');

    //comprobamos si se enviaron los datos desde el formulario correctamente
    if (isset($_POST['yes'])) {
        //recibimos el dato por post o le ponemos uno por defecto si no es asi aunque eso es imposible
        $name = $_POST['nombreCat'] ?? 'Sin nombre';
        
        //creamos una categoria y la insertamos en base de datos
        $miCat = new Categoria($name, 0);
        $miCat->crearCat();
    }

    //llevamos al usuario de vuelta a la pagina con la vista
    header('Location: admin/ensenarProds.php');

?>
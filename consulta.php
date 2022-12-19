<?php
    require_once('clases/includes.php');

    $cat = $_GET['cat'];
    
    //si la categoria no esta vacia, es una comprobación más aunque no seria necesaria ya que es imposible que no llegara la categoria por otros medios
    if (!empty($cat)) {
        
        //obtenemos toda la información de los productos segun la categoria que recibimos
        $prods = Producto::verProdsxCat($cat);

        //si obtenemos la info sacamos toda la información pertinente
        if (!empty($prods)) {
            echo '<tr><th>Nombre</th><th>Precio</th><th>Desripción</th><th>Opciones</th></tr>';
            foreach ($prods as $pos => $prod) {
                echo '<tr class="prod">';
                echo '<td class="nombreTd">'.$prod->getNombre().'</td><td class="precioTd">'.$prod->getPvp().'</td><td class="descTd">'.$prod->getDesc().'</td>';
                echo '<td><div class="optionTd">';
                echo '<form action="editProd.php" method="post">';
                echo '<input type="hidden" value="'.$prod->getNombre().'" name="idProd">';
                echo '<input class="submit" type="submit" value="Actualizar" name="yes">';
                echo '</form>';
                echo '<form action="eliminarProd.php" method="post">';
                echo '<input type="hidden" value="'.$prod->getNombre().'" name="idProd">';
                echo '<input class="submit" type="submit" value="Eliminar" name="yes">';
                echo '</form>';
                echo '</div></td>';
                echo '</tr>';
            }
        }

        //si no se obtiene información es porque no existe productos en esa categoria
        else {
            echo 'Categoria sin productos.';
        }
    }
?>
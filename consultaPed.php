<?php
    require_once('clases/includes.php');

    $cat = $_GET['cat'];

    //si la categoria no esta vacia, es una comprobación más aunque no seria necesaria ya que es imposible que no llegara la categoria por otros medios
    if (!empty($cat)) {
        
        //obtenemos toda la información de los pedidos segun el estado que recibimos
        $prods = Producto::verProdsxCat($cat);

        //si obtenemos la info sacamos toda la información pertinente
        if (!empty($prods)) {
            foreach ($prods as $pos => $prod) {
                echo '<div class="prodsDiv">';
                echo '<p class="prodInfo"><span>'.$prod->getNombre().' </span>'. $prod->getPvp().'</p>';
                echo '<p class="prodInfo prodDesc">'.$prod->getDesc().'</p>';
                echo '<input type="checkbox" value="'.$prod->getNombre().'" name="'.$prod->getNombre().'" class="checks">';
                echo '<input type="number" name="'.$prod->getNombre().'Cant" class="cantidades" value="1" min="1" disabled>';
                echo '</div>';
            }
        }
    }
?>
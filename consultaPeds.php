<?php
    require_once('clases/includes.php');

    $estado = $_GET['estado'];
    
    //si el estado no esta vacio, es una comprobación más aunque no seria necesaria ya que es imposible que no llegara el estado por otros medios
    if (!empty($estado)) {
        
        //obtenemos toda la información de los pedidos segun el estado que recibimos
        $peds = Pedido::verInfoxEstado($estado);

        //si obtenemos la info sacamos toda la información pertinente
        if (!empty($peds)) {
            echo '<tr><th>ID</th><th>Estado</th><th>Info. cliente</th><th>Fecha</th><th>Opciones</th></tr>';
            foreach ($peds as $id => $ped) {
                echo '<tr class="ped">';
                echo '<td class="idTd">'.$id.'</td><td class="estadoTd">'.ucfirst($ped['estadoP']).'</td><td class="userTd">'.$ped['nombreU'].' '.$ped['tlfU'].' '.$ped['dirU'].'</td><td class="fechaTd">'.$ped['fechaP'].'</td>';
                echo '<td>';
                echo '<form action="verPedidoAxId.php" method="POST">';
                echo '<input type="hidden" value="'.$id.'" name="idPed">';
                echo '<input type="submit" value="Administrar" name="Go">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                echo '<tr class="separador"><td colspan="5"></td></tr>';
            }
        }

        //si no se obtiene información es porque no existe reserva con ese estado
        else {
            echo '<p class="noHay">No hay pedido '.$estado.'.</p>';
        }
    }
?>
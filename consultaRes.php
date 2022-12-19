<?php
    require_once('clases/includes.php');

    $estado = $_GET['estado'];
    
    //si el estado no esta vacio, es una comprobación más aunque no seria necesaria ya que es imposible que no llegara el estado por otros medios
    if (!empty($estado)){
        
        //obtenemos toda la información de las reservas segun el estado que recibimos
        $reses = Reserva::verInfoxEstado($estado);

        //si obtenemos la info sacamos toda la información pertinente
        if (!empty($reses)) {
            echo '<tr><th>ID</th><th>Estado</th><th>Info. cliente</th><th>Fecha</th><th>Opciones</th></tr>';
            foreach ($reses as $id => $res) {
                echo '<tr class="res">';
                echo '<td class="idTd">'.$id.'</td><td class="estadoTd">'.ucfirst($res['estadoR']).'</td><td class="userTd">'.$res['nombreU'].' '.$res['tlfU'].' '.$res['dirU'].'</td><td class="fechaTd">'.$res['fechaR'].'</td>';
                echo '<td>';
                echo '<form action="verReservaAxId.php" method="POST">';
                echo '<input type="hidden" value="'.$id.'" name="idRes">';
                echo '<input type="submit" value="Administrar" name="Go">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                echo '<tr class="separador"><td colspan="5"></td></tr>';
            }
        }

        //si no se obtiene información es porque no existe reserva con ese estado
        else {
            echo '<p class="noHay">No hay reserva '.$estado.'.</p>';
        }
    }
?>
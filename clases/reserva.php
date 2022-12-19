<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

/**
 * @author web.ahmed.m@gmail.com
 */
class Reserva{

    /**
     * @var
     */
    protected $fecha;

    /**
     * @var
     */
    protected $estado;

    /**
     * @var
     */
    protected $idUser;

    /**
     * @param $fecha
     * @param $estado
     * @param $idUser
     */
    public function __construct($fecha, $estado, $idUser)
    {
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Fecha: '. $this->fecha. ' Estado: '. $this->estado. ' User: '. $this->idUser;
    }

    /**
     * Inserta una nueva reserva en base de datos
     * @return mixed|void
     * @access public
     */
    function crearRes(){

        //Intentamos iniciar la conexión en la base de datos
        try{
            $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

            if($conexion->connect_errno){

                //Error al soltar un error la función
                throw new Exception("No se ha podido acceder a la base de datos");

            }
        }catch(Exception $ex){
            //Otro tipo de error
            echo $ex->getMessage(), "<br>";

        }

        try{
            $insert = $conexion->stmt_init();
            $insert->prepare("INSERT INTO reserva (fechaYHora, estado, idU) VALUES ('$this->fecha','$this->estado',$this->idUser);");
            $insert->execute();
            $insert->close();

            $consulta = $conexion->stmt_init();
            $consulta->prepare("SELECT LAST_INSERT_ID();");
            $consulta->execute();
            $consulta->bind_result($id);
            $consulta->fetch();
            $consulta->close();
            return $id;
        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve el estado de una reserva por su id
     * @return mixed|void
     * @access public
     * @static
     */
    static function verEstado($id){

        //Intentamos iniciar la conexión en la base de datos
        try{
            $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

            if($conexion->connect_errno){

                //Error al soltar un error la función
                throw new Exception("No se ha podido acceder a la base de datos");

            }
        }catch(Exception $ex){
            //Otro tipo de error
            echo $ex->getMessage(), "<br>";

        }

        try{

            $consulta = $conexion->stmt_init();
            $consulta->prepare("SELECT estado from reserva where id=$id");
            $consulta->execute();
            $consulta->bind_result($estado);
            $consulta->fetch();
            $consulta->close();
            return $estado;
        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve la fecha de una reserva por su id
     * @return mixed|void
     * @access public
     * @static
     */
    static function verFecha($id){

        //Intentamos iniciar la conexión en la base de datos
        try{
            $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

            if($conexion->connect_errno){

                //Error al soltar un error la función
                throw new Exception("No se ha podido acceder a la base de datos");

            }
        }catch(Exception $ex){
            //Otro tipo de error
            echo $ex->getMessage(), "<br>";

        }

        try{

            $consulta = $conexion->stmt_init();
            $consulta->prepare("SELECT fechaYHora from reserva where id=$id");
            $consulta->execute();
            $consulta->bind_result($fecha);
            $consulta->fetch();
            $consulta->close();
            return $fecha;
        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Actualiza el estado de la reserva
     * @return void
     * @access public
     * @static
     * @param $id
     * @param $estado
     */
    static function actEstado($id, $estado) : void{

        //Intentamos iniciar la conexión en la base de datos
        try{
            $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

            if($conexion->connect_errno){

                //Error al soltar un error la función
                throw new Exception("No se ha podido acceder a la base de datos");

            }
        }catch(Exception $ex){
            //Otro tipo de error
            echo $ex->getMessage(), "<br>";

        }

        try{
            $update = $conexion->stmt_init();
            $update->prepare("update reserva set estado = '$estado' where id = $id");
            $update->execute();
            $update->close();

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve toda la información de una reserva y del cliente que la realiza por su id
     * @return array|void
     * @access public
     * @static
     * @param $idPed
     */
    static function verInfoxId($idRes){

        //Intentamos iniciar la conexión en la base de datos
        try{
            $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

            if($conexion->connect_errno){

                //Error al soltar un error la función
                throw new Exception("No se ha podido acceder a la base de datos");

            }
        }catch(Exception $ex){
            //Otro tipo de error
            echo $ex->getMessage(), "<br>";

        }

        try{
            $prodQuery = $conexion->stmt_init();

            $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, r.estado, r.fechaYHora from usuario u join reserva r on u.id = r.idU where r.id = $idRes;");

            $prodQuery->execute();

            $prodQuery->bind_result($nombre, $tlf, $direccion, $estado, $fecha);

            $prodQuery->fetch();

            $info['nombreU'] = $nombre;
            $info['tlfU'] = $tlf;
            $info['dirU'] = $direccion;
            $info['estadoR'] = $estado;
            $info['fechaR'] = $fecha;

            return $info;

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve toda la información de las reservas y del cliente que las realiza por su estado
         * @return array|void
         * @access public
         * @static
         * @param $idPed
         */
        static function verInfoxEstado($estado){

            //Intentamos iniciar la conexión en la base de datos
            try{
                $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

                if($conexion->connect_errno){

                    //Error al soltar un error la función
                    throw new Exception("No se ha podido acceder a la base de datos");

                }
            }catch(Exception $ex){
                //Otro tipo de error
                echo $ex->getMessage(), "<br>";

            }

            try{
                $prodQuery = $conexion->stmt_init();

                $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, r.estado, r.fechaYHora, r.id from usuario u join reserva r on u.id = r.idU where r.estado = '$estado';");

                $prodQuery->execute();

                $prodQuery->bind_result($nombre, $tlf, $direccion, $estado, $fecha, $id);

                $peds= null;
                while($prodQuery->fetch()){
                    $info['nombreU'] = $nombre;
                    $info['tlfU'] = $tlf;
                    $info['dirU'] = $direccion;
                    $info['estadoR'] = $estado;
                    $info['fechaR'] = $fecha;
                    $peds[$id] = $info;
                }


                return $peds;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
        * Devuelve toda la información de TODAS las reservas y del cliente que las realiza por su id
         * @return array|void
         * @access public
         * @static
         */
        static function verInfoxIdTODO(){

            //Intentamos iniciar la conexión en la base de datos
            try{
                $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

                if($conexion->connect_errno){

                    //Error al soltar un error la función
                    throw new Exception("No se ha podido acceder a la base de datos");

                }
            }catch(Exception $ex){
                //Otro tipo de error
                echo $ex->getMessage(), "<br>";

            }

            try{
                $prodQuery = $conexion->stmt_init();

                $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, r.id,r.estado,r.fechaYHora from usuario u join reserva r on u.id = r.idU;");

                $prodQuery->execute();

                $prodQuery->bind_result($nombre, $tlf, $direccion, $id, $estado, $fecha);

                $peds= null;
                while($prodQuery->fetch()){
                    $info['nombreU'] = $nombre;
                    $info['tlfU'] = $tlf;
                    $info['dirU'] = $direccion;
                    $info['estadoR'] = $estado;
                    $info['fechaR'] = $fecha;
                    $peds[$id] = $info;
                }


                return $peds;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
         * Devuelve todas las reservas que hizo un usuario
         * @return array|void
         * @access public
         * @static
         */
        static function verResxUser($idUser){

            //Intentamos iniciar la conexión en la base de datos
            try{
                $conexion = new mysqli('localhost', 'ahmed', '123456', 'mosushi');

                if($conexion->connect_errno){

                    //Error al soltar un error la función
                    throw new Exception("No se ha podido acceder a la base de datos");

                }
            }catch(Exception $ex){
                //Otro tipo de error
                echo $ex->getMessage(), "<br>";

            }

            try{
                $prodQuery = $conexion->stmt_init();

                $prodQuery->prepare("select id from reserva where idU = $idUser;");

                $prodQuery->execute();

                $prodQuery->bind_result($idRes);

                $reses = null;
                $i=0;
                while ($prodQuery->fetch()) {
                    $reses[$i] = $idRes;
                    $i++;
                }

                return $reses;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }
    } 
?>
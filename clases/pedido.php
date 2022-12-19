<?php

    /**
     * @author web.ahmed.m@gmail.com
     */
    class Pedido{
        /**
         * @var
         */
        protected $datafono;

        /**
         * @var
         */
        protected $cambio;

        /**
         * @var
         */
        protected $estado;

        /**
         * @var
         */
        protected $idUser;

        /**
         * @param $datafono
         * @param $cambio
         * @param $estado
         * @param $idUser
         */
        public function __construct($datafono, $cambio, $estado, $idUser)
        {
            $this->datafono = $datafono;
            $this->cambio = $cambio;
            $this->estado = $estado;
            $this->idUser = $idUser;
        }

        /**
         * @return mixed
         */
        public function getDatafono()
        {
            return $this->datafono;
        }

        /**
         * @param mixed $datafono
         */
        public function setDatafono($datafono): void
        {
            $this->datafono = $datafono;
        }

        /**
         * @return mixed
         */
        public function getCambio()
        {
            return $this->cambio;
        }

        /**
         * @param mixed $cambio
         */
        public function setCambio($cambio): void
        {
            $this->cambio = $cambio;
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


        public function __toString()
        {
            return 'Datafono= '. $this->datafono.' Cambio= '. $this->cambio. ' Estado= '.$this->estado.' Usuario= '.$this->idUser;
        }


        /**
         * Inserta un nuevo pedido en base de datos
         * @return mixed|void
         * @access public
         */
        function crearPed(){

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
                $fecha = date('Y-m-d h:i:s');
                $insert = $conexion->stmt_init();
                $insert->prepare("INSERT INTO pedido (datafono, cambio, estado, fechaYHora, idU) VALUES ($this->datafono,$this->cambio,'$this->estado','$fecha',$this->idUser);");
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
         * Devuelve el estado de un pedido por su id
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
                $consulta->prepare("SELECT estado from pedido where id=$id");
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
         * Devuelve la fecha de un pedido por su id
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
                $consulta->prepare("SELECT fechaYHora from pedido where id=$id");
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
         * Actualiza el estado del pedido
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
                $update->prepare("update pedido set estado = '$estado' where id = $id");
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
         * Devuelve toda la información de un pedido y del usuario que lo realiza segun el id del pedido
         * @return array|void
         * @access public
         * @static
         * @param $idPed
         */
        static function verInfoxId($idPed){

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
                
                //select nombre, tlf, direccion from usuario where id = (select idU from pedido where id = $idPed);
                //select estado, fechaYHora from pedido where id = $idPed;
                $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, p.estado, p.fechaYHora from usuario u join pedido p on u.id = p.idU where p.id = $idPed;");

                $prodQuery->execute();

                $prodQuery->bind_result($nombre, $tlf, $direccion, $estado, $fecha);

                $prodQuery->fetch();

                $info['nombreU'] = $nombre;
                $info['tlfU'] = $tlf;
                $info['dirU'] = $direccion;
                $info['estadoP'] = $estado;
                $info['fechaP'] = $fecha;

                return $info;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
         * Devuelve toda la información de un pedido y del usuario que lo realiza segun el estado del pedido
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

                $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, p.estado,p.fechaYHora,p.id from usuario u join pedido p on u.id = p.idU where p.estado = '$estado';");

                $prodQuery->execute();

                $prodQuery->bind_result($nombre, $tlf, $direccion, $estado, $fecha, $id);

                $peds= null;
                while($prodQuery->fetch()){
                    $info['nombreU'] = $nombre;
                    $info['tlfU'] = $tlf;
                    $info['dirU'] = $direccion;
                    $info['estadoP'] = $estado;
                    $info['fechaP'] = $fecha;
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
         * Devuelve toda la información de TODOS los pedidos y del usuario que los realiza
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

                $prodQuery->prepare("select u.nombre,u.tlf,u.direccion, p.id, p.estado, p.fechaYHora from usuario u join pedido p on u.id = p.idU;");

                $prodQuery->execute();

                $prodQuery->bind_result($nombre, $tlf, $direccion, $id, $estado, $fecha);

                $peds= null;
                while($prodQuery->fetch()){
                    $info['nombreU'] = $nombre;
                    $info['tlfU'] = $tlf;
                    $info['dirU'] = $direccion;
                    $info['estadoP'] = $estado;
                    $info['fechaP'] = $fecha;
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
         * Devuelve toda la información sobre los pedidos
         * @return array|void
         * @access public
         * @static
         */
        static function verPeds(){

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

                $prodQuery->prepare("select * from pedido;");

                $prodQuery->execute();

                $prodQuery->bind_result($idPed, $dataF, $cambio, $estado, $idU);

                $peds = null;
                while ($prodQuery->fetch()) {
                    $peds[$idPed] = new Pedido($dataF,$cambio,$estado, $idU);
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
         * Devuelve todos los estados existentes en base de datos
         * @return array|void
         * @access public
         * @static
         */
        static function verEstados(){

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

                $prodQuery->prepare("select distinct estado from pedido;");

                $prodQuery->execute();

                $prodQuery->bind_result($estado);

                $estados = null;
                $i = 0;
                while ($prodQuery->fetch()) {
                    $estados[$i] = $estado;
                    $i++;
                }

                return $estados;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
         * Devuelve toda la información sobre los pedidos
         * @return array|void
         * @access public
         * @static
         */
        static function verPedsxUser($idUser){

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

                $prodQuery->prepare("select id from pedido where idU = $idUser;");

                $prodQuery->execute();

                $prodQuery->bind_result($idPed);

                $peds = null;
                $i=0;
                while ($prodQuery->fetch()) {
                    $peds[$i] = $idPed;
                    $i++;
                }

                return $peds;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

    }
    
?>
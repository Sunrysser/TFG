<?php

    /**
     * @author web.ahmed.m@gmail.com
     */
    class Linea{

        /**
         * @var
         */
        protected $orden;

        /**
         * @var
         */
        protected $idPed;

        /**
         * @var
         */
        protected $idProd;

        /**
         * @var
         */
        protected $cant;

        /**
         * @var
         */
        protected $precioT;

        /**
         * @param $orden
         * @param $idPed
         * @param $idProd
         * @param $cant
         * @param $precioT
         */
        public function __construct($orden, $idPed, $idProd, $cant, $precioT)
        {
            $this->orden = $orden;
            $this->idPed = $idPed;
            $this->idProd = $idProd;
            $this->cant = $cant;
            $this->precioT = $precioT;
        }


        /**
         * @return mixed
         */
        public function getOrden()
        {
            return $this->orden;
        }

        /**
         * @param mixed $orden
         */
        public function setOrden($orden): void
        {
            $this->orden = $orden;
        }

        /**
         * @return mixed
         */
        public function getIdPed()
        {
            return $this->idPed;
        }

        /**
         * @param mixed $idPed
         */
        public function setIdPed($idPed): void
        {
            $this->idPed = $idPed;
        }

        /**
         * @return mixed
         */
        public function getIdProd()
        {
            return $this->idProd;
        }

        /**
         * @param mixed $idProd
         */
        public function setIdProd($idProd): void
        {
            $this->idProd = $idProd;
        }

        /**
         * @return mixed
         */
        public function getCant()
        {
            return $this->cant;
        }

        /**
         * @param mixed $cant
         */
        public function setCant($cant): void
        {
            $this->cant = $cant;
        }

        /**
         * @return mixed
         */
        public function getPrecioT()
        {
            return $this->precioT;
        }

        /**
         * @param mixed $precioT
         */
        public function setPrecioT($precioT): void
        {
            $this->precioT = $precioT;
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return '';
        }


        /**
         * Inserta un nueva liena de pedido en base de datos
         * @return void
         * @access public
         */
        function crearLinea() : void{

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
                $insert->prepare("INSERT INTO linea (orden, idPed, idProd, cant, precioT) VALUES ($this->orden,$this->idPed,'$this->idProd',$this->cant,$this->precioT);");
                $insert->execute();
                $insert->close();
            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
         * Devuelve toda la información sobre las lineas de pedido de un pedido en especifico
         * @return array|void
         * @access public
         * @static
         * @param $idPed
         */
        static function verLineaxPedido($idPed){

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

                $prodQuery->prepare("select orden, idProd, cant, precioT from linea where idPed = ".$idPed.";");

                $prodQuery->execute();

                $prodQuery->bind_result($orden, $idProd, $cant, $precioT);

                $prods = null;
                $i = 0;
                while ($prodQuery->fetch()) {
                    $prods[$i] = new Linea($orden, $idPed, $idProd, $cant, $precioT);
                    $i++;
                }

                return $prods;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

    }
    
?>
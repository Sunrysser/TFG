<?php

use App\Models\User;

    /**
     * @author web.ahmed.m@gmail.com
     */
    class Usuario{
        /**
         * @var
         */
        protected $nombre;

        /**
         * @var
         */
        protected $tlf;

        /**
         * @var
         */
        protected $dir;

        /**
         * @param $nombre
         * @param $tlf
         * @param $dir
         */
        public function __construct($nombre, $tlf, $dir)
        {
            $this->nombre = $nombre;
            $this->tlf = $tlf;
            $this->dir = $dir;
        }

        /**
         * @return mixed
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * @param mixed $nombre
         */
        public function setNombre($nombre): void
        {
            $this->nombre = $nombre;
        }

        /**
         * @return mixed
         */
        public function getTlf()
        {
            return $this->tlf;
        }

        /**
         * @param mixed $tlf
         */
        public function setTlf($tlf): void
        {
            $this->tlf = $tlf;
        }

        /**
         * @return mixed
         */
        public function getDir()
        {
            return $this->dir;
        }

        /**
         * @param mixed $dir
         */
        public function setDir($dir): void
        {
            $this->dir = $dir;
        }

        /**
         * @return string
         */
        public function __toString(): string
        {
            return 'Nombre: '. $this->nombre. ' Tlf: '. $this->tlf. ' Direccion: '. $this->dir;
        }

        /**
         * Inserta una nuevo usuario en base de datos, si no existe otro igual, y devuelve el id
         * @return mixed|void
         * @access public
         */
        function crearUser(){

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

                $query = $conexion->stmt_init();

                $query->prepare("SELECT id FROM usuario WHERE nombre = '$this->nombre' and direccion = '$this->dir' and tlf = '$this->tlf';");

                $query->execute();

                $query->bind_result($id);

                if ($query->fetch()) {
                    $query->close();
                    return $id;
                }

                else {
                    $insert = $conexion->stmt_init();
                    $insert->prepare("INSERT INTO usuario (nombre, tlf, direccion) VALUES ('".$this->nombre."','".$this->tlf."','".$this->dir."');");
                    $insert->execute();
                    $insert->close();

                    $query = $conexion->stmt_init();
                    $query->prepare("SELECT LAST_INSERT_ID();");
                    $query->execute();
                    $query->bind_result($id);
                    $query->fetch();

                    return $id;
                }

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }

        /**
         * Devuelve toda la información sobre un usuario segun su id
         * @return object|void
         * @access public
         * @static
         * @param $cat
         */
        static function verUsxId($id){

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
                
            $firstq = $conexion->stmt_init();

            $firstq->prepare("select nombre, tlf, direccion from usuario where id = '".$id."';");

            $firstq->execute();

            $firstq->bind_result($nombre, $tlf, $dir);

            $firstq->fetch();

            $user = new Usuario($nombre, $tlf, $dir);
            
            return $user;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }


        /**
         * Devuelve toda la información sobre los usuarios
         * @return array|void
         * @access public
         * @static
         */
        static function verUsers(){

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

                $prodQuery->prepare("select * from usuario;");

                $prodQuery->execute();

                $prodQuery->bind_result($id, $nombre, $tlf, $dir);

                $users = null;
                while ($prodQuery->fetch()) {
                    $users[$id] = new Usuario($nombre, $tlf, $dir);
                }

                return $users;

            }catch(Exception $ex){

                //Si no, lanzamos otra
                echo $ex->getMessage(), "<br>";

            }

            //Cerramos la conexion a db
            $conexion->close();
        }
    }
    
?>
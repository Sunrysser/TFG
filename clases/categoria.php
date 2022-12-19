<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

/**
 * @author web.ahmed.m@gmail.com
 */
class Categoria{

    /**
     * @var
     */
    protected $id;
    
    /**
     * @var
     */
    protected $nombre;

    /**
     * @param $nombre
     * @param $id
     * @access public
     */
    public function __construct($nombre, $id){
        if ($id == 0) {
            $this->nombre = $nombre;
        }

        else {
            $this->nombre = $nombre;
            $this->id = $id;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void{
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function __toString(): string{
        return $this->nombre;
    }
    
    /**
     * Devuelve toda la información sobre TODAS las categorias
     * @return array|void
     * @access public
     * @static
     */
    static function verCats(){

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

            $query->prepare("select * from categoria");

            $query->execute();

            $query->bind_result($id,$nombre);

            $cats = null;
            $i = 0;
            while ($query->fetch()) {
                $cats[$i] = new Categoria($nombre, $id);
                $i++;
            }

            return $cats;

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve toda la información sobre una categoria por un id
     * @return mixed|void
     * @access public
     * @static
     * @param $id
     */
    static function verCat($id){

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

            $query->prepare("select nombre from categoria where id = '".$id."';");

            $query->execute();

            $query->bind_result($nombre);

            $query->fetch();

            return $nombre;

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Inserta una nueva categoria en base de datos
     * @return void
     * @access public
     */
    function crearCat() : void{

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
            $insert->prepare("INSERT INTO categoria (nombre) VALUES ('".$this->nombre."');");
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
     * Borra una categoría de la base de datos por su id
     * @return void
     * @access public
     * @static
     * @param $id
     */
    static function BorCat($id) : void{

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
            $update->prepare("delete from categoria where id = '".$id."';");
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
     * Actualiza una categoría de la base de datos por su id
     * @return void
     * @access public
     * @static
     * @param $id
     * @param $nombre
     */
    static function actCat($id, $nombre) : void{

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
            $update->prepare("update categoria set nombre ='".$nombre."' where id ='".$id."';");
            $update->execute();

            $update->close();
            $conexion->close();

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }
}    
?>
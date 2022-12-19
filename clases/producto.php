<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

/**
 * @author web.ahmed.m@gmail.com
 */
class Producto{

    /**
     * @var
     */
    protected $nombre;

    /**
     * @var
     */
    protected $desc;

    /**
     * @var
     */
    protected $pvp;

    /**
     * @var
     */
    protected $cat;

    /**
     * @param $nombre
     * @param $desc
     * @param $pvp
     * @param $cat
     */
    public function __construct($nombre, $desc, $pvp, $cat)
    {
        $this->nombre = $nombre;
        $this->desc = $desc;
        $this->pvp = $pvp;
        $this->cat = $cat;
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
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * @param mixed $pvp
     */
    public function setPvp($pvp): void
    {
        $this->pvp = $pvp;
    }

    /**
     * @return mixed
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param mixed $cat
     */
    public function setCat($cat): void
    {
        $this->cat = $cat;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Nombre: '. $this->nombre. ' Desc: '. $this->desc. ' Precio: '. $this->pvp. ' Categoria: '. $this->cat;
    }

    /**
     * Devuelve el precio de un producto segun su id
     * @param $id
     * @return mixed|void
     */
    static function verPrecioProd($id){
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

            $prodQuery->prepare("select precio from producto where nombre = '".$id."';");

            $prodQuery->execute();

            $prodQuery->bind_result($price);

            $prodQuery->fetch();

            return $price;

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Devuelve toda la informacion de todos los productos de una categoria
     * @return array|void
     * @access public
     * @static
     * @param $cat
     */
    static function verProdsxCat($cat){

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

            $prodQuery->prepare("select nombre, descr, precio from producto where idCat = ".$cat.";");

            $prodQuery->execute();

            $prodQuery->bind_result($name, $desc, $price);

            $prods = null;
            $i = 0;
            while ($prodQuery->fetch()) {
                $prods[$i] = new Producto($name, $desc, $price, $cat);
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

    /**
     * Devuelve toda la información de un producto segun su id (el nombre del producto)
     * @return object|void
     * @access public
     * @static
     * @param $cat
     */
    static function verProdsxNombre($id){

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

        $firstq->prepare("select descr, precio from producto where nombre = '".$id."';");

        $firstq->execute();

        $firstq->bind_result($desc, $precio);

        $firstq->fetch();

        $prod = new Producto($id, $desc, $precio, 'Da igual');

        return $prod;

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Inserta un nuevo producto en base de datos
     * @return void
     * @access public
     */
    function crearProd() : void{

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
            $insert->prepare("INSERT INTO producto VALUES ('".$this->nombre."','".$this->desc."','".$this->pvp."','".$this->cat."');");
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
     * Borra un producto de la base de datos por su id
     * @return void
     * @access public
     * @static
     * @param $id
     */
    static function borProd($id) : void{

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
            $update->prepare("delete from producto where nombre = '".$id."';");
            $update->execute();

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }

    /**
     * Actualiza un producto en base de datos
     * @return void
     * @access public
     * @static
     * @param $desc
     * @param $pvp
     * @param $nombre
     */
    static function actProd($desc, $pvp, $nombre) : void{

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
            $update->prepare("update producto set descr ='".$desc."', precio =".$pvp." where nombre ='".$nombre."';");
            $update->execute();
            $update->close();

        }catch(Exception $ex){

            //Si no, lanzamos otra
            echo $ex->getMessage(), "<br>";

        }

        //Cerramos la conexion a db
        $conexion->close();
    }
}

            
    
?>
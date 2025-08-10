<?php
namespace App;

class Propiedad{

    protected static $db;
    protected static $columnDb = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamientos','creado','vendedorId'];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedorId;

    //Se guarda la instancia unica de la conexion a la base de datos en la clase
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function actualizar(){
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value){
            if($key === 'id') continue;
                $valores[] = "{$key} = '$value'";
        }
        
        $query = "UPDATE propiedades SET ";
        $query .= join(',',array_values($valores));
        $query .= " WHERE id =" . self::$db->escape_string($this->id);

        $resultado = self::$db->query($query);

        if($resultado){
            //echo "Insertado correctamente";
            header('Location: /admin?resultado=2');
        }

    }

    public function Eliminar(){
        $query = "SELECT imagen FROM propiedades WHERE id = " . self::$db->scape_string($this->id);
        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarFoto();
            header('location: /admin?resultado=3');
        }
    }

    public function crear(){
        
        //Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        
        //insertar en la base de datos
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
            
        /* echo $query; */
        $resultado = self::$db->query($query);

        if($resultado){
            //echo "Insertado correctamente";
            header('Location: /admin?resultado=1');
        }
        
    }

    public function atributos(){
        $atributos = [];
        foreach(self::$columnDb as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        //validación de errores
        if(!$this->titulo){
            self::$errores [] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores [] = "Debes añadir un precio";
        }
        if(strlen($this->descripcion) < 40){
            self::$errores [] = "Debes añadir una descripcion de al menos 40 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores [] = "Debes añadir el número de habitaciones";
        }
        if(!$this->wc){
            self::$errores [] = "Debes añadir el número de baños";
        }
        if(!$this->estacionamientos){
            self::$errores [] = "Debes añadir el número de estacionamientos";
        }
        if(!$this->vendedorId){
            self::$errores [] = "Debes seleccionar un vendedor";
        }
        if(!$this->imagen){
            self::$errores [] = "Debe añadir una imagen";
        }

        return self::$errores;
    }

    public function setImagen($imagen){
        //Eliminar Imagen previa
        if(!is_null($this->id)){
            $this->borrarFoto();
        }

        //Asigna al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarFoto(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por un id
    public static function find($id){
        $query = "SELECT * FROM Propiedades WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar a la base de datos
        $resultado = self::$db->query($query);
        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar lo resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self();
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

}
?>
<?php
namespace App;

class ActiveRecord{

    protected static $db;
    protected static $columnDb = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

    

    //Se guarda la instancia unica de la conexion a la base de datos en la clase
    public static function setDB($database){
        self::$db = $database;
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
        
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(',',array_values($valores));
        $query .= " WHERE id =" . self::$db->escape_string($this->id);

        $resultado = self::$db->query($query);

        if($resultado){
            //echo "Insertado correctamente";
            header('Location: /admin?resultado=2');
        }

    }

    public function Eliminar(){
        $query = "SELECT imagen FROM " . static::$tabla . " WHERE id = " . self::$db->scape_string($this->id);
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
        $query = "INSERT INTO " . static::$tabla . " (";
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
        foreach(static::$columnDb as $columna){
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
        return static::$errores;
    }

    public function validar(){
        //validación de errores
        
        static::$errores = [];
        return static::$errores;
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
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por un id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar a la base de datos
        $resultado = self::$db->query($query);
        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar lo resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static();
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
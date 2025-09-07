<?php
namespace App;

class Propiedad extends ActiveRecord{

    protected static $columnDb = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamientos','creado','vendedorId'];
    protected static $tabla = 'propiedades';

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
        $this->vendedorId = $args['vendedorId'] ?? '';
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
}
?>
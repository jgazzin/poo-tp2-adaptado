<?php
require_once "./IBaseDatos.php";

class BaseArray implements IBaseDatos{
    protected $baseDatos;
    protected $errores = [];

    public function insertar($nuevoElemento, $clave=null){

    }
    public function borrar($clave){

    }
    public function buscarPorApellido($apellido){

    }
    public function buscarPorClave($clave){

    }
    public function reemplazar($clave, $elementoNuevo){

    }
    public function getErroresBD(){

    } 
}


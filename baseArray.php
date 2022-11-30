<?php
require_once "./interfaceDatos.php";

class BaseArray implements IDatos{
    protected $baseArray;
    protected $erroresBA = [];

    // constructor recibe array de objetos
    public function __construct($arrayObjetos=[]) {
        $this->baseArray = $arrayObjetos;
    }


    public function insertar($nuevoElemento, $clave=null){
        if($clave===null){
            // si alumno nuevo = clave nueva
            $clave = time();
        }
        // verifica que nueva clave no exista
        if($this->buscarPorClave($clave)!==null){
            $this->erroresBA = ['Clave ingresada duplicada'];
            return;
        }
        // guarda nuevo alumno
        $this->baseArray[$clave] = $nuevoElemento;
        $this->erroresBA = [];
    }


    public function borrar($clave){
        if($this->buscarPorClave($clave)===null) {
            $this->erroresBA = ['Clave no existe'];
            return;
        } else {
            $baseActualizada = $this->baseArray;
            echo "Borrar: " . $clave ."\n";
            unset($baseActualizada[$clave]);
            return $this->baseArray = $baseActualizada;
        }
    }
    
    public function buscarPorApellido($apellido=""){
        $resultado = [];

        foreach($this->baseArray as $alumno){
            if(empty($apellido) || $alumno->getApellido() === $apellido){
                $resultado[] = $alumno;
            }
        }        
        return $resultado;
    }

    public function buscarPorClave($clave){
        if(array_key_exists($clave, $this->baseArray)){
            return $this->baseArray[$clave];
        }else{
            // guarda en errores y retorna null
            $this->erroresBA = ['Clave no existe'];
        }
        return null;
    }

    public function reemplazar($clave, $alumnoNuevo){
        $alumnoModificar = $this->buscarPorClave($clave);
        $baseActualizada = $this->borrar($clave);
        $this->insertar($alumnoNuevo, $clave);
        return $this->baseArray;
    }

    public function getErroresBA(){
        return $this->erroresBA;
    } 
}


<?php
require_once "./alumno.php";

class AlumnoLibre extends Alumno {

    public function __construct($i, $pApellido, $pMateria, $pNota) {
        parent::__construct ($i, $pApellido, $pMateria, $pNota);
        // $this->aprobo(); 
        parent::validar();
    }

    public function aprobo(){
        if (!empty($this->nota)){
            if ($this->nota >=4) {
                return "SI";
            } else {
                return "NO";
            } 
        }

    } 

    public function imprimirDatos (){
        $impresion = parent::imprimirDatos(). "\n".
        "\tAprobo: " . $this->aprobo() . "\n".
        "\tAlumno Libre".PHP_EOL;
        //parent::imprimirErrores();

        return $impresion;
    }  

}

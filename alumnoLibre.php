<?php
require_once "./alumno.php";

class AlumnoLibre extends Alumno {

    public function __construct($pApellido, $pMateria, $pNota, $i) {
        parent::__construct ($pApellido, $pMateria, $pNota, $i);
        $this->id = "AL{$this->apellido}-{$i}";
        // $this->aprobo(); 
        parent::validar();
    }

    public function aprobo(){
        if (!empty($this->nota)){
            if ($this->nota >4) {
                return "SI";
            } else {
                return "NO";
            } 
        }

    } 

    public function imprimirDatos (){
        parent::imprimirDatos();
        echo "Aprobo: " . $this->aprobo() . "\n";
        echo "Alumno Libre".PHP_EOL;
        parent::imprimirErrores();
    }  

}

<?php
require_once "./alumno.php";

class AlumnoRegular extends Alumno {

    protected $anioRegularidad;

    public function __construct($pApellido, $pMateria, $pNota, $pAnioRegularidad, $i) {

        parent::__construct($pApellido, $pMateria, $pNota, $i);
        $this->id = "AR{$this->apellido}-{$i}";
        $this->anioRegularidad = $pAnioRegularidad;
        // $this->aprobo();
        $this->validar();
    }

    // validar datos
    public function validar(){
        parent::validar();
        // anios regularidad
        if (empty($this->anioRegularidad)){
            $this->errores[] = "Año Regularidad vacío";
        } else if (!is_numeric($this->anioRegularidad)){
            $this->errores[] = "Año de regularidad no es numérico";
        } else if ($this->anioRegularidad < 1900 ||
        $this->anioRegularidad > 2022) {
        $this->errores[] = "El año regularidad no es válido (1900/2022)";
        }
        
    }

    public function aprobo(){
        if (!empty($this->nota)){
            if ($this->nota >6) {
                return "SI";
            } else {
                return "NO";
            }
        }
    }

    public function imprimirDatos (){
        parent::imprimirDatos();
        echo "Aprobo: " . $this->aprobo() . "\n";
        echo "Alumno regular".PHP_EOL;
        echo "año regularidad: " . $this->anioRegularidad . "\n";
        parent::imprimirErrores();
    }    

}
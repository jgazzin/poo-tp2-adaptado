<?php
require_once "./alumno.php";

class AlumnoRegular extends Alumno {

    protected $anioRegularidad;

    public function __construct($i, $pApellido, $pMateria, $pNota, $pAnioRegularidad) {

        parent::__construct($i, $pApellido, $pMateria, $pNota);
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
            if ($this->nota >=6) {
                return "SI";
            } else {
                return "NO";
            }
        }
    }

    public function imprimirDatos (){
        $impresion = parent::imprimirDatos() .
        "\tAprobo: " . $this->aprobo() . "\n".
        "\tAlumno regular".PHP_EOL.
        "\taño regularidad: " . $this->anioRegularidad . "\n";
        //parent::imprimirErrores();

        return $impresion;
    }    

}
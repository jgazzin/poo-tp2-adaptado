<?php

abstract class Alumno {
    protected $id;
    protected $apellido;
    protected $materia;
    protected $nota;
    // protected $aprobo;
    protected $errores = [];

    public function __construct($pApellido, $pMateria, $pNota) {
        $this->apellido = $pApellido;
        $this->materia = $pMateria;
        $this->nota = $pNota;
    }

    public function materia(){
        return $this->materia;
    }

    public function getErrores(){
        return $this->errores;
    }
    public function apellido(){
        return $this->apellido;
    }
    public function id(){
        return $this->id;
    }
    public function setId($valor){
        $this->id = $valor;
    }

    //validar datos
    public function validar(){
        //$alumno->apellido
        if (empty($this->apellido)){
            $this->errores[] = "Apellido vacío";
        }

        // $alumno->materia 
        if (empty($this->materia)){
            $this->errores[] = "Materia vacío";
        } else {
            $materiasValidas = [
                "POO", 
                "MATEMATICAS", 
                "BD"];
            $esMateriaValido = in_array($this->materia, $materiasValidas);
            if ($esMateriaValido == false) {
                $this->errores[] = "Materia no válida. debe ser:".implode(" - ", $materiasValidas);
            }
        }

        // $almno->validarNota
        if (empty($this->nota)){
        $this->errores [] = "Nota vacía";
        } else  if (!is_numeric($this->nota)) {
            $this->errores [] = "Valor no numérico";
        } else if ($this->nota >10 || $this->nota < 0) {
            $this->errores [] = "Nota no válida (0-10)";
        }
            
    }
    


    // leerDatos
    public function imprimirDatos () {

        $impresion = "//------------------\n".
        "\tID: " . $this->id . "\n".
        "\tApellido: " . $this->apellido. "\n".
        "\tMateria: " . $this->materia . "\n".
        "\tNota: " . $this->nota . "\n";
        return $impresion;

    }

    // public function imprimirErrores() {
    //     echo "Errores: \n";
    //     if (empty($this->errores)){
    //         echo "\tAlumno Válido\n";
    //     } else {
    //         foreach ($this->errores as $error) {
    //             echo "\t" . $error . "\n";
    //         }
    //     }
    // }
}
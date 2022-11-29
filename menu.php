<?php
require_once "./utiles.php";
require_once "./alumnoLibre.php";
require_once "./alumnoRegular.php";


class Menu {
    private $opciones = [
                'A'=>'Cargar datos',
                'B'=>'Borrar datos',
                'M'=>'Modificar',
                'L'=>'Buscar alumnos por apellido',
                'S'=>'Salir'
            ];    
    public function __construct(){
    }

    public function presentarOpciones(){
        foreach($this->opciones as $opcion=>$mensaje){
            echo "$opcion - $mensaje".PHP_EOL;
        }
    }

    public function ejecutarAccion($opcion, $datosEjercicio, &$errores){
        $nuevoDatosEjercicio = $datosEjercicio;

        switch($opcion){
            // A- cargar datos
            case "A":
                echo "Usted eligio Carga de Datos \n";
                $nuevoDatosEjercicio = $this->cargarDatos($nuevoDatosEjercicio, $errores);
                break;

            // B - borrar datos
            case "B":
                echo "Usted eligio Borrar Datos \n";
                $nuevoDatosEjercicio = $this->borrarDatos($nuevoDatosEjercicio, $errores);
                break;   
            
            // M - modificar datos
            case "M":
                echo "Usted eligió Modificar Datos\n";
                $nuevoDatosEjercicio = $this->modificarDatos($nuevoDatosEjercicio, $errores);
                break;
            case "L":
                echo "Ejecutando LISTAR DATOS".PHP_EOL; 
                $this->listarDatos($datosEjercicio);
                break;
        }
        return $nuevoDatosEjercicio;
    }

    private function listarDatos($datosEjercicio){
        // pedir el apellido a buscar
        Utiles::verDatos($datosEjercicio);
        $mostrar = Utiles::pedirInformacion("Apellido del alumno:");

        foreach($datosEjercicio as $alumno){
            if ($mostrar == $alumno->apellido() || empty($mostrar)){
                $alumno->imprimirDatos();
            } 
        }
    }


    private function cargarDatos($datosEjercicio, &$errores){

        $nuevoAlumno = $this->pedirDatosAlumno();
        // contando los errores puedo saber si es válido
        if(count($nuevoAlumno->getErrores())===0){
            $datosEjercicio[$nuevoAlumno->id()] = $nuevoAlumno;
        } else {
            // si hubo un error, lo paso al que me invocó para que lo trate
            // de la manera que considere
            $errores = $nuevoAlumno->getErrores();
        }
        var_dump($datosEjercicio);
        return $datosEjercicio;

    }

    private function pedirDatosAlumno(){
       
        $apellido = Utiles::pedirInformacion("Ingrese apellido del alumno:");
        $materia = Utiles::pedirInformacion("materia del alumno:");
        $nota = Utiles::pedirInformacion("Ingrese la nota:");
        $esRegular = Utiles::pedirInformacion("es regular la materia? S o N ");
        // índice para el ID (para q no se repitan Id si no se graba nombre)
        $i=time(); // time crea un número muy grande, que no se va a repetir
        if($esRegular=="S"){
            $anioRegularidad = Utiles::pedirInformacion("Anio de regularización:");
            $nuevoAlumno = new AlumnoRegular($apellido, $materia, $nota, $anioRegularidad, $i);
        }else{
            $nuevoAlumno = new AlumnoLibre($apellido, $materia, $nota, $i);
        }
        return $nuevoAlumno;

    }


    private function borrarDatos($datosEjercicio, &$errores){
        Utiles::verDatos($datosEjercicio);
        $borrar = Utiles::pedirInformacion("Elija el ID del alumno a borrar \n");
        if(array_key_exists($borrar, $datosEjercicio)){
            echo "Borrar: " . $borrar ."\n";
            unset($datosEjercicio[$borrar]);
            Utiles::verDatos($datosEjercicio);   
        } else {
            $errores[] = "ID inexistente".PHP_EOL;
        }
        return $datosEjercicio;
    }


    private function modificarDatos($datosEjercicio, &$errores){

        Utiles::verDatos($datosEjercicio);
        $modificar = Utiles::pedirInformacion("Indique ID del alumno a modificar:");
        if(array_key_exists($modificar, $datosEjercicio)){
            $alumnoModificado = $this->pedirDatosAlumno();
            // fix para preservar el id anterior como clave de asociación, coordinado
            // con el id del objeto
            $alumnoModificado->setID($modificar);
            if(count($alumnoModificado->getErrores())===0){
                $datosEjercicio[$modificar] = $alumnoModificado;
            }else{
                // si los datos del nuevo alumno están mal devuelvo los errores
                $errores = $alumnoModificado->getErrores();
            }
        } else {
            $errores[] = "ID inexistente".PHP_EOL;
        }        

        return $datosEjercicio;

    }

}
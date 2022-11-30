<?php
require_once "./utiles.php";

require_once "./alumnoLibre.php";
require_once "./alumnoRegular.php";

require_once "interfaceDatos.php";
require_once "baseArray.php";

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
        // $opcion = $key
        // $mensaje => $value
        foreach($this->opciones as $opcion=>$mensaje){
            Utiles::informarUsuario("$opcion - $mensaje".PHP_EOL);
        }
    }

    public function ejecutarAccion($opcion, IDatos $baseDatos, &$errores){

        switch($opcion){
            // A- cargar datos
            case "A":
                Utiles::informarUsuario("Usted eligio Carga de Datos \n");
                $this->cargarDatos($baseDatos, $errores);
                break;

            // B - borrar datos
            case "B":
                Utiles::informarUsuario("Usted eligio Borrar Datos \n");
                $this->borrarDatos($baseDatos, $errores);
                break;   
            
            // M - modificar datos
            case "M":
                Utiles::informarUsuario("Usted eligió Modificar Datos\n");
                $this->modificarDatos($baseDatos, $errores);
                break;

            // L - modificar datos   
            case "L":
                echo "Ejecutando LISTAR DATOS".PHP_EOL; 
                $this->listarDatos($baseDatos);
                break;

            // S - Salir   
            case "S":
                Utiles::informarUsuario("SALIR DEL PROGRAMA".PHP_EOL); 
                break;
            
            default:
                Utiles::informarUsuario ("Opción no válida".PHP_EOL);
                break;
        }
    }

    // ver solo ID y Apellido
    private function verIniciales(IDatos $baseDatos){
        $cargarTodos = $baseDatos->buscarPorApellido();
        foreach($cargarTodos as $alumno){
            Utiles::informarUsuario("ID: ".$alumno->getId()."\n");
            Utiles::informarUsuario("Apellido: ".$alumno->getApellido()."\n\n");

        }
    }

    private function listarDatos(IDatos $baseDatos){
        $mostrar = Utiles::pedirInformacion('Ingrese un apellido o presione ENTER para ver todos');
        // busco alumno por apellido o todos si mostrar = vacío
        $resultado =  $baseDatos->buscarPorApellido($mostrar);
        foreach($resultado as $alumno){
            Utiles::informarUsuario($alumno->imprimirDatos());

        }
    }

    private function cargarDatos(IDatos $baseDatos, &$errores){
        $nuevoAlumno = $this->pedirDatosAlumno();
        // contando los errores puedo saber si es válido
        if(count($nuevoAlumno->getErrores())===0){
            // implementa metodo de la interface (Objeto de pedir datos + clave o nada)
            $baseDatos->insertar($nuevoAlumno, $cave=null);

        } else {
            // muestra los mensajes de error de validar()
            $errores = $nuevoAlumno->getErrores();
        }
        // no retorna nada porque guarda baseArray (en insertar)
    }

    private function pedirDatosAlumno($alumno=null){
        if($alumno===null){
            // si alumno
            $pk = Utiles::pedirInformacion('Ingrese la clave de identificación [Enter para una genérica]');
            if(empty($pk)){
                $pk = time();
            }
        }else {
            // envío alumno
            $pk = $alumno->getId();
        }

        $apellido = Utiles::pedirInformacion("Ingrese apellido del alumno:");
        $materia = Utiles::pedirInformacion("materia del alumno:");
        $nota = Utiles::pedirInformacion("Ingrese la nota:");
        $esRegular = Utiles::pedirInformacion("es regular la materia? S o N ");

        if($esRegular=="S"){
            $anioRegularidad = Utiles::pedirInformacion("Anio de regularización:");
            $nuevoAlumno = new AlumnoRegular($pk, $apellido, $materia, $nota, $anioRegularidad);
        }else{
            $nuevoAlumno = new AlumnoLibre($pk, $apellido, $materia, $nota);
        }
        // Objeto
        return $nuevoAlumno;
    }


    private function borrarDatos(IDatos $baseDatos, &$errores){
        $this->verIniciales($baseDatos);

        $borrar = Utiles::pedirInformacion("Elija el ID del alumno a borrar");
        $baseDatos->borrar($borrar);
        // return de erroresBA
        $errores = $baseDatos->getErroresBA();
        
    }


    private function modificarDatos(IDatos $baseDatos, &$errores){
        $this->verIniciales($baseDatos);

        $clave = Utiles::pedirInformacion("Indique ID del alumno a modificar:");
        $alumnoViejo = $baseDatos->buscarPorClave($clave);

        if($alumnoViejo===null){
            // si buscarPorClave retorna null llama a erroresBA
            $errores = $baseDatos->getErroresBA();
            return;
        }
        // else - manda alumno viejo para recuperar pk + datos nuevos
        $alumnoNuevo = $this->pedirDatosAlumno($alumnoViejo);
        // devuelve objeto

        // varifica errores surgidos en validar (en constructor)
        if(count($alumnoNuevo->getErrores())>0) {
            $errores = $alumnoNuevo->getErrores();
            return;
        }
        // si todo ok llamo al metodo reemplazar de la interface
        $baseDatos->reemplazar($clave, $alumnoNuevo);
        // trae errores de baseArray para devolver a ejercicio
        $errores = $baseDatos->getErroresBA();
    }

}
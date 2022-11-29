<?php
class Utiles {
    public static function pedirInformacion($mensaje, $mayuscula=true, $quitarEspacios=true){
        echo "$mensaje: ".PHP_EOL;
        $entradaUsuario = fgets(STDIN);
        if($mayuscula){
            $entradaUsuario = strtoupper($entradaUsuario);
        }
        if($quitarEspacios){
            $entradaUsuario = trim($entradaUsuario);
        }        
        return $entradaUsuario;
    }

    // public static function mostrarDatos($datosEjercicio) {
    //     echo "Total Alumnos: ". count($datosEjercicio) . "\n";
    //     foreach($datosEjercicio as $alumno){
    //         echo $alumno->imprimirDatos();
    //     }
    // }

    // public static function verDatos($datosEjercicio) {
    //     echo "Total Alumnos: ". count($datosEjercicio) . "\n";
    //     foreach($datosEjercicio as $alumno){
    //         Utiles::informarUsuario("ID: {$alumno->id()}\n");
    //         Utiles::informarUsuario("Apellido: {$alumno->apellido()}\n\n");
    //     }
    // }

    public static function informarUsuario($mensaje) {
        echo $mensaje;
    }

}
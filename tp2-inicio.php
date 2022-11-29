<?php
require_once "./alumnoRegular.php";
require_once "./alumnoLibre.php";
require_once "./utiles.php";
require_once "./menu.php";

class Ejercicio {
    private $menu;
    private $datosEjercicio = [];

    public function __construct(){
        $this->menu = new Menu();
        $this->demo();
    }

    public function demo(){
    // DEMO control del programa
    $alDemo1= new alumnoRegular ("AR1", "POO", "7", "2022",0);
    $alDemo2= new alumnoLibre ("AL2", "BD", "4",1);
    $alDemo3= new alumnoLibre ("AL3", "BD", "2",2);
    $alDemo4= new alumnoRegular ("AR4", "POO", "3", "2022",3);
    $this->datosEjercicio = [
        "ARAL1-0"=>$alDemo1,
        "ALAL2-1"=>$alDemo2,
        "ALAL3-2"=>$alDemo3,
        "ARAL4-3"=>$alDemo4];
    }

    public function iniciarEjercicio(){
        do {
            $this->menu->presentarOpciones();
            $opcion = Utiles::pedirInformacion('Elija una opción');
            echo "usted eligió $opcion".PHP_EOL;
            $errores = [];
            $this->datosEjercicio = $this->menu->ejecutarAccion($opcion, $this->datosEjercicio, $errores);        
            // al final de la ejecución, deberia verificar y/o listar los errores
            // puede ser otro método o un foreach
            // var_dump($errores);
        }while($opcion!=="S");
    }
}

$ejercicio = new Ejercicio();
$ejercicio->iniciarEjercicio();

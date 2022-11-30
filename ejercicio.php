<?php
require_once "./menu.php";
require_once "./utiles.php";

require_once "./interfaceDatos.php";

class Ejercicio {
    private $menu;
    private $baseEjercicio;

    public function __construct(IDatos $baseDatos){
        $this->menu = new Menu();
        $this->baseEjercicio = $baseDatos;
    }

    public function iniciarEjercicio(){
        do {
            $this->menu->presentarOpciones();
            $opcion = Utiles::pedirInformacion('Elija una opción');
            Utiles::informarUsuario("usted eligió $opcion".PHP_EOL);
            $errores = [];
            // no vuelve queda en menu
            $this->menu->ejecutarAccion($opcion, $this->baseEjercicio, $errores);    

            if(count($errores)>0){
                echo ("Ocurrieron los siguientes errores: ".PHP_EOL);
                foreach($errores as $error){
                    echo($error.PHP_EOL);
                }
            }    

        }while($opcion!=="S");
    }
}
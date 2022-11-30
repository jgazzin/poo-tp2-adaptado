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
            $this->baseEjercicio = $this->menu->ejecutarAccion($opcion, $this->baseEjercicio, $errores);        

        }while($opcion!=="S");
    }
}
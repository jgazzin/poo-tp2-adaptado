<?php
require_once "./alumnoRegular.php";
require_once "./alumnoLibre.php";

require_once "./baseArray.php";

require_once "./utiles.php";
require_once "./menu.php";
require_once "./ejercicio.php";

// DEMO control del programa
$pk1 = time();
$alDemo1= new alumnoRegular ($pk1,"APE1", "POO", 7, 2022);
$pk2= time()+1;
$alDemo2= new alumnoLibre ($pk2,"APE2", "BD", 5);
$pk3= time()+2;
$alDemo3= new alumnoLibre ($pk3,"APE3", "BD", 6);
$pk4= time()+3;
$alDemo4= new alumnoRegular ($pk4,"APE4", "POO", 8, 2021);
$arrayObjetos = [
    $pk1=>$alDemo1,
    $pk2=>$alDemo2,
    $pk3=>$alDemo3,
    $pk4=>$alDemo4
];

// var_dump($arrayObjetos);

$baseArray = new BaseArray($arrayObjetos);
$ejercicio = new Ejercicio($baseArray);
$ejercicio->iniciarEjercicio();

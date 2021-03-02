<?php
if (isset($_GET['accion']) && isset($_GET['nombreFormulario'])) {
    $accion = $_GET['accion'];
    $nombreformulario = $_GET['nombreFormulario'];
    if (isset($_GET['criterio']) && isset($_GET['valor'])) {
        $criterio = $_GET['criterio']; //valor
        $criterio = lcfirst($criterio);
        $valor = $_GET['valor'];
    }
}else if (isset ($_POST['accion'])){
    $accion = $_POST['accion'];
    $datosCampos = $_REQUEST;
    $nombreformulario = $datosCampos['nombreFormulario'];
//    foreach ($datosCampos as $key => $value) {
//        echo $key.'-'.$value.'<br>';
//    }
}else if(isset ($_POST['user']) && isset($_POST['pass'])){
    $accion = "guardar";
    $nombreformulario = "Usuario";
    $datosCampos = ["user"=>$_POST['user'], "pass"=>$_POST['pass']];
}
if (isset($_GET['id'])) {
    $id=$_GET['id'];
}
require_once '../controladoresEspecificos/Controlador'.$nombreformulario.'.php'; //hago el include del controlador corresp
$nombreControlador = "Controlador".$nombreformulario; //meto en una variable el nombre del controlador corresp
$objControlador = new $nombreControlador(); //instancio
switch ($accion) {
    case "eliminar":
        $resultado = $objControlador->$accion($id); //llamo a la acción
        echo json_encode($resultado);//arreglo json
        break;
    case "buscar":
        $resultado = $objControlador->$accion(); //llamo a la acción
        echo json_encode($resultado);//arreglo json
        break;
    case "guardar":
        $resultado = $objControlador->$accion($datosCampos); //llamo a la acción
        echo json_encode($resultado);//arreglo json
        break;
    case "buscarX":
        $datos = ["criterio"=>$criterio, "valor"=>$valor];
        $resultado = $objControlador->$accion($datos); //llamo a la acción
        echo json_encode($resultado);//arreglo json
        break;
    default:
        break;
}
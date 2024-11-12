<?php
require_once 'Modelo/Despacho.php';

$despacho = new Despacho();

if (isset($_POST['registro-despacho'])){

    $despacho->setCantidad($_POST['cantidad-despacho']);
    $despacho->setFecha_despacho($_POST['fecha-despacho']);
    $despacho->setCorrelativo($_POST['correlativo-despacho']);
   

    if($despacho->registrar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">' . "SE REGISTRO!!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . "NO SE REGISTRO!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

if (isset($_POST['eliminar-despacho'])) {
    if ($despacho->eliminar_l($_POST['eliminar-despacho'])) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ELIMINO EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ELIMINAR EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}


 
if (isset($_POST['modificar'])) {
    $despacho->setId_despacho($_POST['modificar']);
    $despacho->setCantidad($_POST['cantidad-despacho']);
    $despacho->setFecha_despacho($_POST['fecha-despacho']);
    $despacho->setCorrelativo($_POST['correlativo-despacho']);
    

    if ($despacho->actualizar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ACTUALIZARON LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ACTUALIZAR LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}
function obtenerClienteLista() {
    $clienteModel = new Despacho();
    return $clienteModel->obtenerClienteLista();
}

function obtenerLote() {
    $loteModel = new Despacho();
    return $loteModel->obtenerLote();
}

function obtenerSerial() {
    $serialModel = new Despacho();
    return $serialModel->obtenerSerial();
}

function obtenerProductos() {
    $producto = new Despacho();
    return $producto->obtenerProductos();
}

$productos = obtenerProductos();
$clientes = obtenerClienteLista();
$lotes = obtenerLote();
$seriales = obtenerSerial();



require_once "Vista/Despacho.php";

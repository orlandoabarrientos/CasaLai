<?php
require_once 'Modelo/Proveedores.php';

$proveedor = new Proveedores();

if (isset($_POST['registro-proveedor'])){

    $proveedor->setNombre($_POST['nombre-proveedor']);
    $proveedor->setRepresentante($_POST['nombre-representante']);
    $proveedor->setRif1($_POST['rif-proveedor']);
    $proveedor->setRif2($_POST['rif-representante']);
    $proveedor->setTelefono1($_POST['telefono-1']);
    $proveedor->setTelefono2($_POST['telefono-2']);
    $proveedor->setDireccion($_POST['direccion-proveedor']);
    $proveedor->setCorreo($_POST['correo-proveedor']);
    $proveedor->setObservacion($_POST['observacion']);


    if($proveedor->registrar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">' . "SE REGISTRO!!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . "NO SE REGISTRO!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

if (isset($_POST['eliminar-proveedor'])) {
    if ($proveedor->eliminar_l($_POST['eliminar-proveedor'])) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ELIMINO EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ELIMINAR EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}


 
if (isset($_POST['guardar'])) {
    $proveedor->setId_proveedor($_POST['guardar']);
    $proveedor->setNombre($_POST['nombre-proveedor']);
    $proveedor->setRepresentante($_POST['nombre-representante']);
    $proveedor->setRif1($_POST['rif-proveedor']);
    $proveedor->setRif2($_POST['rif-representante']);
    $proveedor->setTelefono1($_POST['telefono-1']);
    $proveedor->setTelefono2($_POST['telefono-2']);
    $proveedor->setDireccion($_POST['direccion-proveedor']);
    $proveedor->setCorreo($_POST['correo-proveedor']);
    $proveedor->setObservacion($_POST['observacion']);
    

    if ($proveedor->actualizar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ACTUALIZARON LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ACTUALIZAR LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

$pagina = "Proveedores";
// Verifica si el archivo de vista existe
if (is_file("Vista/" . $pagina . ".php")) {
    
    
    // Incluye el archivo de vista
    require_once("Vista/" . $pagina . ".php");
} else {
    // Muestra un mensaje si la página está en construcción
    echo "Página en construcción";
}

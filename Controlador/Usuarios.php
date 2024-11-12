<?php
require_once 'Modelo/Usuarios.php';

$usuario = new Usuarios();

if (isset($_POST['registro-usuario'])){

    $usuario->setUsername($_POST['nombre-usuario']);
    $usuario->setClave($_POST['clave-usuario']);


    if($usuario->registrar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">' . "SE REGISTRO!!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . "NO SE REGISTRO!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

if (isset($_POST['eliminar-usuario'])) {
    if ($usuario->eliminar_l($_POST['eliminar-usuario'])) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ELIMINO EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ELIMINAR EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}


 
if (isset($_POST['guardar'])) {
    $usuario->setId_usuario($_POST['guardar']);
    $usuario->setUsername($_POST['nombre-usuario']);
    $usuario->setClave($_POST['clave-usuario']);
   
    

    if ($usuario->actualizar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ACTUALIZARON LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ACTUALIZAR LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

$pagina = "Usuarios";
// Verifica si el archivo de vista existe
if (is_file("Vista/" . $pagina . ".php")) {
   
    // Incluye el archivo de vista
    require_once("Vista/" . $pagina . ".php");
} else {
    // Muestra un mensaje si la página está en construcción
    echo "Página en construcción";
}
<?php
require_once 'Modelo/Recepcion.php';

$recepcion = new Recepcion();

if (isset($_POST['registro-recepcion'])){

    $recepcion->setCantidad($_POST['cantidad-recepcion']);
    $recepcion->setFecha_Recepcion($_POST['fecha-recepcion']);
    $recepcion->setCorrelativo($_POST['correlativo-recepcion']);
   


    if($recepcion->registrar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">' . "SE REGISTRO!!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . "NO SE REGISTRO!" . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

if (isset($_POST['eliminar-recepcion'])) {
    if ($recepcion->eliminar_l($_POST['eliminar-recepcion'])) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ELIMINO EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ELIMINAR EL REGISTRO!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}


 
if (isset($_POST['guardar'])) {
    $recepcion->setId_Recepcion($_POST['guardar']);
    $recepcion->setCantidad($_POST['cantidad-recepcion']);
    $recepcion->setFecha_Recepcion($_POST['fecha-recepcion']);
    $recepcion->setCorrelativo($_POST['correlativo-recepcion']);
    

    if ($recepcion->actualizar()) {
        $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">SE ACTUALIZARON LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">NO SE PUDO ACTUALIZAR LOS DATOS!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

if(!empty($_POST)){
		  
    $o = new Recepcion(); 	
    $accion = $_POST['accion'];
    if($accion=='listadoproductos'){
        $respuesta = $o->listadoproductos();
        echo json_encode($respuesta);
    }
    exit; 
  }


function obtenerProveedorLista() {
    $proveedorModel = new Recepcion();
    return $proveedorModel->obtenerProveedorLista();
}

function listadoproductos(){
    $producto = new Recepcion();
    return $producto->listadoproductos();
}

$pagina = "Recepcion";
// Verifica si el archivo de vista existe
if (is_file("Vista/" . $pagina . ".php")) {
    // Obtiene los modelos y productos
    $proveedores = obtenerProveedorLista();
    // Incluye el archivo de vista
    $Producto = listadoproductos();
			
		

    require_once("Vista/" . $pagina . ".php");
} else {
    // Muestra un mensaje si la página está en construcción
    echo "Página en construcción";
}

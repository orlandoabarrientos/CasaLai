<?php

if (!is_file("modelo/" . $pagina . ".php")) {
 
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("modelo/" . $pagina . ".php");
if (is_file("vista/" . $pagina . ".php")) {

    if (!empty($_POST)) {

        $o = new Despacho();
        $accion = $_POST['accion'];
        if ($accion == 'listadoclientes') {
            $respuesta = $o->listadoclientes();
            echo json_encode($respuesta);
        } elseif ($accion == 'listadoproductos') {
            $respuesta = $o->listadoproductos();
            echo json_encode($respuesta);
        } elseif ($accion == 'Despacho') {
            $respuesta = $o->registrar($_POST['id_cliente'], $_POST['idp'], $_POST['cant'], $_POST['id_correlativo'], $_POST['id_lote'], $_POST['id_producto'], $_POST['id_cliente']);
            echo json_encode($respuesta);
        }
        exit;
    }
    $o2 = new Despacho();
    $lotes = $o2->obtenerlotes();
    $clientes = $o2->obtenercliente();

    require_once("vista/" . $pagina . ".php");
} else {
    echo "pagina en construccion";
}

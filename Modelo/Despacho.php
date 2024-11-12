<?php
require_once 'Modelo/config.php';

class Despacho extends BD {
    
    private $conex;
    private $id_despachos;
    private $id_clientes;
    private $cantidad;
    private $fecha_despacho;
    private $correlativo;
    private $activo=1;
    private $tableProductos = 'tbl_productos';
    private $tableModelos = 'tbl_modelos';


  

    function __construct() {
        parent::__construct();
        $this->conex = parent::conexion();
    }

    // Getters y Setters

    public function getId_despacho() {
        return $this->id_despachos;
    }

    public function setId_despacho($id_despachos) {
        $this->id_despachos = $id_despachos;
    }
    public function getId_cliente() {
        return $this->id_clientes;
    }

    public function setId_cliente($id_clientes) {
        $this->id_clientes = $id_clientes;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getFecha_despacho() {
        return $this->fecha_despacho;
    }

    public function setFecha_despacho($fecha_despacho) {
        $this->fecha_despacho = $fecha_despacho;
    }

    public function getCorrelativo() {
        return $this->correlativo;
    }

    public function setCorrelativo($correlativo) {
        $this->correlativo = $correlativo;
    }

    

     // Método para guardar el proveedor

    function registrar() {
        $sql = "INSERT INTO tbl_despachos(cantidad, fecha_despacho, correlativo, activo) 
        VALUES(:Cantidad, :Fecha_despacho, :Correlativo, :activo)";

        $conexion = $this->conex->prepare($sql);

        $conexion->bindParam(':Cantidad', $this->cantidad);
        $conexion->bindParam(':Fecha_despacho', $this->fecha_despacho);
        $conexion->bindParam(':Correlativo', $this->correlativo);
        $conexion->bindParam(':activo', $this->activo);

        return $conexion->execute();

    }

    function consultar() {
        $sql = "SELECT * FROM tbl_despachos";
        $conexion = $this->conex->prepare($sql);
        $conexion->execute();
        $registros = $conexion->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    //modificar
    function actualizar() {
        $sql = "UPDATE tbl_despachos SET cantidad = :Cantidad, fecha_despacho = :Fecha_despacho, correlativo = :Correlativo  WHERE id_despachos= :Id_despacho";

        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':Id_despacho', $this->id_despachos);
        $conexion->bindParam(':Cantidad', $this->cantidad);
        $conexion->bindParam(':Fecha_despacho', $this->fecha_despacho);
        $conexion->bindParam(':Correlativo', $this->correlativo);


        return $conexion->execute();
    }

    // Método para eliminación lógica
    function eliminar_l($id_despacho1) {
        $sql = "UPDATE tbl_despachos SET activo = 0 WHERE id_despachos = :id_despacho1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_despacho1', $id_despacho1);
        return $conexion->execute();
    }

    public function obtenerClienteLista() {
        $query = "SELECT id_clientes, nombre FROM tbl_clientes";
        $stmt = $this->conex->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLote() {
        $query = "SELECT id_lote, lote FROM tbl_lotes";
        $stmt = $this->conex->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerSerial() {
        $query = "SELECT id_serial, `serial` FROM tbl_seriales";
        $stmt = $this->conex->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerProductos() {
       
        $queryProductos = 'SELECT id_producto, nombre_p, stock_actual, id_modelo, codigo FROM ' . $this->tableProductos . ' WHERE Activo = 1';
       
        $stmtProductos = $this->conex->prepare($queryProductos);
        $stmtProductos->execute();
        $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
        $idsModelos = array_column($productos, 'id_modelo');
        $idsModelos = array_unique($idsModelos);

        if (!empty($idsModelos)) {
            $idsModelos = implode(',', $idsModelos);

            $queryModelos = 'SELECT id_modelo, descripcion_mo FROM ' . $this->tableModelos . ' WHERE id_modelo IN (' . $idsModelos . ')';

            $stmtModelos = $this->conex->prepare($queryModelos);
            $stmtModelos->execute();
            $modelos = $stmtModelos->fetchAll(PDO::FETCH_ASSOC);
            $descripcionModelos = [];
            foreach ($modelos as $modelo) {
                $descripcionModelos[$modelo['id_modelo']] = $modelo['descripcion_mo'];
            }
            foreach ($productos as &$producto) {
                if (isset($descripcionModelos[$producto['id_modelo']])) {
                    $producto['descripcion_mo'] = $descripcionModelos[$producto['id_modelo']];
                } else {
                    $producto['descripcion_mo'] = null;
                }
            }
        } else {

            foreach ($productos as &$producto) {
                $producto['descripcion_mo'] = null;
            }
        }

        return $productos;
    }

    
}
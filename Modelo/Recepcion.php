<?php
require_once 'Modelo/datos.php';

class Recepcion extends conexion{
    
    private $conex;
    private $id_proveedor;
    private $id_recepcion;
    private $cantidad;
    private $fecha_recepcion;
    private $correlativo;
    private $activo=1;
    private $tableProductos = 'tbl_productos';
    private $tableModelos = 'tbl_modelos';

  

    function __construct() {
        $this->conex = parent::conecta();
    }

    // Getters y Setters

    public function getId_Recepcion() {
        return $this->id_recepcion;
    }

    public function setId_Recepcion($id_recepcion) {
        $this->id_recepcion = $id_recepcion;
    }
    public function getId_Proveedor() {
        return $this->id_proveedor;
    }

    public function setId_Proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getFecha_Recepcion() {
        return $this->fecha_recepcion;
    }

    public function setFecha_Recepcion($fecha_recepcion) {
        $this->fecha_recepcion = $fecha_recepcion;
    }

    public function getCorrelativo() {
        return $this->correlativo;
    }

    public function setCorrelativo($correlativo) {
        $this->correlativo = $correlativo;
    }

    

     // Método para guardar el proveedor

    function registrar() {
        $sql = "INSERT INTO tbl_recepcion_productos (cantidad, fecha_recepcion, correlativo, activo)
                VALUES (:Cantidad, :Fecha_recepcion, :Correlativo, :activo)";

        $conexion = $this->conex->prepare($sql);

        $conexion->bindParam(':Cantidad', $this->cantidad);
        $conexion->bindParam(':Fecha_recepcion', $this->fecha_recepcion);
        $conexion->bindParam(':Correlativo', $this->correlativo);
        $conexion->bindParam(':activo', $this->activo);

        return $conexion->execute();

    }

    function consultar() {
        $sql = "SELECT * FROM tbl_recepcion_productos";
        $conexion = $this->conex->prepare($sql);
        $conexion->execute();
        $registros = $conexion->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    // Método para listar proveedores
    public function obtenerProveedorLista() {
        $query = "SELECT id_proveedor, nombre FROM tbl_proveedores";
        $stmt = $this->conex->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //modificar
    function actualizar() {
        $sql = "UPDATE tbl_recepcion_productos SET cantidad = :Cantidad, fecha_recepcion = :Fecha_recepcion, correlativo = :Correlativo  WHERE id_recepcion= :Id_recepcion";

        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':Id_recepcion', $this->id_recepcion);
        $conexion->bindParam(':Cantidad', $this->cantidad);
        $conexion->bindParam(':Fecha_recepcion', $this->fecha_recepcion);
        $conexion->bindParam(':Correlativo', $this->correlativo);


        return $conexion->execute();
    }

    // Método para eliminación lógica
    function eliminar_l($id_recepcion1) {
        $sql = "UPDATE tbl_recepcion_productos SET activo = 0 WHERE id_recepcion = :id_recepcion1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_recepcion1', $id_recepcion1);
        return $conexion->execute();
    }

    function eliminar() {
        $sql = "DELETE FROM tbl_recepcion_productos WHERE id_recepcion = :id_recepcion1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':Id_recepcion', $this->id_recepcion);
        return $conexion->execute();
    }

    function listadoproductos(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			
			$resultado = $co->query("Select * from tbl_productos");
			
			if($resultado){
				
				$respuesta = '';
				foreach($resultado as $r){
					$respuesta = $respuesta."<tr style='cursor:pointer' onclick='colocaproducto(this);'>";
						$respuesta = $respuesta."<td style='display:none'>";
							$respuesta = $respuesta.$r['id_producto'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['codigo'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombre_p'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['stock_actual'];
						$respuesta = $respuesta."</td>";
					$respuesta = $respuesta."</tr>";
				}
				
			    
			}
			$r['resultado'] = 'listadoproductos';
			$r['mensaje'] =  $respuesta;
			
		}catch(Exception $e){
			$r['resultado'] = 'error';
		    $r['mensaje'] =  $e->getMessage();
		}
		
		return $r;
		
	}
}
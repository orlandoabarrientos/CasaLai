<?php
require_once 'modelo/config.php';

class Proveedores extends BD {
    
    private $conex;
    private $id_proveedor;
    private $nombre;
    private $representante;
    private $rif1;
    private $rif2;
    private $telefono1;
    private $telefono2;
    private $direccion;
    private $correo;
    private $observacion;
    private $activo=1;

    function __construct() {
        parent::__construct();
        $this->conex = parent::conexion();
    }

    // Getters y Setters
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getRepresentante() {
        return $this->representante;
    }

    public function setRepresentante($representante) {
        $this->representante = $representante;
    }

    public function getRif1() {
        return $this->rif1;
    }

    public function setRif1($rif1) {
        $this->rif1 = $rif1;
    }

    public function getRif2() {
        return $this->rif2;
    }

    public function setRif2($rif2) {
        $this->rif2 = $rif2;
    }

    public function getTelefono1() {
        return $this->telefono1;
    }

    public function setTelefono1($telefono1) {
        $this->telefono1 = $telefono1;
    }

    public function getTelefono2() {
        return $this->telefono2;
    }

    public function setTelefono2($telefono2) {
        $this->telefono2 = $telefono2;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function getId_proveedor() {
        return $this->id_proveedor;
    }

    public function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }
    

     // Método para guardar el proveedor

    function registrar() {
        $sql = "INSERT INTO tbl_proveedores (nombre, presona_contacto, direccion, telefono, telefono_secundario, rif_representante, rif_proveedor, correo, observaciones, activo)
                VALUES (:Nombre, :Representante, :Direccion, :Telefono1, :Telefono2, :Rif2, :Rif1, :Correo, :Observacion, :activo)";

        $conexion = $this->conex->prepare($sql);

        $conexion->bindParam(':Nombre', $this->nombre);
        $conexion->bindParam(':Representante', $this->representante);
        $conexion->bindParam(':Direccion', $this->direccion);
        $conexion->bindParam(':Telefono1', $this->telefono1);
        $conexion->bindParam(':Telefono2', $this->telefono2);
        $conexion->bindParam(':Rif1', $this->rif1);
        $conexion->bindParam(':Rif2', $this->rif2);
        $conexion->bindParam(':Correo', $this->correo);
        $conexion->bindParam(':Observacion', $this->observacion);
        $conexion->bindParam(':activo', $this->activo);

        return $conexion->execute();

    }

    // Método para listar proveedores
    function consultar() {
        $sql = "SELECT * FROM tbl_proveedores";
        $conexion = $this->conex->prepare($sql);
        $conexion->execute();
        $registros = $conexion->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    //modificar
    function actualizar() {
        $sql = "UPDATE tbl_proveedores SET nombre = :Nombre, presona_contacto = :Representante, telefono_secundario = :Telefono2, telefono = :Telefono1, rif_proveedor = :Rif1 ,rif_representante =:Rif2 , correo = :Correo, observaciones = :Observacion, direccion = :Direccion  WHERE id_proveedor= :id_proveedor";

        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_proveedor', $this->id_proveedor);
        $conexion->bindParam(':Nombre', $this->nombre);
        $conexion->bindParam(':Representante', $this->representante);
        $conexion->bindParam(':Direccion', $this->direccion);
        $conexion->bindParam(':Telefono1', $this->telefono1);
        $conexion->bindParam(':Telefono2', $this->telefono2);
        $conexion->bindParam(':Rif1', $this->rif1);
        $conexion->bindParam(':Rif2', $this->rif2);
        $conexion->bindParam(':Correo', $this->correo);
        $conexion->bindParam(':Observacion', $this->observacion);

        return $conexion->execute();
    }

   
    // Método para eliminación lógica
    function eliminar_l($id_proveedor1) {
        $sql = "UPDATE tbl_proveedores SET activo = 0 WHERE id_proveedor = :id_proveedor1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_proveedor1', $id_proveedor1);
        return $conexion->execute();
    }

    function eliminar() {
        $sql = "DELETE FROM tbl_proveedores WHERE id_proveedor = :id_proveedor1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_proveedor', $this->id_proveedor);
        return $conexion->execute();
    }
}
?>

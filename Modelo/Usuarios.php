<?php
require_once 'modelo/config.php';

class Usuarios extends BD {
    
    private $conex;
    private $id_usuario;
    private $username;
    private $clave;
    private $activo=1;

    function __construct() {
        parent::__construct();
        $this->conex = parent::conexion();
    }

    // Getters y Setters
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

        public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    

     // Método para guardar el proveedor

    function registrar() {
        $sql = "INSERT INTO tbl_usuarios (username, `password`, activo)
                VALUES (:usuario, :clave, :activo)";

        $conexion = $this->conex->prepare($sql);

        $conexion->bindParam(':usuario', $this->username);
        $conexion->bindParam(':clave', $this->clave);
        $conexion->bindParam(':activo', $this->activo);

        return $conexion->execute();

    }

    // Método para listar proveedores
    function consultar() {
        $sql = "SELECT * FROM tbl_usuarios";
        $conexion = $this->conex->prepare($sql);
        $conexion->execute();
        $registros = $conexion->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    //modificar
    function actualizar() {
        $sql = "UPDATE tbl_usuarios SET username = :usuario, `password` = :clave  WHERE id_usuario= :id_usuario";

        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_usuario', $this->id_usuario);
        $conexion->bindParam(':usuario', $this->username);
        $conexion->bindParam(':clave', $this->clave);

        return $conexion->execute();
    }

   
    // Método para eliminación lógica
    function eliminar_l($id_usuario1) {
        $sql = "UPDATE tbl_usuarios SET activo = 0 WHERE id_usuario = :id_usuario1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_usuario1', $id_usuario1);
        return $conexion->execute();
    }

    function eliminar() {
        $sql = "DELETE FROM tbl_usuarios WHERE id_usuario = :id_usuario1";
        $conexion = $this->conex->prepare($sql);
        $conexion->bindParam(':id_usuario', $this->id_usuario);
        return $conexion->execute();
    }
}
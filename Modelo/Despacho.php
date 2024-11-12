<?php

require_once 'Modelo/config.php';



class Despacho extends BD
{

    function registrar($id_clientes, $id_producto, $cantidad, $correlativo, $id_lote)
    {
        $co = $this->conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $guarda = $co->query("INSERT INTO tbl_despacho(cantidad, id_clientes, correlativo)
		    values ('$cantidad','$id_clientes','$correlativo')");
            $lid = $co->lastInsertId(); 

            $tamano = count($id_producto);

            for ($i = 0; $i < $tamano; $i++) {
                $gd = $co->query("INSERT INTO `tbl_detalle_despacho`
			   (id_lote, id_producto, id_despacho)
			   values('$id_lote[$i]',
               '$id_producto[$i]'
               )");
            }
            $r['resultado'] = 'registrar';
            $r['mensaje'] =  "Se registro correctamente";
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }


    function listadoclientes()
    {
        $co = $this->conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array(); 
        try {
            $resultado = $co->query("SELECT * FROM tbl_clientes");
            $respuesta = '';
            if ($resultado) {
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr style='cursor:pointer' onclick='colocacliente(this);'>";
                    $respuesta = $respuesta . "<td style='display:none'>";
                    $respuesta = $respuesta . $r['id_clientes'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombre'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['rif'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "</tr>";
                }
            }
            $r['resultado'] = 'listadoclientes';
            $r['mensaje'] =  $respuesta;
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        return $r;
    }

    function listadoproductos()
    {
        $co = $this->conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {

            $resultado = $co->query("SELECT * FROM tbl_productos");

            if ($resultado) {

                $respuesta = '';
                foreach ($resultado as $r) {
                    $respuesta = $respuesta . "<tr style='cursor:pointer' onclick='colocaproducto(this);'>";
                    $respuesta = $respuesta . "<td style='display:none'>";
                    $respuesta = $respuesta . $r['id_producto'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['nombre_p'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "<td>";
                    $respuesta = $respuesta . $r['stock'];
                    $respuesta = $respuesta . "</td>";
                    $respuesta = $respuesta . "</tr>";
                }
            }
            $r['resultado'] = 'listadoproductos';
            $r['mensaje'] =  $respuesta;
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }

        return $r;
    }

    public function obtenerlotes()
    {
        $co = $this->Conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT id_lote, lote FROM tbl_lotes ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
    public function obtenercliente()
    {
        $co = $this->Conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT id_clientes, nombre FROM tbl_clientes ");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
   
}

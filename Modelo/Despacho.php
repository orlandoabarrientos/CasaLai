<?php

require_once 'Modelo/config.php';



class Despacho extends BD
{

    function registrar($id_clientes, $id_producto,$cantidad, $correlativo)
    {
        $co = $this->conexion();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try {
           
            $fecha = date('Y-m-d H:i:s');
            $exist = $co->query("SELECT id_producto, stock FROM tbl_productos ");
            $stock = [];

            while ($row = $exist->fetch(PDO::FETCH_ASSOC)
            ) {
                $stock[$row['id_producto']] = [
                    'cantidad' => $row['stock'],
                ];
            }

            for ($i = 0; $i < count($id_producto); $i++) {
                $idProd = $id_producto[$i];
                $cantidadActual = isset($stock[$idProd]['cantidad']) ? $stock[$idProd]['cantidad'] : 0;
                $Total = $cantidadActual - $cantidad[$i];
                $co->query("UPDATE tbl_productos SET stock = $Total WHERE id_producto = $idProd");
            }
            
                $guarda = $co->query("INSERT INTO tbl_despachos(id_clientes,fecha_despacho ,correlativo)
                values ('$id_clientes',' $fecha','$correlativo')");
                $lid = $co->lastInsertId();
            
          

            $tamano = count($id_producto);

            for ($i = 0; $i < $tamano; $i++) {
                $gd = $co->query("INSERT INTO `tbl_detalle_despachos`
			   (id_producto,cantidad, id_despachos)
			   values(
              '$id_producto[$i]',
               '$cantidad[$i]',
                '$lid'
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

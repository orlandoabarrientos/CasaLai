<?php

require_once 'Modelo/Proveedores.php';
require_once 'Controlador/Proveedores.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="Public/bootstrap/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/darckort.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Gestionar Proveedores</title>
</head>
<body>


    <?php include 'NavBar.php'; ?>


<div class="container">
    <!--== INICIO DEL CONTENIDO ==-->
    <section class="container">
        <div class="row my-5">
            <div class="col-sm-12 col-md-12 col-lg-12">

            <!-- Mensaje de alerta -->
            <?php if (isset($alert)) echo $alert; ?>
            
                <form action="" method="POST" class="formulario-1">
                    <h3 class="display-4 text-center">INCLUIR PROVEEDOR</h3>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="nombre-proveedor">Nombre del Proveedor</label>
                            <input class="form-control" type="text" id="nombre-proveedor" name="nombre-proveedor" placeholder="">
                        </div>
                        <div class="col">
                            <label class="form-label mt-4" for="rif-proveedor">Rif del Proveedor</label>
                            <input class="form-control" type="text" id="rif-proveedor" name="rif-proveedor" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="nombre-representante">Nombre del Representante</label>
                            <input class="form-control" type="text" id="nombre-representante" name="nombre-representante" placeholder="">
                        </div>
                        <div class="col">
                            <label class="form-label mt-4" for="rif-representante">Rif del Representante</label>
                            <input class="form-control" type="text" id="rif-representante" name="rif-representante" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="direccion-proveedor">Direccion</label>
                            <input class="form-control" type="text" id="direccion-proveedor" name="direccion-proveedor" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="telefono-1">Telefono Principal</label>
                            <input class="form-control" type="text" id="telefono-1" name="telefono-1" placeholder="">
                        </div>
                        <div class="col">
                            <label class="form-label mt-4" for="telefono-2">Telefono Secundario</label>
                            <input class="form-control" type="text" id="telefono-2" name="telefono-2" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="correo-proveedor">Correo de Contacto</label>
                            <input class="form-control" type="text" id="correo-proveedor" name="correo-proveedor" placeholder="">
                        </div>
                    </div>
                    <label class="form-label" for="observacion">Observaciones</label>
                    <textarea class="form-control" id="observacion" name="observacion" rows="3" placeholder="Escriba alguna Observaciones que se deba tener en cuenta..."></textarea>
                    <div class="row">
                        <div class="col">
                            <button class="btn" name="registro-proveedor" type="submit">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--== FIN DEL CONTENIDO ==-->

    <!--== LISTADO DE CONSULTA ==-->

    <form action="" method="POST">
    <div class="table-container ">
        <h1 class="titulo-tabla display-5 text-center">LISTA DE PROVEEDORES</h1>
        <table class="tabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($proveedor->consultar() as $row) { ?>
                    <?php if ($row['activo'] == 1) { ?>
                        <tr>
                            <td data-label="#">
                            <button class="btn btn-eliminar" type="submit" name="eliminar-proveedor" value="<?php echo $row['id_proveedor']; ?>">Eliminar</button>
                            <br>
                            <button class="btn btn-modificar" type="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['id_proveedor']; ?>">Modificar</button>
                            </td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['direccion']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['correo']; ?></td>
                        </tr>

                        <!-- MODAL -->
                        <div class="modal fade" id="modal-<?php echo $row['id_proveedor']; ?>" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modificar Proveedor</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    <div class="row">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="nombre-proveedor">Nombre del Proveedor</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['nombre']; ?>" id="nombre-proveedor" name="nombre-proveedor" placeholder="">
                                                                            </div>
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="rif-proveedor">Rif del Proveedor</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['rif_proveedor']; ?>" id="rif-proveedor" name="rif-proveedor" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="nombre-representante">Nombre del Representante</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['presona_contacto']; ?>" id="nombre-representante" name="nombre-representante" placeholder="">
                                                                            </div>
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="rif-representante">Rif del Representante</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['rif_representante']; ?>" id="rif-representante" name="rif-representante" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                        <div class="col">
                                                                            <label class="form-label mt-4" for="telefono-1">Telefono Principal</label>
                                                                            <input class="form-control" type="text" value="<?php echo $row['telefono']; ?>" id="telefono-1" name="telefono-1" placeholder="">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label class="form-label mt-4" for="telefono-2">Telefono Secundario</label>
                                                                            <input class="form-control" type="text" value="<?php echo $row['telefono_secundario']; ?>" id="telefono-2" name="telefono-2" placeholder="">
                                                                        </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="direccion-proveedor">Direccion</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['direccion']; ?>" id="direccion-proveedor" name="direccion-proveedor" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="correo-proveedor">Correo de Contacto</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['correo']; ?>" id="correo-proveedor" name="correo-proveedor" placeholder="">
                                                                            </div>
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="observacion">Observacion</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['observaciones']; ?>" id="observacion" name="observacion" placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-cerrar" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button class="btn btn-modificar" type="submit" name="guardar" value="<?php echo $row['id_proveedor']; ?>">Modificar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                        </div>

                        <!-- FIN DEL MODAL -->


                        <?php } ?>
                <?php } ?>
             
            </tbody>
        </table>
                    <div class="row">
                        <div class="col">
                            <button class="btn" name="" type="button" id="pdfproveedores" name="pdfproveedores"><a href="?pagina=pdfproveedores">Generar Reporte</a></button>
                        </div>
                    </div>

    </div>

                
            

            
    </form>
</div>

<script src="public/bootstrap/js/sidebar.js"></script>
  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/js/jquery-3.7.1.min.js"></script>
  <script src="public/js/jquery.dataTables.min.js"></script>
  <script src="public/js/dataTables.bootstrap5.min.js"></script>
  <script src="public/js/datatable.js"></script>
  <script src="public/js/sweetalert2.js"></script>
</body>
</html>

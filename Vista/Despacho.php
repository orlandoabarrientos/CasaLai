<?php

        require_once 'Modelo/Despacho.php';
        require_once 'Controlador/Despacho.php';
       

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
    <title>Gestionar Despachos</title>
</head>
<body>


<?php include 'NavBar.php'; ?>





        <!--== INICIO DEL CONTENIDO ==-->

    <div class="container formulario-1">

        <!-- Mensaje de alerta -->
        <?php if (isset($alert)) echo $alert; ?>
            
            <form action="" method="POST" class="">
                <h3 class="display-4 text-center">INCLUIR DESPACHO</h3>

		
        </form>
    
<form action="" method="POST">
    <div class="tab-content">

	<div role="tabpanel" class="tab-pane active" id="factura">
    
		<div class="container-tab">

        
        <div class="row">
                    <div class="col">
                        <label class="form-label mt-4" for="nombre-cliente">Nombre del Cliente</label>
                        <select class="form-select" id="nombre-cliente" name="nombre-cliente">
                        <option value="">Seleccionar Cliente</option>
                                <<?php foreach ($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente['id_clientes']; ?>"><?php echo $cliente['nombre']; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label mt-4" for="fecha-despacho">Fecha de Despacho</label>
                        <input class="form-control" type="date" id="fecha-despacho" name="fecha-despacho" placeholder="">
                    </div>

                    <div class="col">
                        <label class="form-label mt-4" for="correlativo-despacho">Correlativo de Despacho</label>
                        <input class="form-control" type="text" id="correlativo-despacho" name="correlativo-despacho" placeholder="">
                    </div>

    </div>


 <!-- MODAL AÑADIR PRODUCTO -->
        <section>
            <div class="contenedor_texto">
                <a href="#" class="cta">AGREGAR PRODUCTO</a>
            </div>
        </section>

        <div class="modal_container2">
                <div class="modal1 modal_close">
                    <p class="close">X</p>
                    <div class="modal_textos">
                        <table class="table table-striped" id="lista-agregados">
                            <tr>
                                <td class="padding15izquierdos">Presione en el Producto para Agregarlo</td>
                            </tr>
                            <tr>
                                <td>Producto Ejemplo N° 1</td>
                            </tr>
                            <tr>
                                <td>Producto Ejemplo N° 2</td>
                            </tr>
                        </table>
                    </div>
                </div> 
        </div>
<!--FIN DE MODAL AÑADIR PRODUCTO-->       




            <div class="col-12" id="lista-recepcion">
            <table class="table table-striped" id="lista-agregados">
                    <tr>
                        <td>Nombre Producto</td>
                        <td>Serial</td>
                        <td>Lote</td>
                        <td>Botones</td>
                    </tr>
                    <tr>
                        <td>Producto Ejemplo</td>
                        <td><input class="form-control" type="text" id="serial" name="serial" placeholder=""></td>
                        <td><input class="form-control" type="text" id="lote" name="lote" placeholder=""></td>
                        <td><button type="button" class="btn2" onclick="eliminalineadetalle(this)">X</button></td>
                    </tr>
            </table>

            </div>
                </div>
       
            </div>


        
	</div>

	<div role="tabpanel" class="tab-pane" id="detalles">
		<div class="container-tab">
        

        

        <div class="col-10 text-right" id="total"></div>
			<hr>
                    
                   
                </div>
         
    </div>
                <div class="row">
                        <div class="col">
                            <button class="btn" name="registro-despacho" type="submit">Registrarse</button>
                        </div>
                    </div>

    </div> 
    </form>
    </div>
        <!--== FIN DEL CONTENIDO ==-->


        <!--== LISTADO DE CONSULTA ==-->
        <form action="" method="POST">
        <div class="table-container ">
            <h1 class="titulo-tabla display-5 text-center">LISTA DE DESPACHOS</h1>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <!-- <th>Cliente/Entrega</th> -->
                        <th>Fecha de Despacho</th>
                        <th>Correlativo</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($despacho->consultar() as $row) { ?>
                    <?php if ($row['activo'] == 1) { ?>
                        <tr>
                            <td data-label="#">
                            <button class="btn btn-eliminar" type="submit" name="eliminar-despacho" value="<?php echo $row['id_despachos']; ?>">Eliminar</button>
                            <br>
                            <button class="btn btn-modificar" type="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['id_despachos']; ?>">Modificar</button>
                            </td>
                           
                            <td><?php echo $row['fecha_despacho']; ?></td>
                            <td><?php echo $row['correlativo']; ?></td>
            
                        </tr>

        <!-- MODAL -->
        <div class="modal fade" id="modal-<?php echo $row['id_despachos']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Modificar Despachos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="cantidad-recepcion" class="col-sm-2 col-form-label">Cantidad</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $row['cantidad']; ?>" name="cantidad-despacho" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fecha-recepcion" class="col-sm-2 col-form-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <input type="date" value="<?php echo $row['fecha_despacho']; ?>" name="fecha-despacho" class="form-control">
                                    </div>
                                 </div>

                                <div class="row mb-3">
                                    <label for="correlativo_recepcion" class="col-sm-2 col-form-label">Correlativo</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $row['correlativo']; ?>" name="correlativo-despacho" class="form-control">
                                    </div>
                                </div>

                        </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-modificar" type="submit" name="modificar" value="<?php echo $row['id_despachos']; ?>">Modificar</button>
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
                            <button class="btn" name="" type="submit">Generar Reporte</button>
                        </div>
                    </div>
        </div>
        </form>

                


        <script src="public/bootstrap/js/sidebar.js"></script>
  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/js/jquery-3.7.1.min.js"></script>
  <script src="public/js/jquery.dataTables.min.js"></script>
  <script src="public/js/dataTables.bootstrap5.min.js"></script>
  <script src="public/js/datatable.js"></script>
  <script src="public/js/sweetalert2.js"></script>
</body>
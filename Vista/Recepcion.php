
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
    <title>Gestionar Recepcion</title>
</head>
<body>


<?php include 'NavBar.php'; ?>





        <!--== INICIO DEL CONTENIDO ==-->

    <div class="container formulario-1">

        <!-- Mensaje de alerta -->
        <?php if (isset($alert)) echo $alert; ?>
            
            <form action="" method="POST" class="">
                <h3 class="display-4 text-center">INCLUIR RECEPCION</h3>


        </form>
    
<form action="" method="POST" id="f">
<input type="text" name="accion" id="accion" style="display:none"/>
    <div class="tab-content">

	<div role="tabpanel" class="tab-pane active" id="factura">
    
		<div class="container-tab">

        
        <div class="row">
                    <div class="col">
                        <label class="form-label mt-4" for="nombre-proveedor">Nombre del Proveedor</label>
                        <select class="form-select" id="proveedorModelo" name="proveedorModelo">
                        <option value="">Seleccionar proveedor</option>
                                <?php foreach ($proveedores as $row){ ?>
                                    <option value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['nombre']; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label mt-4" for="fecha-recepcion">Fecha de Recepcion</label>
                        <input class="form-control" type="date" id="fecha-recepcion" name="fecha-recepcion" placeholder="">
                    </div>

                    <div class="col">
                        <label class="form-label mt-4" for="correlativo-recepcion">Correlativo del Producto</label>
                        <input class="form-control" type="text" id="correlativo-recepcion" name="correlativo-recepcion" placeholder="">
                    </div>
                </div>
       
            </div>
        
	

	 
            <div class="row">
                    <div class="col-md-8 input-group">
                    <input class="form-control" type="text" id="codigoproducto" name="codigoproducto" style="display:none"/>
                    <input class="form-control" type="text" id="idproducto" name="idproducto" style="display:none"/>
                    <button type="button" class="btn btn-primary" id="listadodeproductos" name="listadodeproductos">LISTADO DE PRODUCTOS</button>
                    </div>
                </div>
 

        <!-- seccion del modal productos -->


<!--fin de seccion modal-->
        <div class="row">
                <div class="col-md-12">
                <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>X</th>
                            <th style="display:none">Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>CANT</th>
                            <th>PVP</th>
                            <th>SUB TOT</th>
                        </tr>
                        </thead>
                        <tbody id="detalledeventa">

                        </tbody>
                    </table>
                </div>
            </div>
        

        </div>
               
    </div>
</form>


    </div> 
    <!--INICIO DE MODAL AÑADIR PRODUCTO--> 
    <div class="modal fade" tabindex="-1" role="dialog"  id="modalproductos">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-header text-light bg-info">
        <h5 class="modal-title">Listado de productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-content">
		<table class="table table-striped table-hover">
		<thead>
		  <tr>
		    <th style="display:none">Id</th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Existencia</th>
			<th>PVP</th>
		  </tr>
		</thead>
		<tbody id="listadoproductos">
		 
		</tbody>
		</table>
    </div>
	
  </div>
</div>
<!--FIN DE MODAL AÑADIR PRODUCTO--> 
        <!--== FIN DEL CONTENIDO ==-->


        <!--== LISTADO DE CONSULTA ==-->
        <form action="" method="POST">
        <div class="table-container ">
            <h1 class="titulo-tabla display-5 text-center">LISTA DE RECEPCION</h1>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cantidad</th>
                        <th>Fecha de Recepcion</th>
                        <th>Correlativo</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($recepcion->consultar() as $row) { ?>
                    <?php if ($row['activo'] == 1) { ?>
                        <tr>
                            <td data-label="#">
                            <button class="btn btn-eliminar" type="submit" name="eliminar-recepcion" value="<?php echo $row['id_recepcion']; ?>">Eliminar</button>
                            <br>
                            <button class="btn btn-modificar" type="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['id_recepcion']; ?>">Modificar</button>
                            </td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['fecha_recepcion']; ?></td>
                            <td><?php echo $row['correlativo']; ?></td>
            
                        </tr>

                        <!-- MODAL -->
                        <div class="modal fade" id="modal-<?php echo $row['id_recepcion']; ?>" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modificar RECEPCION</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row mb-3">
                                                                            <label for="cantidad-recepcion" class="col-sm-2 col-form-label">Cantidad</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" value="<?php echo $row['cantidad']; ?>" name="cantidad-recepcion" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="fecha-recepcion" class="col-sm-2 col-form-label">Fecha</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="date" value="<?php echo $row['fecha_recepcion']; ?>" name="fecha-recepcion" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="correlativo_recepcion" class="col-sm-2 col-form-label">Correlativo</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" value="<?php echo $row['correlativo']; ?>" name="correlativo-recepcion" class="form-control">
                                                                            </div>
                                                                        </div>

                                        
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-cerrar" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button class="btn btn-modificar" type="submit" name="guardar" value="<?php echo $row['id_recepcion']; ?>">Modificar</button>
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
                            <button class="btn" name="" type="button">Generar Reporte</button>
                        </div>
                    </div>
        </div>
        </form>

                


        <?php include 'footer.php'; ?>
  <script src="Javascript/recepcion.js"></script>
</body>



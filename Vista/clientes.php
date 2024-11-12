<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Clientes</title>
  <?php include 'header.php'; ?>
    <link rel="stylesheet" href="Styles/darckort.css">
  
</head>
<body>

<?php include 'NavBar.php'; ?>


<div class="container"> 
<form id="incluirclientes" action="" method="POST" class="formulario-1">
    <input type="hidden" name="accion" value="ingresar">
    <h3 class="display-4 text-center">INCLUIR CLIENTE</h3>
    <div class="form-row">
        <div class="col">
                        <label class="form-label mt-2" for="nombre">Nombre del Cliente</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="">
                    </div>

                    <div class="col">
                        <label class="form-label mt-2" for="persona">Persona de Contacto</label>
                        <input class="form-control" type="text" id="persona" name="persona" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label mt-2" for="rif">Rif</label>
                        <input class="form-control" type="text" id="rif" name="rif" placeholder="">
                    </div>

                    <div class="col">
                        <label class="form-label mt-2" for="direccion">Direccion</label>
                        <input class="form-control" type="text" id="direccion" name="direccion" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label mt-2" for="telefono_1">Telefono Principal</label>
                        <input class="form-control" type="text" id="telefono_1" name="telefono_1" placeholder="">
                    </div>

                    <div class="col">
                        <label class="form-label mt-2" for="telefono_2">Telefono Secundario</label>
                        <input class="form-control" type="text" id="telefono_2" name="telefono_2" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label mt-2" for="correo">Correo de Contacto</label>
                        <input class="form-control" type="text" id="correo" name="correo" placeholder="">
                    </div>

                </div>

                

                    <label class="form-label" for="observacion">Observaciones</label>
                    <textarea class="form-control" id="observacion" name="observacion" rows="3" placeholder="Escriba alguna Observaciones que se deba tener en cuenta..."></textarea>

    </div>
    <div class="form-group d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
    </div>
</form>
    </div>


    <div class="table-container">
    <h1 class="titulo-tabla display-5 text-center">LISTA DE CLIENTES</h1>
    <table class="tabla">
        <thead>
            <tr>
                <th>Acciones</th>
                <th>Nombre</th>
                <th>Persona Contacto</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Telefono Secundaio</th>
                <th>Rif</th>
                <th>Correo</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $clientes): ?>
                <?php if ($clientes['activo'] == 1) { ?>
                <tr>
                    <td>
                        <!-- Botón Modificar que abre el modal -->
                        <button type="button" class="btn btn-modificar" data-toggle="modal" data-target="#modificarProductoModal" data-id="<?php echo htmlspecialchars($clientes['id_clientes']); ?>">
                        Modificar
                        </button>
                        <br>
                        <!-- Botón Eliminar -->
                        <a href="#" data-id="<?php echo htmlspecialchars($clientes['id_clientes']); ?>" class="btn btn-eliminar">Eliminar</a>
                    </td>
                    <td><?php echo htmlspecialchars($clientes['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['persona_contacto']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['direccion']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['telefono_secundario']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['rif']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['correo']); ?></td>
                    <td><?php echo htmlspecialchars($clientes['observaciones']); ?></td>
                </tr>
                <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="containera"> <!-- todo el contenido ira dentro de esta etiqueta-->

<form method="post" action="" id="f" target="_blank">
<div class="containera">
    <div class="row">
        <div class="col">
               <button type="button" class="btn btn-primary" id="pdfclientes" name="pdfclientes"><a href="?pagina=pdfclientes">GENERAR PDF</button>
        </div>
        
    </div>
</div>
</form>
    
</div> <!-- fin de container -->



<!-- Modal de modificación -->
<div class="modal fade" id="modificar_clientes_modal" tabindex="-1" role="dialog" aria-labelledby="modificar_clientes_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modificarclientes" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificar_clientes_modal_label">Modificar Marcas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Campos del formulario de modificación -->
                    <input type="hidden" id="modificar_id_clientes" name="id_clientes">
                    <div class="form-group">
                        <label for="modificarnombre">Nombre</label>
                        <input type="text" class="form-control" id="modificarnombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="modificarpersona_contacto">Persona Contacto</label>
                        <input type="text" class="form-control" id="modificarpersona_contacto" name="persona" required>
                    </div>
                    <div class="form-group">
                        <label for="modificardireccion">Direccion</label>
                        <input type="text" class="form-control" id="modificardireccion" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="modificartelefono">Telefono</label>
                        <input type="text" class="form-control" id="modificartelefono" name="telefono_1" required>
                    </div>
                    <div class="form-group">
                        <label for="modificartelefono_secundariotelefono_secundario">Telefono Secundaio</label>
                        <input type="text" class="form-control" id="modificartelefono_secundario" name="telefono_2" required>
                    </div>
                    <div class="form-group">
                        <label for="modificarrif">Rif</label>
                        <input type="text" class="form-control" id="modificarrif" name="rif" required>
                    </div>
                    <div class="form-group">
                        <label for="modificarcorreo">Correo</label>
                        <input type="text" class="form-control" id="modificarcorreo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="modificarobservaciones">Observaciones</label>
                        <input type="text" class="form-control" id="modificarobservaciones" name="observacion" required>
                    </div>
                    
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </div>
                </div>

                
            </form>

            
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="Javascript/clientes.js"></script>
</body>
</html>
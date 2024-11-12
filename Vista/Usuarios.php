<?php

require_once 'Modelo/Usuarios.php';
require_once 'Controlador/Usuarios.php';


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
    <title>Gestionar Usuarios</title>
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
                    <h3 class="display-4 text-center">INCLUIR USUARIO</h3>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="nombre-usuario">Nombre del Usuario</label>
                            <input class="form-control" type="text" id="nombre-usuario" name="nombre-usuario" placeholder="Nombre de Usuario">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label mt-4" for="clave-usuario">Contraseña</label>
                            <input class="form-control" type="text" id="clave-usuario" name="clave-usuario" placeholder="Contraseña">
                        </div>
                        <!-- <div class="col">
                            <label class="form-label mt-4" for="clave-usuario2">Confirmar Contraseña</label>
                            <input class="form-control" type="text" id="clave-usuario2" name="clave-usuario2" placeholder="Repetir Contraseña">
                        </div> -->
                    </div>
                   
                  
                    
                        <div class="col">
                            <button class="btn" name="registro-usuario" type="submit">Registrarse</button>
                        </div>
                   </form>
                </div>
                
            </div>
        
    </section>
</div>
    <!--== FIN DEL CONTENIDO ==-->

    <!--== LISTADO DE CONSULTA ==-->

    <form action="" method="POST">
    <div class="table-container ">
        <h1 class="titulo-tabla display-5 text-center">LISTA DE USUARIOS</h1>
        <table class="tabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de Usuario</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuario->consultar() as $row) { ?>
                    
                        <tr>
                            <td data-label="#">
                            <button class="btn btn-eliminar" type="submit" name="eliminar-usuario" value="<?php echo $row['id_usuario']; ?>">Eliminar</button>
                            <br>
                            <button class="btn btn-modificar" type="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['id_usuario']; ?>">Modificar</button>
                            </td>
                            <td><?php echo $row['username']; ?></td>
                            
                        </tr>

                        <!-- MODAL -->
                        <div class="modal fade" id="modal-<?php echo $row['id_usuario']; ?>" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modificar Usuario</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    <div class="row">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="nombre-usuario">Nombre del Usuario</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['username']; ?>" id="nombre-usuario" name="nombre-usuario" placeholder="">
                                                                            </div>
                                                                    
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <div class="col">
                                                                                <label class="form-label mt-4" for="clave-usuario">Contraseña</label>
                                                                                <input class="form-control" type="text" value="<?php echo $row['password']; ?>" id="clave-usuario" name="clave-usuario" placeholder="">
                                                                            </div>
                                                                            <!-- <div class="col">
                                                                                <label class="form-label mt-4" for="clave-usuario2">Confirmar Contraseña</label>
                                                                                <input class="form-control" type="text" value="<?php //echo $row['password']; ?>" id="clave-usuario2" name="clave-usuario2" placeholder="">
                                                                            </div> -->
                                                                        </div>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-cerrar" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button class="btn btn-modificar" type="submit" name="guardar" value="<?php echo $row['id_usuario']; ?>">Modificar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                        </div>

                        <!-- FIN DEL MODAL -->


                        <?php } ?>
             
             
            </tbody>
        </table>
                    <div class="row">
                        <div class="col">
                            <button class="btn" name="" type="button" id="pdfusuarios" name="pdfusuarios"><a href="?pagina=pdfusuarios">Generar Reporte</a></button>
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

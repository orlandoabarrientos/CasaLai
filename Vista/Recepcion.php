<?php



if (!isset($_SESSION['name'])) {

 	header('Location: .');
 	exit();
 }
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
    <title>Gestionar Recepcion</title>
</head>

<body>

	<?php require_once("vista/NavBar.php"); ?>


	<section class=" " style="margin-top: 110px;">

		<div class="container"> 
			<form method="post" action="" id="f">
				<input type="text" name="accion" id="accion" style="display:none" />
				<h2 class="">Gestionar Recepcion</h2>

				<div class="container">
					<div>
						<button type="button" class="" id="registrar" name="registrar">Registrar Recepcion</button>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class=" ">
							<label for="correlativo">Correlativo del producto</label>
							<input class="" type="text" id="correlativo" name="correlativo" />
							<span id="scorrelativo"></span>
						</div>
						<div class="">
							<label for="proveedor">Proveedor</label>
							<select class="" name="proveedor" id="proveedor">
								<option value='disabled' disabled selected>Seleccione un Proveedor</option>
								<?php
								foreach ($proveedores  as $proveedor) {
									echo "<option value='" . $proveedor['id_proveedor'] . "'>" . $proveedor['nombre'] . "</option>";
								} ?>
							</select>
						</div>
						<div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="descripcion" class="form-label">Descripción:</label>
                                    <textarea class="" id="descripcion" name="descripcion" rows="3" required></textarea>
                                    <span id="sdescripcion"></span>
                                </div>
                            </div>

					</div>
				</div>
				

			

				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>

		
                <div class="row">
                    <div class="col-md-8 input-group">
                    <input class="" type="text" id="codigoproducto" name="codigoproducto" style="display:none"/>
                    <input class="" type="text" id="idproducto" name="idproducto" style="display:none"/>
                    <button type="button" class="" id="listado" name="listado">LISTA DEPRODUCTOS</button>
                    </div>
                </div>
			
				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>
				

				<div class="table-responsive card shadow">

					<div class="row">
						<div class="">
							<table class="" id="tablarecepcion">
								<thead class="">
									<tr>
										<th>Acción</th>
										<th style="display:none">Cl</th>
										<th>Codigo</th>
										<th>Nombre</th>
										<th>Cantidad</th>
										
									</tr>
								</thead>
								<tbody class="" id="recepcion1">
                                   
								</tbody>
							</table>
						</div>
					</div>
				</div>

				
		</div>
		</form>
		</div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modalp">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Listado de productos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped table-hover">
						<thead class="text-center">
							<tr>
								<th style="display:none">Id</th>
								<th>Codigo</th>
								<th>Nombre</th>
							</tr>
						</thead>
						<tbody class="text-center" id="listadop">

						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
    
	
	</section>


	


	
    <?php include 'footer.php'; ?>


	<script type="text/javascript" src="Javascript/recepcion.js"></script>
</body>

</html>
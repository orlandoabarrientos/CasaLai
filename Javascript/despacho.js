$(document).ready(function(){


// Cargar la lista de clientes
   carga_clientes();
//carga la lista de productos
	carga_productos();
	
//boton para levantar modal de clientes
$("#listadodeclientes").on("click",function(){
	$("#modalclientes").modal("show");
});

//boton para levantar modal de productos
$("#listadodeproductos").on("click",function(){
	$("#modalproductos").modal("show");
});


//evento keyup de input cedulacliente	
$("#cedulacliente").on("keyup",function(){
	var cedula = $(this).val();
	var encontro = false;
	$("#listadoclientes tr").each(function(){
		if(cedula == $(this).find("td:eq(1)").text()){
			colocacliente($(this));
			encontro = true;
		} 
	});
	if(!encontro){
		$("#datosdelcliente").html("");
	}
});	

//evento keyup de input codigoproducto
$("#codigoproducto").on("keyup",function(){
	var codigo = $(this).val();
	$("#listadoproductos tr").each(function(){
		if(codigo == $(this).find("td:eq(1)").text()){
			colocaproducto($(this));
		}
	});
});	

//evento click de boton registrar
$("#registrar").on("click",function(){
	
			$('#accion').val('registrar');
			var datos = new FormData($('#f')[0]);
			
			enviaAjax(datos);
		
});
	
	
});

function carga_clientes(){
	
	var datos = new FormData();
	//a ese datos le añadimos la informacion a enviar
	datos.append('accion','listadoclientes'); //le digo que me muestre un listado de aulas
	//ahora se envia el formdata por ajax
	enviaAjax(datos);
}
function carga_productos(){
	
	
	var datos = new FormData();
	
	datos.append('accion','listadoproductos'); //le digo que me muestre un listado de aulas
	
	enviaAjax(datos);
}

//function para saber si selecciono algun productos
function verificaproductos(){
	var existe = false;
	if($("#detalledeventa tr").length > 0){
		existe = true;
	}
	return existe;
}
//fin de verificar si selecciono procductos

//function para buscar si existe el cliente 
function existecliente(){
	var cedula = $("#cedulacliente").val();
	var existe = false;
	$("#listadoclientes tr").each(function(){
		
		if(cedula == $(this).find("td:eq(1)").text()){
			existe = true;
		}
	});
	
	return existe;
	
}
//fin de funcion existecliente

//funcion para colocar los productos
function colocaproducto(linea){
	var id = $(linea).find("td:eq(0)").text();
	var encontro = false;
	
	$("#detalledeventa tr").each(function(){
		if(id*1 == $(this).find("td:eq(1)").text()*1){
			encontro = true
			var t = $(this).find("td:eq(4)").children();
			t.val(t.val()*1+1);
			modificasubtotal(t);
		} 
	});
	
	if(!encontro){
		var l = `
		  <tr>
		   <td>
		   <button type="button" class="btn btn-primary" onclick="eliminalineadetalle(this)">X</button>
		   </td>
		   <td style="display:none">
			   <input type="text" name="idp[]" style="display:none"
			   value="`+
					$(linea).find("td:eq(0)").text()+
			   `"/>`+	
					$(linea).find("td:eq(0)").text()+
		   `</td>
		   <td>`+
					$(linea).find("td:eq(1)").text()+
		   `</td>
		   <td>`+
					$(linea).find("td:eq(2)").text()+
		   `</td>
		   <td>
		      <input type="text" value="1" name="cant[]" onkeyup="modificasubtotal(this)"/>
		   </td>
		   <td>
		       <input type="text" name="pvp[]" style="display:none"
			   value="`+
					$(linea).find("td:eq(4)").text()+
			   `"/>`+
					$(linea).find("td:eq(4)").text()+
		   `</td>
		   <td>`+
					redondearDecimales($(linea).find("td:eq(4)").text()*1,2)+
		   `</td>
		   </tr>`;
		$("#detalledeventa").append(l);
	}
}
//fin de funcion colocar productos


//funcion para modificar subtotal
function modificasubtotal(textocantidad){
	var linea = $(textocantidad).closest('tr');
	var valor = $(textocantidad).val()*1;
	var pvp = $(linea).find("td:eq(5)").text()*1;
	$(linea).find("td:eq(6)").text(redondearDecimales((valor*pvp),2));
}
//fin de funcion modifica subtotal


//funcion para eliminar linea de detalle de ventas
function eliminalineadetalle(boton){
	$(boton).closest('tr').remove();
}
// fin de funcion de eliminar linea


//funcion para colocar datos del cliente en pantalla
function colocacliente(linea){
	$("#cedulacliente").val($(linea).find("td:eq(1)").text());
	$("#idcliente").val($(linea).find("td:eq(0)").text());
	$("#datosdelcliente").html($(linea).find("td:eq(2)").text()+
	"  "+$(linea).find("td:eq(3)").text()+"  "+
	$(linea).find("td:eq(4)").text());
}

//fin de colocar datos del cliente



//Funcion que muestra el modal con un mensaje
function muestraMensaje(mensaje){
	$("#contenidodemodal").html(mensaje);
			$("#mostrarmodal").modal("show");
			setTimeout(function() {
					$("#mostrarmodal").modal("hide");
			},5000);
}


//Función para validar por Keypress
function validarkeypress(er,e){
	
	key = e.keyCode;
	
	
    tecla = String.fromCharCode(key);
	
	
    a = er.test(tecla);
	
    if(!a){
	
		e.preventDefault();
    }
	
    
}
//Función para validar por keyup
function validarkeyup(er,etiqueta,etiquetamensaje,
mensaje){
	a = er.test(etiqueta.val());
	if(a){
		etiquetamensaje.text("");
		return 1;
	}
	else{
		etiquetamensaje.text(mensaje);
		return 0;
	}
}


function redondearDecimales(numero, decimales) {
	return Number(Math.round(numero +'e'+ decimales) +'e-'+ decimales).toFixed(decimales);
	
}
function enviaAjax(datos){
	
	$.ajax({
		async: true,
            url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
            type: 'POST',//tipo de envio 
            contentType: false,
            data: datos,
            processData: false,
            cache: false,
            beforeSend: function(){
				//pasa antes de enviar pueden colocar un loader
				
				
			},
			timeout:10000, //tiempo maximo de espera por la respuesta del servidor
            success: function(respuesta) {//si resulto exitosa la transmision
				
            	try{
	
				var lee = JSON.parse(respuesta);	
				console.log(lee.resultado);
				if(lee.resultado=='listadoclientes'){
	
					$('#listadoclientes').html(lee.mensaje);
				}
				else if(lee.resultado=='listadoproductos'){
					
					$('#listadoproductos').html(lee.mensaje);
				}
				else if(lee.resultado=='registrar'){
					
					muestraMensaje(lee.mensaje);
				}
				else if(lee.resultado=='error'){
					muestraMensaje(lee.mensaje);
				}
				
			}
			catch (e) {
            console.error("Error en análisis JSON:", e); // Registrar el error para depuración
            alert("Error en JSON " + e.name + ": " + e.message);
             }
			  //cuanto termina el proceso ocultan el loader
			  
			},
			error: function (request, status, err) {
            if (status == "timeout") {
                muestraMensaje("Servidor ocupado, intente de nuevo");
            } else {
                muestraMensaje("ERROR: <br/>" + request + status + err);
            }
            },
			complete: function(){
				
			}
			
		});


	
}
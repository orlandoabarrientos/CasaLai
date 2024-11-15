$(document).ready(function(){

    //Seccion para mostrar lo enviado en el modal mensaje//
    
    //Función que verifica que exista algo dentro de un div
    //oculto y lo muestra por el modal
    if($.trim($("#mensajes").text()) != ""){
      muestraMensaje($("#mensajes").html());
    }
    //Fin de seccion de mostrar envio en modal mensaje//		
      
      
      $("#username").on("keypress",function(e){
        validarkeypress(/^[A-Za-z0-9\b]*$/,e);
      });
      
      $("#username").on("keyup",function(){
        validarkeyup(/^[A-Za-z0-9\b]{3,8}$/,$(this),
        $("#susername"),"El formato debe ser 9999999 ");
      });
      
      $("#password").on("keypress",function(e){
        validarkeypress(/^[A-Za-z0-9\b]*$/,e);
      });
      
      $("#password").on("keyup",function(){
        
        validarkeyup(/^[A-Za-z0-9]{3,15}$/,
        $(this),$("#spassword"),"Solo letras y numeros entre 3 y 15 caracteres");
      });
      
      
      
    //FIN DE VALIDACION DE DATOS
    
    
    
    //CONTROL DE BOTONES
    
    
    $("#acceder").on("click",function(){
      event.preventDefault();
      if(validarenvio()){
        
        $("#accion").val("acceder");	
        $("#f").submit();
        
      }
    });
      
    });
    
    //Validación de todos los campos antes del envio
    function validarenvio(){
      
      if(validarkeyup(/^[A-Za-z0-9]{3,8}$/,$("#username"),
        $("#susername"),"El formato debe ser entre 3 y 8 dígitos")==0){
          muestraMensaje("error",4000,"ERROR!","El username debe tener mínimo 3 dígitos y máximo 8");
        return false;					
      }	
      else if(validarkeyup(/^[A-Za-z0-9]{3,15}$/,
        $("#password"),$("#spassword"),"Solo letras y numeros entre 3 y 15 caracteres")==0){
         muestraMensaje("error",4000,"ERROR!","El password debe tener mínimo 3 dígitos y máximo 15");
        return false;
      }
      
      
      return true;
    }
    
    
    //Funcion que muestra el modal con un mensaje
    function muestraMensaje(icono,tiempo,titulo,mensaje){
      Swal.fire({
      icon:icono,
        timer:tiempo,	
        title:titulo,
      html:mensaje,
      showConfirmButton:true,
      confirmButtonText:'Aceptar',
      });
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        const mensajesDiv = document.getElementById("mensajes");
        const mensaje = mensajesDiv.getAttribute("data-mensaje");
    
        if (mensaje) {
            muestraMensaje("error", 4000, "Error", mensaje);
        }
    });
    
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
    
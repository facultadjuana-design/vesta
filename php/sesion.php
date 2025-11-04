<?php

session_start();

if (isset($_REQUEST["accion"])){  
    if ($_REQUEST["accion"]=="cerrarSesion" && isset($_SESSION['email'])){
      cerrarSesion('email');
    }    
}

function cerrarSesion($clave){
  // Elimina la variable clave en sesión.
  unset($_SESSION[$clave]); 
 
  // Elimina la sesion.
  session_destroy();
   
  // Redirecciona a la página de signin. 
    header("Location: login.html");
}

function crearSesion($clave, $valor){
    // Guardar en la sesión el email del usuario.
    $_SESSION[$clave] = $valor;
    header("Location: ../indexusuario.html");
}

function controlarSesion(){
// Controlo si el usuario ya está logueado en el sistema.

  $sesionUsuario=NULL;
  if(isset($_SESSION['email'])){
    // Le asigno la sesion correspondiente al usuario
    $sesionUsuario=$_SESSION['email'];    
    
  }else{
    header("Location: login.html"); 
  }
  
  return $sesionUsuario;
}

?>
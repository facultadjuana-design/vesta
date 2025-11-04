<?php

include "bd.php";     
include "sesion.php";
function main(){
  // Obtengo los datos cargados en el formulario de signin.
  $email = $_POST['email'];       
  $clave = $_POST['password']; 

  // abrir conexión a base de datos, en este caso 'bd_usuario'
  $conn = conectarBDUsuario();
  // Ejecutar consulta
  $resultado = consultarUsuario($conn,$email,$clave);
  // cerrar conexión '$conn' de base de datos
 
  if($resultado!=NULL && $resultado->num_rows>0){  
    crearSesion('email', $email); // crea sesion y redirige
  }else{
    echo 'El email o password es incorrecto, <a href="../login.html">vuelva a intenarlo</a>.<br/>';
  }
  cerrarBDConexion($conn);
}
main();
?>
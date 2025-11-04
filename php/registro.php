<?php
include "bd.php";     
include "sesion.php";
  //session_start();
function main(){
    // Obtengo los datos cargados en el formulario de registro
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // abrir conexión a base de datos
    $conn = conectarBDUsuario();
    
    // Verificación si existe el email en base de datos
    $resVerEmail = verficarEmail($conn,$email);
    if($resVerEmail!=NULL && $resVerEmail->num_rows==0){
        // agregar nuevo usuario
        $filasAfectadas = agregarUsuario($conn,$apellido,$nombre,$email,$direccion,$password);
        // cerrar conexión
        cerrarBDConexion($conn);

        if ($filasAfectadas>0){
            crearSesion('email', $email);
        } 
    }else{
        if ($resVerEmail!=NULL){
            echo 'Email existente. <a href="../login.html">vuelva a intentarlo</a>.<br/>';
        } 
    }
     cerrarBDConexion($conn);
}

main();
?>
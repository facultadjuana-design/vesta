<?php
  
    // Datos para conectar a la base de datos.
    const nombreServidor = "localhost";
    const nombreUsuario = "root";
    const passwordBaseDeDatos = "";
    const nombreBaseDeDatos = "vesta";        

    function conectarBDUsuario(){  
        mysqli_report(MYSQLI_REPORT_STRICT);         //para que lance excepciones
        try {                      // Crear conexión con la base de datos.
            $conn = new mysqli(nombreServidor, nombreUsuario, passwordBaseDeDatos, nombreBaseDeDatos);      
        } catch (Exception $e) {   // si hay un error
            
            // $_SESSION['message'] = $e->getMessage(); //guarda el mensaje de error en la variable de sesion
            // $_SESSION['error'] = TRUE;               //guarda un TRUE en la variable de sesion
            echo 'ERROR:'.$e->getMessage();
            $conn=NULL;                              //devuelve NULL
        }   
        return $conn;
      }

  function cerrarBDConexion($conn){
    if ($conn!=NULL){
        $conn->close();
    }    
  }

  function consultarUsuario($conn,$email,$clave){
    $resultado = NULL;
      
    $sql = "SELECT * FROM cliente WHERE email= '$email' AND clave = $clave";

    $resultado = $conn->query($sql);
     
    
    return $resultado;
  }

  function verficarEmail($conn,$email){
    $resultado = NULL;
    $sql="SELECT * FROM cliente WHERE email='$email'";  
    $resultado = $conn->query($sql);                   
    return $resultado;
  }
  
  function agregarUsuario($conn,$apellido,$nombre,$email,$direccion,$clave){
    $filasAfectadas = 0;
    $sql="INSERT INTO cliente (email,password,apellido,nombre) VALUES ('$email','$clave','$apellido','$nombre','$direccion')";
    $conn->query($sql);
    $filasAfectadas=$conn->affected_rows;
    return $filasAfectadas;
  }

  function consultaDatosUsuario($conn,$email){
    $resultado = NULL;
          
    $sql="SELECT * FROM cliente WHERE email='$email'"; //  
    $res_msqli = $conn->query($sql);                   // respuesta en formato mysqli
    $resultado = $res_msqli->fetch_assoc();            //devuelve un array asociativo
    $res_msqli->free();                                //libera el conjunto de resultados
    
    return $resultado;
  }

  function actualizarUsuario($conn,$email,$clave,$apellido,$nombre,$direccion){
    $filasAfectadas = 0;
    $sql="UPDATE usuario SET apellido = '$apellido' , nombre = '$nombre' WHERE email= '$email' AND password='$password'";
    $conn->query($sql);
    $filasAfectadas=$conn->affected_rows;
    return $filasAfectadas;
  }
?>
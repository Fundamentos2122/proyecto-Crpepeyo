<?php

include("../models/DB.php");
include("../models/Usuario.php");

try
{
    $connection = DBConnection::getConnection();
}
catch(PDOException $e)
{

    error_log("Error de conexion - " . $e,0);
    header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/error.php?error=ERROR DE CONEXION A LA BASE DE DATOS");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    var_dump("xd");
}

if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
    if ($_POST["_method"]=="PUT_USUARIO") 
    {
        //Actualizar usuario 
        session_start();
        $id=$_SESSION["id"];
        $nombre_usuario_anterior = $_POST["nombre_usuario_anterior"];
        $nombre_usuario = $_POST["nombre_usuario"];
        
        if ($nombre_usuario_anterior!=$_SESSION["nombre_usuario"]) {
            header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/cambiar_usuario/cambiar_usuario.php?error=El nombre de usuario anterior no coindice");
            exit();
        }
        try 
        {
            
            $query = $connection->prepare('UPDATE usuario SET nombre_usuario=:nombre_usuario WHERE id=:id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->bindParam(':nombre_usuario',$nombre_usuario,PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() == 0) {
                //Error
                exit();
            }
            
            session_destroy();

            header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/perfil/perfil.php");
        }
        catch (PDOException $e) 
        {
            error_log("Error en query - " . $e,0);
            exit();
        }
    }
    elseif ($_POST["_method"]=="PUT_CONTRASENA") {
        //Actualizar contrasena
        session_start();
        $id=$_SESSION["id"];
        $contrasena_anterior = $_POST["contrasena_anterior"];
        $contrasena = $_POST["contrasena"];
        
        try
        {
            $query = $connection->prepare('SELECT * FROM usuario WHERE id=:id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $usuario=new Usuario($row["id"],$row["nombre_usuario"],$row["contrasena"],$row["rol"]);
            
            if ($contrasena_anterior!=$usuario->getContrasena()) {
                header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/cambiar_contraseña/cambiar_contraseña.php?error=La contraseña anterior no coindice");
                exit();
            }
            try 
            {
                
                $query = $connection->prepare('UPDATE usuario SET contrasena=:contrasena WHERE id=:id');
                $query->bindParam(':id',$usuario->getId(),PDO::PARAM_INT);
                $query->bindParam(':contrasena',$contrasena,PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() == 0) {
                    //Error
                    exit();
                }
                
                session_destroy();

                header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/perfil/perfil.php");
            }
            catch (PDOException $e) 
            {
                error_log("Error en query - " . $e,0);
                exit();
            }
            
        }
        catch (PDOException $e) 
        {
            error_log("Error en query - " . $e,0);
            exit();
        }
        
    }
    else if ($_POST["action"]=="Iniciar sesion") 
    {     
        
        //Hacer login
        $nombre_usuario = $_POST["nombre_usuario"];
        $contrasena = $_POST["contrasena"];
        try
        {
            $query = $connection->prepare('SELECT * FROM usuario WHERE nombre_usuario=:nombre_usuario AND contrasena=:contrasena');
            $query->bindParam(':nombre_usuario',$nombre_usuario,PDO::PARAM_STR);
            $query->bindParam(':contrasena',$contrasena,PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount()==0) {
                //No se encontro el usuario
                header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/login/login.php?error=Usuario y/o contrasena invalida");
                exit();
            }
            
            $usuario;
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {             
                $usuario=new Usuario($row["id"],$row["nombre_usuario"],$row["contrasena"],$row["rol"]);
            }
            session_start();
            
            $_SESSION["id"]=$usuario->getID();
            $_SESSION["nombre_usuario"] = $usuario->getNombreUsuario();
            $_SESSION["rol"] = $usuario->getRol();
            header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views");
            
        }
        catch (PDOException $e)
        {
            var_dump($e);
            error_log("Error en query - " . $e,0);
            //header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/error.php?error=ERROR DE INICIO DE SESION");
            exit();
        }
        
    }
    else if ($_POST["action"]=="Registrarse") 
    {
        //Registrar usuario
        
        $nombre_usuario = $_POST["nombre_usuario"];
        $contrasena = $_POST["contrasena"];
        $rol = "usuario";
        
        try
        {
            $query = $connection->prepare('INSERT INTO usuario VALUES(NULL,:nombre_usuario, 
            :contrasena,:rol)');
            $query->bindParam(':nombre_usuario',$nombre_usuario,PDO::PARAM_STR);
            $query->bindParam(':contrasena',$contrasena,PDO::PARAM_STR);
            $query->bindParam(':rol',$rol,PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() == 0) {
                //Error
                exit();
            }
          
            $usuario=new Usuario($row["id"],$row["nombre_usuario"],$row["contrasena"],$row["rol"]);
            
            session_start();
            
            $_SESSION["id"]=$usuario->getID();
            $_SESSION["nombre_usuario"] = $usuario->getNombreUsuario();
            $_SESSION["rol"] = $usuario->getRol();
            header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views");
        }
        catch (PDOException $e)
        {
            var_dump($e);
            error_log("Error en query - " . $e,0);
            //header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/error.php?error=ERROR DE REGISTRO DE USUARIO");
            exit();
        }
        
    }
    else if ($_POST["_method"]=="DELETE") 
    {
        //Logout
        session_start();
        session_destroy();

        header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/");
        exit();
    }
    
}

?>
<?php
    //Verificar que el usuario este logueado
    session_start(); 
    if (!array_key_exists("nombre_usuario",$_SESSION) ) 
    {
        header("Location: http://localhost/Proyecto Web (Rappel)/views/login/login.php");
        exit();
    }
    //Validar que el usuario sea admin
    
    if ($_SESSION["rol"] == "administrador") 
    {
        header("Location: http://localhost/Proyecto Web (Rappel)/views/admin/admin.php");
        exit();
    }
    //Usuario normal 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta o iniciar sesion </title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../perfil/perfil.css">
</head>
<body class="container-fluid container-XL bg-light">
    <?php 
        
        if (array_key_exists("nombre_usuario",$_SESSION) ) 
        {
            include("../banner/banner2.php");
        }
        else
        {
            include("../banner/banner.php");
        }
    ?>
        <div class="col-12 center">
                <ul style="padding: 0">
                    <li id="usuarioEnter" >
                        <input style="margin: auto;" class="center textSize" type="text" placeHolder="Usuario" id="nombre_usuario" required>
                        <br>
                    </li>
                    <a class="textSize" href="../cambiar_usuario/cambiar_usuario.php">Cambiar nombre de usuario</a>
                    <br>
                    <br>
                    <br>
                    <li id="contraseña">
                        <input  style="margin: auto;" class="center textSize" type="password" placeholder="Contraseña" id="contrasena" required>
                        <br>
                    </li>
                    <a class="textSize" href="../cambiar_contraseña/cambiar_contraseña.php">Cambiar contraseña</a>
                </ul>
        </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script type="text/javascript">
        
        const usuarioInput= document.getElementById("nombre_usuario");
        var nombre='<?php echo $_SESSION["nombre_usuario"]?>'
        usuarioInput.value=nombre

    </script>
</body>
</html>
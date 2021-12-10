<?php
    //Verificar que el usuario este logueado
    session_start(); 

    //Validar que el usuario sea admin
    if ($_SESSION["rol"] !== "administrador") 
    {
        header("Location: http://localhost/practicaphp/views/");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil administrador</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../admin/admin.css">
    <style>
        .parent 
        {
            position: relative;
            top: 0;
            left: 0;
        }
        .image1 
        {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
        }
        .image2 
        {
            position: absolute;
            top: 45%;
            left: 40%;
            width: 20%;
            height: auto;
        }
        .imageC1 
        {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
        }
        .imageC2 
        {
            position: absolute;
            top: 40%;
            left: 44%;
            width: 15%;
            height: auto;
        }
    </style>
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
    <div class="row">
        <div class="col-12 col-M-6 center">
            <ul style="padding: 0; margin: 0 5em;">
                <li id="usuarioEnter" >
                    <input style="margin: auto;" class="center textSize" type="text" 
                    placeHolder="Usuario" id="nombre_usuario" required>
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
        <a style="margin-top: 3em; margin-bottom: 3em; margin-left: -1em;" class="col-12 col-M-6 center" id="añadirProd" href="../añadir_producto/añadir_producto.php">Añadir producto</a>
    </div>
    <br>
    <br>
    <h2>Productos Encargados</h2>
    <div class="row">
    
    <div id="ajax">
        
    </div>

    </div> 
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
        const usuarioInput= document.getElementById("nombre_usuario");
        var nombre='<?php echo $_SESSION["nombre_usuario"];?>'
        usuarioInput.value=nombre



        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange=function()
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("ajax").innerHTML = xhttp.responseText;
            }
        }
        xhttp.open("GET", "../../controllers/productos_adminController.php", true);
        xhttp.send();
            

            
    </script>
</body>
</html>
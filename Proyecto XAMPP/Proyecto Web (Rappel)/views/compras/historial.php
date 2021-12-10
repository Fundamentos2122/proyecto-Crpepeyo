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
    <title>Compras </title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../index/index.css">
    <link rel="stylesheet" href="../compras/compras.css">
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
            top: 35%;
            left: 40%;
            width: 22%;
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
    <div id="ajax"> 
        <!-- <div class="row" style="margin-bottom: 30px;">
        <img class="col-3 spaceImg" src="https://picsum.photos/150" alt="" style="width: 100%; height: 100%;">
        <p class="space col-3">Descripcion</p>
        <p class="space col-3">Mas Informacion</p>
        <p class="space col-3">$Precio</p>
        </div>  -->
    </div> 

    <div style="font-size: 1.5em;">
        <a href="../index.php"><button class="btn btn-secondary btnCompras">Seguir comprando</button></a>
    </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
        
        function ocultaBtns()
        {
            const btns=document.getElementsByClassName("borrar")
            console.log(btns.length);
            for (let index = 0; index < btns.length; index++) 
            {
                
                const element = btns[index];
                element.style.display="none"
            }
        }
        
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange=function()
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("ajax").innerHTML = xhttp.responseText;
                ocultaBtns();
            }
        }
        xhttp.open("GET", "../../controllers/productos_compradosController.php?historial=true", true);
        xhttp.send();

    </script>
</body>
</html>
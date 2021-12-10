<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio </title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="./banner/banner.css">
    <link rel="stylesheet" href="./index.css">
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
        session_start();
        if (array_key_exists("nombre_usuario",$_SESSION) ) 
        {
            include("./banner/banner2.php");
        }
        else
        {
            include("./banner/banner.php");
        }    
    ?>
    <div class="row">
        <?php
            include("../controllers/productosController.php");
        ?>
    </div> 
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
    </script>
</body>
</html>
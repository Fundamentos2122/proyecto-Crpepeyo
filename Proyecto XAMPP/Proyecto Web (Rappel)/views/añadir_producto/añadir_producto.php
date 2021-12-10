<?php
    //Verificar que el usuario este logueado
    session_start(); 
    //Validar que el usuario sea admin
    
    if ($_SESSION["rol"] == "usuario") 
    {
        header("Location: http://localhost/Proyecto Web (Rappel)/views/compras/compras.php");
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
    <title>Añadir producto</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../añadir_producto/añadir_producto.css">
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
            height: 100%;
        }
        .image2 
        {
            position: absolute;
            top: 35%;
            left: 38%;
            width: 25%;
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
        <div class="parent col-12 col-M-4">
            <img id="img_tipo" src="" alt="" class="image1">
            <img id="img_diseno" src="" alt="" class="image2">
        </div>
        <div class="col-12 col-M-6">
            <form action="../../../Proyecto Web (Rappel)/controllers/productosController.php"
            method="POST" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">
            
            <label for="Tipo">Tipo</label>
            <input type="radio" name="tipo" value="Playera" required>Playera
            <input type="radio" name="tipo" value="Sudadera" required>Sudadera
            <input type="radio" name="tipo" value="Chamarra" required>Chamarra
            <input type="radio" name="tipo" value="Gorra" required>Gorra
            <input type="radio" name="tipo" value="Vaso" required>Vaso
            <br>
            <br>
            <input type="text" placeholder="Descipcion del producto" name="descripcion" class="form-control" required>
            <br>
            <br>
            <input type="text" placeholder="Precio" name="precio" class="form-control" required>
            <br>
            <br>
            <input type="text" placeholder="Color" name="color" class="form-control" required>
            <br>
            <br>
            <label for="talla">Talla</label>
            <input type="radio" name="talla" value="S" required>S
            <input type="radio" name="talla" value="M" required>M
            <input type="radio" name="talla" value="L" required>L
            <input type="radio" name="talla" value="XL" required>XL
            <br>
            <br>    
            <label for="foto_tipo">Foto tipo</label>
            <input onchange="showPreviewTipo(event)" id="img_tipo_input" type="file" name="foto_tipo" class="form-control" required>
            <br>
            <br>    
            <label for="foto_diseno">Foto diseño</label>
            <input onchange="showPreviewDiseno(event)" id="img_tipo_diseno"  type="file" name="foto_diseno" class="form-control">
        </div>
        <div class="col-12 col-M-2" style="margin: auto auto;">
            <?php 
                if (array_key_exists("error", $_GET))
                {
                    echo '<div class="alert alert-danger show">' . $_GET["error"] . '</div>';
                }
            ?> 
            <button type="submit" id="guardar" class="btn btn-succes">Guardar</button>
        </div>
        </form>
    </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>

        function showPreviewTipo(event)
        {
            if(event.target.files.length > 0)
            {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("img_tipo");
                preview.src = src;
            }
        }
        function showPreviewDiseno(event)
        {
            if(event.target.files.length > 0)
            {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("img_diseno");
                preview.src = src;
            }
        }
    </script>
</body>
</html>
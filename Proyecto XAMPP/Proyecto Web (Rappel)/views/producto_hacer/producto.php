<?php
    session_start(); 
    //Validar que el usuario sea admin
    if ($_SESSION["rol"] == "administrador") 
    {
        header("Location: http://localhost/Proyecto Web (Rappel)/views/");
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
    <title>Producto</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../producto_hacer/producto.css">
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
            <img id="img_tipo" alt="" src="" class="image1">
            <img id="img_diseno" alt="" class="image2">
    </div>
    <div class="col-12 col-M-6">
    <form action="../../../Proyecto Web (Rappel)/controllers/productos_adminController.php"
    method="POST" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="POST">
            <label for="Tipo">Tipo</label>
            <input type="radio" name="tipo" id="tipoP" value="Playera" disabled>Playera
            <input type="radio" name="tipo" id="tipoS" value="Sudadera" disabled>Sudadera
            <input type="radio" name="tipo" id="tipoC" value="Chamarra" disabled>Chamarra
            <input type="radio" name="tipo" id="tipoG" value="Gorra" disabled>Gorra
            <input type="radio" name="tipo" id="tipoV" value="Vaso" disabled>Vaso
            <br>
            <br>
            <input type="text" placeholder="Descipcion del producto" name="descripcion" class="form-control" required>
            <br>
            <br>
            <p id="precio" class="h6">$Precio variable</p>
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
            <input onchange="showPreviewTipo(event)" id="img_tipo_input" type="file" name="foto_tipo" class="form-control">  
            <br>
            <br>
            <label for="foto_diseno">Foto del diseño</label>
            <input onchange="showPreviewDiseno(event)" id="img_tipo_diseno"  type="file" name="foto_diseno" class="form-control">
        </div>
        <div class="col-12 col-M-2" style="margin: auto auto;">
            <button id="carrito" class="btn btn-succes"> Hacer pedido</button>
    </form>
    </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
        const tipoInputP=document.getElementById("tipoP");
        const tipoInputS=document.getElementById("tipoS");
        const tipoInputC=document.getElementById("tipoC");
        const tipoInputG=document.getElementById("tipoG");
        const tipoInputV=document.getElementById("tipoV");


        const imgTipoInput= document.getElementById("img_tipo");
        const imgDisenoInput= document.getElementById("img_diseno");

        const id = "" + <?php echo $_GET["id"] ?> + "";

        getProducto();

        function getProducto()
        {
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../../controllers/productosController.php?id=" + id, false);
            
            xhttp.onreadystatechange=function()
            {
                if(this.readyState==4)
                {
                    var producto=JSON.parse(this.responseText);
                    
                    if (producto.tipo=="Playera")
                    {
                        tipoInputP.disabled=false;
                        tipoInputP.checked=true;
                    }
                    if (producto.tipo=="Sudadera")
                    {
                        tipoInputS.disabled=false;
                        tipoInputS.checked=true;
                    }
                    if (producto.tipo=="Chamarra")
                    {
                        tipoInputC.disabled=false;
                        tipoInputC.checked=true;
                    }
                    if (producto.tipo=="Gorra")
                    {
                        tipoInputG.disabled=false;
                        tipoInputG.checked=true;
                    }
                    if (producto.tipo=="Vaso")
                    {
                        tipoInputV.disabled=false;
                        tipoInputV.checked=true;
                    }
                        
                   
                    imgTipoInput.src='data:image/jpeg;base64,' + producto.foto_tipo
                }
            };

            xhttp.send();
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
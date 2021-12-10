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
    <title>Editar producto</title>
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
            <form  id="form_put" action="../../../Proyecto Web (Rappel)/controllers/productosController.php"
            method="POST" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <label for="Tipo">Tipo</label>
            <input type="radio" id="tipoP" name="tipo" value="Playera" required>Playera
            <input type="radio" id="tipoS" name="tipo" value="Sudadera" required>Sudadera
            <input type="radio" id="tipoC"  name="tipo" value="Chamarra" required>Chamarra
            <input type="radio" id="tipoG" name="tipo" value="Gorra" required>Gorra
            <input type="radio" id="tipoV" name="tipo" value="Vaso" required>Vaso
            <br>
            <br>
            <input type="text" placeholder="Descipcion del producto" id="descripcion" name="descripcion" class="form-control" required>
            <br>
            <br>
            <input type="text" placeholder="Precio" id="precio" name="precio" class="form-control" required>
            <br>
            <br>
            <input type="text" placeholder="Color" id="color" name="color" class="form-control" required>
            <br>
            <br>
            <label for="talla">Talla</label>
            <input type="radio" id="tallaS" name="talla" value="S" required>S
            <input type="radio" id="tallaM" name="talla" value="M" required>M
            <input type="radio" id="tallaL" name="talla" value="L" required>L
            <input type="radio" id="tallaXL" name="talla" value="XL" required>XL
            <br>
            <br>    
            <label for="foto_tipo">Foto tipo</label>
            <input onchange="showPreviewTipo(event)" id="img_tipo_input" type="file" name="foto_tipo" class="form-control">
            <br>
            <br>    
            <label for="foto_diseno">Foto diseño</label>
            <input onchange="showPreviewDiseno(event)" id="img_tipo_diseno"  type="file" name="foto_diseno" class="form-control">
        </div>
        <div class="col-12 col-M-2" style="margin: auto auto;">
            <input type="submit" value="Editar" id="editar" class="btn btn-succes">
            </form>
            <form id="form_delete" action="../../../Proyecto Web (Rappel)/controllers/productosController.php"
            method="POST" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="Borrar" id="borrar" class="btn btn-danger">
            </form>
        </div>
        
    </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
        const formPut= document.getElementById("form_put");
        const formDelete= document.getElementById("form_delete");

        const tipoPInput=document.getElementById("tipoP");
        const tipoSInput=document.getElementById("tipoS");
        const tipoCInput=document.getElementById("tipoC");
        const tipoGInput=document.getElementById("tipoG");
        const tipoVInput=document.getElementById("tipoV");

        const descripcionInput= document.getElementById("descripcion");
        const precioInput= document.getElementById("precio");
        const colorInput= document.getElementById("color");

        const tallaSInput= document.getElementById("tallaS");
        const tallaMInput= document.getElementById("tallaM");
        const tallaLInput= document.getElementById("tallaL");
        const tallaXLInput= document.getElementById("tallaXL");

        const imgTipoInput= document.getElementById("img_tipo");
        const imgDisenoInput= document.getElementById("img_diseno");

        const id = "" + <?php echo $_GET["id"] ?> + "";
        getProducto()
        

        function getProducto()
        {
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../../controllers/productosController.php?id=" + id, false);
            
            xhttp.onreadystatechange=function()
            {
                if(this.readyState==4)
                {
                    var producto=JSON.parse(this.responseText);
                    formPut.action +="?id=" + producto.id;
                    formDelete.action +="?id=" + producto.id;

                    if (producto.tipo=="Playera") 
                        tipoPInput.checked=true
                    if (producto.tipo=="Sudadera") 
                        tipoSInput.checked=true
                    if (producto.tipo=="Chamarra") 
                        tipoCInput.checked=true
                    if (producto.tipo=="Gorra") 
                        tipoGInput.checked=true
                    if (producto.tipo=="Vaso") 
                        tipoVInput.checked=true
                    descripcionInput.value=producto.descripcion
                    precioInput.value=producto.precio 
                    colorInput.value=producto.color
                    if(producto.talla=="S")
                        tallaSInput.checked=true
                    if(producto.talla=="M")
                        tallaMInput.checked=true
                    if(producto.talla=="L")
                        tallaLInput.checked=true
                    if(producto.talla=="XL")
                        tallaXLInput.checked=true
                    imgTipoInput.src='data:image/jpeg;base64,' + producto.foto_tipo
                    imgDisenoInput.src='data:image/png;base64,'+producto.foto_diseno

                }
            };

            xhttp.send();
        }

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
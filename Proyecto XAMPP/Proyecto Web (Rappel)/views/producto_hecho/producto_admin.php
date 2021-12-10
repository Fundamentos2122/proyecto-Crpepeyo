<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../producto_hecho/producto.css">
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
            top: 40%;
            left: 38%;
            width: 25%;
            height: auto;
        }
    </style>
</head>
<body class="container-fluid container-XL bg-light">
    <?php 
        session_start();
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
            <img id="img_tipo" src="https://picsum.photos/500" alt="" class="image1">
            <img id="img_diseno" src="https://picsum.photos/500" alt="" class="image2">
        </div>
        <div class="col-12 col-M-6">
            <br>
            <br>
            <h3 id="tipo" class="mx-3">Tipo</h3>
            <br>
            <p id="descripcion" class="mx-3 h5">Descripcion producto</p>
            <br>
            <p id="precio" class="mx-3 h5">$Precio</p>
            <br>
            <p id="color" class="mx-3 h5">Color</p>
            <br>
            <button id="btnTalla" class="btn btn-secondary ml-3"></button>
        </div>
    </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>
        const tipoInput=document.getElementById("tipo");
        const descripcionInput= document.getElementById("descripcion");
        const precioInput= document.getElementById("precio");
        const colorInput= document.getElementById("color");
        const btnInput= document.getElementById("btnTalla");
        const imgTipoInput= document.getElementById("img_tipo");
        const imgDisenoInput= document.getElementById("img_diseno");

        const id = "" + <?php echo $_GET["id"] ?> + "";

        getProducto();
        

        function getProducto()
        {
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../../controllers/productos_adminController.php?id=" + id, false);
            
            xhttp.onreadystatechange=function()
            {
                if(this.readyState==4)
                {
                    var producto=JSON.parse(this.responseText);
                    tipoInput.innerHTML=producto.tipo;
                    descripcionInput.innerHTML=producto.descripcion;
                    precioInput.innerHTML='$'+producto.precio;
                    colorInput.innerHTML=producto.color
                    if(producto.talla=="S")
                        btnInput.innerHTML="S"
                    else if(producto.talla=="M")
                        btnInput.innerHTML="M"
                    else if(producto.talla=="L")
                        btnInput.innerHTML="L"
                    else if(producto.talla=="XL")
                        btnInput.innerHTML="XL"
                    imgTipoInput.src='data:image/jpeg;base64,' + producto.foto_tipo
                    imgDisenoInput.src='data:image/png;base64,'+producto.foto_diseno
                }
            };

            xhttp.send();
        }
    </script>
</body>
</html>
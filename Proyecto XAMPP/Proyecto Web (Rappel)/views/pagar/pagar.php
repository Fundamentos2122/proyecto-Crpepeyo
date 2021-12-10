<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../pagar/pagar.css">
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
    <h1 class="text">¡Gracias por tu compra!</h1>
    <p class="text" style="font-size: 1em;">En los proximos dias se te comunicara toda la informacion sobre tu pedido incluyendo el precio final, el dia de entrega y el modo de pago</p>
    <p class="text" style="font-size: 1em;">Cualquier duda comunicarse a la pagina de Facebook o al telefono </p>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre de usuario</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../cambiar_usuario/cambiar_usuario.css">
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
        <div class="col-12 center">
            <?php 
                if (array_key_exists("error", $_GET))
                {
                    echo '<div class="col-4 alert alert-danger show">' . $_GET["error"] . '</div>';
                }
            ?> 
        </div>
        <div class="col-12 center">
            <form action="../../controllers/loginController.php" method="POST" autocomplete="off">
                <input type="hidden" name="_method" value="PUT_USUARIO">
                <ul style="padding: 0">
                    <li id="usuarioEnter" >
                        <input style="margin: auto;" class="center textSize" type="text" placeHolder="Usuario anterior" name="nombre_usuario_anterior" required>
                        <br>
                    </li>
                    <li id="nuevoUsuario">
                        <input  style="margin: auto;" class="center textSize" type="text" placeholder="Nuevo usuario" name="nombre_usuario" required>
                        <br>
                    </li>
                </ul>
            
                <div class="col-12 center">
                    <input type="submit" class="textSize btn btn-secondary separa" value="Cambiar">
                </div>
            </form>
        </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
</body>
</html>
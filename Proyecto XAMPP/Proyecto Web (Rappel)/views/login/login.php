
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta o iniciar sesion </title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="../banner/banner.css">
    <link rel="stylesheet" href="../login/login.css">
</head>
<body class="container-fluid container-XL bg-light">
    <?php include("../banner/banner.php")?>
        <form action="../../controllers/loginController.php" method="POST">
            <div class="col-12 center">
            <?php 
                if (array_key_exists("error", $_GET))
                {
                    echo '<div class="alert alert-danger show">' . $_GET["error"] . '</div>';
                }
            ?> 
            </div>
            <div class="col-12 center">
                <ul style="padding: 0">
                    <li id="usuarioEnter" >
                        <input style="margin: auto;" class="center textSize" type="text" placeHolder="Usuario" name="nombre_usuario" required>
                        <br>
                    </li>
                    <li id="contraseña">
                        <input style="margin: auto;" class="center textSize" type="password" placeholder="Contraseña" name="contrasena" required>
                        <br>
                    </li>
                </ul>
            </div>
            <div class="col-12 center">
                <input type="submit" name="action" value="Iniciar sesion" class="btn btn-secondary separa textSize">
                <input type="submit" name="action" value="Registrarse" class="btn btn-secondary separa textSize">
            </form>
            </div>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
</body>
</html>
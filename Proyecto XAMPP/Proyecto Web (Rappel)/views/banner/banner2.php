<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappel Inicio</title>
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-Crpepeyo/css/framework.css">
    <link rel="stylesheet" href="banner.css">
</head>
<body class="container-fluid container-XL bg-light">
    <nav class="navbar" style="width: 100%;">
        <div class="col-12 col-M-4">
            <a href="../index.php" class="navbar-brand"><img src="../../../Proyecto Web (Rappel)/views/banner/logo.png" alt="" width="100%"></a>
            <ul style="display: flex; justify-content: space-between;">
                <li id="face"><a href="https://www.facebook.com/rappel.souvenirs" style="text-decoration: none;">Rappel <br> Sublimados</a></li>
                <li id="whats">44 43 36 09 05</li>
            </ul>
        </div>
        <button class="navbar-toggle" type="button">
            -
        </button>
        <div class="col-12 col-M-6">
                <h2 class="text-primary" style="text-align: center;">Crea la tuya</h2>
                <ul class="border bg-warning" style="display: flex; justify-content: space-around; list-style: none; padding: 0; flex-wrap: wrap;">
                    <li >
                        <a href="../../../Proyecto Web (Rappel)/views/producto_hacer/producto.php?id=1" class="nav-link">
                            Playera
                        </a>
                    </li>
                    <li>
                        <a href="../../../Proyecto Web (Rappel)/views/producto_hacer/producto.php?id=2" class="nav-link">
                            Sudadera
                        </a>
                    </li>
                    <li>
                        <a href="../../../Proyecto Web (Rappel)/views/producto_hacer/producto.php?id=3" class="nav-link">
                            Chamarra
                        </a>
                    </li>
                    <li>
                        <a href="../../../Proyecto Web (Rappel)/views/producto_hacer/producto.php?id=4" class="nav-link">
                            Gorra
                        </a>
                    </li>
                    <li>
                        <a href="../../../Proyecto Web (Rappel)/views/producto_hacer/producto.php?id=5" class="nav-link">
                            Vaso
                        </a>
                    </li>
                </ul>
        </div>
        <div class="col-12 col-M-2">
            <div class="navbar-collapse">
                <ul class="navbar-nav" style="display: inline-block;">
                    <li class="nav-item">
                        <a id="inicio" href="../index.php" class="nav-link">
                            Inicio
                        </a>
                    </li>
                    <form action="../../../Proyecto Web (Rappel)/controllers/loginController.php" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <li class="nav-item">
                            <p style="margin:0; cursor:pointer" id="usuario" class="nav-link" onclick="cerrarSesion()">
                                <input  id="btnCerrar" type="submit" value="Cerrar sesion" style="display: none;">
                                Cerrar sesion
                            </p>
                        </li>
                    </form>
                    
                    <li class="nav-item">
                        <a id="compras" href="../../../Proyecto Web (Rappel)/views/compras/compras.php" class="nav-link">
                            Mis compras
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a id="perfil" href="../../../Proyecto Web (Rappel)/views/perfil/perfil.php" class="nav-link">
                            Mi perfil
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://fundamentos2122.github.io/framework-css-Crpepeyo/Js/framework.js"></script>
    <script>

        
        function cerrarSesion()
        {
            var btnCerrarInput=document.getElementById("btnCerrar");
            if(btnCerrarInput!=null)
            {
                btnCerrarInput.click()
            }
        }
    </script>
</body>
</html>
<?php

include("../models/DB.php");
include("../models/Producto_admin.php");

try
{
    $connection = DBConnection::getConnection();
}
catch(PDOException $e)
{

    error_log("Error de conexion - " . $e,0);
    header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/error.php?error=ERROR DE CONEXION A LA BASE DE DATOS");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    
    if (array_key_exists("id",$_GET)) 
    {
        //Traer la informacion de un elemento 
        $id=$_GET["id"];
        try 
        {
            $query=$connection->prepare("SELECT * FROM producto_admin WHERE id=:id");
            $query->bindParam(":id",$id,PDO::PARAM_INT);
            $query->execute();    
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $producto = new Producto_admin($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]);
                
                $producto->returnJson();
            }
            exit();
            
        } 
        catch (PDOException $e) 
        {
            error_log("Error en query - " . $e,0);
            exit();
        }
    }
    else 
    {
        //Traer el listado de todos los registros
        try 
        {

            try 
            {
                $query=$connection->prepare("SELECT * FROM producto_admin");
                $query->execute();  
                
                while($row = $query->fetch(PDO::FETCH_ASSOC))
                {
                    
                    $producto = new Producto_admin($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]);
                    
                    echo "<div class='col-4' style='padding: 1%;'>" .
                    "<div class='center parent'>" . 
                        "<a href='../producto_hecho/producto_admin.php?id=" .$producto->getId() . "'>" .
                            "<img src=\"data:image/jpeg;base64," . $producto->getFotoTipo() . "\" alt='' class='imageC1'>" .
                            "<img src=\"data:image/png;base64," . $producto->getFotoDiseno() . "\" alt='' class='imageC2'>" .
                        "</a>" .
    
                    "</div>" .
                    "<div class='center parent'>" .
                        "<p id='descripcion'>". $producto->getDescripcion() . "</p>" .
                    "</div>" .
                    "</div>" ;
                }
            } 
            catch (PDOException $e) 
            {
                error_log("Error en query - " . $e,0);
                exit();
            }
            //Carrusel
            /*$query=$connection->prepare("SELECT id FROM producto ORDER BY RAND() LIMIT 1");
            $query->execute();    
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $random1=$row["id"];
            $query=$connection->prepare("SELECT id FROM producto ORDER BY RAND() LIMIT 1");
            $query->execute();    
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $random2=$row["id"];
            $query=$connection->prepare("SELECT id FROM producto ORDER BY RAND() LIMIT 1");
            $query->execute();    
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $random3=$row["id"];
        
            $query=$connection->prepare("SELECT * FROM producto WHERE id='$random1'");
            $query->execute();    
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $producto1 = new Producto($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]);
            
            $query=$connection->prepare("SELECT * FROM producto WHERE id='$random2'");
            $query->execute(); 
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $producto2 = new Producto($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]);
            

            $query=$connection->prepare("SELECT * FROM producto WHERE id='$random3'");
            $query->execute();    
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $producto3 = new Producto($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]);
            echo 
                "<div class='col-2 center parent'>" .
                    "<img src=\"data:image/jpeg;base64," . $producto1->getFotoTipo() . "\" alt='' class='image1'>" .
                    "<img src=\"data:image/png;base64," . $producto1->getFotoDiseno() . "\" alt='' class='image2'>" .
                "</div>" .
                "<div class='col-8' style='padding: 0;'>" .
                "<div class='center parent'>" . 
                    "<button class='btn btn-info flechaI'> &lt;- </button>" .
                    "<a href='../views/producto_hecho/producto.php?id=" .$producto2->getId() . "'>" .
                        "<img src=\"data:image/jpeg;base64," . $producto2->getFotoTipo() . "\" alt='' class='imageC1'>" .
                        "<img src=\"data:image/png;base64," . $producto2->getFotoDiseno() . "\" alt='' class='imageC2'>" .
                    "</a>" .
                    "<button class='btn btn-info flechaD'> -> </button>" .
                "</div>" .
                "<div class='center parent'>" .
                    "<p id='descripcion'>". $producto2->getDescripcion() . "</p>" .
                "</div>" .
            "</div>" .
            "<div class='col-2 center'>" .
                "<img src=\"data:image/jpeg;base64," . $producto3->getFotoTipo() . "\" alt='' class='image1'>" .
                "<img src=\"data:image/png;base64," . $producto3->getFotoDiseno() . "\" alt='' class='image2'>" .
           "</div>";*/
            
        } 
        catch (PDOException $e) 
        {
            error_log("Error en query - " . $e,0);
            exit();
        }     
    }
}

if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
    if($_POST["_method"]=="POST")
    {
        
        //Guardar Registro
        $tipo=$_POST["tipo"];
        $descripcion=$_POST["descripcion"];
        $precio="";
        if(key_exists("precio",$_POST))
        {
            $precio=$_POST["precio"];
        }
        $color=$_POST["color"];
        $talla=$_POST["talla"];
        $foto_tipo="";
        if ($_FILES["foto_tipo"]["tmp_name"]!="") 
        {
            $tmp_name_tipo=$_FILES["foto_tipo"]["tmp_name"];
            $foto_tipo=file_get_contents($tmp_name_tipo);
        }

        $foto_diseno="";
        if ($_FILES["foto_diseno"]["tmp_name"]!="") 
        {
            $tmp_name_diseno=$_FILES["foto_diseno"]["tmp_name"];
            $foto_diseno = file_get_contents($tmp_name_diseno);
        }
        
        try
        {
            $query=$connection->prepare('INSERT INTO producto_admin VALUES(NULL, :tipo, 
            :descripcion, :precio, :color, :talla, :foto_tipo, :foto_diseno)');
            $query->bindParam(':tipo',$tipo,PDO::PARAM_STR);
            $query->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
            $query->bindParam(':precio',$precio,PDO::PARAM_INT);
            $query->bindParam(':color',$color,PDO::PARAM_STR);
            $query->bindParam(':talla',$talla,PDO::PARAM_STR);
            $query->bindParam(':foto_tipo',$foto_tipo,PDO::PARAM_STR);
            $query->bindParam(':foto_diseno',$foto_diseno,PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() == 0) {
                //Error
                exit();
            }    
            header("Location:http://localhost/Proyecto Web (Rappel)/views/pagar/pagar.php");
        }
        catch (PDOException $e) 
        {
            var_dump($e);
            error_log("Error en query - " . $e,0);
            exit();
        }
    }
}

?>
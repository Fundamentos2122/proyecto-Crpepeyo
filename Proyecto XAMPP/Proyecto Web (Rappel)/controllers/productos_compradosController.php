<?php

include("../models/DB.php");
include("../models/Producto_comprado.php");
include("../models/Producto.php");

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
    if (!array_key_exists("id",$_GET)) 
    {
        //Traer el listado de todos los registros
        try 
        {
            
            session_start();
            $id=$_SESSION["id"];
            if (array_key_exists("historial",$_GET)) 
            {
                $query=$connection->prepare("SELECT producto_comprado.id,producto_comprado.cantidad,producto_comprado.fecha, producto.id as id_producto, producto.tipo, producto.descripcion, producto.precio, producto.color, producto.talla, producto.foto_tipo, producto.foto_diseno FROM producto_comprado INNER JOIN producto ON producto.id=producto_comprado.id_producto WHERE producto_comprado.id_usuario=:id AND producto_comprado.pagado=true");
            }
            else
                $query=$connection->prepare("SELECT producto_comprado.id,producto_comprado.cantidad,producto_comprado.fecha, producto.id as id_producto, producto.tipo, producto.descripcion, producto.precio, producto.color, producto.talla, producto.foto_tipo, producto.foto_diseno FROM producto_comprado INNER JOIN producto ON producto.id=producto_comprado.id_producto WHERE producto_comprado.id_usuario=:id AND producto_comprado.pagado=false");
            $query->bindParam(":id",$id,PDO::PARAM_INT);
            $query->execute();  
            
                   
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $producto = new Producto($row["id"],$row["tipo"],$row["descripcion"],$row["precio"],$row["color"],$row["talla"],$row["foto_tipo"],$row["foto_diseno"]); 
                echo 
                    "<div class='row border'>" .
                    "<div class='center parent col-2'>" . 
                        "<a href='../producto_hecho/producto.php?id=" . $producto->getId() . "'>" .
                            "<img src=\"data:image/jpeg;base64," . $producto->getFotoTipo() . "\" alt='' class='imageC1'>" .
                            "<img src=\"data:image/png;base64," . $producto->getFotoDiseno() . "\" alt='' class='imageC2'>" .
                        "</a>" .
                    "</div>" .
                    "<h3 class='space col-2'>". $producto->getDescripcion() ."</h3>" .
                    "<h3 class='space col-2'> Precio: $". $producto->getPrecio() ."</h3>" .
                    "<h3 class='space col-2'> Cantidad: ". $row["cantidad"] ."</h3>" .
                    "<h4 class='space col-2'> Fecha de compra: ". $row["fecha"] ."</h4>" .
                    "<form action='../../../Proyecto Web (Rappel)/controllers/productos_compradosController.php' method='POST' style='display:flex'" . 
                        "<input type='hidden' name='_method' value='DELETE'>" .
                        "<input type='hidden' name='id' value='". $row["id"] ."'>" .
                        "<input type='hidden' name='borrar' value='true'>" .
                        "<input type='submit' id='btnBorrar' value='Borrar' class='btn btn-danger borrar'>" .
                    "</form>"  .
                    "</div>" ;
                
                /*$producto_comprado = new Producto_comprado($row["id"],$row["id_producto"], $row["id_usuario"], $row["fecha"], $row["cantidad"]);    
                
                if ($id==$producto_comprado->getIdUsuario()) 
                {
                    try
                    {
                           
                        /*$id_producto=$producto_comprado->getIdProducto();
                        $query=$connection->prepare("SELECT * FROM producto WHERE id=:id");
                        $query->bindParam(":id",$id_producto,PDO::PARAM_INT);
                        $query->execute();
                        $rowProducto = $query->fetch(PDO::FETCH_ASSOC); 
                        $producto = new Producto($rowProducto["id"],$rowProducto["tipo"],$rowProducto["descripcion"],$rowProducto["precio"],$rowProducto["color"],$rowProducto["talla"],$rowProducto["foto_tipo"],$rowProducto["foto_diseno"]); 
                        
                        
                    }
                    catch (PDOException $e) 
                    {
                        var_dump($e);
                        error_log("Error en query - " . $e,0);
                        exit();
                    }
                    
                } */
            }
            } 
            catch (PDOException $e) 
            {
                var_dump($e);
                error_log("Error en query - " . $e,0);
                exit();
            }
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if($_POST["_method"]=="POST")
    {
        try
        {
            //Anadir al carrito
            $id_producto=$_POST["id"];
            session_start();
            $id_usuario=$_SESSION["id"];
            date_default_timezone_set('America/Mexico_City');
            $fecha= date('d/m/Y h:i:s a', time());
            $cantidad=$_POST["cantidad"];
            $pagado=false;
            
            $query=$connection->prepare('INSERT INTO producto_comprado VALUES(NULL,:id_producto, 
            :id_usuario, :fecha, :cantidad, :pagado)');
            $query->bindParam(':id_producto',$id_producto,PDO::PARAM_INT);
            $query->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
            $query->bindParam(':fecha',$fecha,PDO::PARAM_STR);
            $query->bindParam(':cantidad',$cantidad,PDO::PARAM_INT);
            $query->bindParam(':pagado',$pagado,PDO::PARAM_BOOL);
            $query->execute();
            if ($query->rowCount() == 0) 
            {
                //Error
                var_dump("error");
                exit();
            }
            header("Location:http://localhost/Proyecto Web (Rappel)/views/compras/compras.php");
        }
        catch (PDOException $e) 
        {
            var_dump($e);
            error_log("Error en query - " . $e,0);
            exit();
        }
    }
    else if($_POST["_method"]=="PUT")
    {
        //Actualizar dato
        try
        {
            session_start();
            $id=$_SESSION["id"];
            $query=$connection->prepare('UPDATE producto_comprado SET pagado=true WHERE id_usuario=:id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() == 0) 
            {
                //Error
                var_dump("error");
                header("Location:http://localhost/Proyecto Web (Rappel)/views/compras/compras.php");
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
    else if($_POST["borrar"]=="true")
    {
        //Eliminar
        $id=$_POST["id"];
        var_dump($id);
        try 
        {
            $query=$connection->prepare('DELETE FROM producto_comprado WHERE id=:id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();

            if ($query->rowCount() == 0) 
            {
                //Error
                exit();
            }
            
            header("Location: http://localhost/Proyecto%20Web%20(Rappel)/views/compras/compras.php");
        } 
        catch (PDOException $e) 
        {
            error_log("Error en query - " . $e,0);
            exit();
        }
    }
}


?>
<?php 

    require_once("conecta.php");    
                $nombre=$_GET['nombreProducto'];
                $precio=$_GET['precio'];
                $existencia=$_GET['existencia'];
                $marca=$_GET['miselect'];
    mysqli_query($con,"insert into producto (nombreProducto, precio, existencia, idMarca) values(\"$nombre\", \"$precio\", \"$existencia\", \"$marca\")");
    
    header("location:productos.php");
?>
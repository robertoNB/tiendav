<?php
if(!isset($_SESSION))
session_start();
$idUsuario=$_SESSION["idUsuario"];

require_once("conecta.php");
mysqli_query($con,"INSERT venta (fecha,idUsuario) values(now(),$idUsuario)");
    $resVta=mysqli_query($con,"SELECT * FROM venta WHERE idUsuario=$idUsuario ORDER BY fecha DESC LIMIT 1");
    while($file=mysqli_fetch_array($resVta)){
        $idVenta=$file["idVenta"];
    }
    $resultado=mysqli_query($con,"SELECT SUM(precio*cantidad) as total, b.idProducto, a.cantidad FROM carrito a inner join producto b on 
                            (a.idProducto = b.idProducto) WHERE idUsuario=$idUsuario");
    while($row=mysqli_fetch_array($resultado)){
        $idProd=$row['idProducto'];
        $cantidad=$row['cantidad'];
        $total=$row["total"];
        mysqli_query($con,"INSERT detalleventa (idProducto,idVenta,cantidad) values($idProd,$idVenta,$cantidad)");
        mysqli_query($con,"UPDATE producto SET existencia=(existencia-$cantidad) WHERE idProducto=$idProd");

    }
    mysqli_query($con,"DELETE FROM carrito WHERE idUsuario=$idUsuario");
    mysqli_query($con,"UPDATE venta SET total=$total WHERE idUsuario=$idUsuario AND idVenta=$idVenta");
    header("location:index.php");


?>
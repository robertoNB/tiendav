<?php
require_once("conecta.php");
require_once("Proteccion.php");
$cantidad=$_POST["cantidad"];
$idProducto=$_POST["idProducto"];
$idUsr=$_SESSION["idUsuario"];
if(mysqli_query($con,"UPDATE carrito SET cantidad=$cantidad WHERE idUsuario=$idUsr AND idProducto=$idProducto"))
{echo json_encode("El carrito se actualizo correctamente"); 
header("location:carrito.php");
}
else{
echo json_encode ("No se actualizo correctamente");
header("location:carrito.php");
}
?>
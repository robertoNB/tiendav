<?php
require_once("../conecta.php");
$action=$_POST["action"];


if($action=="getCarrito")
    obtenerCarrito($con);

if($action=="setCarrito"){
    $idProducto=$_POST["idProducto"];
    $idUsuario=$_SESSION["idUsuario"];
    insertarCarrito($con,$idProducto,$idUsuario);
}

if ($action=="updateCarrito")
{
    $idProducto=$_POST["idProducto"];
    $idUsuario=$_SESSION["idUsuario"];
    actualizarCarritp($con,$idProducto,$idUsuario);
}


if ($action=="deleteCarrito")
{
    $idProducto=$_POST["idProducto"];
    $idUsuario=$_SESSION["idUsuario"];
    eliminarCarrito ($con,$idProducto,$idUsuario);
}
function obtenerCarrito($con){
    $resultado=mysqli_query($con,"select * from carrito");
    $respuesta=array();
    //contruir una asociacion fetch_assoc
    while($row=mysqli_fetch_assoc($resultado))
        $respuesta[]=$row;
    echo json_encode($respuesta);
}

function insertarCarrito($con,$idProducto,$idUsuario){
    mysqli_query($con,"UPDATE carrito SET cantidad=(cantidad+1) WHERE idUsuario=$idUsuario AND idProducto=$idProducto");
    if(mysqli_query($con,"INSERT carrito(idProducto, idUsuario,cantidad) values($idProducto,$idUsuario,1)")){
        echo json_encode("El carrito se inserto correctamente");
    }else{
        echo json_encode ("No se inserto correctamente");<
    }
}

function actualizarCarritp($con,$idProducto,$idUsuario){
    if(mysqli_query($con,"UPDATE carrito SET cantidad=(cantidad+1) WHERE idUsuario=$idUsuario AND idProducto=$idProducto"))
        echo json_encode("El carrito se actualizo correctamente"); 
    else
        echo json_encode ("No se actualizo correctamente");
}

function eliminarCarrito ($con,$idProducto,$idUsuario)){
        if(mysqli_query($con,"DELETE FROM carrito WHERE idUsuario=$idUsuario AND idProducto=$idProducto"))
            echo json_encode("El carrito se elimino correctamente"); 
        else
            echo json_encode ("No se elimino correctamente");
}

?>
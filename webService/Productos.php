<?php
require_once("../conecta.php");
$action=$_POST["action"];

    if($action=="getProductos")
        obtenerProductos($con);

    if($action=="setProducto"){
        $nomProducto=$_POST["nomProducto"];
        $precio=$_POST["precio"];
        $existencia=$_POST["existencia"];
        $idMarca=$_POST["idMarca"];
        insertarProducto($con,$nomProducto,$precio,$existencia,$idMarca);
    }
    if ($action=="updateProducto")
    {
        $id=$_POST["idProducto"];
        $nomProducto=$_POST["nomProducto"];
        $precio=$_POST["precio"];
        $existencia=$_POST["existencia"];
        $idMarca=$_POST["idMarca"];
        actualizarProducto($con,$id,$nomProducto,$precio,$existencia,$idMarca);
    }
    if ($action=="deleteProducto")
    {
        $id=$_POST["idProducto"];
        eliminarProducto($con,$id);
    }
    function obtenerProductos($con){
        $resultado=mysqli_query($con,"select * from producto");
        $respuesta=array();
        //contruir una asociacion fetch_assoc
        while($row=mysqli_fetch_assoc($resultado)){
            $respuesta[]=$row;
        }
        echo json_encode($respuesta);
    }
    function insertarProducto($con,$nomProducto,$precio,$existencia,$idMarca){
        if(mysqli_query($con,"INSERT INTO producto (nomProducto,precio,existencia,idMarca) VALUES ('$nomProducto',$precio,$existencia,$idMarca)"))
             echo json_encode("el producto $nomProducto se inserto correctamente"); 
         else
             echo "No se agrego correctamente";
    }
    function actualizarProducto($con,$id,$nomProducto,$precio,$existencia,$idMarca){
        if(mysqli_query($con,"UPDATE producto SET nomProducto='$nomProducto',precio=$precio ,existencia=$existencia 
                            ,idMarca=$idMarca WHERE idProducto=$id"))
             echo json_encode("el producto $nomProducto se actualizo correctamente"); 
         else
             echo "No se actualizo correctamente";
    }
    function eliminarProducto($con,$id){
        if(mysqli_query($con,"DELETE FROM producto WHERE idMarca=$id"))
        echo json_encode("El producto se elimino correctamente"); 
    else
        echo json_encode ("No se elimino correctamente");
    }
?>
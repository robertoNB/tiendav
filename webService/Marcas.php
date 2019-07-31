<?php
require_once("../conecta.php");
$action=$_POST["action"];


if($action=="getMarcas")
    obtenerMarcas($con);
if($action=="setMarca"){
    $nomMarca=$_POST["nomMarca"];
    insertarMarca($con,$nomMarca);
}
if ($action=="updateMarca")
{
    $id=$_POST["idMarca"];
$nomMarca=$_POST["nomMarca"];
actualizarMarca($con,$id,$nomMarca);
}


if ($action=="deleteMarca")
{
    $id=$_POST["idMarca"];
    eliminarMarca ($con,$id);
}
function obtenerMarcas($con){
    $resultado=mysqli_query($con,"select * from marca");
    $respuesta=array();
    //contruir una asociacion fetch_assoc
    while($row=mysqli_fetch_assoc($resultado))
        $respuesta[]=$row;
    echo json_encode($respuesta);
}

function insertarMarca($con,$nomMarca){
    if(mysqli_query($con,"INSERT INTO marca(nomMarca) VALUES ('$nomMarca')"))
        echo json_encode("La marca $nomMarca se inserto correctamente"); 
    else
        echo "No se agrego correctamente";
}

function actualizarMarca($con,$id,$nomMarca){
    if(mysqli_query($con,"UPDATE marca SET nomMarca='$nomMarca' WHERE idMarca=$id"))
        echo json_encode("La marca $nomMarca se actualizo correctamente"); 
    else
        echo json_encode ("No se actualizo correctamente");
}

function eliminarMarca ($con,$id){
        if(mysqli_query($con,"DELETE FROM marca WHERE idMarca=$id"))
            echo json_encode("La marca se elimino correctamente"); 
        else
            echo json_encode ("No se elimino correctamente");
}

?>
<?php
	$id=$_POST["idProducto"];
    $nom=$_POST["nombreProducto"];
    $precio=$_POST['precio'];
    $existencia=$_POST['existencia'];
    $marca=$_POST['miselect'];
	include_once("conecta.php");
	if(mysqli_query($con,"update producto set nomProducto='".$nom."', precio='".$precio."',existencia='".$existencia."',idMarca='".$marca."' where idProducto=".$id)){
		echo"Se actualizo exitosamente";
		header("location:productos.php");
	}
	else
	{
		echo"No se pudo actualizar";
	}
?>
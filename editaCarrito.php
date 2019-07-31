<?php
require_once("Proteccion.php");
$id=$_GET["idProducto"];
$usr=$_SESSION["idUsuario"];

include_once("conecta.php");
$query=mysqli_query($con,"select * from carrito where idProducto=$id and idUsuario=$usr");
while($row= mysqli_fetch_array($query)){
$cantidad=$row["cantidad"];
}   
?>
<link rel="stylesheet" href="css/materialize.min.css">
<body>
<?php 
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" )
    include("layout/navbarAdmin.php"); 
else
    include("layout/navbarCte.php");

?>
<div class="container">
        <h4 class="center">Editar carrito</h4>
        <form id="formulario" action="updateCarrito.php" method="POST">
            <div class="input-field">
                <input type="hidden" name="idProducto" value="<?php echo$id;?>">
                <input type="text" class="text" name="cantidad" value="<?php echo $cantidad;?>">
                <label for="">cantidad</label>
            </div>
            <div class="row">
                <input id="btn" type="submit" value="Actualizar" class="btn">
            </div>
        </form>        
    </div>
    <div class="container" id="contenido">
        
    </div>
<script src="js/jquery-3.1.1.js"></script>
<script src="js/materialize.js"></script>
<script src="js/all.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
$("#btn").on("click", function(){
    $("#formulario").validate({
    rules:{
        cantidad:{
            required:true
        }
    },
    cantidad:{
        nomMarca:{
            required:"No puede ir vacio"
        }
    },
    errorElement:"div",
    errorClass:"error",
    errorPlacement: function(error, element){
        error.insertAfter(element);
    }
    });
});
</script>
</body>


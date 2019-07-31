<?php require_once("Proteccion.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("layout/head.php"); ?>
<body>
<?php 
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" )
    include("layout/navbarAdmin.php"); 
else
    include("layout/navbarCte.php");
?>
        <div class="card">
            <br>
            <h4 class="center">Gestion del Carrito</h4>
            <div class="container">
                <table>
                    <tr>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php 
            require_once("conecta.php");
            $usr=$_SESSION["idUsuario"];
            $resultado=mysqli_query($con,"select * from carrito a inner join usuario b on 
                            (a.idUsuario=b.idUsuario) inner join producto c on (a.idProducto = c.idProducto) where a.idUsuario=$usr");
            while($fila=mysqli_fetch_array($resultado))
            {
                $idprod=$fila['idProducto'];
                $nomProd=$fila['nomProducto'];
                $cantidad=$fila['cantidad']; 
                
                echo"<tr>";
                echo"<td>$nomProd</td>";
                echo"<td>$cantidad</td>";
                echo"<td><a class='btn green' href='editaCarrito.php?idProducto=$idprod'><i class='fas fa-pen'></i></a> 
                    <a class='btn red' href='borrarCarrito.php?idProducto=$idprod'><i class='fas fa-trash'></i></a></td>";
                echo"</tr>";
            }
            echo "<td><a class='btn green' href='venta.php'><i class='fas fa-hand-holding-usd'></i>Comprar</a>"
            ?>
                </table>
            </div>
        </div>
    </div>
    <?php include("layout/footer.php"); ?>
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(".dropdown-trigger").dropdown();
        $("#btnAlta").on("click", function () {
            $("#frmAlta").validate({
                rules: {
                    nomMarca: {
                        required: true,
                    }
                },
                messages: {
                    nomMarca: {
                        required: "No puede ir vacio",
                    }
                },
                errorElement: "div",
                errorClass: "error",
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
            });

        });
    </script>
</body>

</html>
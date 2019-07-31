<!DOCTYPE html>
<html lang="en">

<?php include("layout/head.php"); ?>
<body>
<?php 
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" )
    include("layout/navbarAdmin.php"); 
else
    include("layout/navbarCte.php");
?>
    <div class="container" id="contenido">
            <div class="row">
            <?php
       
       echo" <div class='row'>";
               require_once("conecta.php");
               $resultado=mysqli_query($con,"select * from producto a inner join marca b ON (a.idMarca=b.idMarca) ");
           while($fila=mysqli_fetch_array($resultado)){
                   $nombre=$fila['nomProducto'];
                   $precio=$fila['precio'];
                   $existencia=$fila['existencia'];
                   $nomMarca=$fila['nomMarca'];
                   $idprod=$fila['idProducto'];
               echo "
               <div class='col sl2 m3'>
                       <div class='card'>
                           <div class='card-image'>
                           <img src='images/i.jpg'>
                               <a class='btn center' data-id='$idprod'>Agrega <i class='fas fa-plus'></i></a>
                            
                       </div>
                       <div class='card-content'>
                            
                                 $nombre<br>
                                 $ $precio<br>
                                 $existencia<br>
                                 $nomMarca<br>
                       </div>
                       </div>
                   </div>";//fin echo2
               }
       echo"</div>";
           ?>                              
            </div>
        </div>    
    <?php include("layout/footer.php"); ?>
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(".dropdown-trigger").dropdown();
        $(".agregar").on("click",function(){
            //constructor, this sirve para a ser la accion al mismo elemento 
            var producto={ idProducto:$(this).data("id"), };
            $.ajax({
                method: "POST",
                url: "altaCarrito.php",
                data: producto,
                success: function(){
                    M.toast({html: 'Producto Agregado'});
                    $(".totalP").load("totalProductos.php");
                }
            });
        });
    </script>
</body>

</html>
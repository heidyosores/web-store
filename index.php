<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <?php include './plantilla/referencias.php'; ?>
</head>

<body id="container-page-index">
    <?php include './plantilla/navbar.php'; ?>
    
      

    <section id="new-prod-index">    
         <div class="container">
            <div class="page-header">
                <h1>Nuestros <small>productos recientes</small></h1>
            </div>
            <div class="row">
              	<?php
                  include 'MySQL/configServer.php';
                  include 'MySQL/consulSQL.php';
                  $consulta= ejecutarSQL::consultar("SELECT * FROM producto WHERE Stock > 0 AND Estado='Activo' ORDER BY id DESC LIMIT 7");
                  $totalproductos = mysqli_num_rows($consulta);
                  if($totalproductos>0){
                      while($fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                     <div class="thumbnail">
                       <img class="img-product" src="assets/img-products/<?php if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ echo $fila['Imagen']; }else{ echo "default.png"; } ?>">
                       <div class="caption">
                       		<h3><?php echo $fila['Marca']; ?></h3>
                            <p><?php echo $fila['NombreProd']; ?></p>
                            <?php if($fila['Descuento']>0): ?>
                             <p>
                             <?php
                             $pref=number_format($fila['Precio']-($fila['Precio']*($fila['Descuento']/100)), 2, '.', '');
                             echo $fila['Descuento']."% descuento: $".$pref; 
                             ?>
                             </p>
                             <?php else: ?>
                              <p>$<?php echo $fila['Precio']; ?></p>
                             <?php endif; ?>
                        <p class="text-center">
                            <a href="infoProd.php?CodigoProd=<?php echo $fila['CodigoProd']; ?>" class="btn btn-primary btn-sm btn-raised btn-block"><i class="fa fa-plus"></i>&nbsp; Detalles</a>
                        </p>
                       </div>
                     </div>
                </div>     
                <?php
                     }   
                  }else{
                      echo '<h2>No hay productos registrados en la tienda</h2>';
                  }  
              	?>  
            </div>
         </div>
    </section>
    

    <?php include './plantilla/footer.php'; ?>
</body>
</html>
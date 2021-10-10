<?php
    include './MySQL/configServer.php';
    include './MySQL/consulSQL.php';
    include './Tareas/securityPanel.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin</title>
    <?php include './plantilla/referencias.php'; ?>
</head>
<body id="container-page-configAdmin">
    <?php include './plantilla/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
          <div class="page-header">
            <h2>Panel de administración Minimarket Carmencita</h2>
          </div>
          <!--====  Nav Tabs  ====-->
          <ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
            <li>
              <a href="configAdmin.php?view=product">
                <i class="fa fa-cubes" aria-hidden="true"></i> Nuevo producto
              </a>
            </li>
            <!--<li>-->
            <!--  <a href="configAdmin.php?view=provider">-->
            <!--    <i class="fa fa-truck" aria-hidden="true"></i> &nbsp; Proveedores-->
            <!--  </a>-->
            <!--</li>-->
            <li>
              <a href="configAdmin.php?view=category">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i> Nueva categoría
              </a>
            </li>
            <!--<li>
              <a href="configAdmin.php?view=admin">
                <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Administradores
              </a>
            </li>
            
            <li>
              <a href="configAdmin.php?view=account">
                <i class="fa fa-address-card" aria-hidden="true"></i> &nbsp; Mi cuenta
              </a>
            </li>-->
          </ul>
          <?php
            $content=$_GET['view'];
            $WhiteList=["product","productlist","productinfo","provider","providerlist","providerinfo","category","categorylist","categoryinfo","admin","adminlist","order","bank","account"];
            if(isset($content)){
              if(in_array($content, $WhiteList) && is_file("./admin/".$content."-view.php")){
                include "./admin/".$content."-view.php";
              }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
              }
            }else{
              echo '<h3 class="text-center">Bienvenido al Panel de administración</h3>';
            }
          ?>
        </div>
    </section>
    <?php include './plantilla/footer.php'; ?>
</body>
</html>
<?php
	echo "<link rel='stylesheet' href='/CSS/sweetalert.css'>";
	echo "<script src='/js/jquery.min.js'></script>";
	echo "<script src='/js/sweetalert.min.js'></script>";
	
	session_start();
 include '../MySQL/configServer.php';
include '../MySQL/consulSQL.php';

	$codeProd=consultasSQL::clean_string($_POST['prod-codigo']);
	$nameProd=consultasSQL::clean_string($_POST['prod-name']);
	$cateProd=consultasSQL::clean_string($_POST['prod-categoria']);
	$priceProd=consultasSQL::clean_string($_POST['prod-price']);
	$marcaProd=consultasSQL::clean_string($_POST['prod-marca']);
	$stockProd=consultasSQL::clean_string($_POST['prod-stock']);
	$codePProd=consultasSQL::clean_string($_POST['prod-codigoP']);
	$estadoProd=consultasSQL::clean_string($_POST['prod-estado']);
	$adminProd=consultasSQL::clean_string($_POST['admin-name']);
	$descProd=consultasSQL::clean_string($_POST['prod-desc-price']);
	$imgName=$_FILES['img']['name'];
	$imgType=$_FILES['img']['type'];
	$imgSize=$_FILES['img']['size'];
	$imgMaxSize=5120;

	if($codeProd!="" && $nameProd!="" && $cateProd!="" && $priceProd!=""  && $marcaProd!="" && $stockProd!="" && $codePProd!=""){
		$verificar=  ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$codeProd."'");
		//$verificar= mysqli_query(ejecutarSQL::conectar(),"CALL ConsultarProductoCodigo('".$codeProd."')");
		
		$verificaltotal = mysqli_num_rows($verificar);
		if($verificaltotal<=0){
			if($imgType=="image/jpeg" || $imgType=="image/png"){
				if(($imgSize/1024)<=$imgMaxSize){
					chmod('../assets/img-products/', 0777);
					switch ($imgType) {
					  case 'image/jpeg':
						$imgEx=".jpg";
					  break;
					  case 'image/png':
						$imgEx=".png";
					  break;
					}
					$imgFinalName=$codeProd.$imgEx;
					if(move_uploaded_file($_FILES['img']['tmp_name'],"../assets/img-products/".$imgFinalName)){
						$SQL = "INSERT INTO producto (CodigoProd, NombreProd, CodigoCat, Precio, Descuento, Marca, Stock, RUCProveedor, Nombre, Estado, Imagen) VALUES ('$codeProd','$nameProd','$cateProd','$priceProd', 
						'$descProd','$marcaProd','$stockProd','$codePProd','$adminProd','$estadoProd', '$imgFinalName')";
						echo $SQL;
						if(mysqli_query(ejecutarSQL::conectar(), $SQL))
						
						{
							echo '<script>
								$(document).on("ready", function(){
								swal({
								  title: "Producto registrado",
								  text: "El producto se añadió a la tienda con éxito",
								  type: "success",
								  showCancelButton: true,
								  confirmButtonClass: "btn-danger",
								  confirmButtonText: "Aceptar",
								  cancelButtonText: "Cancelar",
								  closeOnConfirm: false,
								  closeOnCancel: false
								  },
								  function(isConfirm) {
								  if (isConfirm) {
									location.reload();
								  } else {
									location.reload();
								  }
								});
							});
							</script>';
						}else{
							echo '<script>swal("ERROR300", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
						}   
					}else{
						echo '<script>swal("ERROR301", "Ha ocurrido un error al cargar la imagen", "error");</script>';
					}  
				}else{
					echo '<script>swal("ERROR302", "Ha excedido el tamaño máximo de la imagen, tamaño máximo es de 5MB", "error");</script>';
				}
			}else{
				echo '<script>swal("ERROR303", "El formato de la imagen del producto es invalido, solo se admiten archivos con la extensión .jpg y .png ", "error");</script>';
			}
		}else{
			echo '<script>swal("ERROR", "El código de producto que acaba de ingresar ya está registrado en el sistema, por favor ingrese otro código de producto distinto", "error");</script>';
		}
	}else {
		echo '<script>swal("ERROR", "Los campos no pueden de estar vacíos, por favor verifique e intente nuevamente", "error");</script>';
	}
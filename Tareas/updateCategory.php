<?php
include '../MySQL/configServer.php';
include '../MySQL/consulSQL.php';
	echo "<link rel='stylesheet' href='/CSS/sweetalert.css'>";
	echo "<script src='/js/jquery.min.js'></script>";
	echo "<script src='/js/sweetalert.min.js'></script>";

$codeOldCatUp=consultasSQL::clean_string($_POST['categ-code-old']);
$nameCatUp=consultasSQL::clean_string($_POST['categ-name']);
$descCatUp=consultasSQL::clean_string($_POST['categ-descrip']);
if(consultasSQL::UpdateSQL("categoria", "Nombre='$nameCatUp',Descripcion='$descCatUp'", "CodigoCat='$codeOldCatUp'")){
    echo '<script>
        swal({
          title: "Categoría actualizada",
          text: "Los datos de la categoría se actualizaron con éxito",
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
            window.location.href = "/configAdmin.php?view=categorylist";
          } else {
            location.reload();
          }
        });
    </script>';
}else{
    echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}


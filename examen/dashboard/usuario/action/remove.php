<?php
  
  include ("../../../inc/conexion.php");

  $id = (isset($_POST['id']))?$_POST['id']:'';

  if($id==''){
    echo 'No se pudo obtener el ID del usuario';
    return;
  }

  try{
    $query = "DELETE FROM usuario WHERE id ='$id'";
    $result = mysqli_query($conn, $query);

    if($result){
      // echo "OK-El registro se ha actualizo con exito";
      echo "<script>
      alert('OK-El registro se ha eliminado con exito');
      document.location.href = 'index.php';
      </script>";
      // echo "El registro se ha eliminado con exito";
    }
  }catch(Exception $e){
    echo $e->getMessage();
    return;
  }
  
  mysqli_close($conn);
?>
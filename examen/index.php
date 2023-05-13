<?php
    include ("inc/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="google" value="notranslate" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listar Clientes</title>
    <link rel="icon" type="image/png" href="imagenes/coma-logo-verde.jpg" />
    <link rel="stylesheet" href="css/site.css?v=1" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fe768f460c.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php 
    include ("inc/base/header.php");
    ?>
    <section class="container" style="padding-top:60px;">
      <div class="row">
        <div class="col-12 mt-3">
          <figure>
            <img src="imagenes/coma-logo-4008.png" alt="" />
          </figure>
        </div>
        <div class="col-12 pt-2 pb-2">
          <span class="pull-start">Customer <b>Details</b></span>
          <a class="btn btn-sm btn-warning rounded-pill float-end" href="dashboard/usuario/add/">+ Add New</a>
        </div>  
        <div class="col-12">
            <?php
            try{
              $query = "";
                $query .= "SELECT id as ID, ";
                $query .= " nombre as Name, ";
                $query .= " apellido as Surname, ";
                $query .= " edad as Age, ";
                $query .= " correo_electronico as Email, ";
                $query .= " usuario.tipo_usuario as Type ";
                $query .= "FROM usuario ";

                $result = mysqli_query($conn, $query);
            }catch(Exception $e){
              echo 'Error: '.$e->getMessage(); 
            }
                
                $iTotal = 0;
            ?>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="text-center">
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Edad</th>
                  <th>Correo Electrónico</th>
                  <th>Tipo</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    while($row = mysqli_fetch_array($result)){
                      $iTotal++;
                      ?>
                        <tr id="User<?php echo $row['ID'] ?>" class="text-center">
                          <td><?php echo $row['ID'] ?></td>
                          <td><?php echo $row['Name'] ?></td>
                          <td><?php echo $row['Surname'] ?></td>
                          <td><?php echo $row['Age'] ?></td>
                          <td><?php echo $row['Email'] ?></td>
                          <td><?php echo $row['Type'] ?></td>
                          <td class="text-center">
                              <a class="dropdown-item" href="javascript:EliminarUsuario('<?php echo $row['ID']?>')"><i class="fa-solid fa-trash"></i> Eliminar</a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="10">Total: <?php echo $iTotal ?></td>
                    </tr>
                </tfoot>
              </table>
            </div>
            <p id="MessageText" class="messagebox <?php echo ($_SESSION['error']!='')?'error':''; ?>"><?php echo $_SESSION['error']; ?></p>
        </div>
      </div>
    </section>
    <script>
      function EliminarUsuario(idUser){
        
        $.ajax({
            type:'POST',
            url:'./action/remove.php',
            data:{ id: idUser },
            success:function(data){
                if(data.substring(0,2)=='OK'){
                    $('.messagebox').html(data.substring(3));
                    $('.messagebox').addClass('messagebox_info');
                    $('#Curso'+idUser).remove();
                }else{
                    $('.messagebox').html(data);
                    $('.messagebox').addClass('messagebox_error');
                }
            },error:function(a,b,c){
                $('.messagebox').html(c);
                $('.messagebox').addClass('messagebox_error');
            }
        });
      }
    </script>
  </body>
</html>
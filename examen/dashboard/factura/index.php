<?php
    include ("../../inc/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
        $page_title = 'Listar Facturas';
        // $page_base = '../../';
        include ("../../inc/base/head.php");
    ?>
  </head>
  <body>
    <?php 
    include ("../../inc/base/header.php");
    ?>
    <section class="container" style="padding-top:60px;">
      <div class="row">
        <div class="col-12 mt-3">
          <figure>
            <img src="../../imagenes/coma-logo-4008.png" alt="" />
          </figure>
        </div>
        <div class="col-12 pt-2 pb-2">
          <span class="pull-start">Invoice <b>Details</b></span>
          <a class="btn btn-sm btn-warning rounded-pill float-end" href="./add/">+ Add New</a>
        </div>  
        <div class="col-12">
            <?php
            try{
              $query = "";
                $query .= "SELECT id as ID, ";
                $query .= " id_usuario as User, ";
                $query .= " folio as Folio, ";
                $query .= " saldo as Balance, ";
                $query .= " fecha_facturacion as Billing, ";
                $query .= " factura.fecha_creacion as Creation ";
                $query .= "FROM factura ";

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
                  <th>ID Usuario</th>
                  <th>Folio</th>
                  <th>Saldo</th>
                  <th>Fecha Facturación</th>
                  <th>Fecha Creación</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    while($row = mysqli_fetch_array($result)){
                      $iTotal++;
                      ?>
                        <tr id="User<?php echo $row['ID'] ?>" class="text-center">
                          <td><?php echo $row['ID'] ?></td>
                          <td><?php echo $row['User'] ?></td>
                          <td><?php echo $row['Folio'] ?></td>
                          <td><?php echo $row['Balance'] ?></td>
                          <td><?php echo $row['Billing'] ?></td>
                          <td><?php echo $row['Creation'] ?></td>
                          <td class="text-center">
                              <a class="dropdown-item" href="javascript:EliminarFactura('<?php echo $row['ID']?>')"><i class="fa-solid fa-trash"></i> Eliminar</a>
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
      function EliminarFactura(idInvoice){
        
        $.ajax({
            type:'POST',
            url:'./action/remove.php',
            data:{ id: idInvoice },
            success:function(data){
                if(data.substring(0,2)=='OK'){
                    $('.messagebox').html(data.substring(3));
                    $('.messagebox').addClass('messagebox_info');
                    $('#Curso'+idInvoice).remove();
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
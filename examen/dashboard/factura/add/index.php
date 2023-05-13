<?php
    include ("../../../inc/conexion.php");

    // generar la consulta para extraer los datos
    $idUsuario = trim(isset($_GET['id_usuario'])?$_GET['id_usuario']:'');

    $bNuevo = true;
    
    $Folio = '';
    $Saldo = '';

    if($idFactura!=''){
      $query = "SELECT * FROM Factura WHERE id = '$idFactura'";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result)){
        //Existe el curso asi que lo buscamos
        $row = mysqli_fetch_array($result);

        $Folio = $row['folio'];
        $Saldo = $row['saldo'];
        $bNuevo = false;
      }

      $result->close();
    }

    if($bNuevo){
      $tituloForm = 'Agregar nueva factura';
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
        $page_title = 'Registro de factura';
        $page_base = '../../../';
        include ("../../../inc/base/head.php");
    ?>
  </head>
  <body>
    <?php 
        $page_base = '../../../';
        include ("../../../inc/base/header.php");
    ?>
    <section class="cursos">
      <div class="contenedoregistro">
        <div class="contenedorvideo">
          <div class="titulovideo">
            <h3><?php echo $tituloForm ?></h3>
          </div>
        </div>
        <div class="contenedor_info_centro">
          <!-- Comienza el metodo POST -->
          <form id="FormRegistro" method="POST" action="javascript:sendForm()">
            <input type="hidden" name="id" id="id" value="<?php echo $idFactura ?>" />
            <input type="hidden" name="id_usuario" id="id_usuario" value="" />
            <!-- Añadipo por mi -->
            <input class="elementos" type="text" name="folio" id="folio" placeholder="Escribe el folio" value="<?php echo $Folio ?>" required/>
            <input class="elementos" type="text" name="saldo" id="saldo" placeholder="Escribe el saldo" value="<?php echo $Saldo ?>" required/>
            <!-- Cambiado para que me permitiera registrar -->
            <div class="opciones">
            <button type="submit" class="btn_ingresar" name="btnAdd"><?php echo ($bNuevo)?'Agregar':'Editar'; ?></button>
            <button type="button" class="btn_ingresar" name="btnCancel"  onClick="pageBack()">Cancelar</button>
            </div>
          </form>
          <p id="MessageText" class="messagebox <?php echo ($_SESSION['error']!='')?'error':''; ?>"><?php echo $_SESSION['error']; ?></p>
        </div>
      </div>
    </section>
    <script>
      function pageBack(){
        window.location.href='../';
      }

      function sendForm(){
        var datos = $('#FormRegistro').serialize();

        //Se deshabilitan las cajas de texto y botones
        $('.btn_ingresar').prop('disabled',true);
        $('.elementos').prop('readonly',true);

        //Se quita el mensaje si tiene informacion
        $('.messagebox').removeClass('messagebox_error');
        $('.messagebox').removeClass('messagebox_info');

        $.ajax({
            type:'POST',
            url:'./action/save.php',
            data:datos,
            success:function(data){
                //Se habilitan las cajas de texto y botones
                $('.btn_ingresar').prop('disabled',false);
                $('.elementos').prop('readonly',false);
                //Se asigna un mensaje de informacion
                if(data.substring(0,2)=='OK'){
                  window.location.href='../';
                    $('.messagebox').html(data.substring(3));
                    $('.messagebox').addClass('messagebox_info');    
                }else{
                    $('.messagebox').html(data);
                    $('.messagebox').addClass('messagebox_error');
                }
            },error:function(a,b,c){
                //Se habilitan las cajas de texto y botones
                $('.btn_ingresar').prop('disabled',false);
                $('.elementos').prop('readonly',false);
                //Se asigna un mensaje de error
                $('.messagebox').html(c);
                $('.messagebox').addClass('messagebox_error');
            }
        });
      }
    </script>
  </body>
</html>
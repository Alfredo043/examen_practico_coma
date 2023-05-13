<?php
    include ("../../../inc/conexion.php");

    $bNuevo = true;
    
    $Nombre = '';
    $Apellido = '';
    $Edad = '';
    $Correo_electronico = '';

    if($idUsuario!=''){
      $query = "SELECT * FROM usuario WHERE id = '$idUsuario'";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result)){
        //Existe el curso asi que lo buscamos
        $row = mysqli_fetch_array($result);

        $Nombre = $row['nombre'];
        $Apellido = $row['apellido'];
        $Edad = $row['edad'];
        $Correo_electronico = $row['correo_electronico'];
        $bNuevo = false;
      }

      $result->close();
    }

    if($bNuevo){
      $tituloForm = 'Agregar nuevo usuario';
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
        $page_title = 'Registro de usuario';
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
            <input type="hidden" name="id" id="id" value="<?php echo $idUsuario ?>" />
            <!-- Añadipo por mi -->
            <input class="elementos" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre" value="<?php echo $Nombre ?>" required/>
            <input class="elementos" type="text" name="apellido" id="apellido" placeholder="Escribe el apellido" value="<?php echo $Apellido ?>" required/>
            <input class="elementos" type="text" name="edad" id="edad" placeholder="Escribe tú edad" value="<?php echo $Edad ?>" required/>
            <input class="elementos" rows="3" name="correo_electronico" id="correo_electronico" placeholder="Escribe tú gmail"><?php echo $Correo_electronico ?></input>
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
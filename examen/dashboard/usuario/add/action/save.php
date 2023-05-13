<?php
    session_start();
    include ("../../../../inc/conexion.php");
    
    $Nombre = (isset($_POST['nombre']))?$_POST['nombre']:'';
    $Apellido = (isset($_POST['apellido']))?$_POST['apellido']:'';
    $Edad = (isset($_POST['edad']))?$_POST['edad']:'';
    $Correo_electronico = (isset($_POST['correo_electronico']))?$_POST['correo_electronico']:'';

    if($Nombre==''){
        echo 'Falta el nombre';
        return;
    }

    if($Apellido==''){
        echo 'Falta el apellido';
        return;
    }

    if($Edad==''){
        echo 'Falta la edad';
        return;
    }

    if($Correo_electronico==''){
        echo 'Falta el gmail';
        return;
    }

    try{
        $query = "SELECT id FROM usuario WHERE correo_electronico = '$Correo_electronico'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)){
            echo 'El correo electronico ya esta registrado';
            return;
        }

        $result->close();
        
        $LastId = 0;

        //Buscamos el siguiente Id
        $query = "SELECT MAX(id) as LastId FROM usuario";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $LastId = $row['LastId'];
        }

        $result->close();
        
        //El ultimo id se suma uno para obtener el siguiente
        $NextId = $LastId + 1;

        $query = "";
        $query .= "INSERT INTO usuario(";
        $query .= "   id, ";
        $query .= "   nombre, ";
        $query .= "   apellido, ";
        $query .= "   edad, ";
        $query .= "   correo_electronico, ";
        $query .= "   tipo_usuario ";
        $query .= ")VALUES( ";
        $query .= "   $NextId, ";
        $query .= "   '$Nombre', ";
        $query .= "   '$Apellido', ";
        $query .= "   '$Edad', ";
        $query .= "   '$Correo_electronico', ";
        $query .= "   'cliente')"; //Tipo usuario - Cliente
        
        if(mysqli_query($conn, $query)){
            echo "OK-Usuario registrado correctamente";
        }else{
            echo "Error: ".mysqli_error($conn);
        }
    }catch(Exception $e){
        echo 'Error: '.$e->getMessage();
    }

    mysqli_close($conn);
?>
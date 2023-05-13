<?php
    session_start();
    include ("../../../../inc/conexion.php");

    $IdFactura = (isset($_POST['id']))?$_POST['id']:'';
    
    $Folio = (isset($_POST['folio']))?$_POST['folio']:'';
    $Saldo = (isset($_POST['saldo']))?$_POST['saldo']:'';

    date_default_timezone_set("America/Mexico_City");
    $fechaActual = date('Y-m-d H:i:s');

    if($Folio==''){
        echo 'Falta el folio';
        return;
    }

    if($Saldo==''){
        echo 'Falta el saldo';
        return;
    }

    try{
        $query = "SELECT id FROM factura WHERE folio = '$Folio'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)){
            echo 'El folio ya esta registrado';
            return;
        }

        $result->close();
        
        $LastId = 0;

        //Buscamos el siguiente Id
        $query = "SELECT MAX(id) as LastId FROM factura";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $LastId = $row['LastId'];
        }

        $result->close();
        
        //El ultimo id se suma uno para obtener el siguiente
        $NextId = $LastId + 1;

        $query = "";
        $query .= "INSERT INTO factura(";
        $query .= "   id, ";
        $query .= "   folio, ";
        $query .= "   saldo, ";
        $query .= "   fecha_facturacion, ";
        $query .= "   fecha_creacion ";
        $query .= ")VALUES( ";
        $query .= "   $NextId, ";
        $query .= "   '$Folio', ";
        $query .= "   '$Saldo', ";
        $query .= "   '$fechaActual', "; //Fecha actual
        $query .= "   '$fechaActual')"; //Fecha actual
        
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
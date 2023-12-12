<?php
include '../configuraciones/bd.php';
$conexionBD=BD::crear_instancia();
$id='';
$modelo='';
$color_veh= '';
$marca_veh= '';
$tipo_veh= '';
$afi_veh= '';
$date_soat= '';
$date_tec= '';
$date_lic= '';
$estado= '';
//print_r($_POST);
//mostrando los vehiculos en la tabla de vista_vehiculos
$sql = "SELECT placa_vehi,año_modelo_vehi,fecha_ven_soat_vehi,fecha_ven_tecno_vehi,fecha_ven_litran_vehi,estado,nom_color AS color,afi_id_vehi AS documento, nom_marca AS Marca, nom_tipo_vehi AS Tipo FROM vehiculos INNER JOIN colores  ON color_id_vehi = id_color INNER JOIN marcas  ON marca_id_vehi = id_marca INNER JOIN tipos_vehiculos ON tipo_id_vehi= id_tipo_vehi";
$stmt = $conexionBD->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $vehiculos = $stmt->fetchAll();
} else {
    // Manejar el error de preparación de la consulta.
    $error_message = "REGISTRO NO SE PUDO CONSULTAR";
    echo '<script language="javascript">  console.log("' . $error_message . '"); </script>';
}
//print_r($vehiculos);
//mostrando los colores de la tabla colores de la bd en el select del formulario
$sql1 = "SELECT * FROM colores";
$stmts = $conexionBD->prepare($sql1);
if ($stmts) {
    $stmts->execute();
    $listacolores = $stmts->fetchAll();
} else {
    // Manejar el error de preparación de la consulta.
    $error_message = "REGISTRO NO SE PUDO CONSULTAR";
    echo '<script language="javascript">  console.log("' . $error_message . '"); </script>';
}

//mostrando marcas de vehiculo
$sql2 = "SELECT * FROM marcas";
$stmts2 = $conexionBD->prepare($sql2);
if ($stmts2) {
    $stmts2->execute();
    $listamarcas = $stmts2->fetchAll();
} else {
    // Manejar el error de preparación de la consulta.
    $error_message = "REGISTRO NO SE PUDO CONSULTAR";
    echo '<script language="javascript">  console.log("' . $error_message . '"); </script>';
}
//mostrando tipos de vehiculos
$sql3 = "SELECT * FROM tipos_vehiculos";
$stmts3 = $conexionBD->prepare($sql3);
if ($stmts3) {
    $stmts3->execute();
    $listatipos = $stmts3->fetchAll();
} else {
    // Manejar el error de preparación de la consulta.
    $error_message = "REGISTRO NO SE PUDO CONSULTAR";
    echo '<script language="javascript">  console.log("' . $error_message . '"); </script>';
}
//mostrando afiliados
$sql4 = "SELECT * FROM afiliados";
$stmts4 = $conexionBD->prepare($sql4);
if ($stmts4) {
    $stmts4->execute();
    $listaafi = $stmts4->fetchAll();
} else {
    // Manejar el error de preparación de la consulta.
    $error_message = "REGISTRO NO SE PUDO CONSULTAR";
    echo '<script language="javascript">  console.log("' . $error_message . '"); </script>';
}




//pasos para insertar los datos que vienen del formulario a la base de datos de vehliculos.

if (isset($_POST['id']) && trim($_POST['id']) === '' || isset($_POST['modelo']) && trim($_POST['modelo']) === '' || isset($_POST['color_veh']) && trim($_POST['color_veh']) === '' 
|| isset($_POST['marca_veh']) && trim($_POST['marca_veh']) === '' || isset($_POST['tipo_veh']) && trim($_POST['tipo_veh']) === ''
|| isset($_POST['afi_veh']) && trim($_POST['afi_veh']) === '' || isset($_POST['date_soat']) && trim($_POST['date_soat']) === '' || isset($_POST['date_tec']) && trim($_POST['date_tec']) === ''
|| isset($_POST['date_lic']) && trim($_POST['date_lic']) === '' || isset($_POST['estado']) && trim($_POST['estado']) === '') 
{
   echo '<script language="javascript">alert("FALTA ALGÚN DATO DEL VEHICULO");</script>';
}

else
{
    $id= isset($_POST['id'])?$_POST['id']:'';
    $modelo= isset($_POST['modelo'])?$_POST['modelo']:'';
    $color_veh= isset($_POST['color_veh'])?$_POST['color_veh']:'';
    $marca_veh= isset($_POST['marca_veh'])?$_POST['marca_veh']:'';
    $tipo_veh= isset($_POST['tipo_veh'])?$_POST['tipo_veh']:'';
    $afi_veh= isset($_POST['afi_veh'])?$_POST['afi_veh']:'';
    $date_soat= isset($_POST['date_soat'])?$_POST['date_soat']:'';
    $date_tec= isset($_POST['date_tec'])?$_POST['date_tec']:'';
    $date_lic= isset($_POST['date_lic'])?$_POST['date_lic']:'';
    $estado= isset($_POST['estado'])?$_POST['estado']:'';
    $accion= isset($_POST['accion'])?$_POST['accion']:'';

    if ($accion!='')
    {
        switch($accion)
        {
           case 'guardar':
               
                $sql="insert into vehiculos (placa_vehi,año_modelo_vehi,color_id_vehi,marca_id_vehi,tipo_id_vehi,fecha_ven_soat_vehi,fecha_ven_tecno_vehi,fecha_ven_litran_vehi,afi_id_vehi,estado) values (:id,:modelo,:color_veh,:marca_veh,:tipo_veh,:date_soat,:date_tec,:date_lic,:afi_veh,:estado)";//insertar datos a la tabla vehiculos
                $consulta=$conexionBD->prepare($sql);//preparacion consulta para poder ejecutarla
                $consulta->bindParam(':id',$id);//valores que vienen del formulario
                $consulta->bindParam(':modelo',$modelo);
                $consulta->bindParam(':color_veh',$color_veh);
                $consulta->bindParam(':marca_veh',$marca_veh);
                $consulta->bindParam(':tipo_veh',$tipo_veh);
                $consulta->bindParam(':afi_veh',$afi_veh);    
                $consulta->bindParam(':date_soat',$date_soat);
                $consulta->bindParam(':date_tec',$date_tec);
                $consulta->bindParam(':date_lic',$date_lic);        
                $consulta->bindParam(':estado',$estado);
                
                try {
                    $consulta->execute();
                    echo '<script language="javascript">  alert("SE REGISTRO EL VEHICULO"); </script>';
                    
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        echo '<script language="javascript">  alert("Error: LA PLACA YA EXISTE."); </script>';
                    } else {
                        echo '<script language="javascript">  alert("Error inesperado al registrar el vehiculo."); </script>';
                    }
                }
            break;

            case 'Selecionar':
                $sql = "SELECT * FROM vehiculos WHERE placa_vehi = :id";
                $consulta = $conexionBD->prepare($sql);
                $consulta->bindParam(':id', $id);
                $consulta->execute();
            
                // Verifica si la consulta encontró resultados
                if ($i = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $id = $i['placa_vehi'];
                    $modelo = $i['año_modelo_vehi'];
                    $color_veh = $i['color_id_vehi'];
                    $marca_veh = $i['marca_id_vehi'];
                    $tipo_veh = $i['tipo_id_vehi'];
                    $afi_veh = $i['afi_id_vehi'];
                    $date_soat = $i['fecha_ven_soat_vehi'];
                    $date_tec = $i['fecha_ven_tecno_vehi'];
                    $date_lic = $i['fecha_ven_litran_vehi'];
                    $estado = $i['estado'];
                    
                    
            
                    // Utiliza una variable diferente para el segundo conjunto de consultas
                    //muestra los datos cuando se selleciona acciones seleccionar
                    $idConsulta = $i['placa_vehi'];            
                    /*$sqls = "SELECT colores.id_color from vehiculos INNER JOIN colores on colores.id_color= vehiculos.color_id_vehi WHERE vehiculos.placa_vehi=:idConsulta";
                    $consultas = $conexionBD->prepare($sqls);
                    $consultas->bindParam(':idConsulta', $id);
                    $consultas->execute();
                    $datos_vehi = $consultas->fetchAll(PDO::FETCH_ASSOC);
                    print_r($datos_vehi);

                    foreach ($datos_vehi as $x) {
                        echo $x['id_color'];
                        $arreglo_vehi[]=$x['id_color'];
                    } */    

                    //consulta marca en input marcas
                    //$sqls = "select marcas.id_marca FROM vehiculos INNER join marcas on marcas.id_marca = vehiculos.marca_id_vehi WHERE vehiculos.placa_vehi =:idConsultac";
                    $sqls ="SELECT marcas.id_marca 
                    FROM vehiculos 
                    INNER JOIN marcas ON marcas.id_marca = vehiculos.marca_id_vehi 
                    INNER JOIN afiliados ON afiliados.id_documento_afi = vehiculos.afi_id_vehi 
                    WHERE vehiculos.placa_vehi = :idConsultac";
                    $consultas = $conexionBD->prepare($sqls);
                    $consultas->bindParam(':idConsultac', $id);
                    $consultas->execute();
                    $datos_vehi = $consultas->fetchAll(PDO::FETCH_ASSOC);
                    print_r($datos_vehi);

                    foreach ($datos_vehi as $x) {
                        echo $x['id_marca'];
                        $arreglo_vehi[]=$x['id_marca'];
                    }   

                    
                                     
                    

                } else {
                    // Aquí puedes manejar el caso en el que no se encontraron resultados, por ejemplo:
                    echo '<script language="javascript">  alert("No se encontraron datos para el documento especificado."); </script>';
                }
            
                break;
                       

            
        }
            


    }

    

}	


?>
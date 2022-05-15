<?php
header('Content-Type: application/json');
require_once("utils.php");

$method = strtoupper( $_SERVER['REQUEST_METHOD'] );


if ( $method === 'POST' ) {//Guardar datos

    //Obtener el token y validarlo
    $jwt=utils::getBearerToken();
    $valid=utils::validarToken($jwt);
    
    if($valid){
        include("conexion.php");

        $json = file_get_contents('php://input');
        
        //Validar que la información enviada no este en blanco
        if(empty($json)){
            http_response_code(400);
            exit("Por favor verifique sus datos");
        }
        
        //Validar que la información enviada sea un JSON
        if(json_decode($json) === null){
            http_response_code(400);
            exit("Por favor verifique la estructura de la información enviada");
        }

        //Obtener la información codificada en JSON
        $data=json_decode($json);

        // print_r($data);
        // exit();

        //Validar que vengan todos los campos necesarios
        if(!property_exists($data,'nombre') || !property_exists($data,'estado') || !property_exists($data,'usuarios')){
            http_response_code(400);
            exit("Estructura inválida");
        }

        // Comprobar que venga la lista de usuarios en un array
        if(!is_array($data->usuarios)){
            http_response_code(400);
            exit("Lista de usuarios inválida");
        }

        //Insertar en la base de datos
        $consOfertas="INSERT INTO `api_prueba`.`ofertas`(`nombre_oferta`, `estado`) VALUES ('".$data->nombre."','".$data->estado."')";
        $sqlOfertas=mysqli_query($conexion_mysql,$consOfertas); 
        $newID=mysqli_insert_id($conexion_mysql);

        //Mostrar los mensajes de respuesta dependiendo del resultado
		if($sqlOfertas){

            $relUsers=$data->usuarios;

            foreach ($relUsers as $value) {
                $consRel="INSERT INTO `api_prueba`.`rel_oferta_usuario`(`id_oferta`, `id_usuario`) VALUES ('".$newID."','".$value."')";
                $sqlRel=mysqli_query($conexion_mysql,$consRel); 

                if(!$sqlRel){
                    http_response_code(400);
                    $res=array(
                        "Codigo" => mysqli_errno($conexion_mysql),
                        "Mensaje" => "Error al insertar los datos: ".mysqli_error($conexion_mysql)
                    );

                    echo json_encode($res);
                }
            }

            $res=array(
                "Codigo" => 0,
                "Mensaje" => "Datos insertados correctamente",
                "ID" => $newID
            );

            echo json_encode($res);
        }else{
            http_response_code(400);
            $res=array(
                "Codigo" => mysqli_errno($conexion_mysql),
                "Mensaje" => "Error al insertar los datos: ".mysqli_error($conexion_mysql)
            );

            echo json_encode($res);
        }

    }else{
        http_response_code(400);
        exit(json_encode("Token inválido"));
    }
}elseif ( $method === 'GET' ) {//Consultar datos

    //Obtener el token y validarlo
    $jwt=utils::getBearerToken();
    $valid=utils::validarToken($jwt);

    if($valid){
        include("conexion.php");

        $where="";

        //Validar si se pasa el parámetro id
        if(isset($_GET['id']) && $_GET['id']!=""){
            $where="WHERE `id_oferta`=".$_GET['id'];
        }

        $consulta="SELECT * FROM `api_prueba`.`ofertas` $where";
        $sql=mysqli_query($conexion_mysql,$consulta);

        $rowRes=array();

        if($sql){
            $i=0;
            while($row=mysqli_fetch_assoc($sql)){
                $consUsers="SELECT * FROM `api_prueba`.`usuarios` WHERE id_usuario IN (SELECT id_usuario FROM `api_prueba`.`rel_oferta_usuario` WHERE id_oferta=".$row['id_oferta'].")";
                if($sqlUsers=mysqli_query($conexion_mysql,$consUsers)){
                    $j=0;
                    while($rowUsers=mysqli_fetch_assoc($sqlUsers)){
                        $row['usuarios'][$j]=$rowUsers;
                        $j++;
                    }
                    $rowRes[$i]=$row;
                }
                $i++;
            }
            $data=json_encode($rowRes);
            echo $data;
        }
    }else{
        http_response_code(400);
        exit(json_encode("Token inválido"));
    }
}
?>
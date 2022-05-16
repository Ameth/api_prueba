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

        //Validar que vengan todos los campos necesarios
        if(!property_exists($data,'nombre') || !property_exists($data,'tipo_documento') || !property_exists($data,'documento') || !property_exists($data,'correo')){
            http_response_code(400);
            exit("Estructura inválida");
        }

        //Insertar en la base de datos
        $consulta="INSERT INTO `usuarios`(`nombre`, `tipo_documento`, `documento`, `correo`) VALUES ('".$data->nombre."','".$data->tipo_documento."','".$data->documento."','".$data->correo."')";
        $sql=mysqli_query($conexion_mysql,$consulta); 

        //Mostrar los mensajes de respuesta dependiendo del resultado
		if($sql){
            $res=array(
                "Codigo" => 0,
                "Mensaje" => "Datos insertados correctamente",
                "ID" => mysqli_insert_id($conexion_mysql)
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
        //Validar que se pase el parámetro id
        if(isset($_GET['id']) && $_GET['id']!=""){
            $id=$_GET['id'];

            include("conexion.php");

            $consulta="SELECT * FROM `usuarios` WHERE `id_usuario`=$id";
            $sql=mysqli_query($conexion_mysql,$consulta); 
            if($sql){
                $row=mysqli_fetch_assoc($sql);
                if($row !== null){
                    $data=json_encode($row);
                    echo $data;
                }
            }
        }
    }else{
        http_response_code(400);
        exit(json_encode("Token inválido"));
    }
}
?>
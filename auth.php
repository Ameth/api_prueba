<?php
header('Content-Type: application/json');

require_once ('vendor/autoload.php');
require_once ('utils.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$method = strtoupper( $_SERVER['REQUEST_METHOD'] );

if ( $method === 'POST' ) {
    $json = file_get_contents('php://input');

    // $data=array(
    //     "usuario" => 'aordonez',
    //     "email" => 'amethgabriel@hotmail.com'
    // );
    
    if(empty($json)){
        http_response_code(400);
        exit("Autenticación incorrecta. Por favor verifique sus datos.");
    }
    
    if(json_decode($json) === null){
        http_response_code(400);
        exit("Autenticación incorrecta. Por favor verifique sus datos.");
    }
    
    $time = time();
    $exp_time=$time + 60 * 60 * 24; //Expira en una dia

    // echo $json;
    $data = array(
        'iat' => $time,
        'exp' => $exp_time,
        'data' => json_decode($json, true)
    );
    
    $token = JWT::encode($data,"Asdf1234$");
    
    echo json_encode(array("jwt" => $token));

}elseif( $method === 'GET'){
    try {
        $jwt=utils::getBearerToken();

        $decoded = JWT::decode($jwt, "Asdf1234$", ['HS256']);
        
        echo json_encode($decoded);
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

?>

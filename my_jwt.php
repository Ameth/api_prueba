<?php



class MY_JWT
{

    static public function encode($data)
    {
        include("conexion.php");

        $time = time();
        $exp_time=$time + 60 * 60 * 24; //Expira en una dia

        $token = array(
            'iat' => $time,
            'exp' => $exp_time,
            'data' => $data,
        );

        $newToken = MY_JWT::generateToken($token,'Asdf1234$');

        $consulta="INSERT INTO `api_prueba`.`jwt`(`jwt`, `iat`, `exp`) VALUES ('".$newToken."','".$time."','".$exp_time."')";
        
        $sql=mysqli_query($conexion_mysql,$consulta);
		if($sql){
            return $newToken;
        }else{
            return "Error en la base de datos";
        }

        
    }

    private static function generateToken($pToken, $pSecret_key){
        
        //Generamos las cabeceras del JWT
        $cabecera = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $cabeceraCodificada = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($cabecera));
        
        //Codificamos el Payload
        $datos = json_encode($pToken);
        $datosCodificados =  str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($datos));
        
        //Codificamos la clave secreta
        $claveSecreta = $pSecret_key;
        $firma = hash_hmac('sha256', $cabeceraCodificada. '.' . $datosCodificados, $claveSecreta, true);
        $firmaCodificada = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($firma));
        
        //Generamos el token final
        $tokenJWT = $cabeceraCodificada . '.' . $datosCodificados . '.' . $firmaCodificada;
        
        return $tokenJWT;
    }

    static public function validarToken($pToken, $pSecret_key){
        
        // Dividimos el token por cada '.' 
        $jwt_values = explode('.', $pToken);

        // Extraemos la firma del JWT original 
        $recieved_signature = $jwt_values[2];

        // Concatenamos los primeros 2 argumentos del array resultante, representados por el header y el payload
        $recievedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];

        // Creamos el base64 de la nueva firma generada al aplicar la funcion HMAC al header y el payload concatenados
        $resultedsignature = base64_encode(hash_hmac('sha256', $recievedHeaderAndPayload, $pSecret_key, true));

        // Chequear si la firma nueva creada es igual a la firma recibida del token
        if($resultedsignature == $recieved_signature) {
            return true;
        } else {
            return false;
        }
    }
}

?>

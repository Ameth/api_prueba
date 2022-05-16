<?php 

class utils
{
    //Obtener las cabeceras HTTP de la petición
    private static function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } 
        elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            // print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    
    //Obtener el token de la cabecera Authorization
    public static function getBearerToken() {
        $headers = utils::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function validarToken($pToken) {
        // $url = "http://localhost/api_prueba/auth.php";
        $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/"."auth.php";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array("Authorization: Bearer ".$pToken));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       
        $ret = curl_exec($ch);

        $ob = json_decode($ret);

        if(is_object($ob)){
            return true;
            // return $ob->data->nombre;
        }else{
            // return $ob;
            return false;
        }
    }
}

?>
<?php

class ADFunctions
{

    /**
     * Safe post method
     * Post metodunu olası saldırılara karşı güvenli kılan fonksiyon
     */
    function post($parameter, $condition = false)
    {
        if($condition == false){
            $result = strip_tags(trim($_POST[$parameter]]));
        }elseif($condition == true){
            $result = strip_tags(trim(addslashes($_POST[$parameter])));
        }
        return $result;
    }

    /**
     * Safe get method
     * Get metodunu olası saldırılara karşı güvenli kılan fonksiyon
     */
    function get($parameter, $condition = false)
    {
        if($condition == false){
            $result = strip_tags(trim($_GET[$parameter]));
        }elseif($condition == true){
            $result = strip_tags(trim(addslashes($_GET[$parameter])));
        }
        return $result;
    }

    /**
     * Shows the user's ip address.
     * Kullanıcının ip adresini görmenizi sağlayar.
     */
    function IP()
    {
        if(getenv("HTTP_CLIENT_IP")){
            $ip = getenv("HTTP_CLIENT_IP");
        }elseif(getenv("HTTP_X_FORWARDED_FOR")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if(strstr($ip, ',')){
                $tmp = explode(',', $ip);
                $ip = trim($tmp[0]);
            }
        }else{
            $ip = getenv("REMOTE ADDR");
        }
        return $ip;
    }
}

?>
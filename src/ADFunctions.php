<?php

class ADFunctions
{

    /**
     * Safe post method
     * Post metodunu olası saldırılara karşı güvenli kılan fonksiyon
     */
    public function post($parameter, $condition = false)
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
    public function get($parameter, $condition = false)
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
    public function IP()
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

    /**
     * makes the data url friendly.
     * Verilen girdiyi url dostu bir duruma getirir.
     */
    function sef_link($str)
    {
        $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
        $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
        $perma = strtolower(str_replace($preg, $match, $str));
        $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
        $perma = trim(preg_replace('/\s+/', ' ', $perma));
        $perma = str_replace(' ', '-', $perma);
        return $perma;
    }
}

?>
<?php

namespace App\Support;


class Helper
{

/**
* Get part of string.
* @param string $string
* @param int $start
* @param int $end
* @return string
*/
public static function shortString(string $string, int $start = 0, int $end = 35): string
  {
    return mb_substr($string, $start, $end, 'UTF-8').'...';
  }

  public static function getIp(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); 
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
    return request()->ip(); // ip adresini yakalayamazsa server ip sini getirecek
}
}
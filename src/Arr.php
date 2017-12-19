<?php

namespace Quadrogod\Helpers;

class Arr {        
     
    static function get(array $arr, $key, $default = NULL)
    {        
        if(strpos($key, '.')) 
        {
            $array = $arr; 
            foreach (explode('.', $key) as $segment) {                
                if (isset($array[$segment])) {
                    $array = $array[$segment];
                } else {
                    return $default;
                }
            }
            return $array;
        } 
        else 
        {
            return (isset($arr[$key])) ? $arr[$key] : $default;
        } 
    }
} 


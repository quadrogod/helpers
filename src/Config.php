<?php

namespace Quadrogod\Helpers;

class Config {
    
    /**
     * @var Config
     */
    private static $_instance = null;
 
    /**
     * @var array
     */
    private static $config;
    
    public static $path = null;
    
    private function __construct()
    {        
        if (self::$path) {
            if ( ! is_dir(self::$path)) 
                mkdir(self::$path, 0755, true);
            //
            return realpath(self::$path);
        } else {
            //self::$path = $_SERVER['DOCUMENT_ROOT']; 
            throw new \Exception('Set Config::$path before.');
        }
    }       

    static function get($key, $default = null)
    {        
        $keys = explode('.', $key);
        self::getInstance();
        //
        if ( ! isset(self::$config[$keys[0]]) ) {            
            self::$config[$keys[0]] = require (self::$path . '/' . mb_strtolower($keys[0]) . '.php');
        }
        //        
        return Arr::get(self::$config, $key, $default);             
    }
    
    /**
     * Returns the instance.
     * 
     * @static
     * @return Config
     */
    private static function getInstance() 
    {
        if (self::$_instance == null) {
            self::$_instance = new Self;
        }

        return self::$_instance;
    }
    
    private function __clone() {}
    private function __wakeup() {}

    public function __destruct() 
    {
        self::$_instance = null;
    }
    
}
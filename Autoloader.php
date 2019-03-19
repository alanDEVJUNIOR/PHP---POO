<?php
/** Charge automatique de nos class */
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    private static function autoload($class)
    {
        
        require $class.'.php';
    }

}
?>
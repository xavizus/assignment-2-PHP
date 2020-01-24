<?php
define("ROOT_DIR", __DIR__ . "/../../");
class Settings
{

    private $databaseConfigs = NULL;

    public function __construct()
    {
        try {
            /*
            Quick and dirty way to load an ini-file as an object instead of an array.
            */
            $filepath = ROOT_DIR.'/config.ini';
            $ini_array = json_decode(json_encode(parse_ini_file($filepath, true, INI_SCANNER_TYPED)));
            $this->databaseConfigs = $ini_array->Database;
        } catch (Exception $e) {
            $e->getMessage();
        }

    }

    public function getDatabaseConfig(){
        return $this->databaseConfigs;
    }
} 

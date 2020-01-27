<?php
class Settings
{
    private $databaseConfigs = null;

    public function __construct($path = ROOT_DIR.'/config.ini')
    {
        try {
            /*
            Quick and dirty way to load an ini-file as an object instead of an array.
            */
            $filepath = $path;
            $ini_array = json_decode(json_encode(parse_ini_file($filepath, true, INI_SCANNER_TYPED)));
            $this->databaseConfigs = $ini_array->Database;
        } catch (Exception $e) {
            throw new Exception("An error ocurred: ". $e->getMessage());
        }
    }

    public function getDatabaseConfig()
    {
        return $this->databaseConfigs;
    }
}

<?php

class database {
    static private $requiredInfoKeys = array("host", "user","password","database");
    private $db;
    private $dsn;
    private $options = 
        [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
        ];
        /**
         * @param $connectionInformation object
         * @throw Exception
         * 
         * Expected data:
         * "host" => "yourdbhostname", (required)
         * "username" => "yourdbusername", (required)
         * "password" => "yourdbpassword", (requried)
         * "database" => "yourdb", (requried)
         * "port" => yourDBPort (defaults: 3306)
         * "charset" => wantedCharset (defaults: utf8mb4)
         * "options" => array() with PDO options
         * 
         */
	function __construct($connectionInformation) {
        try {
            $missingKeys = array();

            foreach(SELF::$requiredInfoKeys as $key) {

                if(!property_exists($connectionInformation,$key)) 
                {
                   $missingKeys[] = $key;
                }

            }
            if(!empty($missingKeys)) {
                throw new Exception("Follwing keys are missing: ". implode(', ',$missingKeys));
            }
        } 
        catch(Exception $e) {
            throw new Exception("An error occoured when initlizing database. ". $e->getMessage());
        }
    }
	
}
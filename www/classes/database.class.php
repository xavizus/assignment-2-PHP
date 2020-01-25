<?php

class Database
{
    
    private $dsn;
    private $user;
    private $password;
    private $options =
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private $charset = "utf8mb4";

    public function __construct($databaseInfo)
    {
        $this->dsn =
        "mysql:host=".$databaseInfo->host .
        "port=".$databaseInfo->port .
        "dbname=".$databaseInfo->database .
        "charset=$charset";
        $this->user = $databaseInfo->user;
        $this->password = $databaseInfo->password;
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
        }
        catch (Exception $e) {
            error_log("Something went wrong: ". $e->getMessage());
        }
    }

    // public function something($connectionInformation)
    // {
    //     try {
    //         $missingKeys = array();

    //         foreach ($this->requiredInfoKeys as $key)
    //         {
    //             if (!array_key_exists($key, $connectionInformation))
    //             {
    //                 $missingKeys[] = $key;
    //             }
    //         }
    //         if (!empty($missingKeys)) {
    //             throw new Exception("Follwing keys are missing: ". implode(', '.$missingKeys));
    //         }
    //     }
    //     catch (Exception $e) {
    //         throw new Exception("An error occoured when initlizing database. ". $e->getMessage());
    //     }
    // }
   
    public function checkCredentials($username, $password)
    {
        $sql = "Select `user`
        FROM users
        WHERE user = ? AND pass = ?
        ";
        $statment = $dsn->prepare($sql);
        $statment = $statment->execute(array($username, $password));
        echo ($sql);
    }
}
    

echo ("hello world");
echo (connect());

<?php

class Database
{
    
    private $dbh;
    private $user;
    private $password;
    private $options =
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public function __construct($config)
    {   
        $databaseConfig = $config->getDatabaseConfig();
        $this->user = $databaseConfig->user;
        $this->pass = $databaseConfig->password;
        // Set DSN
        $dsn = 'mysql:host=' . $databaseConfig->host . ';dbname=' . $databaseConfig->database . ';port=' . $databaseConfig->port;

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception($e->getMessage());
        }
    }
   
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

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);

        return $type;
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
}


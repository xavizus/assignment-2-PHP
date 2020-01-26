<?php

if(!defined('ROOT_DIR')) {
    define("ROOT_DIR", __DIR__ . "/../");
}

require("./www/classes/Database.php");

/**
 * To use Database, we need config from Settings.class.php
 */
require("./www/classes/settings.class.php");


use PHPUnit\Framework\TestCase;

class databaseTest extends TestCase {

    protected $databse;
    protected $settings;
	
	public function setUp() :void {

        $this->settings = new \Settings();
        
        try {
            $this->database = new \Database($this->settings->getDatabaseConfig());
        }
        // skipp remaining tests if this one fails.
        catch(Exception $error) {
            $this->markTestSkipped("Something went when loading Database class: ".
            $error->getMessage());
        }
    }
    
    public function testExceptExceptionWithEmptyDatabse() {
        $this->expectException("ArgumentCountError");
        $database = new \Database();
    }

    public function testExceptExceptionWithWrongDatabaseInfo() {
        $this->expectException("Exception");
        $randomData = (object) array(
            "user" => $this->generateRandomString(5), 
            "password" => $this->generateRandomString(10), 
            "host" => $this->generateRandomString(120), 
            "database" => $this->generateRandomString(15),
            "port" => random_int(1000,16200) 
        );

        $database = new \Database($randomData);
    }

    public function testIfQueryWorks() {
        $this->database->query("SELECT * FROM users");

        $data = $this->database->resultSet();

        $this->assertIsArray($data);

    }

    public function testBindFunction() {
        $randomBoolean = (random_int(0,1) == 0 ) ? true : false;
        $randomInt = random_int(1,PHP_INT_MAX);
        $randomString = $this->generateRandomString(10);
        $typesToTest = array(
            PDO::PARAM_INT => $randomInt,
            PDO::PARAM_BOOL => $randomBoolean,
            PDO::PARAM_NULL => NULL,
            PDO::PARAM_STR => $randomString
        );

        $this->database->query("SELECT * FROM users WHERE ueser = (:user)");

        foreach($typesToTest as $keyType => $type) {
            $typeToAssert = $this->database->bind(':user', $type);

            $this->assertEquals($keyType, $typeToAssert);
        }
    }

    private function generateRandomString($length) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY1234567890!"#¤%&/()=?+-_@£$';
        $string = "";

        for($index = 0; $index < $length; $index++) {
            $randomCharacter = rand(0, strlen($characters)-1);
            $string .= $characters[$randomCharacter];
        }

        return $string;
    }
	
}
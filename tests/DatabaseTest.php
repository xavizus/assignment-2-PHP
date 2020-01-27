<?php

if (!defined('ROOT_DIR')) {
    define("ROOT_DIR", __DIR__ . "/../");
}

use PHPUnit\Framework\TestCase;

/**
 * This class tests database class functionality
 */

class databaseTest extends TestCase
{
    protected $databse;
    protected $settings;
    
    /**
     * To run this test, we require two classes,
     * settings and database
     */
    public function setUp() :void
    {
        if (!class_exists('Database', false)) {
            require("./www/classes/database.class.php");
        }
        if (!class_exists('Settings', false)) {
            require("./www/classes/settings.class.php");
        }
        $this->settings = new \Settings();
        
        try {
            $this->database = new \Database($this->settings);
        }

        // skipp remaining tests if loading database fails.
        catch (Exception $error) {
            $this->markTestSkipped("Something went when loading Database class: ".
            $error->getMessage());
        }
    }
    
    /**
     * Tests to load Database without Arguments.
     */
    public function testExceptExceptionWithEmptyDatabse()
    {
        $this->expectException("ArgumentCountError");
        $database = new \Database();
    }

    /**
     * Tests to load database with non-existent datbase.
     */
    public function testExceptExceptionWithWrongDatabaseInfo()
    {
        $this->expectException("Exception");
        $randomData = (object) array(
            "user" => $this->generateRandomString(5),
            "password" => $this->generateRandomString(10),
            "host" => $this->generateRandomString(120),
            "database" => $this->generateRandomString(15),
            "port" => random_int(1000, 16200)
        );

        /**
         * Creating annomous class,
         * I think I found a caseuse for interfaces now.
         */
        $settings = new class($randomData) {
            private $data;
            public function __construct($data) {
                $this->data = $data;
            }
            public function getDatabaseConfig() {
                return  $this->data;
            }
        };

        $database = new \Database($settings);
    }

    /**
     * Test to fetch data.
     */
    public function testIfQueryWorks()
    {
        $this->database->query("SELECT * FROM users");

        $data = $this->database->resultSet();

        $this->assertIsArray($data);
    }

    /**
     * Test to bind functions and expect right types.
     */
    public function testBindFunction()
    {
        $randomBoolean = (random_int(0, 1) == 0) ? true : false;
        $randomInt = random_int(1, PHP_INT_MAX);
        $randomString = $this->generateRandomString(10);
        $typesToTest = array(
            PDO::PARAM_INT => $randomInt,
            PDO::PARAM_BOOL => $randomBoolean,
            PDO::PARAM_NULL => null,
            PDO::PARAM_STR => $randomString
        );

        $this->database->query("SELECT * FROM users WHERE username = (:user)");

        foreach ($typesToTest as $keyType => $type) {
            $typeToAssert = $this->database->bind(':user', $type);

            $this->assertEquals($keyType, $typeToAssert);
        }
    }

    /**
     * string randomizer
     * @params total length of the wanted string
     * Source:
     * https://www.geeksforgeeks.org/generating-random-string-using-php/
     */
    private function generateRandomString($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY1234567890!"#¤%&/()=?+-_@£$';
        $string = "";

        for ($index = 0; $index < $length; $index++) {
            $randomCharacter = rand(0, strlen($characters)-1);
            $string .= $characters[$randomCharacter];
        }

        return $string;
    }
}

<?php

if (!defined('ROOT_DIR')) {
    define("ROOT_DIR", __DIR__ . "/../");
}

 // Require
if (!class_exists('\Settings', false)) {
    require("./www/classes/settings.class.php");
}
 // Require
 if (!class_exists('\Database', false)) {
     require("./www/classes/database.class.php");
 }

 // Require
 if (!class_exists('classes\User', false)) {
     require("./www/classes/User.php");
 }

use PHPUnit\Framework\TestCase;

class userTest extends TestCase
{
    protected $database;

    protected $user;

    private $mockUpData;

    private $testIDs = array();
    
    // This function sets up your default settings before running the tests.
    public function setUp() :void
    {
        $this->mockUpData = array(
            "username" => $this->generateRandomString(20),
            "email" => $this->generateRandomString(5) ."@".$this->generateRandomString(5),
            "password" => password_hash($this->generateRandomString(15), PASSWORD_DEFAULT)
        );
        try {
            $this->database = new Database(new \Settings());
            $this->user = new classes\User($this->database);
        } catch (Exception $error) {
            $this->markTestSkipped("Something went when loading Database or User class: ".
            $error->getMessage());
        }
    }

    /**
     * Check if an exception really throws when wrong path is given.
     */
    public function testIfRegisterCreatesAnAccount()
    {
        $this->assertTrue($this->user->register($this->mockUpData));
        $this->testIDs[] = $this->database->getLastInsertedId();
    }

    public function testIfValidateWorks()
    {
        $this->assertTrue($this->user->validate($this->mockUpData));
    }

    public function tearDown(): void
    {
        foreach ($this->testIDs as $testID) {
            $this->database->deleteUserById($testID);
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

<?php

namespace Test;

// Get namespace for TestCase
use PHPUnit\Framework\TestCase;

// Create a class, could be what ever classname you want,
// make sure you extend the class with TestCase.
class SettingsTest extends TestCase
{

    // This is just a holder for the class we will test against.
    protected $settings;
    
    // This function sets up your default settings before running the tests.
    public function setUp(): void
    {
        if (!defined('ROOT_DIR')) {
            define("ROOT_DIR", __DIR__ . "/../");
        }
        
         // Require the file that we want to test.
        if (!class_exists('\Settings', false)) {
            require("./www/classes/settings.class.php");
        }

        // Try to load Settings with default values.
        try {
            $this->settings = new \Settings();
        } catch (Exception $error) {
            $this->markTestSkipped("Something went when loading Settings class: " .
            $error->getMessage());
        }
    }
    
    // All test functions need to strat with test- and anything after.
    // All assertsions can be found @ https://phpunit.readthedocs.io/en/8.5/

    /**
     * Check if an exception really throws when wrong path is given.
     */
    public function testIfExceptionOfConstructWorks()
    {
        $this->expectException("Exception");
        $settings = new \Settings("/None/existed/Path/test");
    }

    // In this case, we are testing if we get an instance of stdClass.
    public function testGetDatabaseConfig()
    {
        $databaseConfig = $this->settings->getDatabaseConfig();
        $this->assertInstanceOf('stdClass', $databaseConfig);
    }
    
    // This functions tests if the object got specific properties.
    public function testContentsOfDatabaseConfig()
    {
        $properies = array("host","user","password","port","database");
        $databaseConfig = $this->settings->getDatabaseConfig();
        foreach ($properies as $property) {
            // in PHPUnit Attribute is  PHP class Property.
            $this->assertObjectHasAttribute($property, $databaseConfig);
        }
    }
}

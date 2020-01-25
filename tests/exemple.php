<?php
/**
 * Comments in this file are only for educational purpose
 */

 // Require the file that we want to test.
require("./www/classes/settings.class.php");

// Get namespace for TestCase
use PHPUnit\Framework\TestCase;


// Create a class, could be what ever classname you want,
// make sure you extend the class with TestCase.
class Test extends TestCase {

	// This is just a holder for the class we will test against.
	protected $settings;
	
	// This function sets up your default settings before running the tests.
	public function setUp() :void {

		// in this case we are just creating a new object with class Settings
		$this->settings = new \Settings();
	}
	
	// All test functions need to strat with test- and anything after.
	// All assertsions can be found @ https://phpunit.de/manual/6.5/en/appendixes.assertions.html

	// In this case, we are testing if we get an instance of stdClass.
	public function testGetDatabaseConfig() {
		$databaseConfig = $this->settings->getDatabaseConfig();
		$this->assertInstanceOf('stdClass', $databaseConfig);
	}
	
	// This functions tests if the object got specific properties.
	public function testContentsOfDatabaseConfig() {
		$properies = array("host","user","password","port","database");
		$databaseConfig = $this->settings->getDatabaseConfig();
		foreach($properies as $property) {
			// in PHPUnit Attribute is  PHP class Property.
			$this->assertObjectHasAttribute($property, $databaseConfig);
		}
	}
	
}
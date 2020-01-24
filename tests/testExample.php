<?php

use PHPUnit\Framework\TestCase;

class ClassNameTest extends TestCase {
	protected $variable;
	
	public function setUp() {
		$this->variable = new ClassName();
	}
}
<?php
App::uses('Base', 'Model');

/**
 * Base Test Case
 *
 */
class BaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.base'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Base = ClassRegistry::init('Base');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Base);

		parent::tearDown();
	}

}

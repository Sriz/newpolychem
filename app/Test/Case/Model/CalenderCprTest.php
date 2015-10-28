<?php
App::uses('CalenderCpr', 'Model');

/**
 * CalenderCpr Test Case
 *
 */
class CalenderCprTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calender_cpr'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CalenderCpr = ClassRegistry::init('CalenderCpr');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CalenderCpr);

		parent::tearDown();
	}

}

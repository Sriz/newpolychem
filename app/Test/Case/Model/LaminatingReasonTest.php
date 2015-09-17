<?php
App::uses('LaminatingReason', 'Model');

/**
 * LaminatingReason Test Case
 *
 */
class LaminatingReasonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.laminating_reason'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LaminatingReason = ClassRegistry::init('LaminatingReason');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LaminatingReason);

		parent::tearDown();
	}

}

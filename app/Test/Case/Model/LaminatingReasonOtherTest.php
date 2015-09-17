<?php
App::uses('LaminatingReasonOther', 'Model');

/**
 * LaminatingReasonOther Test Case
 *
 */
class LaminatingReasonOtherTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.laminating_reason_other'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LaminatingReasonOther = ClassRegistry::init('LaminatingReasonOther');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LaminatingReasonOther);

		parent::tearDown();
	}

}

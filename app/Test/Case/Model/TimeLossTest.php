<?php
App::uses('TimeLoss', 'Model');

/**
 * TimeLoss Test Case
 *
 */
class TimeLossTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.time_loss'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TimeLoss = ClassRegistry::init('TimeLoss');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TimeLoss);

		parent::tearDown();
	}

}

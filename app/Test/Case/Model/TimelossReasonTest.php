<?php
App::uses('TimelossReason', 'Model');

/**
 * TimelossReason Test Case
 *
 */
class TimelossReasonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.timeloss_reason'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TimelossReason = ClassRegistry::init('TimelossReason');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TimelossReason);

		parent::tearDown();
	}

}

<?php
App::uses('PrintingShiftreport', 'Model');

/**
 * PrintingShiftreport Test Case
 *
 */
class PrintingShiftreportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printing_shiftreport'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PrintingShiftreport = ClassRegistry::init('PrintingShiftreport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrintingShiftreport);

		parent::tearDown();
	}

}

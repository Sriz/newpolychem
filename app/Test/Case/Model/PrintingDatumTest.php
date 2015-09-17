<?php
App::uses('PrintingDatum', 'Model');

/**
 * PrintingDatum Test Case
 *
 */
class PrintingDatumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printing_datum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PrintingDatum = ClassRegistry::init('PrintingDatum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrintingDatum);

		parent::tearDown();
	}

}

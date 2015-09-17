<?php
App::uses('ConsumptionStock', 'Model');

/**
 * ConsumptionStock Test Case
 *
 */
class ConsumptionStockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.consumption_stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ConsumptionStock = ClassRegistry::init('ConsumptionStock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ConsumptionStock);

		parent::tearDown();
	}

}

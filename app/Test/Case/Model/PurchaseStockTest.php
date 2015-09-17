<?php
App::uses('PurchaseStock', 'Model');

/**
 * PurchaseStock Test Case
 *
 */
class PurchaseStockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseStock = ClassRegistry::init('PurchaseStock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseStock);

		parent::tearDown();
	}

}

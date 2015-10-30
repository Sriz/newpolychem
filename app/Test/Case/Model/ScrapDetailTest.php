<?php
App::uses('ScrapDetail', 'Model');

/**
 * ScrapDetail Test Case
 *
 */
class ScrapDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.scrap_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ScrapDetail = ClassRegistry::init('ScrapDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ScrapDetail);

		parent::tearDown();
	}

}

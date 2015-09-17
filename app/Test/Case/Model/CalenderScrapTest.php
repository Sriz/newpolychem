<?php
App::uses('CalenderScrap', 'Model');

/**
 * CalenderScrap Test Case
 *
 */
class CalenderScrapTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calender_scrap'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CalenderScrap = ClassRegistry::init('CalenderScrap');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CalenderScrap);

		parent::tearDown();
	}

}

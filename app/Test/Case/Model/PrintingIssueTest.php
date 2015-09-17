<?php
App::uses('PrintingIssue', 'Model');

/**
 * PrintingIssue Test Case
 *
 */
class PrintingIssueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printing_issue'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PrintingIssue = ClassRegistry::init('PrintingIssue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrintingIssue);

		parent::tearDown();
	}

}

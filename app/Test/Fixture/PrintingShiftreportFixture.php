<?php
/**
 * PrintingShiftreportFixture
 *
 */
class PrintingShiftreportFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'printing_shiftreport';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'shift' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'dimension' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'PF_Color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'color_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'input' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'output' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unprinted_scrap' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'department_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'printed_scrap' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'printed_scrap_reason' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unprinted_scrap_reason' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'shift' => 'Lorem ipsum dolor sit amet',
			'date' => '2015-06-16 04:46:52',
			'id' => 1,
			'dimension' => 'Lorem ipsum dolor sit amet',
			'PF_Color' => 'Lorem ips',
			'color_code' => 'Lorem ipsum dolor sit amet',
			'input' => 'Lorem ips',
			'output' => 'Lorem ipsum dolor sit amet',
			'unprinted_scrap' => 'Lorem ipsum dolor sit amet',
			'department_id' => 'Lorem ipsum dolor sit amet',
			'printed_scrap' => 'Lorem ips',
			'printed_scrap_reason' => 'Lorem ips',
			'unprinted_scrap_reason' => 'Lorem ipsum dolor sit amet'
		),
	);

}

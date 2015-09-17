<?php
/**
 * TimeLossFixture
 *
 */
class TimeLossFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'time_loss';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'timeloss_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'shift' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'department_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'time' => array('type' => 'integer', 'null' => false, 'default' => null),
		'wk_hrs' => array('type' => 'integer', 'null' => true, 'default' => null),
		'reasons' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'timeloss_id', 'unique' => 1)
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
			'timeloss_id' => 1,
			'shift' => 'Lorem ipsum dolor sit amet',
			'date' => '2015-06-12 08:28:47',
			'department_id' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ips',
			'time' => 1,
			'wk_hrs' => 1,
			'reasons' => 'Lorem ipsum dolor sit amet'
		),
	);

}

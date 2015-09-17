<?php
/**
 * ConsumptionStockFixture
 *
 */
class ConsumptionStockFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'consumption_stock';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'consumption_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'quality_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'brand' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'quantity' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'department_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'material_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dimension' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'shift' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'consumption_id', 'unique' => 1)
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
			'consumption_id' => 1,
			'quality_id' => 'Lorem ips',
			'brand' => 'Lorem ipsum dolor sit amet',
			'quantity' => 'Lorem ips',
			'department_id' => 'Lorem ips',
			'date' => 'Lorem ipsum dolor sit amet',
			'material_id' => 'Lorem ipsum dolor sit amet',
			'dimension' => 'Lorem ipsum dolor sit amet',
			'color' => 'Lorem ipsum dolor sit amet',
			'shift' => 'Lorem ip'
		),
	);

}

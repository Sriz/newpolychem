<?php
/**
 * PurchaseStockFixture
 *
 */
class PurchaseStockFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'purchaseStock';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'purchase_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'material_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'vender_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'category_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'quantity' => array('type' => 'integer', 'null' => true, 'default' => null),
		'purchase_date' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'purchase_user' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Reorder_level' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'purchase_id', 'unique' => 1)
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
			'purchase_id' => 1,
			'material_id' => 'Lorem ipsum dolor sit amet',
			'vender_id' => 'Lorem ipsum dolor sit amet',
			'category_id' => 'Lorem ipsum dolor sit amet',
			'quantity' => 1,
			'purchase_date' => 'Lorem ipsum dolor ',
			'purchase_user' => 'Lorem ipsum dolor sit amet',
			'Reorder_level' => 'Lor'
		),
	);

}

<?php
App::uses('AppModel', 'Model');
/**
 * PrintingRawmaterial Model
 *
 */
class PrintingRawmaterial extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'printing_rawmaterial';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'printing_rawmaterialid';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

}

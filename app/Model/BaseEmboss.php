<?php
App::uses('AppModel', 'Model');
/**
 * TimeLoss Model
 *
 */
class BaseEmboss extends AppModel {

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'baseemboss';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'id';

}

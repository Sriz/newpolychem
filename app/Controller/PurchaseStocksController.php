<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseStocks Controller
 *
 * @property PurchaseStock $PurchaseStock
 * @property PaginatorComponent $Paginator
 */
class PurchaseStocksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PurchaseStock->recursive = 0;
		$this->set('purchaseStocks', $this->Paginator->paginate());
		//$this->stock();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PurchaseStock->exists($id)) {
			throw new NotFoundException(__('Invalid purchase stock'));
		}
		$options = array('conditions' => array('PurchaseStock.' . $this->PurchaseStock->primaryKey => $id));
		$this->set('purchaseStock', $this->PurchaseStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PurchaseStock->create();
			if ($this->PurchaseStock->save($this->request->data)) {
				return $this->flash(__('The purchase stock has been saved.'), array('action' => 'index'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PurchaseStock->exists($id)) {
			throw new NotFoundException(__('Invalid purchase stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PurchaseStock->save($this->request->data)) {
				return $this->flash(__('The purchase stock has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PurchaseStock.' . $this->PurchaseStock->primaryKey => $id));
			$this->request->data = $this->PurchaseStock->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PurchaseStock->id = $id;
		if (!$this->PurchaseStock->exists()) {
			throw new NotFoundException(__('Invalid purchase stock'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PurchaseStock->delete()) {
			return $this->flash(__('The purchase stock has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The purchase stock could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	public function stock()
	{
		//$this->Filter->addFilters( array( 'filter1' => array( 'OR' => array( 'User.name' => array('operator' => 'LIKE'), 'User.username' => array('operator' => 'LIKE') ) ) ) );
        $this->paginate=array('limit' => 128);
			 
		//if(empty($this->request->data['Filter']['filter1']))
			//$this->request->data['Filter']['filter1']="material 1";
			 $this->Filter->addFilters( array( 'filter1' => array( 'OR' => array( 'PurchaseStock.material_id' => array('operator' => 'LIKE'), 'PurchaseStock.vender_id' => array('operator' => 'LIKE') ) ) ) );
			 
			
			 $this->Filter->setPaginate('order', 'material_id ASC'); // optional
    $this->Filter->setPaginate('limit', 128);              // optional
    $this->Filter->setPaginate('conditions', $this->Filter->getConditions());// Define conditions
    $this->set('purchaseStocks', $this->paginate());
	}
	}

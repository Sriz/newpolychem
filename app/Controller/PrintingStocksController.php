<?php
App::uses('AppController', 'Controller');
/**
 * PrintingStocks Controller
 *
 * @property PrintingStock $PrintingStock
 * @property PaginatorComponent $Paginator
 */
class PrintingStocksController extends AppController {

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
		$this->PrintingStock->recursive = 0;
		$this->set('printingStocks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintingStock->exists($id)) {
			throw new NotFoundException(__('Invalid printing stock'));
		}
		$options = array('conditions' => array('PrintingStock.' . $this->PrintingStock->primaryKey => $id));
		$this->set('printingStock', $this->PrintingStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PrintingStock->create();
			if ($this->PrintingStock->save($this->request->data)) {
				return $this->flash(__('The printing stock has been saved.'), array('action' => 'index'));
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
		if (!$this->PrintingStock->exists($id)) {
			throw new NotFoundException(__('Invalid printing stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PrintingStock->save($this->request->data)) {
				return $this->flash(__('The printing stock has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PrintingStock.' . $this->PrintingStock->primaryKey => $id));
			$this->request->data = $this->PrintingStock->find('first', $options);
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
		$this->PrintingStock->id = $id;
		if (!$this->PrintingStock->exists()) {
			throw new NotFoundException(__('Invalid printing stock'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintingStock->delete()) {
			return $this->flash(__('The printing stock has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The printing stock could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

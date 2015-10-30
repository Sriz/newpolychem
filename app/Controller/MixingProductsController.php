<?php
App::uses('AppController', 'Controller');
/**
 * MixingProducts Controller
 *
 * @property MixingProduct $MixingProduct
 * @property PaginatorComponent $Paginator
 */
class MixingProductsController extends AppController {

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
		$this->MixingProduct->recursive = 0;
		$this->set('mixingProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MixingProduct->exists($id)) {
			throw new NotFoundException(__('Invalid mixing product'));
		}
		$options = array('conditions' => array('MixingProduct.' . $this->MixingProduct->primaryKey => $id));
		$this->set('mixingProduct', $this->MixingProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MixingProduct->create();
			if ($this->MixingProduct->save($this->request->data)) {
				return $this->flash(__('The mixing product has been saved.'), array('action' => 'index'));
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
		if (!$this->MixingProduct->exists($id)) {
			throw new NotFoundException(__('Invalid mixing product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MixingProduct->save($this->request->data)) {
				return $this->flash(__('The mixing product has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('MixingProduct.' . $this->MixingProduct->primaryKey => $id));
			$this->request->data = $this->MixingProduct->find('first', $options);
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
		$this->MixingProduct->id = $id;
		if (!$this->MixingProduct->exists()) {
			throw new NotFoundException(__('Invalid mixing product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MixingProduct->delete()) {
			return $this->flash(__('The mixing product has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The mixing product could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

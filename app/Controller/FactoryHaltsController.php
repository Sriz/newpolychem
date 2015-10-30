<?php
App::uses('AppController', 'Controller');
/**
 * FactoryHalts Controller
 *
 * @property FactoryHalt $FactoryHalt
 * @property PaginatorComponent $Paginator
 */
class FactoryHaltsController extends AppController {

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
		$this->FactoryHalt->recursive = 0;
		$this->set('factoryHalts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FactoryHalt->exists($id)) {
			throw new NotFoundException(__('Invalid factory halt'));
		}
		$options = array('conditions' => array('FactoryHalt.' . $this->FactoryHalt->primaryKey => $id));
		$this->set('factoryHalt', $this->FactoryHalt->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FactoryHalt->create();
			if ($this->FactoryHalt->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->FactoryHalt->exists($id)) {
			throw new NotFoundException(__('Invalid factory halt'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FactoryHalt->save($this->request->data)) {
				return $this->flash(__('The factory halt has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('FactoryHalt.' . $this->FactoryHalt->primaryKey => $id));
			$this->request->data = $this->FactoryHalt->find('first', $options);
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
		$this->FactoryHalt->id = $id;
		if (!$this->FactoryHalt->exists()) {
			throw new NotFoundException(__('Invalid factory halt'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FactoryHalt->delete()) {
			return $this->flash(__('The factory halt has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The factory halt could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

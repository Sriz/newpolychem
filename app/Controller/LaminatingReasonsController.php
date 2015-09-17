<?php
App::uses('AppController', 'Controller');
/**
 * LaminatingReasons Controller
 *
 * @property LaminatingReason $LaminatingReason
 * @property PaginatorComponent $Paginator
 */
class LaminatingReasonsController extends AppController {

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
		$this->LaminatingReason->recursive = 0;
		$this->set('laminatingReasons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LaminatingReason->exists($id)) {
			throw new NotFoundException(__('Invalid laminating reason'));
		}
		$options = array('conditions' => array('LaminatingReason.' . $this->LaminatingReason->primaryKey => $id));
		$this->set('laminatingReason', $this->LaminatingReason->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LaminatingReason->create();
			if ($this->LaminatingReason->save($this->request->data)) {
				$this->Session->setFlash(__('The laminating reason has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The laminating reason could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->LaminatingReason->exists($id)) {
			throw new NotFoundException(__('Invalid laminating reason'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LaminatingReason->save($this->request->data)) {
				$this->Session->setFlash(__('The laminating reason has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The laminating reason could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LaminatingReason.' . $this->LaminatingReason->primaryKey => $id));
			$this->request->data = $this->LaminatingReason->find('first', $options);
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
		$this->LaminatingReason->id = $id;
		if (!$this->LaminatingReason->exists()) {
			throw new NotFoundException(__('Invalid laminating reason'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LaminatingReason->delete()) {
			$this->Session->setFlash(__('The laminating reason has been deleted.'));
		} else {
			$this->Session->setFlash(__('The laminating reason could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

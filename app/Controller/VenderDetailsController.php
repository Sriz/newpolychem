<?php
App::uses('AppController', 'Controller');
/**
 * VenderDetails Controller
 *
 * @property VenderDetail $VenderDetail
 * @property PaginatorComponent $Paginator
 */
class VenderDetailsController extends AppController {

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
		$this->VenderDetail->recursive = 0;
		$this->set('venderDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VenderDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vender detail'));
		}
		$options = array('conditions' => array('VenderDetail.' . $this->VenderDetail->primaryKey => $id));
		$this->set('venderDetail', $this->VenderDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->VenderDetail->create();
			if ($this->VenderDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vender detail has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vender detail could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->VenderDetail->exists($id)) {
			throw new NotFoundException(__('Invalid vender detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->VenderDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The vender detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vender detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VenderDetail.' . $this->VenderDetail->primaryKey => $id));
			$this->request->data = $this->VenderDetail->find('first', $options);
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
		$this->VenderDetail->id = $id;
		if (!$this->VenderDetail->exists()) {
			throw new NotFoundException(__('Invalid vender detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VenderDetail->delete()) {
			$this->Session->setFlash(__('The vender detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The vender detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

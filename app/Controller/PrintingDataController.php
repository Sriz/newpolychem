<?php
App::uses('AppController', 'Controller');
/**
 * PrintingData Controller
 *
 * @property PrintingDatum $PrintingDatum
 * @property PaginatorComponent $Paginator
 */
class PrintingDataController extends AppController {

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
		$this->PrintingDatum->recursive = 0;
		$this->set('printingData', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintingDatum->exists($id)) {
			throw new NotFoundException(__('Invalid printing datum'));
		}
		$options = array('conditions' => array('PrintingDatum.' . $this->PrintingDatum->primaryKey => $id));
		$this->set('printingDatum', $this->PrintingDatum->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PrintingDatum->create();
			if ($this->PrintingDatum->save($this->request->data)) {
				$this->Session->setFlash(__('The printing datum has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printing datum could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->PrintingDatum->exists($id)) {
			throw new NotFoundException(__('Invalid printing datum'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PrintingDatum->save($this->request->data)) {
				$this->Session->setFlash(__('The printing datum has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printing datum could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PrintingDatum.' . $this->PrintingDatum->primaryKey => $id));
			$this->request->data = $this->PrintingDatum->find('first', $options);
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
		$this->PrintingDatum->id = $id;
		if (!$this->PrintingDatum->exists()) {
			throw new NotFoundException(__('Invalid printing datum'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintingDatum->delete()) {
			$this->Session->setFlash(__('The printing datum has been deleted.'));
		} else {
			$this->Session->setFlash(__('The printing datum could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

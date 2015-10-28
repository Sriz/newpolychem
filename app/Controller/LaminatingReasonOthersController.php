<?php
App::uses('AppController', 'Controller');
/**
 * LaminatingReasonOthers Controller
 *
 * @property LaminatingReasonOther $LaminatingReasonOther
 * @property PaginatorComponent $Paginator
 */
class LaminatingReasonOthersController extends AppController {

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
		$this->LaminatingReasonOther->recursive = 0;
		$this->set('laminatingReasonOthers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LaminatingReasonOther->exists($id)) {
			throw new NotFoundException(__('Invalid laminating reason other'));
		}
		$options = array('conditions' => array('LaminatingReasonOther.' . $this->LaminatingReasonOther->primaryKey => $id));
		$this->set('laminatingReasonOther', $this->LaminatingReasonOther->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LaminatingReasonOther->create();
			if ($this->LaminatingReasonOther->save($this->request->data)) {
				$this->Session->setFlash(__('The laminating reason other has been saved.'), array ('class' => 'alert alert-success'));
				//return $this->redirect(array('controller'=>'PrintingShiftreports','action' => 'add'));
			} else {
				$this->Session->setFlash(__('The laminating reason other could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->LaminatingReasonOther->exists($id)) {
			throw new NotFoundException(__('Invalid laminating reason other'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LaminatingReasonOther->save($this->request->data)) {
				$this->Session->setFlash(__('The laminating reason other has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The laminating reason other could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LaminatingReasonOther.' . $this->LaminatingReasonOther->primaryKey => $id));
			$this->request->data = $this->LaminatingReasonOther->find('first', $options);
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
		$this->LaminatingReasonOther->id = $id;
		if (!$this->LaminatingReasonOther->exists()) {
			throw new NotFoundException(__('Invalid laminating reason other'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LaminatingReasonOther->delete()) {
			$this->Session->setFlash(__('The laminating reason other has been deleted.'));
		} else {
			$this->Session->setFlash(__('The laminating reason other could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

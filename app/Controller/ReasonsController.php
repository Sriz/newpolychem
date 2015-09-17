<?php
App::uses('AppController', 'Controller');
/**
 * Reasons Controller
 *
 * @property Reason $Reason
 * @property PaginatorComponent $Paginator
 */
class ReasonsController extends AppController {

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
		$this->Reason->recursive = 0;
		$this->set('reasons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reason->exists($id)) {
			throw new NotFoundException(__('Invalid reason'));
		}
		$options = array('conditions' => array('Reason.' . $this->Reason->primaryKey => $id));
		$this->set('reason', $this->Reason->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reason->create();
			if ($this->Reason->save($this->request->data)) {
				return $this->flash(__('The reason has been saved.'), array('action' => 'index'));
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
		if (!$this->Reason->exists($id)) {
			throw new NotFoundException(__('Invalid reason'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reason->save($this->request->data)) {
				return $this->flash(__('The reason has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Reason.' . $this->Reason->primaryKey => $id));
			$this->request->data = $this->Reason->find('first', $options);
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
		$this->Reason->id = $id;
		if (!$this->Reason->exists()) {
			throw new NotFoundException(__('Invalid reason'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Reason->delete()) {
			return $this->flash(__('The reason has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The reason could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

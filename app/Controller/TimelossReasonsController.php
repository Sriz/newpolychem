<?php
App::uses('AppController', 'Controller');
/**
 * TimelossReasons Controller
 *
 * @property TimelossReason $TimelossReason
 * @property PaginatorComponent $Paginator
 */
class TimelossReasonsController extends AppController {

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
		$this->TimelossReason->recursive = 0;
		$this->set('timelossReasons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TimelossReason->exists($id)) {
			throw new NotFoundException(__('Invalid timeloss reason'));
		}
		$options = array('conditions' => array('TimelossReason.' . $this->TimelossReason->primaryKey => $id));
		$this->set('timelossReason', $this->TimelossReason->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TimelossReason->create();
			if ($this->TimelossReason->save($this->request->data)) {
				return $this->flash(__('The timeloss reason has been saved.'), array('action' => 'index'));
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
		if (!$this->TimelossReason->exists($id)) {
			throw new NotFoundException(__('Invalid timeloss reason'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TimelossReason->save($this->request->data)) {
				return $this->flash(__('The timeloss reason has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('TimelossReason.' . $this->TimelossReason->primaryKey => $id));
			$this->request->data = $this->TimelossReason->find('first', $options);
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
		$this->TimelossReason->id = $id;
		if (!$this->TimelossReason->exists()) {
			throw new NotFoundException(__('Invalid timeloss reason'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TimelossReason->delete()) {
			return $this->flash(__('The timeloss reason has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The timeloss reason could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

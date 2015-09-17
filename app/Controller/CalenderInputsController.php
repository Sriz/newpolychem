<?php
App::uses('AppController', 'Controller');
/**
 * CalenderInputs Controller
 *
 * @property CalenderInput $CalenderInput
 * @property PaginatorComponent $Paginator
 */
class CalenderInputsController extends AppController {

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
		$this->CalenderInput->recursive = 0;
		$this->set('calenderInputs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CalenderInput->exists($id)) {
			throw new NotFoundException(__('Invalid calender input'));
		}
		$options = array('conditions' => array('CalenderInput.' . $this->CalenderInput->primaryKey => $id));
		$this->set('calenderInput', $this->CalenderInput->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CalenderInput->create();
			if ($this->CalenderInput->save($this->request->data)) {
				return $this->flash(__('The calender input has been saved.'), array('action' => 'index'));
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
		if (!$this->CalenderInput->exists($id)) {
			throw new NotFoundException(__('Invalid calender input'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CalenderInput->save($this->request->data)) {
				return $this->flash(__('The calender input has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CalenderInput.' . $this->CalenderInput->primaryKey => $id));
			$this->request->data = $this->CalenderInput->find('first', $options);
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
		$this->CalenderInput->id = $id;
		if (!$this->CalenderInput->exists()) {
			throw new NotFoundException(__('Invalid calender input'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CalenderInput->delete()) {
			return $this->flash(__('The calender input has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The calender input could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

<?php
App::uses('AppController', 'Controller');
/**
 * DepartmentStocks Controller
 *
 * @property DepartmentStock $DepartmentStock
 * @property PaginatorComponent $Paginator
 */
class DepartmentStocksController extends AppController {

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
		$this->DepartmentStock->recursive = 0;
		
		$data = $this->Paginator->paginate('DepartmentStock',array('DepartmentStock.department_id' => AuthComponent::user('role')));
	
	$this->set('departmentStocks', $data);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DepartmentStock->exists($id)) {
			throw new NotFoundException(__('Invalid department stock'));
		}
		$options = array('conditions' => array('DepartmentStock.' . $this->DepartmentStock->primaryKey => $id));
		$this->set('departmentStock', $this->DepartmentStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DepartmentStock->create();
			if ($this->DepartmentStock->save($this->request->data))
			{
				$this->Session->setFlash(__('The department stock has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department stock could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->DepartmentStock->exists($id)) {
			throw new NotFoundException(__('Invalid department stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DepartmentStock->save($this->request->data)) {
				$this->Session->setFlash(__('The department stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department stock could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DepartmentStock.' . $this->DepartmentStock->primaryKey => $id));
			$this->request->data = $this->DepartmentStock->find('first', $options);
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
		$this->DepartmentStock->id = $id;
		if (!$this->DepartmentStock->exists()) {
			throw new NotFoundException(__('Invalid department stock'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DepartmentStock->delete()) {
			$this->Session->setFlash(__('The department stock has been deleted.'));
		} else {
			$this->Session->setFlash(__('The department stock could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

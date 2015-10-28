<?php
App::uses('AppController', 'Controller');
/**
 * Dimensions Controller
 *
 * @property Dimension $Dimension
 * @property PaginatorComponent $Paginator
 */
class PrintDimensionTargetController extends AppController {

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
		$this->PrintDimensionTarget->recursive = 0;
		$this->set('dimensions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintDimensionTarget->exists($id)) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		$options = array('conditions' => array('Dimension.' . $this->PrintDimensionTarget->primaryKey => $id));
		$this->set('dimension', $this->PrintDimensionTarget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PrintDimensionTarget->create();
			if ($this->PrintDimensionTarget->save($this->request->data)) {
				return $this->flash(__('The dimension has been saved.'), array('action' => 'index'));
			}
			else
				echo "error";
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
		if (!$this->PrintDimensionTarget->exists($id)) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		if ($this->request->is(array('post', 'put'))) {
//print_r($this->request->data);die;
			if ($this->PrintDimensionTarget->save($this->request->data)) {
				
				$this->flash(__('The dimension has been saved.'), array('action' => 'index'));
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PrintDimensionTarget.' . $this->PrintDimensionTarget->primaryKey => $id));
			$this->request->data = $this->PrintDimensionTarget->find('first', $options);
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
		$this->PrintDimensionTarget->id = $id;
		if (!$this->PrintDimensionTarget->exists()) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintDimensionTarget->delete()) {
			//$this->flash(__('The dimension has been deleted.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			return $this->flash(__('The dimension could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

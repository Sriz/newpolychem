<?php
App::uses('AppController', 'Controller');
/**
 * Dimensions Controller
 *
 * @property Dimension $Dimension
 * @property PaginatorComponent $Paginator
 */
class DimensionTargetController extends AppController {

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
		$this->DimensionTarget->recursive = 0;
		$all = $this->DimensionTarget->query("select * from dimension_target order by dimension");
		$this->set('dimensions', $all);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DimensionTarget->exists($id)) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		$options = array('conditions' => array('Dimension.' . $this->DimensionTarget->primaryKey => $id));
		$this->set('dimension', $this->DimensionTarget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			//echo'<pre>';print_r($this->request);die;
			$this->DimensionTarget->create();
			if ($this->DimensionTarget->save($this->request->data)) {
				
				return $this->redirect(array('controller' => 'DimensionTarget', 'action' => 'index'));
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
		if (!$this->DimensionTarget->exists($id)) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		if ($this->request->is(array('post', 'put'))) {
//print_r($this->request->data);die;
			if ($this->DimensionTarget->save($this->request->data)) {
				
				$this->flash(__('The dimension has been saved.'), array('action' => 'index/sort:date/direction:desc'));
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('DimensionTarget.' . $this->DimensionTarget->primaryKey => $id));
			$this->request->data = $this->DimensionTarget->find('first', $options);
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
		$this->DimensionTarget->id = $id;
		if (!$this->DimensionTarget->exists()) {
			throw new NotFoundException(__('Invalid dimension'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DimensionTarget->delete()) {
			//$this->flash(__('The dimension has been deleted.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			return $this->flash(__('The dimension could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

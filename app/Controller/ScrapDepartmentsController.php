<?php
App::uses('AppController', 'Controller');
/**
 * ScrapDepartments Controller
 *
 * @property ScrapDepartment $ScrapDepartment
 * @property PaginatorComponent $Paginator
 */
class ScrapDepartmentsController extends AppController {

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
		$this->ScrapDepartment->recursive = 0;
		$this->set('scrapDepartments', $this->Paginator->paginate());
		$this->loadModel('Quality');
		$this->quality();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScrapDepartment->exists($id)) {
			throw new NotFoundException(__('Invalid scrap department'));
		}
		$options = array('conditions' => array('ScrapDepartment.' . $this->ScrapDepartment->primaryKey => $id));
		$this->set('scrapDepartment', $this->ScrapDepartment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScrapDepartment->create();
			if ($this->ScrapDepartment->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->ScrapDepartment->exists($id)) {
			throw new NotFoundException(__('Invalid scrap department'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScrapDepartment->save($this->request->data)) {
				return $this->flash(__('The scrap department has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('ScrapDepartment.' . $this->ScrapDepartment->primaryKey => $id));
			$this->request->data = $this->ScrapDepartment->find('first', $options);
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
		$this->ScrapDepartment->id = $id;
		if (!$this->ScrapDepartment->exists()) {
			throw new NotFoundException(__('Invalid scrap department'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ScrapDepartment->delete()) {
			return $this->flash(__('The scrap department has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The scrap department could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	public function quality()
	{
		$option=$this->Quality->find('list', array('fields' => array('quality_id', 'name')));
		$this->set('opt',$option);
		//echo $option;
				
	}
	
	
	
	}

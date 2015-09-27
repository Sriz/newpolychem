<?php
App::uses('AppController', 'Controller');
/**
 * PrintingPatterns Controller
 *
 * @property PrintingPattern $PrintingPattern
 * @property PaginatorComponent $Paginator
 */
class PrintingPatternsController extends AppController {

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
		$this->PrintingPattern->recursive = 0;
		$this->set('printingPatterns', $this->Paginator->paginate());
		$this->loadModel('CategoryPrinting');
        $category = $this->CategoryPrinting->find('all');
        $this->set('category', $category);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintingPattern->exists($id)) {
			throw new NotFoundException(__('Invalid printing pattern'));
		}
		$options = array('conditions' => array('PrintingPattern.' . $this->PrintingPattern->primaryKey => $id));
		$this->set('printingPattern', $this->PrintingPattern->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PrintingPattern->create();
			if ($this->PrintingPattern->save($this->request->data)) {
				return $this->flash(__('The printing pattern has been saved.'), array('action' => 'index'));
			}
		}
		$this->loadModel('CategoryPrinting');
        $category = $this->CategoryPrinting->find('all');
        $this->set('category', $category);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PrintingPattern->exists($id)) {
			throw new NotFoundException(__('Invalid printing pattern'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PrintingPattern->save($this->request->data)) {
				return $this->flash(__('The printing pattern has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PrintingPattern.' . $this->PrintingPattern->primaryKey => $id));
			$this->request->data = $this->PrintingPattern->find('first', $options);
		}

		$this->loadModel('CategoryPrinting');
        $category = $this->CategoryPrinting->find('all');
        $this->set('category', $category);
        $currentId =$this->PrintingPattern->query("SELECT * from printing_pattern WHERE  id='$id'")[0]['printing_pattern']['category_id'];
        $this->set('currentId', isset($currentId)?$currentId:null);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PrintingPattern->id = $id;
		if (!$this->PrintingPattern->exists()) {
			throw new NotFoundException(__('Invalid printing pattern'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintingPattern->delete()) {
			return $this->flash(__('The printing pattern has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The printing pattern could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

<?php
App::uses('AppController', 'Controller');
/**
 * LaminatingTarget Controller
 *
 * @property LaminatingTarget $LaminatingTarget
 * @property PaginatorComponent $Paginator
 */
class LaminatingTargetController extends AppController {

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
		$this->LaminatingTarget->recursive = 0;
		$this->set('laminatingTargets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LaminatingTarget->exists($id)) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		$options = array('conditions' => array('LaminatingTarget.' . $this->LaminatingTarget->primaryKey => $id));
		$this->set('laminatingTarget', $this->LaminatingTarget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			if ($this->LaminatingTarget->save($this->request->data)) {
				$this->Session->setFlash(__('The Scrap Mixing has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Scrap Mixing could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->LaminatingTarget->exists($id)) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LaminatingTarget->save($this->request->data)) {
				$this->Session->setFlash(__('The mixing material has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mixing material could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LaminatingTarget.' . $this->LaminatingTarget->primaryKey => $id));
			$this->request->data = $this->LaminatingTarget->find('first', $options);
		}
        $this->loadModel('CategoryMaterial');
        $category = $this->CategoryMaterial->find('all');
        $this->set('category', $category);
        $currentId =$this->LaminatingTarget->query("SELECT * from mixing_materials WHERE  id='$id'")[0]['mixing_materials']['category_id'];
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
		$this->LaminatingTarget->id = $id;
		if (!$this->LaminatingTarget->exists()) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LaminatingTarget->delete()) {
			$this->Session->setFlash(__('The mixing material has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mixing material could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

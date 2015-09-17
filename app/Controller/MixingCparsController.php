<?php
App::uses('AppController', 'Controller');
/**
 * MixingCpars Controller
 *
 * @property MixingCpar $MixingCpar
 * @property PaginatorComponent $Paginator
 */
class MixingCparsController extends AppController {

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
		$this->MixingCpar->recursive = 0;
		$this->set('mixingCpars', $this->Paginator->paginate());
		$this->loadModel('Material');
		$this->loadModel('Quality');
		$this->material();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MixingCpar->exists($id)) {
			throw new NotFoundException(__('Invalid mixing cpar'));
		}
		$options = array('conditions' => array('MixingCpar.' . $this->MixingCpar->primaryKey => $id));
		$this->set('mixingCpar', $this->MixingCpar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MixingCpar->create();
			if ($this->MixingCpar->save($this->request->data)) {
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
		if (!$this->MixingCpar->exists($id)) {
			throw new NotFoundException(__('Invalid mixing cpar'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MixingCpar->save($this->request->data)) {
				return $this->flash(__('The mixing cpar has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('MixingCpar.' . $this->MixingCpar->primaryKey => $id));
			$this->request->data = $this->MixingCpar->find('first', $options);
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
		$this->MixingCpar->id = $id;
		if (!$this->MixingCpar->exists()) {
			throw new NotFoundException(__('Invalid mixing cpar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MixingCpar->delete()) {
			return $this->flash(__('The mixing cpar has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The mixing cpar could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	
	
	public function material()
	{
		$option=$this->Material->find('list', array('fields' => array('material_id', 'material_name')));
		$this->set('opt',$option);
		$option1=$this->Quality->find('list', array('fields' => array('quality_id', 'name')));
		$this->set('opt1',$option1);
		
		//echo $option;
				
	}
	
	}

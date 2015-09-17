<?php
App::uses('AppController', 'Controller');
/**
 * Qualities Controller
 *
 * @property Quality $Quality
 * @property PaginatorComponent $Paginator
 */
class QualitiesController extends AppController {

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
		$this->Quality->recursive = 0;
		$this->set('qualities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Quality->exists($id)) {
			throw new NotFoundException(__('Invalid quality'));
		}
		$options = array('conditions' => array('Quality.' . $this->Quality->primaryKey => $id));
		$this->set('quality', $this->Quality->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Quality->create();
			if ($this->Quality->save($this->request->data)) {
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
		if (!$this->Quality->exists($id)) {
			throw new NotFoundException(__('Invalid quality'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quality->save($this->request->data)) {
				return $this->flash(__('The quality has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Quality.' . $this->Quality->primaryKey => $id));
			$this->request->data = $this->Quality->find('first', $options);
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
		$this->Quality->id = $id;
		if (!$this->Quality->exists()) {
			throw new NotFoundException(__('Invalid quality'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quality->delete()) {
			return $this->flash(__('The quality has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The quality could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

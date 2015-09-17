<?php
App::uses('AppController', 'Controller');
/**
 * ScrapMains Controller
 *
 * @property ScrapMain $ScrapMain
 * @property PaginatorComponent $Paginator
 */
class ScrapMainsController extends AppController {

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
		$this->ScrapMain->recursive = 0;
		$this->set('scrapMains', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScrapMain->exists($id)) {
			throw new NotFoundException(__('Invalid scrap main'));
		}
		$options = array('conditions' => array('ScrapMain.' . $this->ScrapMain->primaryKey => $id));
		$this->set('scrapMain', $this->ScrapMain->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScrapMain->create();
			if ($this->ScrapMain->save($this->request->data)) {
				$this->Session->setFlash(__('The scrap main has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scrap main could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->ScrapMain->exists($id)) {
			throw new NotFoundException(__('Invalid scrap main'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScrapMain->save($this->request->data)) {
				$this->Session->setFlash(__('The scrap main has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scrap main could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ScrapMain.' . $this->ScrapMain->primaryKey => $id));
			$this->request->data = $this->ScrapMain->find('first', $options);
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
		$this->ScrapMain->id = $id;
		if (!$this->ScrapMain->exists()) {
			throw new NotFoundException(__('Invalid scrap main'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ScrapMain->delete()) {
			$this->Session->setFlash(__('The scrap main has been deleted.'));
		} else {
			$this->Session->setFlash(__('The scrap main could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

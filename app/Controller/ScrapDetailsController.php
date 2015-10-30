<?php
App::uses('AppController', 'Controller');
/**
 * ScrapDetails Controller
 *
 * @property ScrapDetail $ScrapDetail
 * @property PaginatorComponent $Paginator
 */
class ScrapDetailsController extends AppController {

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
		$this->ScrapDetail->recursive = 0;
		$this->set('scrapDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScrapDetail->exists($id)) {
			throw new NotFoundException(__('Invalid scrap detail'));
		}
		$options = array('conditions' => array('ScrapDetail.' . $this->ScrapDetail->primaryKey => $id));
		$this->set('scrapDetail', $this->ScrapDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScrapDetail->create();
			if ($this->ScrapDetail->save($this->request->data)) {
				return $this->flash(__('The scrap detail has been saved.'), array('action' => 'index'));
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
		if (!$this->ScrapDetail->exists($id)) {
			throw new NotFoundException(__('Invalid scrap detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScrapDetail->save($this->request->data)) {
				return $this->flash(__('The scrap detail has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('ScrapDetail.' . $this->ScrapDetail->primaryKey => $id));
			$this->request->data = $this->ScrapDetail->find('first', $options);
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
		$this->ScrapDetail->id = $id;
		if (!$this->ScrapDetail->exists()) {
			throw new NotFoundException(__('Invalid scrap detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ScrapDetail->delete()) {
			return $this->flash(__('The scrap detail has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The scrap detail could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

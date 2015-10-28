<?php
App::uses('AppController', 'Controller');
/**
 * PrintingRawmaterials Controller
 *
 * @property PrintingRawmaterial $PrintingRawmaterial
 * @property PaginatorComponent $Paginator
 */
class PrintingRawmaterialsController extends AppController {

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
		$this->PrintingRawmaterial->recursive = 0;
		$this->set('printingRawmaterials', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintingRawmaterial->exists($id)) {
			throw new NotFoundException(__('Invalid printing rawmaterial'));
		}
		$options = array('conditions' => array('PrintingRawmaterial.' . $this->PrintingRawmaterial->primaryKey => $id));
		$this->set('printingRawmaterial', $this->PrintingRawmaterial->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PrintingRawmaterial->create();
			if ($this->PrintingRawmaterial->save($this->request->data)) {
				return $this->flash(__('The printing rawmaterial has been saved.'), array('action' => 'index'));
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
		if (!$this->PrintingRawmaterial->exists($id)) {
			throw new NotFoundException(__('Invalid printing rawmaterial'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PrintingRawmaterial->save($this->request->data)) {
				return $this->flash(__('The printing rawmaterial has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PrintingRawmaterial.' . $this->PrintingRawmaterial->primaryKey => $id));
			$this->request->data = $this->PrintingRawmaterial->find('first', $options);
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
		$this->PrintingRawmaterial->id = $id;
		if (!$this->PrintingRawmaterial->exists()) {
			throw new NotFoundException(__('Invalid printing rawmaterial'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintingRawmaterial->delete()) {
			return $this->flash(__('The printing rawmaterial has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The printing rawmaterial could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

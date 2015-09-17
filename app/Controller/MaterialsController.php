<?php
App::uses('AppController', 'Controller');
/**
 * Materials Controller
 *
 * @property Material $Material
 * @property PaginatorComponent $Paginator
 */
class MaterialsController extends AppController {

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
		$this->Material->recursive = 0;
		$this->set('materials', $this->Paginator->paginate());
		$this->loadModel('Category');
		$this->loadModel('VenderDetail');
		$this->category();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
		$this->set('material', $this->Material->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Material->create();
			print_r($this->request->data);
			if ($this->Material->save($this->request->data)) {
				$mid = $this->request->data['Material']['material_name'];
				$vid = $this->request->data['Material']['vender_id'];
				$cid = $this->request->data['Material']['category_id'];
				$d = date('d-m-y');
				//$this->Material->query("insert into purchaseStock(material_id,vender_id,category_id,quantity,purchase_date) value('$mid','$vid','$cid',0,$d)");
				$this->Material->query("insert into purchaseStock(material_id,quantity,purchase_date) value('$mid',0,'$d')");
				$this->flash(__('The material has been saved.'), array('action' => 'index'));
				return $this->redirect(array('action' => 'index'));
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
	
		
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Material->save($this->request->data)) {
				return $this->flash(__('The material has been saved.'), array('action' => 'index'));
			return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
			$this->request->data = $this->Material->find('first', $options);
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
		$this->Material->id = $id;
		if (!$this->Material->exists()) {
			throw new NotFoundException(__('Invalid material'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Material->delete()) {
			 $this->flash(__('The material has been deleted.'), array('action' => 'index'));
			 return $this->redirect(array('action' => 'index'));
		} else {
			 $this->flash(__('The material could not be deleted. Please, try again.'), array('action' => 'index'));
			 return $this->redirect(array('action' => 'index'));
		}
	}
	public function category()
	{
		$option=$this->Category->find('list', array('fields' => array('category_name', 'category_name')));
		$this->set('opt',$option);
		$option1=$this->VenderDetail->find('list', array('fields' => array('vender_name', 'vender_name')));
		$this->set('opt1',$option1);
		
		//echo $option;
				
	}
	
	
	}

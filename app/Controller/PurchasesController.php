<?php
App::uses('AppController', 'Controller');
/**
 * Purchases Controller
 *
 * @property Purchase $Purchase
 * @property PaginatorComponent $Paginator
 */
class PurchasesController extends AppController {

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
		$this->Purchase->recursive = 0;
		$this->set('purchases', $this->Paginator->paginate());
		$this->loadModel('Material');
		$this->loadModel('PurchaseStock');
		$this->loadModel('VenderDetail');
		$this->loadModel('Category');
		//$this->vender();
			$this->material();
		
		
	}

/*
 * view method
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Purchase->exists($id)) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		$options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
		$this->set('purchase', $this->Purchase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
			$this->loadModel('PurchaseStock');
		if ($this->request->is('post')) {
			$this->Purchase->create();
				
					if ($this->Purchase->save($this->request->data))
					{
							$nqt;
							$cid = $this->request->data['Purchase']['material_id'];
							$cqt = $this->request->data['Purchase']['quantity'];
								$updatedDate = $this->request->data['Purchase']['purchase_date'];
								print_r($updatedDate);
							if($pqt = $this->Purchase->query("select quantity as quantity from purchaseStock where purchaseStock.material_id = '$cid'"))
							{
								foreach($pqt as $n):
									$nqt = intval($n['purchaseStock']['quantity']) + intval($cqt);
								endforeach;
								$this->Purchase->query("update purchaseStock set purchaseStock.quantity = $nqt, purchaseStock.purchase_date = '$updatedDate' where purchaseStock.material_id = '$cid'");
								$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
								return $this->redirect(array('action' => 'index'));
							}
							else
							{
								$this->Purchase->query("insert into purchaseStock(material_id,quantity,purchase_date) value('$cid',$cqt,'$updatedDate')");
								
							}
						
						
						$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}
					else{
						
						$this->Session->setFlash(__('The request could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		if (!$this->Purchase->exists($id)) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purchase->save($this->request->data)) {
				return $this->flash(__('The purchase has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
			$this->request->data = $this->Purchase->find('first', $options);
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
		$this->Purchase->id = $id;
		if (!$this->Purchase->exists()) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Purchase->delete()) {
			 $this->flash(__('The purchase has been deleted.'), array('action' => 'index'));
			return $this->redirect(array('action' => 'index'));
		} else {
			 $this->flash(__('The purchase could not be deleted. Please, try again.'), array('action' => 'index'));
			 return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function material()
	{
		$option=$this->Material->find('list', array('fields' => array('material_name', 'material_name')));
		$this->set('opt',$option);
		//echo $option;
		$option1=$this->VenderDetail->find('list', array('fields' => array('vender_name', 'vender_name')));
		$this->set('opt1',$option1);
		
		$option2=$this->Category->find('list', array('fields' => array('category_name', 'category_name')));
		$this->set('opt2',$option2);
		
				
	}
	
	
	}

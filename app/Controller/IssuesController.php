<?php
App::uses('AppController', 'Controller');
/**
 * Issues Controller
 *
 * @property Issue $Issue
 * @property PaginatorComponent $Paginator
 */
class IssuesController extends AppController {

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
		$this->Issue->recursive = 0;
		$this->set('issues', $this->Paginator->paginate());
		$this->loadModel('Material');
		$this->loadModel('Category');
		$this->loadModel('Department');
		$this->material();
		$this->storelist();
		$this->Filter->addFilters(
							  array( 'filter1' => array(
														'OR' => array(
																	  'Issue.material_id' => array('operator' => 'LIKE'),
																	  'Issue.date' => array('operator' => 'LIKE'),
																	  'Issue.Issued_to'=>array('operator'=>'LIKE')
																	  )
														)
									)
							  );
	//	$this->Filter->addFilters( array( 'filter1' => array( 'OR' => array( 'Issue.issued_to' => array('operator' => 'LIKE'), 'Issue.department.vender_id' => array('operator' => 'LIKE'),'Issue.material_id' => array('operator' => 'LIKE') ) ) ) );
	$this->Filter->setPaginate('order', 'date ASC'); // optional
    $this->Filter->setPaginate('limit', 128);              // optional
    $this->Filter->setPaginate('conditions', $this->Filter->getConditions());// Define conditions
	$this->set('issues', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('issue', $this->Issue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('PurchaseStock');
		if ($this->request->is('post'))
		{
			$cid = $this->request->data['Issue']['material_id'];
			$dpt_id = $this->request->data['Issue']['issued_to'];
			if($this->Issue->query("select quantity as quantity from purchaseStock where material_id = '$cid'"))
			{
				$pqt = $this->Issue->query("select quantity as quantity from purchaseStock where material_id = '$cid'");
					$cqt = $this->request->data['Issue']['quantity'];
					$db_qt;
					foreach($pqt as $n):
						$db_qt = intval($n['purchaseStock']['quantity']);
					endforeach;
					
					if(intval($db_qt) >= intval($cqt))
					{
						$this->Issue->create();
						$db_qt = intval($db_qt) - intval($cqt);
						if ($this->Issue->save($this->request->data))
						{
							$this->Issue->query("update purchaseStock set purchaseStock.quantity = $db_qt where purchaseStock.material_id = '$cid'");	
							
							$nqt;
							$updatedDate = date('d-m-y');
							if($pqt = $this->Issue->query("select quantity as quantity from  department_stock where  department_stock.material_id = '$cid' and  department_stock.department_id = '$dpt_id'"))
							{
								foreach($pqt as $n):
									$nqt = intval($n['department_stock']['quantity']) + intval($cqt);
								endforeach;
								$this->Issue->query("update department_stock set department_stock.quantity = '$nqt', department_stock.date = '$updatedDate' where department_stock.material_id = '$cid' and  department_stock.department_id = '$dpt_id'");
							}
							else
							{
								$this->Issue->query("insert into department_stock(material_id,quantity,date,department_id) value('$cid',$cqt,'$updatedDate','$dpt_id')");
								
							}
							
							$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
							return $this->redirect(array('action' => 'index'));
						} else
						{
							$this->Session->setFlash(__('The request could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
							return $this->redirect(array('action' => 'index'));
						}
						
						
					}
					else
					{
						$this->Session->setFlash(__('Error: Please Enter Appropriate Quantity.'), array ('class' => 'alert alert-danger'));
						return $this->redirect(array('action' => 'index'));
					}
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
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Issue->save($this->request->data)) {
				return $this->flash(__('The issue has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
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
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Issue->delete()) {
			return $this->flash(__('The issue has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The issue could not be deleted. Please, try again.'), array('action' => 'index'));
		}
		
	}
	public function material()
	{
		$this->loadModel('Material');
		$mt=$this->Material->find('list', array('fields' => array('material_name', 'material_name')));
		$this->set('opt',$mt);
		
				
	}
	public function storelist()
	{
		$store=$this->Department->find('list',array('fields'=>array('name','name')));
		$this->set('store',$store);
		
	}
	
	}

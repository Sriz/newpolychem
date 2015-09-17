<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 *
 * @property Request $Request
 * @property PaginatorComponent $Paginator
 */
class RequestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	//public $uses      =  array('Material');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
	$this->Filter->addFilters(
							  array( 'filter1' => array(
														'OR' => array(
																	  'Request.material_id' => array('operator' => 'LIKE'),
																	  'Request.department_id' => array('operator' => 'LIKE'),
																	  'Request.user_id' => array('operator' => 'LIKE'),
																	  'Request.date' => array('operator' => 'LIKE')
																	  )
														)
									)
							  );
	$this->Filter->setPaginate('order', 'user_id ASC'); // optional
    $this->Filter->setPaginate('limit', 128);              // optional
    $this->Filter->setPaginate('conditions', $this->Filter->getConditions());// Define conditions
	
	$data = $this->Paginator->paginate(
    'Request', array('Request.department_id' => AuthComponent::user('role'))
);
	$this->set('requests', $data);
	
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		$this->set('request', $this->Request->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->material();
		$this->department();
		if ($this->request->is('post')) {
			$this->Request->create();
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index/sort:request_id/direction:desc'));
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
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index/sort:request_id/direction:desc'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
		}
		
	
	}
	public function material()
	{
		$this->loadModel('Material');
		$mt=$this->Material->find('list', array('fields' => array('material_name', 'material_name')));
		$this->set('materials',$mt);			
	}
	public function department()
	{
		$this->loadModel('Department');
		$d = $this->Department->find('list',array('fields'=>array('name','name')));
		$this->set('department',$d);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Request->delete()) {
			$this->Session->setFlash(__('The request has been deleted.'));
			return $this->redirect(array('action' => 'index/sort:request_id/direction:desc'));
		} else {
			$this->Session->setFlash(__('The request could not be deleted. Please, try again.'));
			return $this->redirect(array('action' => 'index/sort:request_id/direction:desc'));
		}
		
	}
	
	
	public function ajaxupdate()
	{
		$this->request->onlyAllow('ajax');
		if($_GET['id'] and $_GET['data'])
	{
	$id = $_GET['id'];
$data = $_GET['data'];
$key = $_GET['key'];
echo $key;
	}
	$this->Request->query("update request set $key='$data' where request_id='$id'");
	echo 'success';
		
	}
	public function create_pdf(){
		
 
   // $date1=date('00-m-Y');
	//$date2=date1('d-m-Y');
	
	$users = $this->User->find('all');
	$this->set(compact('users'));
	$this->loadModel('ConsumptionStock');
	$raws=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and date='18-06-2015' group by material_id order by consumption_id");
	$this->set('mixingraws',$raws);
	$scraps=$this->ConsumptionStock->query("select material_id,sum(quantity) as sum from consumption_stock where (material_id='Scrap Laminated' or material_id='Scrap Unprinted' or material_id='Scrap Printed' or material_id='Scrap CT' or material_id='Scrap Plain') and date='18-06-2015' group by material_id order by consumption_id");
	$this->set('mixingscraps',$scraps);
	$totalmaterials=$this->ConsumptionStock->query("select sum(quantity) as totalmaterial from consumption_stock where material_id !='Scrap Laminated' and material_id !='Scrap Plain'");
		$this->set('rawmaterial',$totalmaterials);
		$totalscrap=$this->ConsumptionStock->query("SELECT sum(quantity) as scrap_total from consumption_stock where (material_id='Scrap Laminated' or material_id='Scrap Plain' or material_id='Scrap Printed' or material_id='Scrap Unprinted' or material_id='Scrap CT') and date='18-06-2015'");
		$this->set("scraptotal",$totalscrap);
		$today=$this->ConsumptionStock->query("select sum(quantity) as total from consumption_stock where date='18-06-2015'");
		$this->set('totaltoday',$today);
		//$tomonth->$this->ConsumptionStcok->query("select sum(quantity) where date between $date to $date1");
		//$this->set('month',$month);
    $this->layout = '/pdf/default';
 
    $this->render('/pdf/my_pdf_view');
	
 
}
public function download_pdf() {
 
    $this->viewClass = 'Media';
 $name="Consumption Report for $date('d-m-Y')";
    $params = array(
 
        'id' => 'test.pdf',
        'name' => $name ,
        'download' => false,
        'extension' => 'pdf',
        'path' => APP . 'files/pdf' . DS
    );
 
    $this->set($params);
 
}
	
	}
	

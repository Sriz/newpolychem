<?php
App::uses('AppController', 'Controller');
/**
 * PrintingIssues Controller
 *
 * @property PrintingIssue $PrintingIssue
 * @property PaginatorComponent $Paginator
 */
class PrintingIssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	//public $components = array('Highcharts.Highcharts');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->rawmaterial();
		$this->totalfetch();
		$this->PrintingIssue->recursive = 0;
		 $this->paginate=array('limit' => 60);
		$this->set('printingIssues', $this->Paginator->paginate());
		$this->Filter->addFilters(
        array(
            'filter1' => array(
                'PrintingIssue.date' => array(
                    'operator' => 'LIKE',
                    'value' => array(
                        'before' => '%', // optional
                        'after'  => '%'  // optional
                    )
                )
            )
        )
    );
		 $this->Filter->setPaginate('order', 'PrintingIssue.date ASC'); // optional
    $this->Filter->setPaginate('limit', 60);     // optional

    // Define conditions
    $this->Filter->setPaginate('conditions', $this->Filter->getConditions());

    $this->PrintingIssue->recursive = 0;
    $this->set('printingIssues', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PrintingIssue->exists($id)) {
			throw new NotFoundException(__('Invalid printing issue'));
		}
		$options = array('conditions' => array('PrintingIssue.' . $this->PrintingIssue->primaryKey => $id));
		$this->set('printingIssue', $this->PrintingIssue->find('first', $options));
	
	
	
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->rawmaterial();
		if ($this->request->is('post')) {
			$this->PrintingIssue->create();
			if ($this->PrintingIssue->saveAll($this->request->data['PrintingIssue'])) {
				$this->Session->setFlash(__('The printing issue has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index/sort:id/direction:desc'));
			} else {
				$this->Session->setFlash(__('The printing issue could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
	$end=$id;
	$start=($id-15)-1;
	echo $start;
	echo $end;
		$this->set('datas',$this->PrintingIssue->query("SELECT * FROM `printing_issue` WHERE id between $start and $end"));

		if (!$this->PrintingIssue->exists($id)) {
			throw new NotFoundException(__('Invalid printing issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			foreach($this->request->data as $data):
			 $d[]=$data;
			endforeach;
			//print_r($d);
			for($i=1;$i<=15;$i++)
			{
				$material=$d['0'][$i]['material'];
				$pattern=$d['0'][$i]['pattern'];
				$quantity=$d['0'][$i]['quantity'];
				$date=$d['0'][$i]['date'];
				$total=$d['0'][$i]['total'];
				$this->PrintingIssue->query("UPDATE `polychem`.`printing_issue` SET `date` = '$date',`material` = '$material',`pattern` = '$pattern',`quantity` = '$quantity',`total` = '$total' WHERE `printing_issue`.`id` =$start");			
				$start=$start+1;
			}
			
			$options = array('conditions' => array('PrintingIssue.' . $this->PrintingIssue->primaryKey => $id));
			$this->request->data = $this->PrintingIssue->find('first', $options);
			return $this->redirect(array('action' => 'index/sort:consumption_id/direction:desc'));
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
		$this->PrintingIssue->id = $id;
		if (!$this->PrintingIssue->exists()) {
			throw new NotFoundException(__('Invalid printing issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrintingIssue->delete()) {
			$this->Session->setFlash(__('The printing issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The printing issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function rawmaterial()
	{
		$this->loadModel('PrintingRawmaterial');
		$this->loadModel('PrintingPattern');
		$option=$this->PrintingRawmaterial->find('list', array('fields' => array('printing_rawmaterialid', 'name')));
		$this->set('patterns',$option);
		$option1=$this->PrintingPattern->find('list', array('fields' => array('id', 'pattern_name'),'order'=>array('id ASC')));
		$this->set('rawmaterials',$option1);
		
		
				
	}
	public function totalfetch()
	{
		
		
		$this->set('total',$this->PrintingIssue->query("SELECT SUM(quantity) as total FROM printing_issue
                                  GROUP BY pattern ORDER BY id ASC "));
		
	}
	
	public function create_pissuepdf(){
		$this->request->onlyAllow('ajax');
		$date=$_POST['city_id'];
		$this->set('today',$date);
		$this->loadModel('PrintingStock');
		$material=$this->PrintingStock->query("SELECT *from printing_stock where date='$date'");
		$this->set('rawmaterials',$material);
		//$tots=$this->PrintingIssue->query("select sum(balance) as total_balance,sum(issue) as total_issue, sum(consumption) as total_consumption from printing_stock where date='$date'");
		
		
		$patt=$this->PrintingIssue->query("SELECT distinct(pattern),quantity from printing_issue where date ='$date'");
		$this->set('patterns',$patt);
		
		//$this->loadModel('PrintingexPattern');
		$option1=$this->PrintingIssue->query("SELECT material, quantity ,total
		FROM printing_issue  where date='$date'");
		$this->set('rawmaterials1',$option1);
		$this->set('totalp',$this->PrintingIssue->query("SELECT sum(quantity)  as quantity FROM printing_issue  where date='$date' group by pattern order by id"));
		
	
    $this->layout = '/pdf/default';
 
    $this->render('/pdf/print_issue_report');
	
 
}
public function download_pdf() {
 
    $this->viewClass = 'Media';
 //$name="Consumption Report for $date('d-m-Y')";
    $params = array(
 
        'id' => 'test.pdf',
        'name' => $name ,
        'download' => false,
        'extension' => 'pdf',
        'path' => APP . 'files/pdf' . DS
    );
 
    $this->set($params);
 
}
	
	public function material()
	{
		
	}
	
	public function date_fetch()
	{
		$this->request->onlyAllow('ajax');
		
	$id = $_POST['city_id'];
$this->Session->write('date', $id);
$this->create_pdf();

	}
	
	
	
	}

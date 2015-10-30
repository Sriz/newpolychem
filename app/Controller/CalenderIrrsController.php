<?php
App::uses('AppController', 'Controller');
/**
 * CalenderIrrs Controller
 *
 * @property CalenderIrr $CalenderIrr
 * @property PaginatorComponent $Paginator
 */
class CalenderIrrsController extends AppController {

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
		$this->CalenderIrr->recursive = 0;
		$this->set('calenderIrrs', $this->Paginator->paginate());
		$this->loadModel('CalenderCpr');
		$this->quality();
		
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CalenderIrr->exists($id)) {
			throw new NotFoundException(__('Invalid calender irr'));
		}
		$options = array('conditions' => array('CalenderIrr.' . $this->CalenderIrr->primaryKey => $id));
		$this->set('calenderIrr', $this->CalenderIrr->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CalenderIrr->create();
			if ($this->CalenderIrr->save($this->request->data)) {
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
		if (!$this->CalenderIrr->exists($id)) {
			throw new NotFoundException(__('Invalid calender irr'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CalenderIrr->save($this->request->data)) {
				return $this->flash(__('The calender irr has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CalenderIrr.' . $this->CalenderIrr->primaryKey => $id));
			$this->request->data = $this->CalenderIrr->find('first', $options);
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
		$this->CalenderIrr->id = $id;
		if (!$this->CalenderIrr->exists()) {
			throw new NotFoundException(__('Invalid calender irr'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CalenderIrr->delete()) {
			return $this->flash(__('The calender irr has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The calender irr could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	public function quality()
	{
		$option=$this->CalenderCpr->find('list',array('fields'=>array('quality','quality'),'order'=>'quality','group'=>'quality'));
		$this->set('quality',$option);
		//echo $option;
				
	}
	public function fetchdimension()
	{
		$this->request->onlyAllow('ajax');
    $this->loadModel('CalenderCpr');
    $qwt=$this->request->data['id'];
    //$tp=$this->request->data['type'];
   $type=$this->CalenderCpr->query("select distinct(dimension) from calender_cpr where quality='$qwt'");
              echo '<option value="null">Please select</option>';
             foreach($type as $t):
             
            echo '<option value="'.$t['calender_cpr']['dimension'].'">'.$t['calender_cpr']['dimension'].'</option>';
             
             endforeach;
    
    
}
public function fetchcolor()
	{
		$this->request->onlyAllow('ajax');
    $this->loadModel('CalenderCpr');
    $qwt=$this->request->data['id'];
    //$tp=$this->request->data['type'];
   $type=$this->CalenderCpr->query("select distinct(color) from calender_cpr where quality='$qwt'");
              echo '<option value="null">Please select</option>';
             foreach($type as $t):
             
            echo '<option value="'.$t['calender_cpr']['color'].'">'.$t['calender_cpr']['color'].'</option>';
			
			
             
             endforeach;
    
    
}
public function fetchemb()
{
	$this->request->onlyAllow('ajax');
    $this->loadModel('CalenderCpr');
    $qwt=$this->request->data['id'];
    //$tp=$this->request->data['type'];
   $type=$this->CalenderCpr->query("select distinct(embossing) from calender_cpr where quality='$qwt'");
              echo '<option value="null">Please select</option>';
             foreach($type as $t):
             
            echo '<option value="'.$t['calender_cpr']['embossing'].'">'.$t['calender_cpr']['embossing'].'</option>';
			
			
             
             endforeach;
	
}
	
	
	
	}

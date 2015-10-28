<?php
App::uses('AppController', 'Controller');
/**
 * CalenderPrograms Controller
 *
 * @property CalenderProgram $CalenderProgram
 * @property PaginatorComponent $Paginator
 */
class CalenderProgramsController extends AppController {

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
		$this->CalenderProgram->recursive = 0;
		$this->set('calenderPrograms', $this->Paginator->paginate());
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
		if (!$this->CalenderProgram->exists($id)) {
			throw new NotFoundException(__('Invalid calender program'));
		}
		$options = array('conditions' => array('CalenderProgram.' . $this->CalenderProgram->primaryKey => $id));
		$this->set('calenderProgram', $this->CalenderProgram->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CalenderProgram->create();
			if ($this->CalenderProgram->save($this->request->data)) {
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
		if (!$this->CalenderProgram->exists($id)) {
			throw new NotFoundException(__('Invalid calender program'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CalenderProgram->save($this->request->data)) {
				return $this->flash(__('The calender program has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('CalenderProgram.' . $this->CalenderProgram->primaryKey => $id));
			$this->request->data = $this->CalenderProgram->find('first', $options);
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
		$this->CalenderProgram->id = $id;
		if (!$this->CalenderProgram->exists()) {
			throw new NotFoundException(__('Invalid calender program'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CalenderProgram->delete()) {
			return $this->flash(__('The calender program has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The calender program could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	public function quality()
	{
		$tp=$this->CalenderCpr->find('list',array('fields'=>array('quality','quality'),'order'=>'quality','group'=>'quality'));
		$this->set('quality',$tp);
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


	}
	

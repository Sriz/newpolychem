<?php
App::uses('AppController', 'Controller');
/**
 * MixingMaterials Controller
 *
 * @property MixingMaterial $MixingMaterial
 * @property PaginatorComponent $Paginator
 */
class MixingMaterialsController extends AppController {

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
		$this->MixingMaterial->recursive = 0;
		$this->set('mixingMaterials', $this->Paginator->paginate());

        $this->loadModel('CategoryMaterial');
        $category = $this->CategoryMaterial->find('all');
        $this->set('category', $category);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MixingMaterial->exists($id)) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		$options = array('conditions' => array('MixingMaterial.' . $this->MixingMaterial->primaryKey => $id));
		$this->set('mixingMaterial', $this->MixingMaterial->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MixingMaterial->create();
			if ($this->MixingMaterial->save($this->request->data)) {

				$new_material = $this->request->data;
				//print'<pre>';print_r($new_material);print'</pre>';die;
				$this->loadModel('ConsumptionStock');
				$dates = $this->ConsumptionStock->query("select distinct(nepalidate) as nepalidate from consumption_stock order by consumption_id asc");
				
				//print'<pre>';print_r($dates);print'</pre>';die;
				$material_id_query=$this->MixingMaterial->query("select id from mixing_materials order by id desc limit 1");
    			
    			$material_id = $material_id_query[0]['mixing_materials']['id'];
    			//echo $material_id;die;
    			$dept = $new_material['MixingMaterial']['department'];
    			//echo $dept;die;
				foreach($dates as $date){
					$nepdate = $date['consumption_stock']['nepalidate'];
					
					$query = $this->ConsumptionStock->query("insert into consumption_stock
							  (quantity,department_id,nepalidate,m_id) 
			    		values('0','$dept','$nepdate','$material_id')");
					
				}
				

				$this->Session->setFlash(__('The mixing material has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mixing material could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
			}
		}
        $this->loadModel('CategoryMaterial');
        $category = $this->CategoryMaterial->find('all');
        $this->set('category', $category);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MixingMaterial->exists($id)) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MixingMaterial->save($this->request->data)) {
				$this->Session->setFlash(__('The mixing material has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mixing material could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MixingMaterial.' . $this->MixingMaterial->primaryKey => $id));
			$this->request->data = $this->MixingMaterial->find('first', $options);
		}
        $this->loadModel('CategoryMaterial');
        $category = $this->CategoryMaterial->find('all');
        $this->set('category', $category);
        $currentId =$this->MixingMaterial->query("SELECT * from mixing_materials WHERE  id='$id'")[0]['mixing_materials']['category_id'];
        $this->set('currentId', isset($currentId)?$currentId:null);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MixingMaterial->id = $id;
		if (!$this->MixingMaterial->exists()) {
			throw new NotFoundException(__('Invalid mixing material'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MixingMaterial->delete()) {
			$this->Session->setFlash(__('The mixing material has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mixing material could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

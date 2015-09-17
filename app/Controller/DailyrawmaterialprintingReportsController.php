<?php
App::uses('AppController', 'Controller');
/**
 * DailyrawmaterialprintingReports Controller
 *
 * @property DailyrawmaterialprintingReport $DailyrawmaterialprintingReport
 * @property PaginatorComponent $Paginator
 */
class DailyrawmaterialprintingReportsController extends AppController {

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
		$this->DailyrawmaterialprintingReport->recursive = 0;
		$this->set('dailyrawmaterialprintingReports', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DailyrawmaterialprintingReport->exists($id)) {
			throw new NotFoundException(__('Invalid dailyrawmaterialprinting report'));
		}
		$options = array('conditions' => array('DailyrawmaterialprintingReport.' . $this->DailyrawmaterialprintingReport->primaryKey => $id));
		$this->set('dailyrawmaterialprintingReport', $this->DailyrawmaterialprintingReport->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DailyrawmaterialprintingReport->create();
			if ($this->DailyrawmaterialprintingReport->save($this->request->data)) {
				return $this->flash(__('The dailyrawmaterialprinting report has been saved.'), array('action' => 'index'));
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
		if (!$this->DailyrawmaterialprintingReport->exists($id)) {
			throw new NotFoundException(__('Invalid dailyrawmaterialprinting report'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DailyrawmaterialprintingReport->save($this->request->data)) {
				return $this->flash(__('The dailyrawmaterialprinting report has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('DailyrawmaterialprintingReport.' . $this->DailyrawmaterialprintingReport->primaryKey => $id));
			$this->request->data = $this->DailyrawmaterialprintingReport->find('first', $options);
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
		$this->DailyrawmaterialprintingReport->id = $id;
		if (!$this->DailyrawmaterialprintingReport->exists()) {
			throw new NotFoundException(__('Invalid dailyrawmaterialprinting report'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DailyrawmaterialprintingReport->delete()) {
			return $this->flash(__('The dailyrawmaterialprinting report has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The dailyrawmaterialprinting report could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

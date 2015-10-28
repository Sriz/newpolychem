<?php
App::uses('AppController', 'Controller');

/**
 * BaseEmbosses Controller
 *
 * @property BaseEmboss $BaseEmboss
 * @property PaginatorComponent $Paginator
 */
class BaseEmbossesController extends AppController
{

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
    public function index()
    {
        $this->BaseEmboss->recursive = 0;
        $data = $this->Paginator->paginate();
        $data1 = array_unique($data);
        $this->set('baseEmbosses', $data1);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->BaseEmboss->exists($id)) {
            throw new NotFoundException(__('Invalid base emboss'));
        }
        $options = array('conditions' => array('BaseEmboss.' . $this->BaseEmboss->primaryKey => $id));
        $this->set('baseEmboss', $this->BaseEmboss->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->BaseEmboss->create();
            if ($this->BaseEmboss->save($this->request->data)) {
                $this->Session->setFlash(__('The base emboss has been saved.'), array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The base emboss could not be saved. Please, try again.'), array('class' => 'alert alert-danger'));
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
    public function edit($id = null)
    {
        if (!$this->BaseEmboss->exists($id)) {
            throw new NotFoundException(__('Invalid base emboss'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->BaseEmboss->save($this->request->data)) {
                $this->Session->setFlash(__('The base emboss has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The base emboss could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('BaseEmboss.' . $this->BaseEmboss->primaryKey => $id));
            $this->request->data = $this->BaseEmboss->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->BaseEmboss->id = $id;
        if (!$this->BaseEmboss->exists()) {
            throw new NotFoundException(__('Invalid base emboss'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->BaseEmboss->delete()) {
            $this->Session->setFlash(__('The base emboss has been deleted.'));
        } else {
            $this->Session->setFlash(__('The base emboss could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}

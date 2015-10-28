<?php
App::uses('AppController', 'Controller');

class CategoryPrintingController extends AppController {
	public $components = array('Paginator');
	public function index() {
        $this->loadModel('CategoryPrinting');
        $categoryItems = $this->CategoryPrinting->query("select * from category_printings");
        //send to view
        $this->set('categoryItems', $categoryItems);
	}

	public function add()
    {
        if ($this->request->is('post')) {
            $name = $this->request->data('name');
            //query to add to database
            $this->CategoryPrinting->query("insert into category_Printings (name) values ('$name')");
            //alert message
            $this->Session->setFlash(__('The mixing material Category has been saved.'));
            $this->redirect(['action'=>'index']);
        }
    }

    public function edit($id=null)
    {
        if($id):
        if($this->request->is('post'))
        {
            //$catId= $this->request->data('id');
            $name = $this->request->data('name');
            //query to add to database
            $this->CategoryPrinting->query("UPDATE category_printings SET name='$name' WHERE  id=$id");
            //alert message
            $this->Session->setFlash(__('The mixing material Category has been saved.'));
            $this->redirect(['action'=>'index']);
        }
        $category = $this->CategoryPrinting->query("SELECT * from category_printings where id=$id")[0]['category_printings'];
        $this->set('category',$category);
        endif;
    }

	public function delete($id = null) {
        if($id):
        $id = intval($id);
        $result = $this->CategoryPrinting->query("DELETE FROM category_printings WHERE id=$id");
        $this->Session->setFlash(__('Item Deleted Successfully.'));
        return $this->redirect(array('action' => 'index'));
        endif;
    }}

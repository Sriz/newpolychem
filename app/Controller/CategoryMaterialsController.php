<?php
App::uses('AppController', 'Controller');

class CategoryMaterialsController extends AppController {
	public $components = array('Paginator');
	public function index() {
        $this->loadModel('CategoryMaterial');
        $categoryItems = $this->CategoryMaterial->query("select * from category_materials");
        //send to view
        $this->set('categoryItems', $categoryItems);
	}

	public function add()
    {
        if ($this->request->is('post')) {
            $name = $this->request->data('name');
            //query to add to database
            $this->CategoryMaterial->query("insert into category_materials (name) values ('$name')");
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
            $this->CategoryMaterial->query("UPDATE category_materials SET name='$name' WHERE  id=$id");
            //alert message
            $this->Session->setFlash(__('The mixing material Category has been saved.'));
            $this->redirect(['action'=>'index']);
        }
        $category = $this->CategoryMaterial->query("SELECT * from category_materials where id=$id")[0]['category_materials'];
        $this->set('category',$category);
        endif;
    }

	public function delete($id = null) {
        if($id):
        $id = intval($id);
        $result = $this->CategoryMaterial->query("DELETE FROM category_materials WHERE id=$id");
        $this->Session->setFlash(__('Item Deleted Successfully.'));
        return $this->redirect(array('action' => 'index'));
        endif;
    }}

<?php
App::uses('AppController', 'Controller');

class TblPrintingIssuesController extends AppController
{

    public function index()
    {
        $this->TblPrintingIssue->recursive = 0;
        $this->loadModel('PrintingPattern');
        $this->loadModel('TblPrintingIssue');
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 7;
        $pagination->currentPage = isset($_GET['page_id']) ? $_GET['page_id'] <= 0 ? 1 : $_GET['page_id'] : 1;
        $pagination->offset = ($pagination->currentPage - 1) * $pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblPrintingIssue->find('all', [
                'conditions' => ['nepalidate' => $searchDate],
                'offset' => $pagination->offset,
                'limit' => $pagination->limit,
                'order' => ['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblPrintingIssue->find('all', ['conditions' => ['nepalidate' => $searchDate],])) / $pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblPrintingIssue->find('all', ['offset' => $pagination->offset, 'limit' => $pagination->limit, 'order' => ['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblPrintingIssue->find('all')) / $pagination->limit);
        }
        $material_lists = $this->PrintingPattern->find('all', [
            'order' => ['category_id ASC', 'pattern_name ASC']
        ]);

        $this->set('pagination', $pagination);
        $this->set('consumptions', isset($consumptions) ? $consumptions : null);
        $this->set('material_lists', isset($material_lists) ? $material_lists : null);
    }

    /*
     * Print function
     */
    public function pdf()
    {
        $this->loadModel('PrintingPattern');
        $this->loadModel('TblPrintingIssue');
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 7;
        $pagination->currentPage = isset($_GET['page_id']) ? $_GET['page_id'] <= 0 ? 1 : $_GET['page_id'] : 1;
        $pagination->offset = ($pagination->currentPage - 1) * $pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblPrintingIssue->find('all', [
                'conditions' => ['nepalidate' => $searchDate],
                'offset' => $pagination->offset,
                'limit' => $pagination->limit,
                'order' => ['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblPrintingIssue->find('all', ['conditions' => ['nepalidate' => $searchDate],])) / $pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblPrintingIssue->find('all', ['offset' => $pagination->offset, 'limit' => $pagination->limit, 'order' => ['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblPrintingIssue->find('all')) / $pagination->limit);
        }
        $material_lists = $this->PrintingPattern->find('all', [
            'order' => ['category_id ASC', 'pattern_name ASC']
        ]);
        $this->set('pagination', $pagination);
        $this->set('consumptions', isset($consumptions) ? $consumptions : null);
        $this->set('material_lists', isset($material_lists) ? $material_lists : null);
        $this->layout = 'pdf';
    }


    public function add()
    {
        $this->loadModel('BaseEmboss');

        if ($this->request->is('post')){
            $data = $this->request->data;
            //encode materials array as json
            $data['patterns'] = json_encode($data['patterns']);
            //save
            if ($this->TblPrintingIssue->save($data)) {
                // Set a session flash message and redirect.
                $this->Session->setFlash(__('The consumption stock has been saved.'), array('class' => 'alert alert-success'));
                return $this->redirect('index');
            }
        }
        $this->loadModel('PrintingPattern');

        $materials = $this->PrintingPattern->query("select * from printing_pattern ORDER BY category_id ASC, pattern_name ASC");
        // $materials = $this->PrintingPattern->find('all', [
        //         'order'=>['category_id ASC']]);
        $this->set('materials', $materials);
    }

    public function edit($id = null)
    {
        $this->loadModel('PrintingPattern');
        $this->TblPrintingIssue->id = $id;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            //encode materials array as json
            $data['patterns'] = json_encode($data['patterns']);
            //save
            if ($this->TblPrintingIssue->save($data)) {
                // Set a session flash message and redirect.
                $this->Session->setFlash('Data Saved!');
                return $this->redirect('index');
            }
        }
        $sql = "SELECT * FROM tbl_printing_issue WHERE  id=$id";
        $consumption = $this->TblPrintingIssue->query($sql);
        $this->loadModel('MixingMaterial');

        $materials = $this->PrintingPattern->query("select * from printing_pattern ORDER BY category_id ASC, pattern_name ASC");

        $this->set('materials', $materials);
        $this->set('consumption', $consumption);
    }
    public function delete($id = null)
    {
        $this->TblPrintingIssue->id = $id;
        if (!$this->TblPrintingIssue->exists()) {
            throw new NotFoundException(__('Invalid consumption stock'));
        }
        //TODO::check whether id came from tbl_printing_issue or not.
        if ($id) {
            $this->TblPrintingIssue->query("delete from tbl_printing_issue where id=$id");
            $this->Session->setFlash(__('The consumption stock has been deleted.'));
        } else {
            $this->Session->setFlash(__('The consumption stock could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }


    function exportcsv()
    {
        //exit;
        $this->loadModel('TblPrintingIssue');
        $result = $this->TblPrintingIssue->query("select * from tbl_printing_issue order by nepalidate desc");


        //print'<pre>';print_r($result);die;print'</pre>';
        $this->set('posts', $result);

        $this->layout = null;

        $this->autoLayout = false;

        Configure::write('debug', '2');
    }



}
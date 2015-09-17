<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'ConvertDates');
class TblConsumptionStocksController extends AppController
{
    public $components = array('Paginator', 'RequestHandler');
    public function index()
    {
        $this->TblConsumptionStock->recursive = 0;
        $this->loadModel('Material');
        $this->loadModel('MixingMaterial');
        $this->loadModel('Quality');
        $this->loadModel('TblConsumptionStock');
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 7;
        $pagination->currentPage = isset($_GET['page_id'])?$_GET['page_id']<=0?1:$_GET['page_id']:1;
        $pagination->offset =($pagination->currentPage-1)*$pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblConsumptionStock->find('all', [
                'conditions' => ['nepalidate' =>$searchDate],
                'offset'=>$pagination->offset,
                'limit' => $pagination->limit,
                'order'=>['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all', ['conditions' => ['nepalidate' =>$searchDate],]))/$pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblConsumptionStock->find('all', ['offset'=>$pagination->offset, 'limit' => $pagination->limit, 'order'=>['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all'))/$pagination->limit);
        }
        $material_lists = $this->MixingMaterial->find('all',[
            'order'=>['category_id ASC', 'name ASC']
        ]);
        $this->set('pagination', $pagination);
        $this->set('consumptions', isset($consumptions)?$consumptions:null);
        $this->set('material_lists', isset($material_lists)?$material_lists:null);
    }
    /*
     * Print function
     */
    public function pdf()
    {
        $this->loadModel('Material');
        $this->loadModel('MixingMaterial');
        $this->loadModel('Quality');
        $this->loadModel('TblConsumptionStock');
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 7;
        $pagination->currentPage = isset($_GET['page_id'])?$_GET['page_id']<=0?1:$_GET['page_id']:1;
        $pagination->offset =($pagination->currentPage-1)*$pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblConsumptionStock->find('all', [
                'conditions' => ['nepalidate' =>$searchDate],
                'offset'=>$pagination->offset,
                'limit' => $pagination->limit,
                'order'=>['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all', ['conditions' => ['nepalidate' =>$searchDate],]))/$pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblConsumptionStock->find('all', ['offset'=>$pagination->offset, 'limit' => $pagination->limit, 'order'=>['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all'))/$pagination->limit);
        }
        $material_lists = $this->MixingMaterial->find('all',[
            'order'=>['category_id ASC', 'name ASC']
        ]);
        $this->set('pagination', $pagination);
        $this->set('consumptions', isset($consumptions)?$consumptions:null);
        $this->set('material_lists', isset($material_lists)?$material_lists:null);
        $this->layout='pdf';
    }
    public function add()
    {
        $this->loadModel('BaseEmboss');
        $brand=$this->BaseEmboss->find('list',array('fields'=>array('Brand','Brand'),'order'=>'Brand','group'=>'Brand'));

        $dimensions=$this->BaseEmboss->find('list',array('fields'=>array('Dimension','Dimension'),'order'=>'Dimension','group'=>'Dimension'));
        //print_r($dimensions);die;
        //$colors=$this->BaseEmboss->find('list',array('fields'=>array('Color','Color'),'order'=>'Color','group'=>'Color'));
        $this->set('brand',$brand);
        $this->set('dimensions',$dimensions);
        //$this->set('colors',$colors);
        if ($this->request->is('post')) {
            $data = $this->request->data;
            //encode materials array as json
            $data['materials'] = json_encode($data['materials']);
            //save
            if ($this->TblConsumptionStock->save($data)) {
                // Set a session flash message and redirect.
                $this->Session->setFlash(__('The consumption stock has been saved.'), array('class' => 'alert alert-success'));
                return $this->redirect('index');
            }
        }
        $this->loadModel('MixingMaterial');

        $materials = $this->MixingMaterial->query("select * from mixing_materials ORDER BY category_id ASC, name ASC");
        // $materials = $this->MixingMaterial->find('all', [
        //         'order'=>['category_id ASC']]);
        $this->set('materials', $materials);
    }
   public function edit($id = null)
    {
        $this->loadModel('BaseEmboss');
        $brand=$this->BaseEmboss->find('list',array('fields'=>array('Brand','Brand'),'order'=>'Brand','group'=>'Brand'));
        $dimensions=$this->BaseEmboss->find('list',array('fields'=>array('Dimension','Dimension'),'order'=>'Dimension','group'=>'Dimension'));
        //$colors=$this->BaseEmboss->find('list',array('fields'=>array('Color','Color'),'order'=>'Color','group'=>'Color'));
        $this->set('brand',$brand);
        $this->set('dimensions',$dimensions);
        //$this->set('colors',$colors);
        $this->TblConsumptionStock->id = $id;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            //encode materials array as json
            $data['materials'] = json_encode($data['materials']);
            //save
            if ($this->TblConsumptionStock->save($data)) {
                // Set a session flash message and redirect.
                $this->Session->setFlash('Data Saved!');
                return $this->redirect('index');
            }
        }
        $sql = "SELECT * FROM tbl_consumption_stock WHERE  id=$id";
        $consumption = $this->TblConsumptionStock->query($sql);
        $this->loadModel('MixingMaterial');
//        $materials = $this->MixingMaterial->find('all', ['order'=>['category_id ASC']]);
        $materials = $this->MixingMaterial->query("select * from mixing_materials ORDER BY category_id ASC, name ASC");
        $this->set('materials', $materials);
        $this->set('consumption', $consumption);
    }
    public function delete($id = null)
    {
        $this->TblConsumptionStock->id = $id;
        if (!$this->TblConsumptionStock->exists()) {
            throw new NotFoundException(__('Invalid consumption stock'));
        }
        //TODO::check whether id came from tbl_consumption_stock or not.
        if ($id) {
            $this->TblConsumptionStock->query("delete from tbl_consumption_stock where id=$id");
            $this->Session->setFlash(__('The consumption stock has been deleted.'));
        } else {
            $this->Session->setFlash(__('The consumption stock could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
public function t()
    {
            $this->request->onlyAllow('ajax');
            $this->loadModel('BaseEmboss');
            $d=$this->request->data['id'];
            $type=$this->BaseEmboss->query("select distinct(Type) from BaseEmboss where Brand='$d' order by Type asc");
            $arr = array();
            foreach($type as $t):
                $arr[] =$t['BaseEmboss']['Type'];
            endforeach;
            echo "<option value=''>--Choose One--</option>";
            foreach($arr as $t):
            echo "<option value=$t>$t</option>";
            endforeach;
    }
    public function qualityChange()
    {
        //$this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $brand=$this->request->data['brand'];
        $type=$this->request->data['quality'];

        $dimension=$this->BaseEmboss->query("select distinct(Dimension) from BaseEmboss where Brand='$brand'");
        
        $arr = array();
        foreach($dimension as $d):
            $arr[] =$d['BaseEmboss']['Dimension'];

        endforeach;

        echo "<option value=''>--Choose One--</option>";
        foreach($arr as $ta):
            echo "<option value='$ta'>$ta</option>";
        endforeach;
        exit;
    }
    public function dimensionChange()
    {
        //$this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $brand=$this->request->data['brand'];
        $type=$this->request->data['quality'];
        $dimension=$this->request->data['dimension'];
        $color=$this->BaseEmboss->query("select distinct(Color) from BaseEmboss where Brand='$brand' AND Type like '$type%' AND Dimension='$dimension' order by Color asc");
        $arr = array();
        foreach($color as $c):
            $arr[] =$c['BaseEmboss']['Color'];
        endforeach;

        echo "<option value=''>--Choose One--</option>";
        foreach($arr as $t):
            echo "<option value=$t>$t</option>";
        endforeach;
        exit;
    }


    function exportcsv() 
    {
        $this->loadModel('TblConsumptionStock');
        $result=$this->TblConsumptionStock->query("select * from tbl_consumption_stock order by nepalidate desc");

        
        //print'<pre>';print_r($result);die;print'</pre>';
        $this->set('posts', $result);

        $this->layout = null;

        $this->autoLayout = false;

        Configure::write('debug','2');
    }



    

}
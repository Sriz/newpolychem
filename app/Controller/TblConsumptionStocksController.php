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
        $pagination->currentPage = isset($_GET['page_id']) ? $_GET['page_id'] <= 0 ? 1 : $_GET['page_id'] : 1;
        $pagination->offset = ($pagination->currentPage - 1) * $pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblConsumptionStock->find('all', [
                'conditions' => ['nepalidate' => $searchDate],
                'offset' => $pagination->offset,
                'limit' => $pagination->limit,
                'order' => ['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all', ['conditions' => ['nepalidate' => $searchDate],])) / $pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblConsumptionStock->find('all', ['offset' => $pagination->offset, 'limit' => $pagination->limit, 'order' => ['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all')) / $pagination->limit);
        }
        $material_lists = $this->MixingMaterial->find('all', [
            'order' => ['category_id ASC', 'name ASC']
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
        $this->loadModel('Material');
        $this->loadModel('MixingMaterial');
        $this->loadModel('Quality');
        $this->loadModel('TblConsumptionStock');
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 7;
        $pagination->currentPage = isset($_GET['page_id']) ? $_GET['page_id'] <= 0 ? 1 : $_GET['page_id'] : 1;
        $pagination->offset = ($pagination->currentPage - 1) * $pagination->limit;
        //search action
        $searchDate = isset($_GET['q']) ? $_GET['q'] : null;
        if ($searchDate) {
            //query to search
            $searchQuery = $this->TblConsumptionStock->find('all', [
                'conditions' => ['nepalidate' => $searchDate],
                'offset' => $pagination->offset,
                'limit' => $pagination->limit,
                'order' => ['nepalidate DESC']
            ]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all', ['conditions' => ['nepalidate' => $searchDate],])) / $pagination->limit);
            if ($searchQuery) {
                $consumptions = $searchQuery;
            }
        } else {
            //'order' => array('Model.created', 'Model.field3 DESC'),
            $consumptions = $this->TblConsumptionStock->find('all', ['offset' => $pagination->offset, 'limit' => $pagination->limit, 'order' => ['nepalidate DESC']]);
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->find('all')) / $pagination->limit);
        }
        $material_lists = $this->MixingMaterial->find('all', [
            'order' => ['category_id ASC', 'name ASC']
        ]);
        $this->set('pagination', $pagination);
        $this->set('consumptions', isset($consumptions) ? $consumptions : null);
        $this->set('material_lists', isset($material_lists) ? $material_lists : null);
        $this->layout = 'pdf';
    }

    public function add()
    {
        $this->loadModel('BaseEmboss');
        $brand = $this->BaseEmboss->find('list', array('fields' => array('Brand', 'Brand'), 'order' => 'Brand', 'group' => 'Brand'));

        $dimensions = $this->BaseEmboss->find('list', array('fields' => array('Dimension', 'Dimension'), 'order' => 'Dimension', 'group' => 'Dimension'));
        //print_r($dimensions);die;
        //$colors=$this->BaseEmboss->find('list',array('fields'=>array('Color','Color'),'order'=>'Color','group'=>'Color'));
        $this->set('brand', $brand);
        $this->set('dimensions', $dimensions);
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
        $brand = $this->BaseEmboss->find('list', array('fields' => array('Brand', 'Brand'), 'order' => 'Brand', 'group' => 'Brand'));
        $dimensions = $this->BaseEmboss->find('list', array('fields' => array('Dimension', 'Dimension'), 'order' => 'Dimension', 'group' => 'Dimension'));
        //$colors=$this->BaseEmboss->find('list',array('fields'=>array('Color','Color'),'order'=>'Color','group'=>'Color'));
        $this->set('brand', $brand);
        $this->set('dimensions', $dimensions);
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

        $materials = $this->MixingMaterial->query("select * from mixing_materials ORDER BY category_id ASC, name ASC");

        $brand = $consumption[0]['tbl_consumption_stock']['brand'];
        $quality = $consumption[0]['tbl_consumption_stock']['quality'];
        $dimension = $consumption[0]['tbl_consumption_stock']['dimension'];
        $color = $consumption[0]['tbl_consumption_stock']['color'];

        $this->loadModel('BaseEmboss');
        $qualityQuery = $this->BaseEmboss->query("select distinct(Type) from BaseEmboss where Brand='$brand' order by Type asc");
        $arrQuality = array();
        foreach ($qualityQuery as $t):
            $arrQuality[] = $t['BaseEmboss']['Type'];
        endforeach;

        $dimensionQuery = $this->BaseEmboss->query("select distinct(Dimension) from BaseEmboss where Brand='$brand'");
        $arrDimension = array();
        foreach ($dimensionQuery as $d):
            $arrDimension[] = $d['BaseEmboss']['Dimension'];
        endforeach;
        $colorQuery = $this->BaseEmboss->query("select distinct(Color) from BaseEmboss where Brand='$brand' AND Type like '$quality%' AND Dimension='$dimension' order by Color asc");
        $arrColor = array();
        foreach ($colorQuery as $c):
            $arrColor[] = $c['BaseEmboss']['Color'];
        endforeach;

        $this->set('arrQuality', $arrQuality);
        $this->set('arrDimension', $arrDimension);
        $this->set('arrColor', $arrColor);


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
        $d = $this->request->data['id'];
        $type = $this->BaseEmboss->query("select distinct(Type) from BaseEmboss where Brand='$d' order by Type asc");
        $arr = array();
        foreach ($type as $t):
            $arr[] = $t['BaseEmboss']['Type'];
        endforeach;
        echo "<option value=''>--Choose One--</option>";
        foreach ($arr as $t):
            echo "<option value=$t>$t</option>";
        endforeach;
    }

    public function qualityChange()
    {
        //$this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $brand = $this->request->data['brand'];
        $type = $this->request->data['quality'];

        $dimension = $this->BaseEmboss->query("select distinct(Dimension) from BaseEmboss where Brand='$brand'");

        $arr = array();
        foreach ($dimension as $d):
            $arr[] = $d['BaseEmboss']['Dimension'];

        endforeach;

        echo "<option value=''>--Choose One--</option>";
        foreach ($arr as $ta):
            echo "<option value='$ta'>$ta</option>";
        endforeach;
        exit;
    }

    public function dimensionChange()
    {
        //$this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $brand = $this->request->data['brand'];
        $type = $this->request->data['quality'];
        $dimension = $this->request->data['dimension'];
        $color = $this->BaseEmboss->query("select distinct(Color) from BaseEmboss where Brand='$brand' AND Type like '$type%' AND Dimension='$dimension' order by Color asc");
        $arr = array();
        foreach ($color as $c):
            $arr[] = $c['BaseEmboss']['Color'];
        endforeach;

        echo "<option value=''>--Choose One--</option>";
        foreach ($arr as $t):
            echo "<option value=$t>$t</option>";
        endforeach;
        exit;
    }


    function exportcsv()
    {
        //exit;
        $this->loadModel('TblConsumptionStock');
        $result = $this->TblConsumptionStock->query("select * from tbl_consumption_stock order by nepalidate desc");


        //print'<pre>';print_r($result);die;print'</pre>';
        $this->set('posts', $result);

        $this->layout = null;

        $this->autoLayout = false;

        Configure::write('debug', '2');
    }

    function monthly_report()
    {
        $this->request->onlyAllow('ajax');
        $month = $_POST['id'];
        $this->loadModel('MixingMaterial');
        $this->loadModel('CategoryMaterial');
        $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC ");
        $lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1")[0]['tbl_consumption_stock']['nepalidate'];
        $month = '%'.substr($lastDate, 0, 4).'-'.$month.'%';

        $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate like '$month'");

        echo '<table class="table table-bordered">';
        echo '<tr class="success"><td>Materials</td><td>Quantity</td><td>Percentage</td></tr>';
        
        $v=0;
        $atr=0;
        $ts=0;
        $tbs=0;

        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $v = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $v = 0;
                }
                if($m['mixing_materials']['category_id']==13){
                    $tbs += $v;
                }elseif($m['mixing_materials']['category_id']==14){
                    $ts += $v;
                }else{

                    $atr = $v+$atr;
                }
            endforeach;
        endforeach;
        $tq = $atr?$atr:1;


        $i=0;
        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
        $totalBroughtScrap=0;
        $totalScrap =0;
        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $valMaterial = 0;
                }
                if($m['mixing_materials']['category_id']==13){
                    $totalBroughtScrap += $valMaterial;
                }elseif($m['mixing_materials']['category_id']==14){
                    $totalScrap += $valMaterial;
                }else{
                    $totalMaterial += $valMaterial;
                    $allTotalRaw = $valMaterial+$allTotalRaw;
                    $valMaterial =  0;
                }
                $allTotal += $valMaterial;
            endforeach;
            if($m['mixing_materials']['category_id']!=13 && $m['mixing_materials']['category_id']!=14) {
                echo '<tr class="warning"><td>' . $m['mixing_materials']['name'] . '</td><td>' . number_format($totalMaterial, 2) . '</td><td>' . number_format($totalMaterial * 100 / $atr, 2) . '%</td></tr>';
                
            }
            $totalMaterial = 0;
        endforeach;

        $total = $allTotalRaw+$totalBroughtScrap+$totalScrap;
        $total = $total?$total:1;   
        //echo $total;die;
        echo '<tr class="success"><td>Total Raw Materials</td><td>'.number_format($allTotalRaw,2).'</td><td>'.number_format($allTotalRaw*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';
        //need to fix $totalBroughtScrap
        //$totalBroughtScrap = $totalBroughtScrap/2;
        $bought_percent = $totalBroughtScrap*100/$total;
        echo '<tr class="success"><td>Total Bought Scrap </td><td>'.number_format($totalBroughtScrap,2).'</td><td>'.number_format($totalBroughtScrap*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';




        $valMat = 0;
        //$allTotalScrap =0;
        //$TotalScrap1 =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $valMat = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $valMat = 0;
                }
                if($m['mixing_materials']['category_id']==14){
                    $totalScrap1 += $valMat;
                }
                $allTotalScrap += $valMat;
            endforeach;
            if($m['mixing_materials']['category_id']==14) {
                echo '<tr class="warning"><td>' . $m['mixing_materials']['name'] . '</td><td>' . number_format($totalScrap1, 2) . '</td><td>' . number_format($totalScrap1 * 100 / $totalScrap, 2) . '%</td></tr>';
            }
            $totalScrap1 = 0;
        endforeach;







        
        
        echo '<tr class="success"><td>Total Factory Scrap </td><td>'.number_format($totalScrap,2).'</td><td>'.number_format($totalScrap*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';
        
        echo '<tr class="danger"><td>Total Materials </td><td>'.number_format($total,2).'</td><td>'.number_format($total*100/$total,2).'%</td></tr>';
        echo '</table>';

       
        exit;
    }


 function to_date_consumption()
    {
        $this->request->onlyAllow('ajax');
        $dim = $_POST['dim'];
        $brand = $_POST['brand'];
        //echo $dim.'<br/>'.$brand;die;
        $this->loadModel('MixingMaterial');
        $this->loadModel('CategoryMaterial');
        $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC ");
        //$lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1")[0]['tbl_consumption_stock']['nepalidate'];
        //$month = '%'.substr($lastDate, 0, 4).'-'.$month.'%';

        $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where dimension='$dim' and brand='$brand'");

        echo '<table class="table table-bordered">';
        echo '<tr class="success"><td>Materials</td><td>Quantity</td><td>Percentage</td></tr>';
        
        $v=0;
        $atr=0;
        $ts=0;
        $tbs=0;

        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $v = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $v = 0;
                }
                if($m['mixing_materials']['category_id']==13){
                    $tbs += $v;
                }elseif($m['mixing_materials']['category_id']==14){
                    $ts += $v;
                }else{

                    $atr = $v+$atr;
                }
            endforeach;
        endforeach;
        $tq = $atr?$atr:1;


        $i=0;
        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
        $totalBroughtScrap=0;
        $totalScrap =0;
        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $valMaterial = 0;
                }
                if($m['mixing_materials']['category_id']==13){
                    $totalBroughtScrap += $valMaterial;
                }elseif($m['mixing_materials']['category_id']==14){
                    $totalScrap += $valMaterial;
                }else{
                    $totalMaterial += $valMaterial;
                    $allTotalRaw = $valMaterial+$allTotalRaw;
                    $valMaterial =  0;
                }
                $allTotal += $valMaterial;
            endforeach;
            if($m['mixing_materials']['category_id']!=13 && $m['mixing_materials']['category_id']!=14) {
                echo '<tr class="warning"><td>' . $m['mixing_materials']['name'] . '</td><td>' . number_format($totalMaterial, 2) . '</td><td>' . number_format($totalMaterial * 100 / $atr, 2) . '%</td></tr>';
                
            }
            $totalMaterial = 0;
        endforeach;

        $total = $allTotalRaw+$totalBroughtScrap+$totalScrap;
        $total = $total?$total:1;   
        //echo $total;die;
        echo '<tr class="success"><td>Total Raw Materials</td><td>'.number_format($allTotalRaw,2).'</td><td>'.number_format($allTotalRaw*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';
        //need to fix $totalBroughtScrap
        //$totalBroughtScrap = $totalBroughtScrap/2;
        $bought_percent = $totalBroughtScrap*100/$total;
        echo '<tr class="success"><td>Total Bought Scrap </td><td>'.number_format($totalBroughtScrap,2).'</td><td>'.number_format($totalBroughtScrap*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';




        $valMat = 0;
        //$allTotalScrap =0;
        //$TotalScrap1 =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
        foreach($allMaterials as $m):
            foreach($allConsumptionStocks as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $valMat = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $valMat = 0;
                }
                if($m['mixing_materials']['category_id']==14){
                    $totalScrap1 += $valMat;
                }
                $allTotalScrap += $valMat;
            endforeach;
            if($m['mixing_materials']['category_id']==14) {
                echo '<tr class="warning"><td>' . $m['mixing_materials']['name'] . '</td><td>' . number_format($totalScrap1, 2) . '</td><td>' . number_format($totalScrap1 * 100 / $totalScrap, 2) . '%</td></tr>';
            }
            $totalScrap1 = 0;
        endforeach;







        
        
        echo '<tr class="success"><td>Total Factory Scrap </td><td>'.number_format($totalScrap,2).'</td><td>'.number_format($totalScrap*100/$total,2).'%</td></tr>';
        echo'<tr><td colspan="3"></td></tr>';
        
        echo '<tr class="danger"><td>Total Materials </td><td>'.number_format($total,2).'</td><td>'.number_format($total*100/$total,2).'%</td></tr>';
        echo '</table>';

       
        exit;
    }

   
}
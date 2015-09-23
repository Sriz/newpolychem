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


    // function monthly_report()
    // {
    //     $this->request->onlyAllow('ajax');
    //     $month = $_POST['id'];
    //     $this->loadModel('MixingMaterial');
    //     $this->loadModel('CategoryMaterial');
    //     $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials");
    //     $lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1")[0]['tbl_consumption_stock']['nepalidate'];
    //     $month = '%'.substr($lastDate, 0, 4).'-'.$month.'%';

    //     $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate like '$month'");
    //     $materialCategory = $this->CategoryMaterial->query("SELECT * FROM category_materials");

    //     echo '<table class="table table-bordered">';
    //     echo '<tr class="success"><td>Materials</td><td>Quantity</td><td>Percentage</td></tr>';
    //     $totalBroughtScrap=0;
    //     $totalScrap =0;
    //     $totalRawMaterials = 0;
    //     $allTotal =0;
    //     $totalMaterial=0;
    //     $grandTotal = 0;
    //     $allTotalRaw = 0;
    //     foreach($allMaterials as $m):
    //         foreach($allConsumptionStocks as $c):
    //             $materialJSON = $c['tbl_consumption_stock']['materials'];
    //             $materialOBJ = json_decode($materialJSON);
    //             if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
    //                 $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
    //             }else{
    //                 $valMaterial = 0;
    //             }

    //             if($m['mixing_materials']['category_id']==13){
    //                 $totalBroughtScrap += $valMaterial;
    //             }elseif($m['mixing_materials']['category_id']==14){
    //                 $totalScrap += $valMaterial;
    //             }else{
    //                 $totalMaterial += $valMaterial;
    //                 $allTotalRaw = $valMaterial+$allTotalRaw;
    //                 $valMaterial =  0;
    //             }
    //             $allTotal += $valMaterial;
    //         endforeach;
    //         echo '<tr><td>'.$m['mixing_materials']['name'].'</td><td>'.number_format($totalMaterial,2).'</td><td>11%</td></tr>';
    //         $totalMaterial = 0;
    //     endforeach;
    //     echo '<tr><td>Total </td><td>'.number_format($allTotalRaw).'</td></tr>';
    //     echo '<tr><td>Total Brought Scrap </td><td>'.number_format($totalBroughtScrap,2).'</td></tr>';
    //     echo '<tr><td>Total Scrap </td><td>'.number_format($totalScrap,2).'</td></tr>';
    //     echo '</table>';
    //     //echo $allTotal;
    //     //var_dump($allConsumptionStocks);

    //     exit;
    //}



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
        $totalBroughtScrap=0;
        $totalScrap =0;

        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;

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

                    $allTotalRaw = $valMaterial+$allTotalRaw;
                }
            endforeach;
        endforeach;
        $totalQuantity = $allTotalRaw?$allTotalRaw:1;
        $i=0;
        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
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
            echo '<tr><td>'.$m['mixing_materials']['name'].'</td><td>'.number_format($totalMaterial,2).'</td><td>'.number_format($totalMaterial*100/$totalQuantity, 2).'%</td></tr>';
            $result[$i]['material_name']=$m['mixing_materials']['name'];
            $result[$i]['material_quantity']=$totalMaterial;
            $result[$i]['material_percent']=$totalMaterial*100/$totalQuantity;

            $totalMaterial = 0;
        endforeach;
        $total = $allTotalRaw+$totalBroughtScrap+$totalScrap;
        $raw_percent = $allTotalRaw*100/$total;
        echo '<tr class="success"><td>Total Raw Materials</td><td>'.number_format($allTotalRaw,2).'</td><td>'.number_format($raw_percent,2).'%</td></tr>';
        $bought_percent = $totalBroughtScrap*100/$total;
        echo '<tr class="info"><td>Total Bought Scrap </td><td>'.number_format($totalBroughtScrap,2).'</td><td>'.number_format($bought_percent,2).'%</td></tr>';
        $scrap_percent = $totalScrap*100/$total;
        echo '<tr class="warning"><td>Total Factory Scrap </td><td>'.number_format($totalScrap,2).'</td><td>'.number_format($scrap_percent,2).'%</td></tr>';
        $total_percent = $raw_percent+$bought_percent+$scrap_percent;
        echo '<tr class="danger"><td>Total Materials </td><td>'.number_format($total,2).'</td><td>'.number_format($total_percent,2).'%</td></tr>';
        echo '</table>';

        $result['total_raw']=$allTotalRaw;
        $result['total_raw_percent']=$raw_percent;
        $result['total_bought']=$totalBroughtScrap;
        $result['total_bought_percent']=$bought_percent;
        $result['total_scrap']=$totalScrap;
        $result['total_scrap_percent']=$scrap_percent;
        $result['total_percent']=$total_percent;
        //echo $allTotal;
        //var_dump($allConsumptionStocks);

        
        // echo $this->Html->link('Download CSV file', array('action' => 'export_monthly_report'), array('target' => '_blank', 'class' => 'btn btn-success'));
        // $this->set('posts', $result);
        exit;
    }


    //download csv for monthly report
    function export_monthly_report(){
        
    }

    //end of download csv for monthly report

    //To date consumption

    function to_date_consumption()
    {
        $this->request->onlyAllow('ajax');
        $dim = $_POST['dim'];
        $brand = $_POST['brand'];
        //echo $dim.'<br/>'.$brand;die;

        $this->loadModel('MixingMaterial');
        $this->loadModel('CategoryMaterial');
        $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC");
        // $lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock");
        $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where dimension='$dim' and brand='$brand'");
        //echo'<pre>';print_r($allConsumptionStocks);die;


        echo '<table class="table table-bordered">';
        echo '<tr class="success"><td>Materials</td><td>Quantity</td><td>Percentage</td></tr>';
        $totalBroughtScrap=0;
        $totalScrap =0;

        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;

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

                    $allTotalRaw = $valMaterial+$allTotalRaw;
                }
            endforeach;
        endforeach;
        $totalQuantity = $allTotalRaw?$allTotalRaw:1;

        $allTotal =0;
        $totalMaterial=0;
        $allTotalRaw = 0;
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
            echo '<tr><td>'.$m['mixing_materials']['name'].'</td><td>'.number_format($totalMaterial,2).'</td><td>'.number_format($totalMaterial*100/$totalQuantity, 2).'%</td></tr>';
            $totalMaterial = 0;
        endforeach;
        $total = $allTotalRaw+$totalBroughtScrap+$totalScrap;
        $raw_percent = $allTotalRaw*100/$total;
        echo '<tr class="success"><td>Total Raw Materials</td><td>'.number_format($allTotalRaw,2).'</td><td>'.number_format($raw_percent,2).'%</td></tr>';
        $bought_percent = $totalBroughtScrap*100/$total;
        echo '<tr class="info"><td>Total Bought Scrap </td><td>'.number_format($totalBroughtScrap,2).'</td><td>'.number_format($bought_percent,2).'%</td></tr>';
        $scrap_percent = $totalScrap*100/$total;
        echo '<tr class="warning"><td>Total Factory Scrap </td><td>'.number_format($totalScrap,2).'</td><td>'.number_format($scrap_percent,2).'%</td></tr>';
        $total_percent = $raw_percent+$bought_percent+$scrap_percent;
        echo '<tr class="danger"><td>Total Materials </td><td>'.number_format($total,2).'</td><td>'.number_format($total_percent,2).'%</td></tr>';
        echo '</table>';
        //echo $allTotal;
        //var_dump($allConsumptionStocks);

        exit;
    }

    //end of to date consumption
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


//      public function monthly_report()
//     {
//         ob_end_clean();
//         //$d= array("orange", "banana");
//         $d = array();
//         $startday = "01";
//         $endday = "32";
//         $getmonth = $_POST['id'];
//         $this->loadModel('TblConsumptionStock');
//         $date = $this->TblConsumptionStock->query("select nepalidate from tbl_consumption_stock order by nepalidate desc limit 1");
//         foreach ($date as $n):
//             $nepdte = $n['tbl_consumption_stock']['nepalidate'];
//         endforeach;
//         $nepdate = explode('-', $nepdte);
//         $year = $nepdate[0];


//         $startmonth = $year . "-" . $getmonth . "-" . $startday;
//         $endmonth = $year . "-" . $getmonth . "-" . $endday;
//         //echo $startmonth;echo $endmonth;die;
//         $this->set('date1', $endmonth);
//         $users = $this->User->find('all');
//         $this->set(compact('users'));
//         //$this->loadModel('TblConsumptionStock');

//         //$raws=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and date BETWEEN '$startmonth' and '$endmonth' group by material_id order by consumption_id");
//         $material = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate between '$startmonth' and '$endmonth'");
//         //echo'<pre>';print_r($material);die;
//        // $material_one_d=$this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date'");
//         //print_r($material_one_d);die;
//         $this->loadModel('MixingMaterial');
//         $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id!=13 and category_id!=14");        
//         //$total_raw=0;

//         foreach($mix_id as $material_id):   
//             echo'<pre>';print_r($material_id);die;
//             //$total['mixing_materials']['id']=
//         endforeach;


//         foreach($material as $mater):
//             $materials = json_decode($mater['tbl_consumption_stock']['materials'],true);
//             $i=0;
//             foreach($mix_id as $m):
//                 $material1[$i] = $materials[$m['mixing_materials']['id']];
//                 $i++;
//             endforeach;

//             echo'<pre>';print_r($material1);die;

//         endforeach;

        
        

       



//         $mix_id = $this->MixingMaterial->query("select id,name from mixing_materials where category_id!=13 and category_id!=14");        
//         $i=0;
//         foreach($mix_id as $m):
//             foreach($material_one_d as $md):
//                 $materials = json_decode($md['tbl_consumption_stock']['materials']);
//                 $total_raw_indi[$i] = $materials->$m['mixing_materials']['id'];
//             endforeach;
//             $i++;
//         endforeach;

        
        
//         $this->set('raw_materials_d',$total_raw);
// //echo'<pre>';print_r($raws)die;





//         $total = $this->ConsumptionStock->query("SELECT  sum(quantity) as total FROM polychem.consumption_stock
// where material_id<>'Bought Scrap' and material_id<>'Scrap Laminated' and material_id<>'Scrap Printed'
// and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth'");
//         foreach ($total as $t):
//             $totalinput = $t['0']['total'];
//         endforeach;

//         $scrap = $this->ConsumptionStock->query("SELECT sum(quantity) as total FROM polychem.consumption_stock where material_id='Bought Scrap' OR material_id='Scrap Laminated' OR material_id='Scrap Printed' OR material_id='Scrap Unprinted' OR material_id='Scrap Plain' OR material_id='Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth' ");

//         foreach ($scrap as $sc):
//             $totalscrap = $sc['0']['total'];
//         endforeach;

//         echo "<table>";
//         foreach ($raws as $r):
//             echo "<tr>";
//             echo "<td align='left'>" . $r['consumption_stock']['material_id'] . "</td>";
//             echo "<td align='right'>&nbsp;&nbsp;" . number_format($r['0']['total'], 2) . "</td>";
//             echo "<td align='right'>&nbsp;&nbsp;&nbsp;" . number_format($r['0']['rawpercentage'], 2) . "%</td>";

//             echo "</tr>";
//         endforeach;
//         if (empty($raws)) {
//             echo "<tr>";
//             echo "<td><strong>Total</strong></td>";
//             echo "<td align='right'>" . number_format(0, 2) . "</td>";
//             echo "</tr>";
//             echo "<tr>";
//             echo "<td><strong>Total Scrap</strong></td>";
//             echo "<td align='right'>" . number_format(0, 2) . "</td>";
//             echo "</tr>";
//             echo "<tr>";
//             echo "<td><strong>Total Input</strong></td>";
//             echo "<td align='right'>" . number_format(0, 2) . "</td>";
//             echo "</tr>";

//             echo "</table>";
//         } else {
//             echo "<tr>";
//             echo "<td><strong>Total</strong></td>";
//             echo "<td align='right'>" . number_format($totalinput, 2) . "</td>";
//             echo "</tr>";
//             echo "<tr>";
//             echo "<td><strong>Total Scrap</strong></td>";
//             echo "<td align='right'>" . number_format($totalscrap, 2) . "</td>";
//             echo "</tr>";
//             echo "<tr>";
//             echo "<td><strong>Total Input</strong></td>";
//             echo "<td align='right'>" . number_format($totalinput + $totalscrap, 2) . "</td>";
//             echo "</tr>";

//             echo "</table>";
//         }
//     }





    

}
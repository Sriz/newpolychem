<?php
App::uses('AppController', 'Controller');
/**
 * CalenderCprs Controller
 *
 * @property CalenderCpr $CalenderCpr
 * @property PaginatorComponent $Paginator
 */
class CalenderCprsController extends AppController
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
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('MixingMaterials');
        $lastDate = $this->TblConsumptionStock->query("SELECT nepalidate from tbl_consumption_stock order by nepalidate desc limit 1")[0]['tbl_consumption_stock']['nepalidate'];
        //echo $lastDate;die;
        $newItemAdded = $this->TblConsumptionStock->query("select DISTINCT(count(nepalidate)) as count from tbl_consumption_stock where nepalidate='$lastDate' AND length IS  null and ntwt IS NULL")[0][0]['count'];
        $materials = $this->MixingMaterials->query("select * from mixing_materials");
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 20;
        $pagination->currentPage = isset($_GET['page_id'])?$_GET['page_id']<=0?1:$_GET['page_id']:1;
        $pagination->offset =($pagination->currentPage-1)*$pagination->limit;
        $searchDate = isset($_GET['search'])?$_GET['search']:null;
        if ($searchDate):
            $consumptionItems = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$searchDate' and length is NOT  NULL and ntwt is not NULL limit $pagination->offset, $pagination->limit");
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$searchDate' and length is NOT  NULL  and ntwt is not NULL"))/$pagination->limit);
            $lengthTotal = $this->TblConsumptionStock->query("SELECT sum(length) as sum from tbl_consumption_stock where nepalidate = '$searchDate'")[0][0]['sum'];
            $ntwtTotal = $this->TblConsumptionStock->query("select sum(ntwt) as sum from tbl_consumption_stock where nepalidate = '$searchDate'")[0][0]['sum'];
            $totalMaterials = $this->TblConsumptionStock->query("SELECT materials from tbl_consumption_stock where nepalidate = '$searchDate' and length is not null and ntwt is not null");
        else:
            $consumptionItems = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$lastDate' and  length is NOT  NULL  and ntwt is not NULL ORDER  BY  nepalidate desc limit $pagination->offset, $pagination->limit");
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$lastDate' and  length is NOT  NULL  and ntwt is not NULL"))/$pagination->limit);
            $lengthTotal = $this->TblConsumptionStock->query("SELECT sum(length) as sum from tbl_consumption_stock where nepalidate = '$lastDate'")[0][0]['sum'];
            $ntwtTotal = $this->TblConsumptionStock->query("select sum(ntwt) as sum from tbl_consumption_stock  where nepalidate = '$lastDate'")[0][0]['sum'];
            $totalMaterials = $this->TblConsumptionStock->query("SELECT materials from tbl_consumption_stock WHERE nepalidate = '$lastDate' and length is not null and ntwt is not null");
        endif;
        //Raw Materials
        $this->loadModel('CategoryMaterial');
        $this->loadModel('MixingMaterials');
        $mixingMaterialLists = $this->MixingMaterials->query("Select * from mixing_materials");
        $materialCategory = $this->CategoryMaterial->query("Select * from category_materials");
        if($searchDate):
            $consumptionMaterials = $this->TblConsumptionStock->query("Select materials from tbl_consumption_stock WHERE nepalidate ='$searchDate' and length is not null and ntwt is not null");
        else:
            $consumptionMaterials = $this->TblConsumptionStock->query("Select materials from tbl_consumption_stock where nepalidate = '$lastDate' and length is not null and ntwt is not null");
        endif;
        $this->set('mixingMaterialLists', $mixingMaterialLists);
        $this->set('materialCategory', $materialCategory);
        $this->set('consumptionMaterials', $consumptionMaterials);
        //calender scrap
        $this->loadModel('CalenderScrap');
        if($searchDate):
            $calenderScraps = $this->CalenderScrap->query("select * from calender_scrap WHERE date='$searchDate'");
        else:
            $calenderScraps = $this->CalenderScrap->query("select * from calender_scrap WHERE date = '$lastDate'");
        endif;
        
        //
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('BaseEmboss');
        
        $mix = $this->TblConsumptionStock->query("select * from tbl_consumption_stock");
        foreach($mix as $m):
            $id = $m['tbl_consumption_stock']['id'];
            $dimension = $m['tbl_consumption_stock']['dimension'];
            $brand = $m['tbl_consumption_stock']['brand'];
            $quality = $m['tbl_consumption_stock']['quality'];
            $color = $m['tbl_consumption_stock']['color'];
            $base_emboss = $this->BaseEmboss->query("select Emboss from baseemboss where Brand='$brand' and Dimension = '$dimension' 
                and Type = '$quality' and  Color ='$color'");
            foreach ($base_emboss as $emboss) {
                $base = $emboss['baseemboss']['Emboss']; 
                
            }
            $mix_emboss[$id] = $base;   
            
            
        endforeach;
        $this->set('mix_emboss',$mix_emboss);
        //
        
        $this->set('calenderScraps',$calenderScraps);
        //send to view
        $this->set('lastDate',$lastDate);
        $this->set('newItemAdded',$newItemAdded);
        $this->set('lengthTotal', $lengthTotal);
        $this->set('ntwtTotal', $ntwtTotal);
        $this->set('consumptionItems', $consumptionItems);
        $this->set('material_lists', $materials);
        $this->set('totalMaterials', $totalMaterials);
        $this->set('pagination', $pagination);
    }
    
    public function pdf()
    {
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('MixingMaterials');
        $lastDate = $this->TblConsumptionStock->query("SELECT nepalidate from tbl_consumption_stock order by nepalidate desc limit 1")[0]['tbl_consumption_stock']['nepalidate'];
        $newItemAdded = $this->TblConsumptionStock->query("select DISTINCT(count(nepalidate)) as count from tbl_consumption_stock where nepalidate='$lastDate' AND length IS  null and ntwt IS NULL")[0][0]['count'];
        $materials = $this->MixingMaterials->query("select * from mixing_materials");
        // Custom pagination
        $pagination = new stdClass();
        $pagination->limit = 20;
        $pagination->currentPage = isset($_GET['page_id'])?$_GET['page_id']<=0?1:$_GET['page_id']:1;
        $pagination->offset =($pagination->currentPage-1)*$pagination->limit;
        $searchDate = isset($_GET['search'])?$_GET['search']:null;
        $date = isset($_GET['search'])?$_GET['search']:$lastDate;
        $date = $date?$date:$lastDate;
        $lastDatenewVal = $date;
        
        if ($searchDate):
            $consumptionItemsThisMonth = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate like '%".substr($searchDate,0,7)."%' and length is NOT  NULL and ntwt is not NULL");
            $consumptionItemsThisYear = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate like '%".substr($searchDate,0,4)."%' and length is NOT  NULL and ntwt is not NULL");
            $consumptionItems = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$searchDate' and length is NOT  NULL  and ntwt is not NULL limit $pagination->offset, $pagination->limit");
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$searchDate' and length is NOT  NULL  and ntwt is not NULL"))/$pagination->limit);
            $lengthTotal = $this->TblConsumptionStock->query("SELECT sum(length) as sum from tbl_consumption_stock where nepalidate = '$searchDate'")[0][0]['sum'];
            $ntwtTotal = $this->TblConsumptionStock->query("select sum(ntwt) as sum from tbl_consumption_stock where nepalidate = '$searchDate'")[0][0]['sum'];
            $totalMaterials = $this->TblConsumptionStock->query("SELECT materials from tbl_consumption_stock where nepalidate = '$searchDate'  and length is not null and ntwt is not null");
        else:
            $consumptionItemsThisMonth = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate like '%".substr($lastDate,0,7)."%' and length is NOT  NULL and ntwt is not NULL");
            $consumptionItemsThisYear = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate like '%".substr($lastDate,0,4)."%' and length is NOT  NULL and ntwt is not NULL");
            $consumptionItems = $this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$lastDate' and length is NOT  NULL  and ntwt is not NULL ORDER  BY  nepalidate desc limit $pagination->offset, $pagination->limit");
            $pagination->totalPage = ceil(count($this->TblConsumptionStock->query("select * from tbl_consumption_stock where nepalidate = '$lastDate' and length is NOT  NULL  and ntwt is not NULL"))/$pagination->limit);
            $lengthTotal = $this->TblConsumptionStock->query("SELECT sum(length) as sum from tbl_consumption_stock where nepalidate = '$lastDate'")[0][0]['sum'];
            $ntwtTotal = $this->TblConsumptionStock->query("select sum(ntwt) as sum from tbl_consumption_stock  where nepalidate = '$lastDate'")[0][0]['sum'];
            $totalMaterials = $this->TblConsumptionStock->query("SELECT materials from tbl_consumption_stock where nepalidate = '$lastDate' and length is not null and ntwt is not null");
        endif;
        
        //Raw Materials
        $this->loadModel('CategoryMaterial');
        $this->loadModel('MixingMaterial');
        $mixingMaterialLists = $this->MixingMaterial->query("Select * from mixing_materials");
        $materialCategory = $this->CategoryMaterial->query("Select * from category_materials");
        if($searchDate):
            $consumptionMaterials = $this->TblConsumptionStock->query("Select materials from tbl_consumption_stock WHERE nepalidate ='$searchDate' and length is not null and ntwt is not null");
        else:
            $consumptionMaterials = $this->TblConsumptionStock->query("Select materials from tbl_consumption_stock where nepalidate = '$lastDate' and length is not null and ntwt is not null");
        endif;
        $this->set('mixingMaterialLists', $mixingMaterialLists);
        $this->set('materialCategory', $materialCategory);
        $this->set('consumptionMaterials', $consumptionMaterials);
        //calender scrap
        $this->loadModel('CalenderScrap');
        if($searchDate):
            $calenderScraps = $this->CalenderScrap->query("select * from calender_scrap WHERE date='$searchDate'");
        else:
            $calenderScraps = $this->CalenderScrap->query("select * from calender_scrap WHERE date = '$lastDate'");
        endif;
        $this->set('calenderScraps',$calenderScraps);
        //timeloss calculation
        $this->loadModel('TimeLoss');
        $timeLossLossHourAll = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate='".$date."' and type='LossHour' and department_id='calender'");
        $timeLossBreakDownAll = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate = '$date' and type='BreakDown' and department_id='calender'");
        list($year,$month,$date)=explode('-',$date);
        $timeLossLossHourMonth = $this->TimeLoss->query("SELECT sum(totalloss_sec) as loss_lh_m FROM time_loss where nepalidate like '$year-$month%' and type='LossHour' and department_id='calender'");
        $timeLossLossHourYear = $this->TimeLoss->query("SELECT sum(totalloss_sec) as loss_lh_y FROM time_loss where nepalidate like '$year-%' and type='LossHour' and department_id='calender'");
        //echo'<pre>';print_r($timeLossLossHourYear);die;
        $timeLossBreakMonth = $this->TimeLoss->query("SELECT sum(totalloss_sec) as loss_bd_m FROM time_loss where nepalidate like '$year-$month%' and type='BreakDown' and department_id='calender'");
        $timeLossBreakYear = $this->TimeLoss->query("SELECT sum(totalloss_sec) as loss_bd_y FROM time_loss where nepalidate like '$year%' and type='BreakDown' and department_id='calender'");
      /*  $timeLossBreakDownCurrentMonth = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate like '%".substr($date,0,7)."%' and type='BreakDown' and department_id='calender'");
        $timeLossLossHourCurrentMonth = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate like '%".substr($date,0,7)."%' and type='LossHour' and department_id='calender'");
        $this->set('timeLossBreakDownCurrentMonth', $timeLossBreakDownCurrentMonth);
        $this->set('timeLossLossHourCurrentMonth', $timeLossLossHourCurrentMonth);*/
        //tomonth and toYear calculation
        $totalMat = 0;
        $totalLen = 0;
        $totalNtwt = 0;
        $lastDayInt = intVal(substr($lastDatenewVal,8,9));

        foreach($consumptionItemsThisMonth as $c) {
            $day = intVal(substr($c['tbl_consumption_stock']['nepalidate'],8,9));
            if($day<=$lastDayInt){
                $totalLen += $c['tbl_consumption_stock']['length'];
                $totalNtwt += $c['tbl_consumption_stock']['ntwt'];
                $mat = json_decode($c['tbl_consumption_stock']['materials']);
                foreach ($materials as $m):
                    if (property_exists($mat, $m['mixing_materials']['id'])) {
                        $totalWeight = $mat->$m['mixing_materials']['id'];
                    } else {
                        $totalWeight = 0;
                    }
                    $totalMat += $totalWeight;
                endforeach;
            }
        }
        $consumptionItemsThisMonthArr = [];
        $consumptionItemsThisMonthArr['length'] =$totalLen;
        $consumptionItemsThisMonthArr['ntwt'] =$totalNtwt;
        $consumptionItemsThisMonthArr['total'] =$totalMat;
        $totalMat = 0;
        $totalLen = 0;
        $totalNtwt = 0;
        $lastMonthInt =intVal(substr($lastDatenewVal,5,2));
        foreach($consumptionItemsThisYear as $c) {
            $month = intVal(substr($c['tbl_consumption_stock']['nepalidate'],5,2));
            $day = intVal(substr($c['tbl_consumption_stock']['nepalidate'],8,9));

            if($month<=$lastMonthInt){
                if($month==$lastMonthInt)
                {
                    if($day<=$lastDayInt)
                    {
                        $totalLen += $c['tbl_consumption_stock']['length'];
                        $totalNtwt += $c['tbl_consumption_stock']['ntwt'];
                        $mat = json_decode($c['tbl_consumption_stock']['materials']);
                        foreach ($materials as $m):
                            if (property_exists($mat, $m['mixing_materials']['id'])) {
                                $totalWeight = $mat->$m['mixing_materials']['id'];
                            } else {
                                $totalWeight = 0;
                            }
                            $totalMat += $totalWeight;
                        endforeach;
                    }
                }else {
                    $totalLen += $c['tbl_consumption_stock']['length'];
                    $totalNtwt += $c['tbl_consumption_stock']['ntwt'];
                    $mat = json_decode($c['tbl_consumption_stock']['materials']);
                    foreach ($materials as $m):
                        if (property_exists($mat, $m['mixing_materials']['id'])) {
                            $totalWeight = $mat->$m['mixing_materials']['id'];
                        } else {
                            $totalWeight = 0;
                        }
                        $totalMat += $totalWeight;
                    endforeach;
                }
            }
        }
        $consumptionItemsThisYearArr = [];
        $consumptionItemsThisYearArr['length'] =$totalLen;
        $consumptionItemsThisYearArr['ntwt'] =$totalNtwt;
        $consumptionItemsThisYearArr['total'] =$totalMat;
        //Loss hour tomonth toyear calculation
        
        //End: Loss hour calc
        //send to view
        $this->set('lastDate',$lastDate);
        $this->set('newItemAdded',$newItemAdded);
        $this->set('lengthTotal', $lengthTotal);
        $this->set('ntwtTotal', $ntwtTotal);
        $this->set('consumptionItems', $consumptionItems);
        $this->set('consumptionItemsThisMonth', $consumptionItemsThisMonthArr);
        $this->set('consumptionItemsThisYear', $consumptionItemsThisYearArr);
        $this->set('material_lists', $materials);
        $this->set('totalMaterials', $totalMaterials);
        $this->set('pagination', $pagination);
        $this->set('timeLossLossHourAll', $timeLossLossHourAll);
        $this->set('timeLossLossHourMonth', $timeLossLossHourMonth);
        $this->set('timeLossLossHourYear', $timeLossLossHourYear);
        
       //echo'<pre>';print_r($timeLossLossHourYear);die;
        $this->set('timeLossBreakDownAll', $timeLossBreakDownAll);
        $this->set('timeLossBreakMonth', $timeLossBreakMonth);
        $this->set('timeLossBreakYear', $timeLossBreakYear);
        
        $this->layout = 'pdf';
    }
     public function add()
    {
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('MixingMaterials');
        //$this->fetchdata();
        //$this->loaddata();
        $lastDate = $this->TblConsumptionStock->query('Select distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1')[0]['tbl_consumption_stock']['nepalidate'];
        if(isset($_GET['search']))
        {
            $lastDate = $_GET['search'];
            $consumptioItems = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate = '$lastDate' AND LENGTH IS  NULL AND NTWT IS NULL ");
        }else {
            $consumptioItems = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate = '$lastDate' AND LENGTH IS  NULL AND NTWT IS NULL ");
        }
        $material_lists = $this->MixingMaterials->query("SELECT * FROM mixing_materials");
        //is submitted
        if ($this->request->is('post')) {
            //$id = $this->request->data('id');
            $length = $this->request->data('length');
            $ntwt = $this->request->data('ntwt');
            foreach($length as $key=>$l):
                $this->TblConsumptionStock->query("UPDATE tbl_consumption_stock SET length=$l WHERE id=$key");
            endforeach;
            foreach($ntwt as $key=>$n):
                $this->TblConsumptionStock->query("UPDATE tbl_consumption_stock SET ntwt=$n WHERE id=$key");
            endforeach;
            //update value of length and ntwt
            $this->Session->setFlash(__('The calender cpr has been updated.'), array('class' => 'alert alert-success'));
            return $this->redirect(['action'=>'index']);
        }
        $this->set('material_lists', $material_lists);
        $this->set('lastDate',$lastDate);
        $this->set('consumptionItems',$consumptioItems);
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
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('MixingMaterials');
        $consumptioItem = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where id=$id");
        $material_lists = $this->MixingMaterials->query("SELECT * FROM mixing_materials");
        if ($this->request->is('post')) {
            $id = $this->request->data('id');
            $length = intval($this->request->data('length'));
            $ntwt = intval($this->request->data('ntwt'));
            //update value of length and ntwt
            $updateQuery = $this->TblConsumptionStock->query("UPDATE tbl_consumption_stock SET length=$length,ntwt=$ntwt WHERE id=$id");
            $this->Session->setFlash(__('The calender cpr has been updated.'), array('class' => 'alert alert-success'));
            return $this->redirect(['action'=>'index']);
        }
        $this->set('material_lists', $material_lists);
        $this->set('consumptionItem',$consumptioItem);
    }
    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    //disable this function
    public function delete($id = null)
    {
        $this->CalenderCpr->id = $id;
        if (!$this->CalenderCpr->exists()) {
            throw new NotFoundException(__('Invalid calender cpr'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->CalenderCpr->delete()) {
            $this->Session->setFlash(__('The calender cpr has been deleted.'));
        } else {
            $this->Session->setFlash(__('The calender cpr could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index/sort:id/direction:desc'));
    }
    public function fetchdata()
    {
        $this->loadModel('ConsumptionStock');
        $sh = $this->ConsumptionStock->find('list', array('fields' => array('shift', 'shift'), 'order' => 'shift', 'group' => 'shift'));
        $this->set('shift', $sh);
        $tp = $this->ConsumptionStock->find('list', array('fields' => array('quality_id', 'quality_id'), 'order' => 'quality_id', 'group' => 'quality_id'));
        $this->set('type', $tp);
        $bnd = $this->ConsumptionStock->find('list', array('fields' => array('brand', 'brand'), 'order' => 'brand', 'group' => 'brand'));
        $this->set('brand', $bnd);
        $clr = $this->ConsumptionStock->find('list', array('fields' => array('color', 'color'), 'order' => 'color', 'group' => 'color'));
        $this->set('color', $clr);
    }
    public function datafetch()
    {
        $this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $qwt = $this->request->data['id'];
        $tp = $this->request->data['type'];
        $type = $this->BaseEmboss->query("select distinct(Color) from base where Brand='$qwt' and Type='$tp'");
        echo '<option value="null">Please select</option>';
        foreach ($type as $t):
            echo '<option value="' . $t['BaseEmboss']['Color'] . '">' . $t['BaseEmboss']['Color'] . '</option>';
        endforeach;
    }
    public function fetchdimension()
    {
        $this->request->onlyAllow('ajax');
        $this->loadModel('Base');
        $qwt = $this->request->data['id'];
        $tp = $this->request->data['type'];
        $type = $this->Base->query("select distinct(dimension) from base where brand='$qwt' and type='$tp'");
        echo '<option value="null">Please select</option>';
        foreach ($type as $t):
            echo '<option value="' . $t['base']['dimension'] . '">' . $t['base']['dimension'] . '</option>';
        endforeach;
    }
    public function fetchemboss()
    {
        $this->request->onlyAllow('ajax');
        $this->loadModel('BaseEmboss');
        $qwt = $this->request->data['id'];
        $tp = $this->request->data['type'];
        if ($tp == "Base-UT") {
            $type = $this->Base->query("select distinct(Emboss) from baseemboss where Brand='$qwt' and Type='$tp'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):
                echo '<option value="' . $t['BaseEmboss']['Emboss'] . '">' . $t['BaseEmboss']['Emboss'] . '</option>';
                //echo $t['base']['embossingUT'];
            endforeach;
        } else if ($tp == "Base-MT") {
            $type = $this->Base->query("select distinct(Emboss) from BaseEmboss where Brand='$qwt' and Type='$tp'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):
                echo '<option value="' . $t['BaseEmboss']['Emboss'] . '">' . $t['BaseEmboss']['Emboss'] . '</option>';
            endforeach;
        } else if ($tp == "OT") {
            $type = $this->Base->query("select distinct(Emboss) from BaseEmboss where Brand='$qwt' and Type='$tp'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):
                echo '<option value="' . $t['BaseEmboss']['Emboss'] . '">' . $t['BaseEmboss']['Emboss'] . '</option>';
            endforeach;
        } else if ($tp == "Print Film") {
            $type = $this->Base->query("select distinct(Emboss) from BaseEmboss where Brand='$qwt' and Type='$tp'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):
                echo '<option value="' . $t['BaseEmboss']['Emboss'] . '">' . $t['BaseEmboss']['Emboss'] . '</option>';
            endforeach;
        } else if ($tp == "Clear Transparent") {
            $type = $this->Base->query("select distinct(Emboss) from BaseEmboss where Brand='$qwt' and Type='$tp'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):
                echo '<option value="' . $t['BaseEmboss']['Emboss'] . '">' . $t['BaseEmboss']['Emboss'] . '</option>';
            endforeach;
        } else {
            echo '<option value="null">null</option>';
        }
    }
    public function total()
    {
        $this->loadModel('ConsumptionStock');
        //$this->loadModel('ConsumptionStock');
        $d = $this->ConsumptionStock->query("SELECT nepalidate from consumption_stock order by consumption_id desc limit 1");
        foreach ($d as $dt):
            $date = $dt['consumption_stock']['nepalidate'];
        endforeach;
        $dat = $d['0']['consumption_stock']['nepalidate'];
        //echo ;
        $this->set('dat', $d);
        $query = $this->ConsumptionStock->query("select sum(quantity) as total from consumption_stock where nepalidate='$dat'");
        $this->set('total', $query);
        $this->loadModel('CalenderScrap');
        $sps = $this->CalenderScrap->query("SELECT *
FROM calender_scrap where date='$dat'");
        $this->set('scraps', $sps);
        $dana = $this->ConsumptionStock->query("select sum(quantity) as totdana from consumption_stock where material_id='DANA' and nepalidate='$dat'");
        $this->set('danaused', $dana);
        $raws = $this->ConsumptionStock->query("SELECT sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and nepalidate='$dat'");
        $this->set('mixingraws', $raws);
        $totalscrap = $this->ConsumptionStock->query("SELECT sum(quantity) as scrap_total from consumption_stock where (material_id='Scrap Laminated' or material_id='Scrap Plain' or material_id='Scrap Printed' or material_id='Scrap Unprinted' or material_id='Scrap CT') and nepalidate='$dat'");
        $this->set("scraptotal", $totalscrap);
    }
    public function loaddata()
    {
        $date;
        $this->loadModel('ConsumptionStock');
        $d = $this->ConsumptionStock->query("SELECT nepalidate from consumption_stock order by consumption_id desc limit 1");
        foreach ($d as $dt):
            $date = $dt['consumption_stock']['nepalidate'];
        endforeach;
        $opt = $this->ConsumptionStock->query("SELECT distinct consumption_stock.nepalidate,consumption_stock.uid, BaseEmboss.Emboss, consumption_stock.quality_id, consumption_stock.brand, consumption_stock.dimension, consumption_stock.color, consumption_stock.shift,consumption_stock.total FROM polychem.BaseEmboss BaseEmboss, polychem.consumption_stock consumption_stock WHERE BaseEmboss.Brand = consumption_stock.brand AND BaseEmboss.Dimension = consumption_stock.dimension AND BaseEmboss.Type = consumption_stock.quality_id AND BaseEmboss.Color = consumption_stock.color AND consumption_stock.inserted=0 AND consumption_stock.nepalidate='$date'");
        $this->set('consumptionStocks', $opt);
    }
    public function edit_data()
    {
        $date = date('d-m-Y');
        $this->set('consumptionStocks', $this->CalenderCpr->query("select * from calender_cpr"));
    }
    function time_elapsed($secs){
        if(isset($secs)):
            $bit = [
                'Years' => $secs / 31556926 % 12,
                'Weeks' => $secs / 604800 % 52,
                'Days' => $secs / 86400 % 7,
                'Hours' => $secs / 3600 % 24,
                'Minutes' => $secs / 60 % 60,
                'seconds' => $secs % 60
            ];
            foreach($bit as $k => $v)
                if($v > 0) {
                    $ret[] = $v .' '. $k;
                }
            return join(' ', $ret);
        endif;
    }
    public function create_calenderpdf()
    {
        $this->loadModel('ConsumptionStock');
        $this->request->onlyAllow('ajax');
        $date = isset($_POST['city_id'])?$_POST['city_id']:Date('Y-m-d');
        //$date = '2072-04-01';
        $this->set('today', $date);
        //$date=$this->Session->read('date');
        $raws = $this->ConsumptionStock->query("SELECT sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and nepalidate='$date'");
        $this->set('mixingraws', $raws);
        $query = $this->ConsumptionStock->query("select sum(quantity) as total from consumption_stock where nepalidate='$date'");
        $this->set('total', $query);
        $totalscrap = $this->ConsumptionStock->query("SELECT sum(quantity) as scrap_total from consumption_stock where (material_id='Scrap Laminated' or material_id='Scrap Plain' or material_id='Scrap Printed' or material_id='Scrap Unprinted' or material_id='Scrap CT') and nepalidate='$date'");
        $this->set("scraptotal", $totalscrap);
        //$this->loadModel('Materials');
        $calt = $this->CalenderCpr->query("select *from calender_cpr where date='$date'");
        $this->set('cal', $calt);
        $tot = $this->CalenderCpr->query("select sum(length) as total_length ,sum(ntwt) as total_ntwt from calender_cpr where date='$date'");
        $this->set('totalntlg', $tot);
        $thismonth = substr($date,0,7);
        $tot = $this->CalenderCpr->query("select sum(length) as total_length ,sum(ntwt) as total_ntwt from calender_cpr where date LIKE '%$thismonth%'");
        $this->set('total_to_month', $tot);
        $thisyear = substr($date,0,4);
        $tot = $this->CalenderCpr->query("select sum(length) as total_length ,sum(ntwt) as total_ntwt from calender_cpr where date LIKE '%$thisyear%'");
        $this->set('total_to_year', $tot);
        $this->set('today',$date);
        $this->loadModel('CalenderScrap');
        $sps = $this->CalenderScrap->query("select *from calender_scrap where date='$date'");
        $this->set('scrapsused', $sps);
        $this->loadModel('TimeLoss');
        $time = $this->TimeLoss->query("select * from time_loss where nepalidate='$date' and department_id='calender' order BY TYPE ");
        $this->set('tl', $time);
        //SELECT sum(totalloss_sec) FROM `time_loss` WHERE type='LossHour' && nepalidate='2072-04-14'
        //$date = "2072-04-01";
        $type1 = 'LossHour';
        $time1 = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as ts from time_loss where nepalidate='$date' && department_id='calender' && type='$type1' /*order BY TYPE */");
        $time_elapsed_loss = $this->time_elapsed($time1[0][0]['ts']);
        $this->set('tl_loss', isset($time_elapsed_loss)?$time_elapsed_loss:'0');
        $type2 = 'BreakDown';
        $time2 = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as ts from time_loss where nepalidate='$date' && department_id='calender' && type='$type2' /*order BY TYPE */");
        $time_elapsed_brk = $this->time_elapsed($time2[0][0]['ts']);
        $this->set('tl_break', isset($time_elapsed_brk)?$time_elapsed_brk:'0');
        $dana = $this->ConsumptionStock->query("select sum(quantity) as totdana from consumption_stock where material_id='DANA' and nepalidate='$date'");
        $this->set('danaused', $dana);
        $broughtscrap = $this->ConsumptionStock->query("select sum(quantity) as totbs from consumption_stock where material_id='Bought Scrap' and nepalidate='$date'");
        $this->set('broughtscrap', $broughtscrap);
        //unaccounted loss calculation part
        //unaccounted loss= input-total ntwt-scrap generated
        $unaccountedloss = $this->ConsumptionStock->query("select sum(quantity) as totbs from consumption_stock where material_id='Bought Scrap' and nepalidate='$date'");
        $this->set('unaccountedloss', $unaccountedloss);
        $this->layout = '/pdf/default';
        $this->render('/pdf/calender_reports');
    }
    public function download_calenderpdf()
    {
        $this->viewClass = 'Media';
        $name = "Consumption Report for $date('d-m-Y')";
        $params = array(
            'id' => 'test.pdf',
            'name' => $name,
            'download' => false,
            'extension' => 'pdf',
            'path' => APP . 'files/pdf' . DS
        );
        $this->set($params);
    }
    public function date_fetch()
    {
        $this->request->onlyAllow('ajax');
        $id = $_POST['city_id'];
        $this->Session->write('date', $id);
        $this->create_calenderpdf();
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
<?php
App::uses('AppController', 'Controller');
App::import('Controller','ConvertDates');

/**
 * ConsumptionStocks Controller
 *
 * @property ConsumptionStock $ConsumptionStock
 * @property PaginatorComponent $Paginator
 */
class ConsumptionStocksController extends AppController {

/**
 * Components
 *
 * @var array
 *
 */
	
	public $components = array('Paginator','RequestHandler');
	 
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
	
		$this->ConsumptionStock->recursive = 0;
     	$this->loadModel('Material');
		$this->loadModel('MixingMaterial');
		$this->loadModel('Quality');
		$this->material();
		
        $this->Filter->addFilters(
			
        array(
            'filter1' => array(
                'ConsumptionStock.nepalidate' => array(
                    'operator' => 'LIKE',
                    'value' => array(
                        'before' => '%', // optional
                        'after'  => '%'  // optional
                    )
                )
            )
        )
    );

  
    $this->Filter->setPaginate('limit', 128);// optional
 
    $this->Filter->setPaginate('conditions', $this->Filter->getConditions());
		$this->paginate = array('limit' => 128, 'page' => 1,
			'order'=>array('consumption_id'=>'desc'),
		);
    $this->set('consumptionStocks', $this->Paginator->paginate());

	
	
	
		}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConsumptionStock->exists($id)) {
			throw new NotFoundException(__('Invalid consumption stock'));
		}
		$options = array('conditions' => array('ConsumptionStock.' . $this->ConsumptionStock->primaryKey => $id));
		$this->set('consumptionStock', $this->ConsumptionStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $type="";
		 $d=date('d');
	 $m=date('m');
	 $y=date('Y');
		$obj=new ConvertDatesController;
	$this->set('nepdate',$obj->eng_to_nep($y,$m,$d));
	
		$this->material();
		if ($this->request->is('post')) {
			$this->ConsumptionStock->create();
			
			if ($this->ConsumptionStock->saveAll($this->request->data['Consumption']))
			{
			 
			 $date=date('d-m-Y');
			 $this->loadModel('DepartmentStock');
			 
			 $i = 0;
				foreach($this->ConsumptionStock->query("select material_id,quantity from consumption_stock where date='$date' order by consumption_id desc limit 0,32 ") as $d):
				$qt=$d['consumption_stock']['quantity'];
				$mat=$d['consumption_stock']['material_id'];
							
				$this->DepartmentStock->query("update department_stock set department_stock.quantity = quantity-'$qt', department_stock.date = '$date' where department_stock.material_id = '$mat' and  department_stock.department_id = 'mixing'");
				$i = $i+1;
				endforeach;
				//print_r($this->request->data['Consumption']);
				$this->Session->setFlash(__('The consumption stock has been saved.'), array ('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The consumption stock could not be saved. Please, try again.'), array ('class' => 'alert alert-danger'));
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
		$this->loadModel('Base');
		$this->loadModel('BaseEmboss');
		$this->loadModel('Dimension');
		$this->loadModel('MixingMaterial');
		$count=$this->MixingMaterial->query("select count(name) as total from mixing_materials");
		foreach($count as $c):
			$t=$c['0']['total'];

			endforeach;
	$end=$id;
	$start=($id-$t)+1;
		//echo $end;exit;




		$brd=$this->ConsumptionStock->query("select brand from consumption_stock where consumption_id between $start and $end");
		$mixing_brand=$brd['0']['consumption_stock']['brand'];

		$quality_mixing=$this->BaseEmboss->find('list',array('fields'=>array('type','type'),'conditions'=>array('BaseEmboss.brand'=>$mixing_brand),'order'=>'type ASC'));
		$this->set('tp',$quality_mixing);

		$dmnsno=$this->BaseEmboss->find('list',array('fields'=>array('dimension','dimension'),'conditions'=>array('BaseEmboss.brand'=>$mixing_brand),'order'=>'dimension ASC'));
		$this->set('dn',$dmnsno);

		$qlty=$this->BaseEmboss->find('list',array('fields'=>array('color','color'),'conditions'=>array('brand'=>$brd['0']['consumption_stock']['brand']),'order'=>'color ASC'));
		$this->set('cl',$qlty);




		$this->set('datas',$this->ConsumptionStock->query("select * from consumption_stock where consumption_id between $start and $end"));
		$this->material();

        $clr=$this->BaseEmboss->find('list',array('fields'=>array('color','color'),'order'=>'color','group'=>'color'));;
        $this->set('clo',$clr);
		  $dmnsn=$this->BaseEmboss->find('list',array('fields'=>array('dimension','dimension'),'order'=>'dimension'));
          $this->set('dmnsn',$dmnsn);
             $type=$this->BaseEmboss->find('list',array('fields'=>array('type','type'),'order'=>'type','group'=>'type'));
			 $this->set('tr',$type);
		if (!$this->ConsumptionStock->exists($id)) {
			throw new NotFoundException(__('Invalid consumption stock'));
		}
		
			
		if ($this->request->is(array('post', 'put'))) {
			foreach($this->request->data as $data):
			 $d[]=$data;
			endforeach;
			for($i=1;$i<=$t;$i++)
			{
				$quality=$d['0'][$i]['quality_id'];
				$brand=$d['0'][$i]['brand'];
				$quantity=$d['0'][$i]['quantity'];
				$color=$d['0'][$i]['color'];
				$dimension=$d['0'][$i]['dimension'];
				$date=$d['0'][$i]['date'];
				$total=$d['0'][$i]['total'];
				$shift=$d['0'][$i]['shift'];
				$this->ConsumptionStock->query("UPDATE `consumption_stock` SET  `quality_id`='$quality',shift='$shift', inserted='0', total='$total' ,`brand`='$brand',  `quantity`='$quantity',  `color`='$color',   `dimension`='$dimension',  `date`='$date' WHERE `consumption_stock`.`consumption_id` = $start");
				$start=$start+1;
				//echo "H";
			}
			
		
			$options = array('conditions' => array('ConsumptionStock.' . $this->ConsumptionStock->primaryKey => $id));
			$this->request->data = $this->ConsumptionStock->find('first', $options);
			return $this->redirect(array('action' => 'index'));
		}
	//$this->material();
	//$this->edit_data($start,$end);
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConsumptionStock->id = $id;
		if (!$this->ConsumptionStock->exists()) {
			throw new NotFoundException(__('Invalid consumption stock'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConsumptionStock->delete()) {
			$this->Session->setFlash(__('The consumption stock has been deleted.'));
		} else {
			$this->Session->setFlash(__('The consumption stock could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index/sort:consumption_id/direction:desc'));
	}
	
	public function material()
	{
		$this->loadModel('Material');
		$this->loadModel('MixingMaterial');
		$this->loadModel('Quality');
		$this->loadModel('BaseEmboss');
		$option=$this->Material->find('list', array('fields' => array('material_id', 'material_name')));
		$this->set('opt',$option);
		$option1=$this->MixingMaterial->find('list', array('fields' => array('name', 'name'),'order'=>'id desc'));
		$this->set('mixingraws',$option1);
		
		$option11=$this->MixingMaterial->find('list', array('fields' => array('name', 'name')));
		$this->set('mixingraws1',$option11);
		
		
		$option2=$this->Quality->find('list', array('fields' => array('quality_id', 'name')));
		$this->set('quality',$option2);
		$brand=$this->BaseEmboss->find('list',array('fields'=>array('Brand','Brand'),'order'=>'Brand','group'=>'Brand'));
		//foreach($brand as $brand):
		$this->set('brand',$brand);						 
		//endforeach;
		
				
	}
	
	public function select()
	{
		$this->request->onlyAllow('ajax');
			$this->loadModel('Dimension');
	$id=$this->request->data['country_id'];
	$data=$this->Dimension->query("select dimension from dimension where base='$id'");
	$color=$this->Dimension->query("select color from dimension where base='$id'");
	//echo $this->$data;
	//foreach ($data as $d):
	//print_r($d['dimension']);
	//echo $d['dimension']['dimension'];
	//endforeach;
echo	'<label>Dimension:'; 
echo '<select name="state" id="drop2" class="form-control">';
foreach($data as $d):
echo	'<option value="">'.$d['dimension']['dimension'].'</option>';
endforeach;
echo '</select>';
echo '</label>';

echo	'<label>Color:'; 
echo '<select name="state" id="drop2" class="form-control">';
foreach($color as $d):
echo	'<option value="">'.$d['dimension']['color'].'</option>';
endforeach;
echo '</select>';
echo '</label>';


$this->set('a','aa');

//$this->render('index');


	}
	
	
	public function t()
    {
         if($this->request->is('ajax'))
        {
            
            $this->request->onlyAllow('ajax');
            $this->loadModel('BaseEmboss');
            $d=$this->request->data['id'];
             $type=$this->BaseEmboss->query("select distinct(Type) from BaseEmboss where Brand='$d'");
              echo '<option value="null">Please select</option>';
             foreach($type as $t):
             
            echo '<option value="'.$t['BaseEmboss']['Type'].'">'.$t['BaseEmboss']['Type'].'</option>';
             
             endforeach;
            
            
            
        }
	
	}
    public function dimension()
    {
         if($this->request->is('ajax'))
        {
            
            $this->request->onlyAllow('ajax');
            $this->loadModel('BaseEmboss');
            $d=$this->request->data['id'];
             $c=$this->request->data['type'];
             $type=$this->BaseEmboss->query("select distinct(Dimension) from BaseEmboss where Brand='$c' and Type='$d' order by Dimension");
              echo '<option value="null">Please select</option>';
             foreach($type as $t):
             
            echo '<option value="'.$t['BaseEmboss']['Dimension'].'">'.$t['BaseEmboss']['Dimension'].'</option>';
             
             endforeach;
            
            
            
        }
	
	}
    
    public function color()
    {
         if($this->request->is('ajax'))
        {
            
            $this->request->onlyAllow('ajax');
            $this->loadModel('BaseEmboss');
            $d=$this->request->data['id'];
               $c=$this->request->data['type'];
             $type=$this->BaseEmboss->query("select distinct(Color) from BaseEmboss where Brand='$c' and Type='$d'");
              echo '<option value="null">Please select</option>';
			  
             foreach($type as $t):
             
            echo '<option value="'.$t['BaseEmboss']['Color'].'">'.$t['BaseEmboss']['Color'].'</option>';
                
             endforeach;
            
            
            
        }
	
	}
    
	public function ajaxupdate()
	{
		$this->request->onlyAllow('ajax');
		if($_GET['id'] and $_GET['data'])
	{
	$id = $_GET['id'];
$data = $_GET['data'];
$key = $_GET['key'];
echo $key;
	}
	$this->ConsumptionStock->query("update consumption_stock set $key='$data' where consumption_id='$id'");
	echo 'success';
	}
	public function fetch_edit($id = null)
	{
		echo $id;
		//echo $this->ConsumptionStock->id = $id;
		//echo $this->request->data['ConsumptionStock']['consumption_id'];
		//print_r($this->request->data);
	}
	
	
	public function reports()
	{
		
	
	
	 
	//$this->set('date1',$val);
	
	 
		//$date = date('d-m-Y');
		$today=$this->ConsumptionStock->query("select distinct(total) as total from consumption_stock where date='$date'");
		$this->set('totaltoday',$today);
		$raws=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT'  group by material_id order by consumption_id");
		$this->set('mixingraws',$raws);
		$sumscrap1=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as srapsum from consumption_stock where material_id='Scrap Unprinted' or material_id ='Scrap Laminated' or material_id ='Scrap Printed' or material_id ='Scrap Plain' or material_id='Scrap CT' group by material_id order by consumption_id");
		$this->set('mixingscrap',$sumscrap1);
		$totalmaterials=$this->ConsumptionStock->query("select sum(quantity) as totalmaterial from consumption_stock where material_id !='Scrap Laminated' and material_id !='Scrap Plain'");
		$this->set('rawmaterial',$totalmaterials);
		$totalscrap=$this->ConsumptionStock->query("SELECT sum(quantity) as scrap_total from consumption_stock where material_id='Scrap Laminated' or material_id='Scrap Plain' or material_id='Scrap Printed' or material_id='Scrap Unprinted' or material_id='Scrap CT'");
		$this->set("scraptotal",$totalscrap);
	//$this->layout = pdf;
	//$this->render(); 
		
	}

	public function create_mixingpdf(){
		$this->request->onlyAllow('ajax');

		$date = $_POST['city_id'];
		$this->set('date1',$date);
		$this->loadModel('MixingMaterial');
		$sql = "SELECT quantity,material_id,brand,quality_id,dimension,color,total FROM consumption_stock where nepalidate='$date'";
		$sqlmixing = "SELECT * FROM mixing_materials";
		$sqltotal = "SELECT B.name,COALESCE(SUM(A.quantity),0) as TOTAL FROM consumption_stock A RIGHT JOIN mixing_materials B ON A.material_id = B.name AND A.nepalidate='$date' GROUP BY B.name ORDER BY B.id ASC";
		$resulttot= $this->ConsumptionStock->query($sqltotal);

		$result= $this->ConsumptionStock->query($sql);
		$resultmixing= $this->MixingMaterial->query($sqlmixing);
		$countmixing = count($resultmixing);
		$countcomption = count($result);
		$loop = $countcomption/$countmixing;

		$str = '';
		$dispkeyst = 0;
		for($mast = 0;$mast<4;$mast++){
			$str.= '<tr>';
			$dispkeyst = $mast;
			for($i=0;$i<=$loop;$i++){

				if($i==0){
					if($mast == 0){
						$str.='<th width="200px">Brand</th>';
					}else if($mast == 1){
						$str.='<th width="200px">Quality</th>';
					}else if($mast == 2){
						$str.='<th width="200px">Dimension</th>';
					}else{
						$str.='<th width="200px">Color</th>';
					}
				}else{
					if($mast == 0){
						$str.='<th style="text-align:right">'.$result[$dispkeyst]['consumption_stock']['brand'].'</th>';
					}else if($mast == 1){
						$str.='<td align="right">'.$result[$dispkeyst]['consumption_stock']['quality_id'].'</td>';
					}else if($mast == 2){
						$str.='<td align="right">'.$result[$dispkeyst]['consumption_stock']['dimension'].'</td>';
					}else{
						$str.='<td align="right">'.$result[$dispkeyst]['consumption_stock']['color'].'</td>';
					}
					$dispkeyst+=$countmixing;
				}

			}
			if($mast ==0){
				$str.='<td align="right">Total</td>';
			}else{
				$str.='<td></td>';
			}

			$str.= '</tr>';

		}

		$index = 0;
		for($j =0;$j<$countmixing;$j++) {
			$displaykey = $index;
			$str.='<tr>';
			for($i=0;$i<$loop;$i++){
				$displaykey;
				if($i==0){

					$str.='<td width="200px">'.$result[$displaykey]['consumption_stock']['material_id'].'</td>';
				}
				$str.='<td align="right">'.number_format($result[$displaykey]['consumption_stock']['quantity'],2).'</td>';
				$displaykey+=$countmixing;
			}
			$str.='<th style="text-align:right;">'.number_format($resulttot[$j][0]['TOTAL'],2).'</th>';
			$index=$index+1;
			$str.='</tr>';
		}
		$mygrtot = 0;
		$disptot = 0;
		for($tot = 0;$tot<=$loop;$tot++){
			if($tot ==0){
				$str.='<td width="200px">Total</td>';
			}else{
				$mygrtot+= $result[$disptot]['consumption_stock']['total'];
				$str.='<td align="right">'.number_format($result[$disptot]['consumption_stock']['total'],2).'</td>';
			}
			echo $disptot+=$countmixing-1;
		}
		$str.='<td align="right">'.number_format($mygrtot,2).'</td>';




		$this->set('str1',$str);



		$this->layout = '/pdf/default';

		$this->render('/pdf/my_pdf_view');


	}
public function download_consumptionpdf() {
 //$data=$this->request->data['filter']['filter1'];
 //echo $data;
    $this->viewClass = 'Media';
	$name='consumption';
    $params = array(
   'id' => "consumption.pdf",
   'name' => 'consumption',
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
//$this->create_mixingpdf();

	}
    
	public function monthly_report()
	{
			  ob_end_clean();
//$d= array("orange", "banana");
$d=array();
 $startday="01";
 $endday="30";
   $getmonth=$_POST['id'];
   $date=$this->ConsumptionStock->query("select nepalidate from consumption_stock order by consumption_id desc limit 1");
  foreach($date as $n):
  $nepdte=$n['consumption_stock']['nepalidate'];
  endforeach;
   $nepdate=explode('-',$nepdte);
   $year=$nepdate[0];
   
   
   $startmonth=$year."-".$getmonth."-".$startday;
   $endmonth=$year."-".$getmonth."-".$endday;
   //echo $startmonth;
   //echo $endmonth;
	$this->set('date1',$endmonth);
   $users = $this->User->find('all');
	$this->set(compact('users'));
	$this->loadModel('ConsumptionStock');
	//$raws=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and date BETWEEN '$startmonth' and '$endmonth' group by material_id order by consumption_id");
	$raws=$this->ConsumptionStock->query("SELECT material_id, sum(quantity) as total,sum( quantity ) *100 / (SELECT sum( quantity )  FROM polychem.consumption_stock 
                                                                   
                                                                  
where material_id<>'Bought Scrap' and material_id<>'Scrap Laminated' and material_id<>'Scrap  Printed'                                                                   
                                                                   
and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and nepalidate BETWEEN '$startmonth'
                                                                   
and '$endmonth') as rawpercentage FROM polychem.consumption_stock where material_id<>'Bought Scrap' and material_id<>'Scrap Laminated' and material_id<>'Scrap Printed'

and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and nepalidate BETWEEN '$startmonth'

and '$endmonth' GROUP BY material_id ORDER BY consumption_id");

	$total=$this->ConsumptionStock->query("SELECT  sum(quantity) as total FROM polychem.consumption_stock
where material_id<>'Bought Scrap' and material_id<>'Scrap Laminated' and material_id<>'Scrap Printed'
and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth'");
	foreach($total as $t):
	$totalinput=$t['0']['total'];
	endforeach;
	
	$scrap=$this->ConsumptionStock->query("SELECT sum(quantity) as total FROM polychem.consumption_stock where material_id='Bought Scrap' OR material_id='Scrap Laminated' OR material_id='Scrap Printed' OR material_id='Scrap Unprinted' OR material_id='Scrap Plain' OR material_id='Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth' ");
	
	foreach($scrap as $sc):
	$totalscrap=$sc['0']['total'];
	endforeach;
	
	echo "<table>";
	foreach($raws as $r):
	echo "<tr>";
	echo "<td align='left'>".$r['consumption_stock']['material_id']."</td>";
	echo "<td align='right'>&nbsp;&nbsp;".number_format($r['0']['total'],2)."</td>";
	echo "<td align='right'>&nbsp;&nbsp;&nbsp;".number_format($r['0']['rawpercentage'],2)."%</td>";

	echo "</tr>";
	endforeach;
	if(empty($raws))
	{
		echo "<tr>";
	echo "<td><strong>Total</strong></td>";
	echo "<td align='right'>".number_format(0,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Total Scrap</strong></td>";
	echo "<td align='right'>".number_format(0,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Total Input</strong></td>";
	echo "<td align='right'>".number_format(0,2)."</td>";
	echo "</tr>";
	
echo "</table>";
	}
	else
	{
	echo "<tr>";
	echo "<td><strong>Total</strong></td>";
	echo "<td align='right'>".number_format($totalinput,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Total Scrap</strong></td>";
	echo "<td align='right'>".number_format($totalscrap,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Total Input</strong></td>";
	echo "<td align='right'>".number_format($totalinput+$totalscrap,2)."</td>";
	echo "</tr>";
	
echo "</table>";
	}
	}
	
	
 
	
	public function viewpdf()
	{
	 $this->loadModel('MixingMaterial');
// increase memory limit in PHP 
ini_set('memory_limit', '256M');
 $this->ConsumptionStock->recursive = 0;
        $this->paginate=array('limit' => 128);
		$this->set('consumptionStocks', $this->Paginator->paginate());
		$option1=$this->MixingMaterial->find('list', array('fields' => array('name', 'name')));
		$this->set('mixingraws',$option1);
   }
   public function edit_data($st,$nd)
   {
   //$start=$id;
	// 	$end=($id+32)-1;
	
		//$this->set('datas',$this->ConsumptionStock->query("select * from consumption_stock where consumption_id between $start and $end"));
		
	
   }
}

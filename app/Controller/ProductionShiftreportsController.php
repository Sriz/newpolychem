<?php
App::uses('AppController', 'Controller');

/**
 * ProductionShiftreports Controller
 *
 * @property ProductionShiftreport $ProductionShiftreport
 * @property PaginatorComponent $Paginator
 */
class ProductionShiftreportsController extends AppController
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
        $date = 0;
        $this->ProductionShiftreport->recursive = 0;
        $this->set('productionShiftreports', $this->Paginator->paginate());
        $this->quality();
        $this->Filter->addFilters(
            array(
                'filter1' => array(
                    'ProductionShiftreport.date' => array(
                        'operator' => 'LIKE',
                        'value' => array(
                            'before' => '%', // optional
                            'after' => '%'  // optional
                        )
                    )
                )
            )
        );
        $this->Filter->setPaginate('order', 'ProductionShiftreport.date ASC'); // optional
        $this->Filter->setPaginate('limit', 20);              // optional

        // Define conditions
        $this->Filter->setPaginate('conditions', $this->Filter->getConditions());

        $this->ProductionShiftreport->recursive = 0;
        $this->set('productionShiftreports', $this->paginate());

        $date1;
        if (isset($this->request->data['filter']['filter1'])) {
            $date1 = $this->request->data['filter']['filter1'];
        }

        if (isset($date1) == 0) {
            $this->set('total', $this->ProductionShiftreport->query("select sum(base_ut) as base,sum(base_mt) as mt,sum(base_ot) as ot,sum(print_film) as pf,sum(CT) as ct,sum(output) as output from production_shiftreport"));
        } else {
            //$date=$this->request->data;
            $this->set('total', $this->ProductionShiftreport->query("select sum(base_ut) as base,sum(base_mt) as mt,sum(base_ot) as ot,sum(print_film) as pf,sum(CT) as ct,sum(output) as output from production_shiftreport where date='$date1'"));

        }


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
        if (!$this->ProductionShiftreport->exists($id)) {
            throw new NotFoundException(__('Invalid production shiftreport'));
        }
        $options = array('conditions' => array('ProductionShiftreport.' . $this->ProductionShiftreport->primaryKey => $id));
        $this->set('productionShiftreport', $this->ProductionShiftreport->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        $this->quality();
        $this->color();
        $this->loadModel('LaminatingReasonOthers');
        if ($this->request->is('post')) {
            $this->ProductionShiftreport->create();
            if ($this->ProductionShiftreport->save($this->request->data)) {
                $this->Session->setFlash(__('The request has been saved.'), array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index/sort:date/direction:desc'));
            } else {
                $this->Session->setFlash(__('The request could not be saved. Please, try again.'), array('class' => 'alert alert-danger'));
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
        if (!$this->ProductionShiftreport->exists($id)) {
            throw new NotFoundException(__('Invalid production shiftreport'));
        }
        $this->quality();
        $this->color();

        if ($this->request->is(array('post', 'put'))) {


            if ($this->ProductionShiftreport->save($this->request->data)) {
                //return $this->flash(__('The production shiftreport has been saved.'), array('action' => 'index'));
                return $this->redirect(array('action' => 'index/sort:date/direction:desc'));
            }
        } else {
            $options = array('conditions' => array('ProductionShiftreport.' . $this->ProductionShiftreport->primaryKey => $id));
            $this->request->data = $this->ProductionShiftreport->find('first', $options);
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
        $this->ProductionShiftreport->id = $id;
        if (!$this->ProductionShiftreport->exists()) {
            throw new NotFoundException(__('Invalid production shiftreport'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ProductionShiftreport->delete()) {
            return $this->flash(__('The production shiftreport has been deleted.'), array('action' => 'index/sort:date/direction:desc'));
        } else {
            return $this->flash(__('The production shiftreport could not be deleted. Please, try again.'), array('action' => 'index/sort:date/direction:desc'));
        }
    }

    public function quality()
    {
        $date = date('d-m-Y');
        $this->loadModel('Product');
        $option = $this->Product->find('list', array('fields' => array('brand', 'brand'), 'order' => 'brand', 'group' => 'brand'));
        $this->set('opt', $option);
        $optn = $this->Product->find('list', array('fields' => array('color', 'color'), 'order' => 'color', 'group' => 'color'));
        $this->set('opti', $optn);
        //echo $option;
        $this->set('total', $this->ProductionShiftreport->query("select sum(base_ut) as base,sum(base_mt) as mt,sum(base_ot) as ot,sum(print_film) as pf,sum(CT) as ct,sum(output) as output from production_shiftreport where date='$date'"));

    }


    public function color()
    {
        if ($this->request->is('ajax')) {

            $this->request->onlyAllow('ajax');
            $this->loadModel('Product');
            $d = $this->request->data['id'];

            $type = $this->Product->query("select color from product where brand='$d'");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):

                echo '<option value="' . $t['product']['color'] . '">' . $t['product']['color'] . '</option>';

            endforeach;


        } else {
            //$this->loadModel('Product');
            //$type=$this->Product->query("select distinct(color) from product order by color asc");
            //$this->set('c',$type);
        }
    }

    public function create_productionpdf()
    {
        //$startmonthly=date('01-m-Y');
        //$endmonthly=date('30-m-Y');
        //$date=date('d-m-Y');
        $this->losshour_calculate("laminating");
        $this->request->onlyAllow('ajax');
        $date = $_POST['city_id'];
        $this->set('today', $date);
        $product = $this->ProductionShiftreport->query("select brand,color,base_ut,base_mt,print_film,base_ot,CT,output,(print_film/output) as po,(CT/output) as co from production_shiftreport where shift='A' and date='$date'");
        $this->set('pd', $product);
        $tot = $this->ProductionShiftreport->query("select sum(base_ut)as ut,sum(base_mt) as mt ,sum(print_film) as pf ,sum(base_ot) as ot ,sum(CT) as ct ,sum(output) as op,(sum(print_film/output)) as po,(sum(CT/output)) as co from production_shiftreport where shift='A' and date='$date'");
        $this->set('totala', $tot);

        $productb = $this->ProductionShiftreport->query("select brand,color,base_ut,base_mt,print_film,base_ot,CT,output,(print_film/output) as po,(CT/output) as co from production_shiftreport where shift='B' and date='$date'");
        $this->set('pdb', $productb);
        $totb = $this->ProductionShiftreport->query("select sum(base_ut)as ut,sum(base_mt) as mt ,sum(print_film) as pf ,sum(base_ot) as ot ,sum(CT) as ct ,sum(output) as op,(sum(print_film/output)) as po,(sum(CT/output)) as co from production_shiftreport where shift='B' and date='$date'");
        $this->set('totalb', $totb);
        $totalab = $this->ProductionShiftreport->query("select sum(base_ut)as ut,sum(base_mt) as mt ,sum(print_film) as pf ,sum(base_ot) as ot ,sum(CT) as ct ,sum(output) as op,(sum(print_film/output)) as po,(sum(CT/output)) as co from production_shiftreport where date='$date'");
        $this->set('totalab', $totalab);
        $today = $this->ProductionShiftreport->query("select (sum(base_UT)+sum(base_MT))  as todayutmt,sum(print_film) as todayprint,sum(CT) as totalct,sum(output) as todayoutput from production_shiftreport where date='$date'");
        $this->set('todays', $today);


        $dt = explode('-', $date);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';

        $this->loadModel('TimeLoss');

        $time = $this->TimeLoss->query("select * from time_loss where nepalidate='$date' and department_id='laminating'");
        $this->set('tl', $time);
        $timeloss = $this->TimeLoss->query("SELECT type,time as starttime , wk_hrs as endtime ,totalloss as losstime,reasons from time_loss where department_id='laminating' and nepalidate='$date'");
        $this->set('losstoday', $timeloss);

        $losshour1 = $this->TimeLoss->query("select truncate(sum(totalloss),2) as l1 from time_loss where department_id='laminating' and nepalidate='$date' and type='LossHour'");
        foreach ($losshour1 as $l):
            $lossh = $l['0']['l1'];
        endforeach;
        $ltoday = explode('.', $lossh);
        $lhour = $ltoday['0'];
        $lmin = isset($ltoday['1']) ? $ltoday['1'] : '00';


        if ($lmin >= 60) {
            $a = $lmin / 60;
            $hr = explode('.', $a);
            $hour = $lhour + $hr['0'];
            $b = $lmin % 60;
            $d = $hour . "." . $b;
            $todaylosshour = $todaylosshour + $d;
            $this->set('lhlosstoday', $d);


        } else {
            $this->set('lhlosstoday', $losshour);

        }


        //$this->set('bdlosstoday',$bd);


        //print_r($lh);
        //$this->set('bdlosstoday',$lh);

        $tomonths = $this->ProductionShiftreport->query("select (sum(base_UT)+sum(base_MT))  as mnthutmt,sum(print_film) as mnthprint,sum(CT) as mnthct,sum(output) as mnthoutput from production_shiftreport where date between '$startm' and  '$date'");
        $this->set('tomonth', $tomonths);
        $toyear = $this->ProductionShiftreport->query("select (sum(base_UT)+sum(base_MT))  as mnthutmt,sum(print_film) as mnthprint,sum(CT) as mnthct,sum(output) as mnthoutput from production_shiftreport where date between '$starty' and  '$date'");
        $this->set('toyears', $toyear);


        $this->layout = '/pdf/default';

        $this->render('/pdf/production_shiftreport');


    }

    public function download_pdf()
    {
        $date = isset($_GET['date'])?trim($_GET['date']):null;
        $this->loadModel('ProductionShiftreport');
        $this->loadModel('TimeLoss');
        $lastDate = $this->ProductionShiftreport->query("SELECT distinct(date) FROM production_shiftreport ORDER BY date ASC LIMIT 1")[0]['production_shiftreport']['date'];
        $date = $date?$date:$lastDate; //if date is not selected use last date;
        $productionShiftReportA = $this->ProductionShiftreport->query("SELECT * from production_shiftreport WHERE date ='$date' and shift='A'");
        $productionShiftReportB = $this->ProductionShiftreport->query("SELECT * from production_shiftreport WHERE date ='$date' and shift='B'");

        $lastMonth = substr($date, 0, 7);
        $lastYear = substr($date, 0, 4);
        $startmonth = substr($date, 0, 7).'-01';
        $startyear = substr($date, 0, 4).'-01-01';


        /*
         * ProductionShiftReport To Month
         */
        $productionShiftReportToMonth = $this->ProductionShiftreport->query("SELECT * from production_shiftreport where date between '$startmonth' and '$date'");
        $productionShiftReportToYear = $this->ProductionShiftreport->query("SELECT * from production_shiftreport where date between '$startyear' and '$date'");

        /*
         * Initialize value as 0
         */
        $shiftReportToMonth = array();
        $shiftReportToMonth['base_ut']=0;
        $shiftReportToMonth['base_mt']=0;
        $shiftReportToMonth['base_ot']=0;
        $shiftReportToMonth['print_film']=0;
        $shiftReportToMonth['CT']=0;
        $shiftReportToMonth['output']=0;

        $shiftReportToYear = array();
        $shiftReportToYear['base_ut']=0;
        $shiftReportToYear['base_mt']=0;
        $shiftReportToYear['base_ot']=0;
        $shiftReportToYear['print_film']=0;
        $shiftReportToYear['CT']=0;
        $shiftReportToYear['output']=0;

        foreach($productionShiftReportToMonth as $pm){
            $shiftReportToMonth['base_ut'] += intval($pm['production_shiftreport']['base_ut']);
            $shiftReportToMonth['base_mt'] += intval($pm['production_shiftreport']['base_mt']);
            $shiftReportToMonth['base_ot'] += intval($pm['production_shiftreport']['base_ot']);
            $shiftReportToMonth['print_film'] += intval($pm['production_shiftreport']['print_film']);
            $shiftReportToMonth['CT'] += intval($pm['production_shiftreport']['CT']);
            $shiftReportToMonth['output'] += intval($pm['production_shiftreport']['output']);
        }
        foreach($productionShiftReportToYear as $py)
        {
            $shiftReportToYear['base_ut'] += intval($py['production_shiftreport']['base_ut']);
            $shiftReportToYear['base_mt'] += intval($py['production_shiftreport']['base_mt']);
            $shiftReportToYear['base_ot'] += intval($py['production_shiftreport']['base_ot']);
            $shiftReportToYear['print_film'] += intval($py['production_shiftreport']['print_film']);
            $shiftReportToYear['CT'] += intval($py['production_shiftreport']['CT']);
            $shiftReportToYear['output'] += intval($py['production_shiftreport']['output']);
        }
        /*
         * Timeloss Calculation
         */
        $timeLossLossHour = $this->TimeLoss->query("SELECT * from time_loss where nepalidate ='$date' and  department_id ='laminating' and type='LossHour' order by nepalidate ");
        $timeLossBreakDown = $this->TimeLoss->query("SELECT * from time_loss where nepalidate ='$date' and  department_id ='laminating' AND type='BreakDown' order by nepalidate ");

        $timeLossLossHourAll = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate='".$date."' and type='LossHour' and department_id='laminating'");
        $timeLossBreakDownAll = $this->TimeLoss->query("SELECT * FROM time_loss where nepalidate = '$date' and type='BreakDown' and department_id='laminating'");

        /*
         * CT KG Consumption
         */
        $this->loadModel('LaminatingTargets');
        $this->loadModel('ProductionShiftreport');
        $laminating_targets = $this->LaminatingTargets->Query("SELECT * from laminating_targets ");
        $production_shiftreportToDay = $this->ProductionShiftreport->Query("SELECT * from production_shiftreport WHERE  date='$date'");
        $production_shiftreportToMonth = $this->ProductionShiftreport->Query("SELECT * from production_shiftreport where date between '$startmonth' and '$date'");
        $production_shiftreportToYear = $this->ProductionShiftreport->Query("SELECT * from production_shiftreport where date between '$startyear' and '$date'");

        $ct['ToDay'] = $this->ct_table($laminating_targets, $production_shiftreportToDay);
        $ct['ToMonth'] = $this->ct_table($laminating_targets, $production_shiftreportToMonth);
        $ct['ToYear'] = $this->ct_table($laminating_targets, $production_shiftreportToYear);

        /*
         * send data to view
         */
        $this->set('date', $date);
        $this->set('productionShiftReportA', $productionShiftReportA);
        $this->set('productionShiftReportB', $productionShiftReportB);
        $this->set('shiftReportToMonth', $shiftReportToMonth);
        $this->set('shiftReportToYear', $shiftReportToYear);
        $this->set('timeLossLossHour', $timeLossLossHour);
        $this->set('timeLossBreakDown', $timeLossBreakDown);
        $this->set('timeLossLossHourAll', $timeLossLossHourAll);
        $this->set('timeLossBreakDownAll', $timeLossBreakDownAll);
        $this->set('ctArr', $ct);
        $this->layout = 'pdf';
    }
    private function ct_table($laminating_targets, $production_shiftreport)
    {
        $data['dull_ct']=0;
        $data['two_yard']=0;
        $data['two_meter']=0;

        foreach ($laminating_targets as $l) {
            if ($l['laminating_targets']['type'] == 'Dull CT') {
                foreach ($production_shiftreport as $p) {
                    if ($p['production_shiftreport']['brand'] == $l['laminating_targets']['brand']) {
                        $data['dull_ct'] += $p['production_shiftreport']['CT'];
                    }
                }
            }
            if ($l['laminating_targets']['type'] == '2 yard') {
                foreach ($production_shiftreport as $p) {
                    if ($p['production_shiftreport']['brand'] == $l['laminating_targets']['brand']) {
                        $data['two_yard'] += $p['production_shiftreport']['CT'];
                    }
                }
            }
            if ($l['laminating_targets']['type'] == '2 meter') {
                foreach ($production_shiftreport as $p) {
                    if ($p['production_shiftreport']['brand'] == $l['laminating_targets']['brand']) {
                        $data['two_meter'] += $p['production_shiftreport']['CT'];
                    }
                }
            }
        }

        return $data;
    }

    public function losshour_calculate($dept)
    {
        $this->loadModel('TimeLoss');

        $last_date = $this->TimeLoss->query("SELECT nepalidate FROM time_loss WHERE  department_id='$dept' ORDER  BY  nepalidate DESC  limit 1");
        $last_date = $last_date[0]['time_loss']['nepalidate'];


        //breakdown last date
        $query_breakdown_today = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE department_id='$dept' AND type='BreakDown' AND  nepalidate='$last_date'");
        $breakdown_today = $this->time_elapsed($query_breakdown_today[0][0]['s']);


        //loss hour last date
        $query_losshour_today = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE department_id='$dept' AND type='LossHour' AND  nepalidate='$last_date'");
        $losshour_today = $this->time_elapsed($query_losshour_today[0][0]['s']);

        $month = explode('-', $last_date);
        $current_month = $month[0] . '-' . $month[1] . '%';
        $month = explode('-', $last_date);
        $current_day = $month[0] . '-' . $month[1] . '-' . $month[2];
        //breakdown to month
        $query_breakdown_tomonth = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_month' AND department_id='$dept' AND type='BreakDown'");
        $query_numberofdays_break_in_month = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM 	polychem.time_loss WHERE 	department_id = '$dept' AND 	type = 'BreakDown' AND 	nepalidate LIKE '%$current_month%' ");
        $breakdown_month_avg = $query_breakdown_tomonth[0][0]['s'] / $query_numberofdays_break_in_month[0][0]['total'];
        $breakdown_tomonth = $this->time_elapsed($breakdown_month_avg);

        //  echo $query_breakdown_tomonth[0][0]['s']; exit;

        //loss hour to month with avg
        $query_losshour_tomonth = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_month' AND department_id='$dept' AND type='LossHour'");
        $query_numberofdays_loss_in_month = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM 	polychem.time_loss WHERE 	department_id = '$dept' AND 	type = 'LossHour' AND 	nepalidate LIKE '%$current_month%' ");
        $tomonthdata = $query_losshour_tomonth[0][0]['s'] / $query_numberofdays_loss_in_month[0][0]['total'];
        $losshour_tomonth = $this->time_elapsed($tomonthdata);


        $year = explode('-', $last_date);
        $current_year = $month[0] . '%';
        //breakdown to month
        $query_breakdown_toyear = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_year' AND department_id='$dept' AND type='BreakDown'");
        $query_numberofdays_break_in_year = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM 	polychem.time_loss WHERE 	department_id = '$dept' AND 	type = 'BreakDown' AND 	nepalidate LIKE '%$current_year%' ");

        $breakdown_year_avg = $query_breakdown_toyear[0][0]['s'] / $query_numberofdays_break_in_year[0][0]['total'];

        $breakdown_toyear = $this->time_elapsed($breakdown_year_avg);

        //loss hour to year
        $query_losshour_toyear = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_year' AND department_id='$dept' AND type='LossHour'");
        $query_numberofdays_loss_in_year = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM 	polychem.time_loss WHERE 	department_id = '$dept' AND 	type = 'LossHour' AND 	nepalidate LIKE '%$current_year%' ");
        $toyearavg = $query_losshour_toyear[0][0]['s'] / $query_numberofdays_loss_in_year[0][0]['total'];
        $losshour_toyear = $this->time_elapsed($toyearavg);


        //worked hour today
        $total_working_days_query_d = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_day' AND department_id='$dept'");
        $total_working_days_d = $total_working_days_query_d[0][0]['loss'];


        //worked hour toMonth
        $total_working_days_query_m = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_month' AND department_id='$dept'");
        //$toal_working_days_month_avg=


        $total_working_days_m = $total_working_days_query_m[0][0]['loss'];
        // echo $total_working_days_m;exit;

        //worked hour toYear
        $total_working_days_query_y = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_year' AND department_id='$dept'");
        $total_working_days_y = $total_working_days_query_y[0][0]['loss'];

        $breakdown1 = $query_breakdown_today[0][0]['s'];
        $losshour1 = $query_losshour_today[0][0]['s'];
        $total_loss1 = $breakdown1 + $losshour1;

        $workhour1 = $total_working_days_d * 24 * 60 * 60 - ($total_loss1);
        $workhour_d = $this->time_elapsed($workhour1);

        //worked hour tomonth
        $breakdown2 = $query_breakdown_tomonth[0][0]['s'];
        $losshour2 = $query_losshour_tomonth[0][0]['s'];
        $total_loss2 = $breakdown2 + $losshour2;
        $workhour_m = $total_working_days_m * 24 * 60 * 60 - ($total_loss2);
        $avg_working_month = $workhour_m / $total_working_days_m;
        $workhour_m = $this->time_elapsed($avg_working_month);

        //worked hour toyear
        $breakdown3 = $query_breakdown_toyear[0][0]['s'];
        $losshour3 = $query_losshour_toyear[0][0]['s'];
        $total_loss3 = $breakdown3 + $losshour3;
        $workhour_y = $total_working_days_y * 24 * 60 * 60 - ($total_loss3);
        $avg_working_year = $workhour_y / $total_working_days_y;
        $workhour_y = $this->time_elapsed($avg_working_year);

        //send value to view
        $this->set('breakdown_today', $breakdown_today);
        $this->set('losshour_today', $losshour_today);
        $this->set('breakdown_tomnoth', $breakdown_tomonth);
        $this->set('losshour_tomonth', $losshour_tomonth);
        $this->set('breakdown_toyear', $breakdown_toyear);
        $this->set('losshour_toyear', $losshour_toyear);
        $this->set('workhour_d', $workhour_d);
        $this->set('workhour_m', $workhour_m);
        $this->set('workhour_y', $workhour_y);
    }

    public function time_elapsed($secs)
    {
        if (isset($secs)):
            $bit = [
                'years' => $secs / 31556926 % 12,
                'weeks' => $secs / 604800 % 52,
                'days' => $secs / 86400 % 7,
                'hours' => $secs / 3600 % 24,
                'minutes' => $secs / 60 % 60,
                'seconds' => $secs % 60
            ];
            foreach ($bit as $k => $v)
                if ($v > 0) {
                    $ret[] = $v . $k;
                }
            return join(' ', $ret);
        endif;
    }

    public function convert_sec($string_time)
    {
        $a = explode('.', $string_time);
        if (isset($a[1])) {
            if (strlen($a[1]) == 1) {
                $a[1] = $a[1] * 10;
            }
        }
        if (isset($a[1])) {
            return ($a[0] * 60 * 60) + ($a[1] * 60);
        } else {
            return $a[0] * 60 * 60;
        }
    }
}

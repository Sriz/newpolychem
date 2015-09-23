<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController
{
public $name = 'Pages';
public $components = array('FusionCharts.FusionCharts');
public $useTable = 'ConsumptionStock';

public $helpers = array('Html', 'Session', 'FusionCharts.FusionCharts', 'Form', 'Csv');
public $layout = "chart.demo";

public $uses = array();

public function beforeFilter()
{
    parent::beforeFilter();
    $this->Auth->allow('home', 'maintenance');
}
public function index()
{


    $this->material();
    $this->printing_chart();
    $this->printing_dashboard();
    $this->fetch_printingdata();
    $this->printing_loss_reason();
    $this->materialUsed_percent();
    $this->breakdown();
    $this->losshour();
    //  $this->losshour_calculate(AuthComponent::user('role'));// default department = calender


    if (AuthComponent::user('role') == 'mixing') {

        // $this->monthly_report();
        $this->fetch_totalConsumption();
        $this->dash_values();

    } elseif (AuthComponent::user('role' == 'calender')) {
        $this->dash_values();
        $this->output();
        $this->per_working_hour();
        $this->notification();
        $this->calenderreports();
        $this->losshour_calculate(AuthComponent::user('role'));
        $this->losshr_reason_forBD();
        $this->losshr_reason_forLH();
        $this->perhouroutput();
        $this->fetch_totalConsumption();
    } else {
        echo "Wrong Department/you are not allowed";
        exit;
    }

    // //$this->s();
    // $d = $this->ConsumptionStock->query("select nepalidate from consumption_stock order by consumption_id desc limit 1");
    // foreach ($d as $dt):
    //     $date = $dt['consumption_stock']['nepalidate'];
    // endforeach;
    // // $this->calculate_losshour(AuthComponent::user('role'));
    // $this->set('users_count', $this->User->find('count'));

    // $rawpercentage = $this->ConsumptionStock->query("select material_id,sum(quantity)*100/(select sum(quantity) from polychem.consumption_stock) as rawpercentage from polychem.consumption_stock where nepalidate='$date' group by material_id order by consumption_id;");
    // $this->set('rpercentage', $rawpercentage);

    // $arr = array();
    // foreach ($rawpercentage as $value):
    //     $arr[] = array('value' => $value['0']['rawpercentage'], 'params' => array('name' => $value['consumption_stock']['material_id']));

    // endforeach;

    $this->FusionCharts->create
    (
        'Column3D Chart',
        array
        (
            'type' => 'Column3D',
            'width' => 900,
            'height' => 350,
            'id' => '',
            'showLabels' => '0',
            'labelDisplay' => 'rotate'
        )
    );
    $this->FusionCharts->setChartParams
    (
        'Column3D Chart',
        array
        (
            'caption' => 'Daily consumption of Raw Material',
            'xAxisName' => 'Materials',
            'yAxisName' => '% Percentage %',
            'decimalPrecision' => '0',
            'formatNumberScale' => '0',
            'rotateNames' => '1'


        )
    );
    $this->FusionCharts->addChartData
    (
        'Column3D Chart', $arr

    );

}

public function material()
{
    $this->loadModel('Material');
    $this->loadModel('MixingMaterial');
    $this->loadModel('Quality');
    $this->loadModel('Base');
    $option = $this->Material->find('list', array('fields' => array('material_id', 'material_name')));
    $this->set('opt', $option);
    $option1 = $this->MixingMaterial->find('list', array('fields' => array('name', 'name')));
    $this->set('mixingraws', $option1);
    $option2 = $this->Quality->find('list', array('fields' => array('quality_id', 'name')));
    $this->set('quality', $option2);
    $brand = $this->Base->find('list', array('fields' => array('brand', 'brand'), 'order' => 'brand', 'group' => 'brand'));
    //foreach($brand as $brand):
    $this->set('brand', $brand);

}

public function printing_chart()
{
    $this->loadModel("TimeLoss");
    $rawpercentage = $this->TimeLoss->query("SELECT nepalidate,
    TYPE , totalloss
    FROM time_loss
    LIMIT 0 , 30");
    //print_r($rawpercentage);

    $arr = array();
    $year = array();
    //print_r($rawpercentage);
    foreach ($rawpercentage as $value):
        $color = str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        $arr[$value['time_loss']['TYPE']] = array('params' => array('color' => $color), 'data' => array(array('value' => $value['time_loss']['totalloss'])));
        $year[] = $value['time_loss']['date'];

    endforeach;
    //print_r($arr);
    $this->FusionCharts->create
    (
        'Column2D Chart',
        array
        (
            'type' => 'MSColumn2D',
            'width' => 600,
            'height' => 350,
            'id' => ''
        )
    );
    $this->FusionCharts->setChartParams
    (
        'Column2D Chart',
        array
        (
            'caption' => 'Break Down Ratio',
            'subcaption' => 'In Hour',
            'xAxisName' => 'Date',
            'yAxisName' => 'Time(in hour)',
            'hoverCapBg' => 'DEDEBE',
            'hoverCapBorder' => '889E6D',
            'rotateNames' => '1',
            'yAxisMaxValue' => '24',
            'numDivLines' => '9',
            'divLineColor' => 'CCCCCC',
            'divLineAlpha' => '80',
            'decimalPrecision' => '0',
            'showAlternateHGridColor' => '1',
            'AlternateHGridAlpha' => '30',
            'AlternateHGridColor' => 'CCCCCC'
        )
    );
    $this->FusionCharts->setCategoriesParams
    (
        'Column2D Chart',
        array
        (
            'font' => 'Arial',
            'fontSize' => '11',
            'fontColor' => '000000'
        )
    );
    $this->FusionCharts->addCategories
    (
        'Column2D Chart', $year
    );
    $this->FusionCharts->addDatasets
    (
        'Column2D Chart', $arr

    );


}

public function printing_dashboard()
{

    $this->loadModel('TimeLoss');
    $this->loadModel("PrintingShiftreport");
    $date1;
    $dd = $this->TimeLoss->query("select nepalidate from time_loss where department_id = 'printing' order by id DESC LIMIT 1");

    foreach ($dd as $d):
        $timedate = $date1 = $d['time_loss']['nepalidate'];
    endforeach;

    if (isset($date1)) {
        $dt = explode('-', $date1);
    }

    if (isset($dt)) {
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
    }

    if (isset($m) and isset($yr)) {
        $timemonth = $startmonth = $yr . '-' . $m . '-' . '01';
        $timeyear = $startyear = $yr . '-' . '01' . '-' . '01';
    }

    $dateprint = $this->PrintingShiftreport->query("select date from printing_shiftreport order by id DESC LIMIT 1");
    foreach ($dateprint as $d):
        $date2 = $d['printing_shiftreport']['date'];
    endforeach;
    if (isset($date2)) {
        $dt = explode('-', $date2);
        $yr1 = $dt[0];
        $m1 = $dt[1];
        $d1 = $dt[2];
        $startmonth2 = $yr1 . '-' . $m1 . '-' . '01';
        $startyear2 = $yr1 . '-' . '01' . '-' . '01';
    }
    if (isset($date2)) {

        $color = $this->PrintingShiftreport->query("SELECT COUNT(DISTINCT dimension,color_code) as total FROM printing_shiftreport where date='$date2'");
        $this->set('color', $color);
        $calenderrations = $this->PrintingShiftreport->query("SELECT dimension,sum(output) as output,sum(input) as input,sum(output)/sum(input) as cratio,COUNT(dimension) as target from printing_shiftreport group by dimension");
        $this->set('calenderratio', $calenderrations);
        $monthly = $this->PrintingShiftreport->query("SELECT COUNT(DISTINCT dimension,color_code) as total FROM printing_shiftreport WHERE date between '$startmonth2'
AND '$date2'");
        $this->set('monthly1', $monthly);

        $yearly = $this->PrintingShiftreport->query("SELECT COUNT(DISTINCT dimension,color_code) as total FROM printing_shiftreport");
        $this->set('yearly1', $yearly);

        $output = $this->PrintingShiftreport->query("select sum(output) as output from printing_shiftreport where date='$date2'");
        $this->set('output', $output);

        $omonthly = $this->PrintingShiftreport->query("select sum(output) as output from printing_shiftreport WHERE date between '$startmonth2'
        AND '$date2'");
        $this->set('omonthly', $omonthly);

        $oyearly = $this->PrintingShiftreport->query("select sum(output) as output from printing_shiftreport");
        $this->set('oyearly', $oyearly);
        $this->set('dayinmonth', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinmonth from time_loss where department_id='printing' and nepalidate between '$timemonth' and '$timedate'"));
        $this->set('dayinyear', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinyear from time_loss where department_id='printing' and nepalidate between '$timeyear' and '$timedate'"));
        $breakdowndate = $this->TimeLoss->query("SELECT sum( totalloss ) as loss
FROM time_loss
WHERE department_id = 'printing'
AND TYPE = 'breakdown'");
        $this->set('breakdown', $breakdowndate);

        $bm = $this->TimeLoss->query("SELECT sum( totalloss ) as loss
FROM time_loss
WHERE nepalidate between '$startmonth'
AND '$date1' AND department_id = 'printing'
AND TYPE = 'breakdown' ");

        $this->set('bmonthly', $bm);

        $td = $this->TimeLoss->query("SELECT sum( totalloss ) as loss
FROM time_loss
WHERE nepalidate='$date1' AND department_id = 'printing'
AND TYPE = 'breakdown' ");

        $this->set('d', $td);
    }
    $losshour = $this->TimeLoss->query("SELECT sum( totalloss ) as lossh
FROM time_loss
WHERE department_id = 'printing'
AND TYPE = 'losshour'");

    $this->set('lh', $losshour);
    if (isset($startmonth) and isset($date1)) {
        $lm = $this->TimeLoss->query("SELECT sum( totalloss ) as lossh
FROM time_loss
WHERE nepalidate between '$startmonth'
AND '$date1' AND department_id = 'printing'
AND TYPE = 'losshour' ");

        $this->set('lou', $lm);

        $tod = $this->TimeLoss->query("SELECT sum( totalloss ) as lossh
FROM time_loss
WHERE nepalidate='$date1' AND department_id = 'printing'
AND TYPE = 'losshour' ");

        $this->set('todates', $tod);
        //total running hour calculation printing
        $lo = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate='$date1' and department_id='printing'");
        $this->set('printworkinghour', $lo); //today working hour
        //print_r($lo);
        $lom = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startmonth' and nepalidate<='$date1' and department_id='printing'");
        $this->set('printmworkinghour', $lom); //monthly working hour
        $loy = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startyear' and nepalidate<='$date1' and department_id='printing'");
        $this->set('printyworkinghour', $loy); //monthly working hour
    }

    //output per working hour calculation

    if (isset($date2) and isset($startmonth2)) {
        $outputtoday = $this->PrintingShiftreport->query("select sum(output)/24 as total from printing_shiftreport where date='$date2'");
        $this->set('todayout', $outputtoday);


        //echo date_diff($startmonth2,$date2);
        $outputtomonth = $this->PrintingShiftreport->query("select sum(output)/24 as total from printing_shiftreport where date>='$startmonth2' and date<='$date2'");
        $this->set('tomnth', $outputtomonth);

    }


}

public function fetch_printingdata()
{
    $this->loadModel('PrintingShiftreport');

    $date = date('d-m-Y');
    $dashsrw = $this->PrintingShiftreport->query("SELECT sum(input) as today_input from printing_shiftreport where date = '$date'");
    $this->set('today_input', $dashsrw);
    $dashsrw = $this->PrintingShiftreport->query("SELECT sum(input) as today_output from printing_shiftreport where date = '$date'");
    $this->set('today_output', $dashsrw);

    $d = 1;
    if (date('m') == 1) {
    } else {
        $m = date('m') - 1;
    }
    $y = date('y');
    $newdates = date_create($d . "-" . $m . "-" . $y);
    $newdate = $newdates->format('d-m-y');
    $dashbs = $this->PrintingShiftreport->query("SELECT sum(output) as tomonth_input from printing_shiftreport where  date between '$newdate' and '$date'");
    $this->set('tomonth_input', $dashbs);
    $dashbs = $this->PrintingShiftreport->query("SELECT sum(output) as tomonth_output from printing_shiftreport where  date between '$newdate' and '$date'");
    $this->set('tomonth_output', $dashbs);

    $newdates = date_create("1-1-" . $y);
    $newdate = $newdates->format('d-m-y');
    $dashbs = $this->PrintingShiftreport->query("SELECT sum(output) as toyear_input from printing_shiftreport where date between '$newdate' and  '$date'");
    $this->set('toyear_input', $dashbs);
    $dashbs = $this->PrintingShiftreport->query("SELECT sum(output) as toyear_output from printing_shiftreport where date between '$newdate' and  '$date'");
    $this->set('toyear_output', $dashbs);
    //calender working hour calculation


}

public function printing_loss_reason()
{
    $this->loadModel("TimeLoss");
    $lossreason = $this->TimeLoss->query("SELECT
    dimension,
    input,
    output,
    input-output as loss,
    printed_scrap,
    printed_scrap_reason,
    unprinted_scrap,
    unprinted_scrap_reason,
    printed_reason_1,
    quantity_1,
    printed_reason_2,
    quantity_2,
    printed_reason_3,
    quantity_3,
    printed_reason_4,
    quantity_4,
    printed_reason_5,
    quantity_5,
    unprinted_reason_1,
    quantity1,
    unprinted_reason_2,
    quantity2,
    unprinted_reason_3,
    quantity3,
    unprinted_reason_4,
    quantity4,
    unprinted_reason_5,
    quantity5

FROM
    polychem.printing_shiftreport;");

    $this->set('lossprinted', $lossreason);
}

public function losshr_reason_forBD()
{
    $dept = AuthComponent::user('role');
    $this->loadModel('TimeLoss');
    $currentdate = $this->TimeLoss->query("select nepalidate from time_loss  where department_id='$dept' and type='BreakDown' order by nepalidate DESC LIMIT 1");
    foreach ($currentdate as $d):
        $currentdote = $d['time_loss']['nepalidate'];
    endforeach;
    //print_r($currentdte);
    if (isset($currentdote)) {
        $dt = explode('-', $currentdote);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';

        $tdbdloss = $this->TimeLoss->query("SELECT reasons,(sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'BreakDown' and nepalidate = '$currentdote' and department_id='$dept') as tdbdloss FROM `time_loss` WHERE type = 'BreakDown'  and department_id='$dept' and nepalidate = '$currentdote' GROUP By reasons");
        $this->set('tdbdloss', $tdbdloss);
        // print_r($currentdote);
        // exit;


        $tmbdloss = $this->TimeLoss->query("SELECT reasons,(sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'BreakDown' and nepalidate BETWEEN '$startm' and '$currentdote' and department_id='$dept')  as tmbdloss FROM `time_loss` WHERE type = 'BreakDown'  and department_id='$dept' and (nepalidate BETWEEN '$startm' and '$currentdote') GROUP By reasons");
        $this->set('tmbdloss', $tmbdloss);
        $tybdloss = $this->TimeLoss->query("SELECT reasons,(sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'BreakDown' and nepalidate BETWEEN '$starty' and '$currentdote' and department_id='$dept')  as tybdloss FROM `time_loss` WHERE type = 'BreakDown' and department_id='$dept' and (nepalidate BETWEEN '$starty' and '$currentdote') GROUP By reasons");
        $this->set('tybdloss', $tybdloss);
        $current_date_time_loss = $this->TimeLoss->query("SELECT nepalidate FROM time_loss WHERE  TYPE ='BreakDown' ORDER BY nepalidate DESC LIMIT 1");
        $this->set('current_date_time_loss', $current_date_time_loss);
    }
}

public function losshr_reason_forLH()
{
    $dept = AuthComponent::user('role');
    $this->loadModel('TimeLoss');
    $currentdate = $this->TimeLoss->query("select nepalidate from time_loss where department_id='$dept' and type='LossHour' order by nepalidate DESC LIMIT 1");
    foreach ($currentdate as $d):
        $currentdte = $d['time_loss']['nepalidate'];
    endforeach;
    //echo $currentdte;die;
    if (isset($currentdte)) {
        $dt = explode('-', $currentdte);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        //$this->set('cmonth',$m);
        //$this->set('cday',$d);
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';
        //print_r($startm.'='.$starty);


//START
        $all_reasons = $this->TimeLoss->query("select distinct(reasons) from time_loss where department_id='$dept' and type='LossHour'");
        $i = 0;
        foreach ($all_reasons as $reasons):
            $reason = $reasons['time_loss']['reasons'];

            $tdlhloss[$i] = $this->TimeLoss->query("SELECT (sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'LossHour' and nepalidate = '$currentdte' and department_id = '$dept' )  as tdlhloss FROM `time_loss` WHERE type = 'LossHour' and department_id='$dept' and nepalidate = '$currentdte' and reasons='$reason'");


            $tmlhloss[$i] = $this->TimeLoss->query("SELECT (sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'LossHour' and nepalidate BETWEEN '$startm' and '$currentdte' and department_id='$dept')  as tmlhloss FROM `time_loss` WHERE type = 'LossHour' and department_id='$dept' and nepalidate BETWEEN '$startm' and '$currentdte' and reasons='$reason' GROUP By reasons");

            $tylhloss[$i] = $this->TimeLoss->query("SELECT (sum(totalloss_sec)*100)/(SELECT SUM(totalloss_sec) from time_loss WHERE type = 'LossHour' and nepalidate BETWEEN '$starty' and '$currentdte' and department_id='$dept') as tylhloss FROM `time_loss` WHERE type = 'LossHour' and department_id='$dept' and nepalidate BETWEEN '$starty' and '$currentdte' and reasons='$reason' GROUP By reasons");
            $losshour_reason[$i] = $reasons['time_loss']['reasons'];
            $i++;
        endforeach;
        //echo '<pre>';   print_r($tmlhloss);die;
        //echo '<pre>';   print_r($tmlhloss);die;
        $this->set('reasons', $losshour_reason);
        $this->set('tdlhloss', $tdlhloss);
        $this->set('tmlhloss', $tmlhloss);
        $this->set('tylhloss', $tylhloss);
        //print_r($starty.'='.$currentdate);

        $current_date_time_breakdown = $this->TimeLoss->query("SELECT nepalidate FROM time_loss WHERE  TYPE ='LossHour' ORDER BY nepalidate DESC LIMIT 1");
        $this->set('current_date_time_breakdown', $current_date_time_breakdown);
    }
}

public function materialUsed_percent()
{
    $rdate;
    $this->loadModel('ProductionShiftreport');
    $dod = $this->ProductionShiftreport->query("select date from production_shiftreport order by date DESC LIMIT 1");
    foreach ($dod as $d):
        $rdate = $d['production_shiftreport']['date'];
    endforeach;
    if (isset($rdate)) {
        $dt = explode('-', $rdate);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        $this->set('cday', $d);
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';

        $this->set('tdmtlr_percent', $this->ProductionShiftreport->query("SELECT (sum(base_ut-output)*100/sum(base_ut)) as base_ut,(select sum(base_mt-output)/sum(base_mt)*100  from production_shiftreport where base_mt>0 and date='$rdate' ) as base_mt,(sum(base_ot-output)*100/sum(base_ot)) as base_ot,(sum(CT-output)*100/sum(CT)) as CT,(sum(print_film-output)*100/sum(print_film)) as print_film from production_shiftreport  where date = '$rdate'"));
        $this->set('tmmtlr_percent', $this->ProductionShiftreport->query("SELECT (sum(base_ut-output)*100/sum(base_ut)) as base_ut,(select sum(base_mt-output)/sum(base_mt)*100  from production_shiftreport where base_mt>0 and date between '$startm' and  '$rdate' ) as base_mt,(sum(base_ot-output)*100/sum(base_ot)) as base_ot,(sum(CT-output)*100/sum(CT)) as CT,(sum(print_film-output)*100/sum(print_film)) as print_film  FROM production_shiftreport where date between '$startm' and  '$rdate'"));
        $this->set('tymtlr_percent', $this->ProductionShiftreport->query("SELECT (sum(base_ut-output)*100/sum(base_ut)) as base_ut,(select sum(base_mt-output)/sum(base_mt)*100  from production_shiftreport where base_mt>0 and date between '$starty' and  '$rdate' ) as base_mt,(sum(base_ot-output)*100/sum(base_ot)) as base_ot,(sum(CT-output)*100/sum(CT)) as CT,(sum(print_film-output)*100/sum(print_film)) as print_film  FROM production_shiftreport where date between '$starty' and  '$rdate'"));
        $this->set('tdcolorcount', $this->ProductionShiftreport->query("SELECT count(DISTINCT color) as tdcolorcount FROM production_shiftreport  where date = '$rdate'"));
        $this->set('tmcolorcount', $this->ProductionShiftreport->query("SELECT count(DISTINCT color) as tmcolorcount FROM production_shiftreport  where date between '$startm' and  '$rdate'"));
        $this->set('tycolorcount', $this->ProductionShiftreport->query("SELECT count(DISTINCT color) as tycolorcount FROM production_shiftreport  where date between '$starty' and  '$rdate'"));


        $this->set('tdprint_percent', $this->ProductionShiftreport->query("SELECT brand,(SUM(print_film-output)/SUM(print_film)*100) as print_film FROM production_shiftreport  where date = '$rdate' group by brand order by id"));
        $this->set('tmprint_percent', $this->ProductionShiftreport->query("SELECT brand,(SUM(print_film-output)/SUM(print_film)*100) as print_film  FROM production_shiftreport where date between '$startm' and '$rdate' group by brand order by id "));
        $this->set('typrint_percent', $this->ProductionShiftreport->query("select brand,(SUM(print_film-output)/SUM(print_film)*100)  as print_film FROM production_shiftreport  where date between '$starty' and '$rdate' group by brand order by id "));


        //$rdate;
        $this->loadModel('PrintingShiftreport');
        $dod = $this->PrintingShiftreport->query("select date from printing_shiftreport order by id DESC LIMIT 1");
        foreach ($dod as $d):
            $rdate = $d['printing_shiftreport']['date'];
        endforeach;

        $dt = explode('-', $rdate);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        $this->set('cmonth', $d);
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';
        $this->set('tdprcnt', $this->PrintingShiftreport->query("SELECT SUM(printed_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date = '$rdate') as printedpercent FROM printing_shiftreport where date='$rdate'"));
        $this->set('tmprcnt', $this->PrintingShiftreport->query("SELECT SUM(printed_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date between '$startm' and  '$rdate') as printedpercent FROM printing_shiftreport where date between '$startm' and  '$rdate'"));
        $this->set('typrcnt', $this->PrintingShiftreport->query("SELECT SUM(printed_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date between '$starty' and  '$rdate') as printedpercent FROM printing_shiftreport where date between '$starty' and  '$rdate'"));


        $this->set('tdunprcnt', $this->PrintingShiftreport->query("SELECT SUM(unprinted_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date = '$rdate') as unprintedpercent FROM printing_shiftreport where date='$rdate'"));
        $this->set('tmunprcnt', $this->PrintingShiftreport->query("SELECT SUM(unprinted_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date between '$startm' and  '$rdate') as unprintedpercent FROM printing_shiftreport where date between '$startm' and  '$rdate'"));
        $this->set('tyunprcnt', $this->PrintingShiftreport->query("SELECT SUM(unprinted_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date between '$starty' and  '$rdate') as unprintedpercent FROM printing_shiftreport where date between '$starty' and  '$rdate'"));
        $this->set('tyunprcnt', $this->PrintingShiftreport->query("SELECT SUM(unprinted_scrap)*100/(SELECT SUM(input) from printing_shiftreport where date between '$starty' and  '$rdate') as unprintedpercent FROM printing_shiftreport where date between '$starty' and  '$rdate'"));


        //start printed and upprinted total
        $total_printed_td = $this->PrintingShiftreport->query("SELECT SUM(input) as input,SUM(output) as output FROM printing_shiftreport where date='$rdate'");
        $this->set('total_input_td', $total_printed_td['0']['0']['input']);
        $this->set('total_putput_td', $total_printed_td['0']['0']['output']);

        $total_printed_tm = $this->PrintingShiftreport->query("SELECT SUM(input) as input,SUM(output) as output FROM printing_shiftreport where date between '$startm' and  '$rdate'");
        $this->set('total_input_tm', $total_printed_tm['0']['0']['input']);
        $this->set('total_output_tm', $total_printed_tm['0']['0']['output']);

        $total_printed_ty = $this->PrintingShiftreport->query("SELECT SUM(input) as input,SUM(output) as output FROM printing_shiftreport where date between '$starty' and  '$rdate'");
        $this->set('total_input_ty', $total_printed_ty['0']['0']['input']);
        $this->set('total_output_ty', $total_printed_ty['0']['0']['output']);
        //end  printed and upprinted total

        $this->set('tdinput', $this->PrintingShiftreport->query("SELECT SUM(input) as tdinput FROM printing_shiftreport where date = '$rdate'"));
        $this->set('tminput', $this->PrintingShiftreport->query("SELECT SUM(input) as tminput FROM printing_shiftreport where date between '$startm' and  '$rdate'"));
        $this->set('tyinput', $this->PrintingShiftreport->query("SELECT SUM(input) as tyinput FROM printing_shiftreport where date between '$starty' and  '$rdate'"));


    }
}

public function calenderreports()
{
    //echo "function called";
    $this->loadModel('TimeLoss');
    $this->loadModel('CalenderCpr');
    $this->loadModel('ConsumptionStock');
    $this->loadModel('CalenderScrap');
    $_department_id = AuthComponent::user('role');
    $dd = $this->CalenderCpr->query("select date from calender_cpr order by date DESC LIMIT 1");
    foreach ($dd as $d):
        $date1 = $d['calender_cpr']['date'];
    endforeach;

    $dod = $this->TimeLoss->query("select nepalidate from time_loss where department_id='$_department_id' order by nepalidate DESC LIMIT 1");
    foreach ($dod as $d):
        $date2 = $d['time_loss']['nepalidate'];
    endforeach;
    if (isset($date2)) {
        $_d = explode('-', $date2);
        $_y = $_d[0];
        $_m = $_d[1];
        $_n = $_y . '-' . $_m;
    }
    $_daysinmonth = $this->TimeLoss->query("select count(DISTINCT nepalidate) as dim from time_loss where department_id='$_department_id' and nepalidate LIKE '%$_n%' ");
    $this->set('_daysinmonth', $_daysinmonth['0']['0']['dim']);
    $_daysinyear = $this->TimeLoss->query("select count(DISTINCT nepalidate) as diy from time_loss where department_id='$_department_id' and nepalidate LIKE '%$_y%' ");
    $this->set('_daysinyear', $_daysinyear['0']['0']['diy']);

    $dood = $this->ConsumptionStock->query("select nepalidate from consumption_stock order by consumption_id DESC LIMIT 1");
    foreach ($dood as $d):
        $date3 = isset($d['consumption_stock']['nepalidate']) ? $d['consumption_stock']['nepalidate'] : '0';
    endforeach;
    if (isset($date3)) {
        $n_dt = explode('-', $date3);
        $n_y = $n_dt[0];
        $n_m = $n_dt[1];
        $n_month = $n_y . '-' . $n_m . '-01';
        $n_year = $n_y . '-01-01';
    }

    $doood = $this->CalenderScrap->query("select date from calender_scrap order by id DESC LIMIT 1");
    foreach ($doood as $d):
        $date4 = $d['calender_scrap']['date'];
    endforeach;
    if (isset($date4)) {
        $ndt = explode('-', $date3);
        $ny = $ndt[0];
        $nm = $ndt[1];
        $n_st_month = $ny . '-' . $nm . '-01';
        $n_st_year = $ny . '-01-01';
    }
    if (isset($date1)) {
        $dt = explode('-', $date1);

        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];

        $startmonth = $yr . '-' . $m . '-' . '01';
        $startyear = $yr . '-' . '01' . '-' . '01';

        //$startmonth=date('01-m-Y');
        $endmonth = $yr . '-' . $m . '-30';
        $odim = $this->CalenderCpr->query("SELECT DISTINCT (
Dimension
), count( DISTINCT (
Dimension
) ) AS total
FROM calender_cpr");
        $this->set('onlydim', $odim);

        $odimon = $this->CalenderCpr->query("SELECT DISTINCT (Dimension), count( DISTINCT (Dimension) ) AS total
                                          FROM calender_cpr where date between '$startmonth' AND '$endmonth'
");
        $this->set('mon', $odimon);
        $todate = $this->CalenderCpr->query("SELECT DISTINCT (
Dimension
), count( DISTINCT (
Dimension
) ) AS total FROM calender_cpr where date='$date1'
");
        $this->set('tody', $todate);

        $aaj = $this->CalenderCpr->query("SELECT DISTINCT(Dimension),sum(length) as totallength from calender_cpr where date='$date1' group by Dimension order by id");
        $this->set('dimtday', $aaj);
        $current_date = $this->CalenderCpr->query("SELECT date FROM calender_cpr WHERE date order BY date DESC limit 1");
        $this->set('current_date', $current_date);

        $dashsrw = $this->CalenderCpr->query("SELECT quality,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date='$date1' group by quality");
        $this->set('brandtoday', $dashsrw);
        $dim = $this->CalenderCpr->query("SELECT Dimension,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date='$date1' group by Dimension order by id");
        $this->set('dimtoday', $dim);
        $tot = $this->CalenderCpr->query("SELECT sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date='$date1'");
        $this->set('today', $tot);

        $tot1 = $this->CalenderCpr->query("SELECT sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startmonth' and '$date1'");
        $this->set('month', $tot1);
        $dash = $this->CalenderCpr->query("SELECT quality,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startmonth' and '$date1' group by quality");
        $this->set('brandmonth', $dash);
        $dim1 = $this->CalenderCpr->query("SELECT Dimension,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startmonth' and '$date1' group by Dimension order by id");
        $this->set('dimmonth', $dim1);

        //for to year
        //print_r($date);
        $tot2 = $this->CalenderCpr->query("SELECT DISTINCT(Dimension),sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startyear' and  '$date1'");
        $this->set('year', $tot2);
        $dash1 = $this->CalenderCpr->query("SELECT quality,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startyear' and '$date1' group by quality");
        $this->set('brandyear', $dash1);
        $dim2 = $this->CalenderCpr->query("SELECT Dimension,sum(length) as totallength,sum(ntwt) as totalntwt from calender_cpr where date between '$startyear' and '$date1' group by Dimension order by id");
        $this->set('dimyear', $dim2);
        $brandratio = $this->CalenderCpr->query("SELECT quality,sum(ntwt)/sum(length) as ratio from calender_cpr where date='$date1' group by quality ");
        $this->set('ratio', $brandratio);

        if ($date1) {
            $calendertotal = $this->CalenderCpr->query("select sum(ntwt) as totc from calender_cpr where date='$date1'");
            $this->set('calendertotals', $calendertotal);
            if (isset($startmonth)) {
                $n_monthlytotal = $this->CalenderCpr->query("select sum(ntwt) as n_monthlytotal from calender_cpr where date between '$startmonth' and '$date1' ");
                $this->set('n_monthlytotal', $n_monthlytotal['0']['0']['n_monthlytotal']);
            }
            if (isset($startyear)) {
                $n_yearlytotal = $this->CalenderCpr->query("select sum(ntwt) as n_yearlytotal from calender_cpr where date between '$startyear' and '$date1' ");
                $this->set('n_yearlytotal', $n_yearlytotal['0']['0']['n_yearlytotal']);
            }
        }
        //for laminating

        if (isset($date3)) {
            $totalinput = $this->ConsumptionStock->query("select sum(quantity) as tot  from consumption_stock where nepalidate='$date3'");
            $this->set('totalinputs', $totalinput);
            if (isset($n_month)) {
                $n_cs_monthly = $this->ConsumptionStock->query("select sum(quantity) as n_cs_monthly  from consumption_stock where nepalidate between '$n_month' and '$date3'");
                $this->set('n_cs_monthly', $n_cs_monthly['0']['0']['n_cs_monthly']);
            }
            if (isset($n_year)) {
                $n_cs_yearly = $this->ConsumptionStock->query("select sum(quantity) as n_cs_yearly from consumption_stock where nepalidate between '$n_year' and '$date3'");
                $this->set('n_cs_yearly', $n_cs_yearly['0']['0']['n_cs_yearly']);
            }
        }
        if (isset($date4)) {
            $sptot = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s from calender_scrap where date='$date4'");
            $this->set('sptots', $sptot);
            if (isset($n_st_month)) {
                $n_st_monthly = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as n_st_monthly from calender_scrap where date between '$n_st_month' and '$date4'");
                $this->set('n_st_monthly', $n_st_monthly['0']['0']['n_st_monthly']);
            }
            if (isset($n_st_year)) {
                $n_st_yearly = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as n_st_yearly from calender_scrap where date between '$n_st_year' and '$date4'");
                $this->set('n_st_yearly', $n_st_yearly['0']['0']['n_st_yearly']);
            }
        }

        //$total=($totalinput-$sptot);


        //calender working hour calculation


        //printing loss hour calculation
        $rdate;
        $this->loadModel('ProductionShiftreport');
        $dod = $this->ProductionShiftreport->query("select date from production_shiftreport order by id DESC LIMIT 1");
        foreach ($dod as $d):
            $rdate = $d['production_shiftreport']['date'];
        endforeach;
        if (isset($rdate)) {
            $dt = explode('-', $rdate);
            $yr = $dt[0];
            $m = $dt[1];
            $d = $dt[2];
            $this->set('cmonth', $m);
            $this->set('cday', $d);
            $startm = $yr . '-' . $m . '-' . '01';
            $starty = $yr . '-' . '01' . '-' . '01';
            //$tdlls=$this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as lloss FROM `time_loss` where nepalidate='$rdate' and department_id='laminating'");
            //$this->set('tdlls',$tdlls); //today working hour
            //monthly
            //$tmlls=$this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as lloss FROM `time_loss` where nepalidate>='$startm' and nepalidate<='$rdate' and department_id='laminating'");
            //$this->set('tmlls',$tmlls); //monthly working hour
            //$tylls=$this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as lloss FROM `time_loss` where nepalidate>='$starty' and nepalidate<='$rdate' and department_id='laminating'");
            //$this->set('tylls',$tylls); //yearly working hour

            $todaycalenderop = $this->ProductionShiftreport->query("select SUM(output) as output from production_shiftreport where date = '$rdate'");
            //$this->ProductionShiftreport->find('list',array('fields'=>array('output','output'),'conditions'=>array('date'=>$rdate)));
            $this->set('todaycalenderop', $todaycalenderop);
            $tomonthcalenderop = $this->ProductionShiftreport->query("select SUM(output) as output from production_shiftreport where date between '$startm' and '$rdate'");
            $this->set('tomonthcalenderop', $tomonthcalenderop);
            $toyrcalenderop = $this->ProductionShiftreport->query("select SUM(output) as output from production_shiftreport where date between '$starty' and '$rdate'");
            $this->set('toyrcalenderop', $toyrcalenderop);
        }
    }
}
public function breakdown()
{
    $dept = AuthComponent::user('role');
    $this->loadModel('TimeLoss');
    $currentdate = $this->TimeLoss->query("select nepalidate from time_loss where department_id='$dept' and type='BreakDown' order by nepalidate DESC LIMIT 1");
    foreach ($currentdate as $d):
        $currentdate1 = $d['time_loss']['nepalidate'];
    endforeach;
    if (isset($currentdate1)) {
        $dt = explode('-', $currentdate1);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        //$this->set('cmonth',$m);
        //$this->set('cday',$d);
        $startmonth1 = $yr . '-' . $m . '-' . '01';
        $startyear1 = $yr . '-' . '01' . '-' . '01';

        //$timeloss=$this->TimeLoss->query("select sum(totalloss) as todayloss from time_loss where department_id='$dept' and nepalidate='$currentdate'  and type='LossHour'");
        //$this->set('todayloss',$timeloss);
        //print_r($timeloss);
        $timeloss = $this->TimeLoss->query("select sum(totalloss) as todaybdloss from time_loss where department_id='$dept' and nepalidate='$currentdate1' and type='BreakDown'");
        $this->set('todaybdloss', $timeloss);

        //$timeloss=$this->TimeLoss->query("select sum(totalloss) as todaylosscc from time_loss where department_id='$dept' and nepalidate='$currentdate'  and type='LossHour'");
        //$this->set('todaylossc',$timeloss);
        $timeloss = $this->TimeLoss->query("select sum(totalloss) as todaybdlossc from time_loss where department_id='$dept' and nepalidate='$currentdate1' and type='BreakDown'");
        $this->set('todaybdlossc', $timeloss);
        //laminatiing

        $onlytime = $this->TimeLoss->query("select type from time_loss where nepalidate = '$currentdate1' group by type");
        $this->set('otype', $onlytime);

        //laminating
        //$timelossmonth=$this->TimeLoss->query("select sum(totalloss) as tomonthloss from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate') and type='LossHour'");
        //$this->set('tomonthloss',$timelossmonth);
        $timelossmonth = $this->TimeLoss->query("select sum(totalloss) as tomonthbdloss from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate1') and type='BreakDown'");
        $this->set('tomonthbdloss', $timelossmonth);

        //$timelossmonth=$this->TimeLoss->query("select sum(totalloss) as tomonthlossc from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate') and type='LossHour'");
        //$this->set('tomonthlossc',$timelossmonth);
        $timelossmonth = $this->TimeLoss->query("select sum(totalloss) as tomonthbdlossc from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate1') and type='BreakDown'");
        $this->set('tomonthbdlossc', $timelossmonth);
        //laminating

        //laminating
        //$timelossyear=$this->TimeLoss->query("select sum(totalloss) as toyearloss from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdatee2') and type='LossHour'");
        //$this->set('toyearloss',$timelossyear);
        $timelossyear = $this->TimeLoss->query("select sum(totalloss) as toyearbdloss from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate1') and type='BreakDown'");
        $this->set('toyearbdloss', $timelossyear);

        //$timelossyear=$this->TimeLoss->query("select sum(totalloss) as toyearlossc from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate') and type='LossHour'");
        //$this->set('toyearlossc',$timelossyear);
        $timelossyear = $this->TimeLoss->query("select sum(totalloss) as toyearbdlossc from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate1') and type='BreakDown'");
        $this->set('toyearbdlossc', $timelossyear);
        //laminating
        $lo = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate='$currentdate1' and department_id='$dept'");
        $this->set('workinghour', $lo); //today working hour
        //monthly
        $lom = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startmonth1' and nepalidate<='$currentdate1' and department_id='$dept'");
        $this->set('mworkinghour', $lom); //monthly working hour
        $loy = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startyear1' and nepalidate<='$currentdate1' and department_id='$dept'");
        $this->set('yworkinghour', $loy); //yearly working hour

        $this->set('laminating_dm', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinmonth from time_loss where department_id='$dept' and nepalidate between '$startmonth1' and '$currentdate1'"));
        $this->set('laminating_dy', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinyear from time_loss where department_id='$dept' and nepalidate between '$startyear1' and '$currentdate1'"));
    }

}

public function losshour()
{
    $dept = AuthComponent::user('role');
    $this->loadModel('TimeLoss');
    $currentdate = $this->TimeLoss->query("select nepalidate from time_loss where department_id='$dept' and type='LossHour' order by nepalidate DESC LIMIT 1");
    foreach ($currentdate as $d):
        $currentdate1 = $d['time_loss']['nepalidate'];
    endforeach;
    if (isset($currentdate1)) {
        $dt = explode('-', $currentdate1);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        //$this->set('cmonth',$m);
        //$this->set('cday',$d);
        $startmonth1 = $yr . '-' . $m . '-' . '01';
        $startyear1 = $yr . '-' . '01' . '-' . '01';

        $timeloss = $this->TimeLoss->query("select sum(totalloss) as todayloss from time_loss where department_id='$dept' and nepalidate='$currentdate1'  and type='LossHour'");
        $this->set('todayloss', $timeloss);
        //print_r($timeloss);
        //$timeloss=$this->TimeLoss->query("select sum(totalloss) as todaybdloss from time_loss where department_id='$dept' and nepalidate='$currentdate' and type='BreakDown'");
        //  $this->set('todaybdloss',$timeloss);

        $timeloss = $this->TimeLoss->query("select sum(totalloss) as todaylosscc from time_loss where department_id='$dept' and nepalidate='$currentdate1'  and type='LossHour'");
        $this->set('todaylossc', $timeloss);
        //$timeloss=$this->TimeLoss->query("select sum(totalloss) as todaybdlossc from time_loss where department_id='$dept' and nepalidate='$currentdate' and type='BreakDown'");
        //$this->set('todaybdlossc',$timeloss);
        //laminatiing

        $onlytime = $this->TimeLoss->query("select type from time_loss where nepalidate = '$currentdate1' group by type");
        $this->set('otype', $onlytime);

        //laminating
        $timelossmonth = $this->TimeLoss->query("select sum(totalloss) as tomonthloss from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate1') and type='LossHour'");
        $this->set('tomonthloss', $timelossmonth);
        //$timelossmonth=$this->TimeLoss->query("select sum(totalloss) as tomonthbdloss from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate') and type='BreakDown'");
        //$this->set('tomonthbdloss',$timelossmonth);

        $timelossmonth = $this->TimeLoss->query("select sum(totalloss) as tomonthlossc from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate1') and type='LossHour'");
        $this->set('tomonthlossc', $timelossmonth);
        //$timelossmonth=$this->TimeLoss->query("select sum(totalloss) as tomonthbdlossc from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$currentdate') and type='BreakDown'");
        //$this->set('tomonthbdlossc',$timelossmonth);
        //laminating

        //laminating
        $timelossyear = $this->TimeLoss->query("select sum(totalloss) as toyearloss from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate1') and type='LossHour'");
        $this->set('toyearloss', $timelossyear);
        //$timelossyear=$this->TimeLoss->query("select sum(totalloss) as toyearbdloss from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate') and type='BreakDown'");
        //$this->set('toyearbdloss',$timelossyear);

        $timelossyear = $this->TimeLoss->query("select sum(totalloss) as toyearlossc from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate1') and type='LossHour'");
        $this->set('toyearlossc', $timelossyear);
        //$timelossyear=$this->TimeLoss->query("select sum(totalloss) as toyearbdlossc from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$currentdate') and type='BreakDown'");
        //$this->set('toyearbdlossc',$timelossyear);
        //laminating
        $lo = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate='$currentdate1' and department_id='$dept'");
        $this->set('workinghour', $lo); //today working hour
        //monthly
        $lom = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startmonth1' and nepalidate<='$currentdate1' and department_id='$dept'");
        $this->set('mworkinghour', $lom); //monthly working hour
        $loy = $this->TimeLoss->query("SELECT TRUNCATE(SUM(totalloss),2) as loss FROM `time_loss` where nepalidate>='$startyear1' and nepalidate<='$currentdate1' and department_id='$dept'");
        $this->set('yworkinghour', $loy); //yearly working hour

        $this->set('laminating_dm', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinmonth from time_loss where department_id='$dept' and nepalidate between '$startmonth1' and '$currentdate1'"));
        $this->set('laminating_dy', $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) as dayinyear from time_loss where department_id='$dept' and nepalidate between '$startyear1' and '$currentdate1'"));
    }
}

public function losshour_calculate($dept)
{
    $this->loadModel('TimeLoss');
    $lastDate = $this->TimeLoss->query("SELECT nepalidate FROM time_loss WHERE department_id='$dept' ORDER BY nepalidate DESC limit 1")[0]['time_loss']['nepalidate'];
    $Month = explode('-', $lastDate);
    $lastMonth = $Month[0] . '-' . $Month[1];
    $lastYear = $Month[0];
    //breakdown
    $breakdownToDay = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='BreakDown' and nepalidate LIKE '%$lastDate%'")[0][0]['sum'];
    $breakdownToMonth = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='BreakDown' and  nepalidate LIKE '%$lastMonth%'")[0][0]['sum'];
    $breakdownToMonthCount = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as count from time_loss where department_id='$dept' and type= 'BreakDown' and nepalidate like '%$lastMonth%'")[0][0]['count'];
    $breakdownToYear = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='BreakDown' and  nepalidate LIKE '%$lastYear%'")[0][0]['sum'];
    $breakdownToYearCount = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as count from time_loss where department_id='$dept' and type= 'BreakDown' and nepalidate like '%$lastYear%'")[0][0]['count'];
    //losshour
    $losshourToDay = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='LossHour' and nepalidate LIKE '%$lastDate%'")[0][0]['sum'];
    $losshourToMonth = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='LossHour' and  nepalidate LIKE '%$lastMonth%'")[0][0]['sum'];
    $losshourToMonthCount = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as count from time_loss where department_id='$dept' and type= 'LossHour' and nepalidate like '%$lastMonth%'")[0][0]['count'];
    $losshourToYear = $this->TimeLoss->query("SELECT sum(totalloss_sec) as sum from time_loss where department_id='$dept' and type='LossHour' and  nepalidate LIKE '%$lastYear%'")[0][0]['sum'];
    $losshourToYearCount = $this->TimeLoss->query("SELECT count(distinct(nepalidate)) as count from time_loss where department_id='$dept' and type= 'LossHour' and nepalidate like '%$lastYear%'")[0][0]['count'];
    //WorkedHour
    $workedHourToDay = 24 * 60 * 60 - ($breakdownToDay + $losshourToDay);
    $workedHourToMonth = 24 * 60 * 60 - ($breakdownToMonth / $breakdownToMonthCount + $losshourToMonth / $losshourToMonthCount);
    $workedHourToYear = 24 * 60 * 60 - ($breakdownToYear / $breakdownToYearCount + $losshourToYear / $losshourToYearCount);
    //breakdown
    $this->set('breakdownToDay', $this->time_elapsed($breakdownToDay));
    $this->set('breakdownToMonth', $this->time_elapsed($breakdownToMonth / $breakdownToMonthCount));
    $this->set('breakdownToYear', $this->time_elapsed($breakdownToYear / $breakdownToYearCount));
    //LossHour
    $this->set('losshourToDay', $this->time_elapsed($losshourToDay));
    $this->set('losshourToMonth', $this->time_elapsed($losshourToMonth / $losshourToMonthCount));
    $this->set('losshourToYear', $this->time_elapsed($losshourToYear / $losshourToYearCount));
    //WorkedHour
    $this->set('workedHourToDay', $this->time_elapsed($workedHourToDay));
    $this->set('workedHourToMonth', $this->time_elapsed($workedHourToMonth));
    $this->set('workedHourToYear', $this->time_elapsed($workedHourToYear));
    $this->set('lastDate', $lastDate);
    $this->set('lastMonth', $lastMonth);
    $this->set('lastYear', $lastYear);
//        $last_date = $this->TimeLoss->query("SELECT nepalidate FROM time_loss WHERE  department_id='$dept' ORDER  BY  nepalidate DESC  limit 1");
//        $last_date = $last_date[0]['time_loss']['nepalidate'];
//        $this->set('current_date_loss_hour',$last_date);
//
//
//        //breakdown last date
//        $query_breakdown_today = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE department_id='$dept' AND type='BreakDown' AND  nepalidate='$last_date'");
//        $breakdown_today = $this->time_elapsed($query_breakdown_today[0][0]['s']);
//
//
//        //loss hour last date
//        $query_losshour_today = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE department_id='$dept' AND type='LossHour' AND  nepalidate='$last_date'");
//        $losshour_today = $this->time_elapsed($query_losshour_today[0][0]['s']);
//
//        $month = explode('-', $last_date);
//        $current_month = $month[0] . '-' . $month[1] . '%';
//        $month = explode('-', $last_date);
//        $current_day = $month[0] . '-' . $month[1] .'-'.$month[2];
//        //breakdown to month
//        $query_breakdown_tomonth = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_month' AND department_id='$dept' AND type='BreakDown'");
//        $query_numberofdays_break_in_month=$this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM   polychem.time_loss WHERE    department_id = '$dept' AND     type = 'BreakDown' AND  nepalidate LIKE '%$current_month%' ");
//        $breakdown_month_avg=$query_breakdown_tomonth[0][0]['s']/ $query_numberofdays_break_in_month[0][0]['total'];
//        $breakdown_tomonth = $this->time_elapsed($breakdown_month_avg);
//
//        //loss hour to month with avg
//        $query_losshour_tomonth = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_month' AND department_id='$dept' AND type='LossHour'");
//       $query_numberofdays_loss_in_month=$this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM     polychem.time_loss WHERE    department_id = '$dept' AND     type = 'LossHour' AND   nepalidate LIKE '%$current_month%' ");
//       $tomonthdata=$query_losshour_tomonth[0][0]['s']/ $query_numberofdays_loss_in_month[0][0]['total'];
//       $losshour_tomonth = $this->time_elapsed($tomonthdata);
//
//
//        $year = explode('-', $last_date);
//        $current_year = $month[0] . '%';
//        //breakdown to month
//        $query_breakdown_toyear = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_year' AND department_id='$dept' AND type='BreakDown'");
//        $query_numberofdays_break_in_year=$this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM    polychem.time_loss WHERE    department_id = '$dept' AND     type = 'BreakDown' AND  nepalidate LIKE '%$current_year%' ");
//
//        $breakdown_year_avg=$query_breakdown_toyear[0][0]['s']/ $query_numberofdays_break_in_year[0][0]['total'];
//
//        $breakdown_toyear = $this->time_elapsed($breakdown_year_avg);
//
//        //loss hour to year
//        $query_losshour_toyear = $this->TimeLoss->query("SELECT SUM(totalloss_sec) as s from time_loss WHERE nepalidate LIKE  '$current_year' AND department_id='$dept' AND type='LossHour'");
//        $query_numberofdays_loss_in_year=$this->TimeLoss->query("SELECT count(distinct(nepalidate)) as total FROM     polychem.time_loss WHERE    department_id = '$dept' AND     type = 'LossHour' AND   nepalidate LIKE '%$current_year%' ");
//        $toyearavg=$query_losshour_toyear[0][0]['s']/ $query_numberofdays_loss_in_year[0][0]['total'];
//        $losshour_toyear = $this->time_elapsed($toyearavg);
//
//
//        //worked hour today
//        $total_working_days_query_d = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_day' AND department_id='$dept'");
//        $total_working_days_d = $total_working_days_query_d[0][0]['loss'];
//
//
//
//        //worked hour toMonth
//        $total_working_days_query_m = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_month' AND department_id='$dept'");
//        //$toal_working_days_month_avg=
//
//
//        $total_working_days_m = $total_working_days_query_m[0][0]['loss'];
//       // echo $total_working_days_m;exit;
//
//        //worked hour toYear
//        $total_working_days_query_y = $this->TimeLoss->query("SELECT count(DISTINCT nepalidate) AS loss from time_loss WHERE nepalidate LIKE '$current_year' AND department_id='$dept'");
//        $total_working_days_y = $total_working_days_query_y[0][0]['loss'];
//
//        $breakdown1 = $query_breakdown_today[0][0]['s'];
//        $losshour1 =$query_losshour_today[0][0]['s'];
//        $total_loss1 = $breakdown1 + $losshour1;
//
//        $workhour1 = $total_working_days_d*24*60*60-($total_loss1);
//        $workhour_d = $this->time_elapsed($workhour1);
//
//        //worked hour tomonth
//        $breakdown2 = $query_breakdown_tomonth[0][0]['s'];
//        $losshour2 = $query_losshour_tomonth[0][0]['s'];
//        $total_loss2 = $breakdown2 + $losshour2;
//        $workhour_m = $total_working_days_m * 24 * 60 * 60 - ($total_loss2);
//        $avg_working_month= $workhour_m/$total_working_days_m;
//        $workhour_m = $this->time_elapsed($avg_working_month);
//
//        //worked hour toyear
//        $breakdown3 = $query_breakdown_toyear[0][0]['s'];
//        $losshour3 = $query_losshour_toyear[0][0]['s'];
//        $total_loss3 = $breakdown3 + $losshour3;
//        $workhour_y = $total_working_days_y * 24 * 60 * 60 - ($total_loss3);
//        $avg_working_year=$workhour_y/$total_working_days_y;
//        $workhour_y = $this->time_elapsed($avg_working_year);
//
//        //send value to view
//        $this->set('breakdown_today', $breakdown_today);
//        $this->set('losshour_today', $losshour_today);
//        $this->set('breakdown_tomnoth', $breakdown_tomonth);
//        $this->set('losshour_tomonth', $losshour_tomonth);
//        $this->set('breakdown_toyear', $breakdown_toyear);
//        $this->set('losshour_toyear', $losshour_toyear);
//        $this->set('workhour_d', $workhour_d);
//        $this->set('workhour_m', $workhour_m);
//        $this->set('workhour_y', $workhour_y);
}
function calculate_losshour($dept)
{
    // $this->loadModel('TimeLoss');
    // $dat = $this->TimeLoss->query("select nepalidate from time_loss order by nepalidate desc limit 1");
    // foreach ($dat as $d):
    //   $date = $d['time_loss']['nepalidate'];
    //endforeach;
    // $dt = explode('-', $date);
    //$yr = $dt[0];
    //$m = $dt[1];
    // $d = $dt[2];
    // $startmonth1 = $yr . '-' . $m . '-' . '01';
    // $startyear1 = $yr . '-' . '01' . '-' . '01';


    $nd = $this->TimeLoss->query("select nepalidate from time_loss where department_id='$dept' order by id desc limit 1");
    foreach ($nd as $d):
        $dae = $d['time_loss']['nepalidate'];
    endforeach;
    $dot = explode('-', $dae);
    $yer = $dot['0'];
    $mi = $dot['1'];
    $da = $dot['2'];
    $startmonth11 = $yer . '-' . $mi;
    $startyear11 = $yer;

    $tomonth = $this->TimeLoss->query("select count(nepalidate) as total from time_loss where nepalidate LIKE '$startmonth11%' and department_id='$dept'");
    foreach ($tomonth as $to):
        $tt = $to['0']['total'];
    endforeach;

    $toyear = $this->TimeLoss->query("select count(nepalidate) as total from time_loss where nepalidate LIKE '$startmonth11%' and department_id='$dept'");
    foreach ($toyear as $toy):
        $tot = $toy['0']['total'];
    endforeach;


    $this->set('monthly', $tt);
    $this->set('yearly', $tot);
    //$this->set('x',$startyear11);

    $losshour = $this->TimeLoss->query("select truncate(sum(totalloss),2) as l1 from time_loss where department_id='$dept' and nepalidate='$dae' and type='LossHour'");
    foreach ($losshour as $l):
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
        $this->set('todayloss1', $d);


    } else {
        $this->set('todayloss1', $losshour);

    }


    $losstomonth = $this->TimeLoss->query("select truncate(sum(totalloss),2) as tomonthlossc from time_loss where (department_id='$dept') and (nepalidate between '$startmonth1' and '$date') and type='LossHour'");
    foreach ($losstomonth as $lm):
        $lossm = $lm['0']['tomonthlossc'];
    endforeach;
    $month = explode('.', $lossm);
    $mhour = $month['0'];
    $mmin = $month['1'];
    if ($lmin >= 60) {
        $a = $mmin / 60;
        $hr = explode('.', $a);
        $hour = $mhour + $hr['0'];
        $b = $mmin % 60;
        $d = $hour . "." . $b;
        $this->set('mloss1', $d);

    } else {
        $this->set('mloss1', $losstomonth);
    }

    $losstoyear = $this->TimeLoss->query("select truncate(sum(totalloss),2) as tomonthlossc from time_loss where (department_id='$dept') and (nepalidate between '$startyear1' and '$date') and type='LossHour'");
    foreach ($losstoyear as $ly):
        $lossy = $ly['0']['tomonthlossc'];
    endforeach;
    $year = explode('.', $lossy);
    $yhour = $year['0'];
    $ymin = $year['1'];
    if ($ymin >= 60) {
        $a = $ymin / 60;
        $hr = explode('.', $a);
        $hour = $yhour + $hr['0'];
        $b = $ymin % 60;
        $d = $hour . "." . $b;
        $this->set('yloss1', $d);

    } else {
        $this->set('yloss1', $losstoyear);
    }


    $breakdown = $this->TimeLoss->query("select truncate(sum(totalloss),2) as lossm from time_loss where department_id='$dept' and nepalidate='$dae' and type='BreakDown'");
    foreach ($breakdown as $bk):
        $lossb = $bk['0']['lossm'];
    endforeach;


    $btoday = explode('.', $lossb);
    $bhour = $btoday['0'];
    $bmin = isset($btoday['1']) ? $btoday['1'] : '00';
    if ($bmin >= 60) {

        $a = $bmin / 60;
        $hour1 = explode('.', $a);
        $hour = $bhour + $hour;
        $b = $bmin % 60;
        $d = $hour . "." . $b;

        $this->set('tbreakdown', $d);

    } else {
        $this->set('tbreakdown', $breakdown);
    }

    $breakdowntomonth = $this->TimeLoss->query("SELECT sum(totalloss) as los1 from time_loss where department_id='$dept' and nepalidate>='$startmonth1' and nepalidate<='$date' and type='BreakDown' ");
    //print_r($breakdowntomonth);
    foreach ($breakdowntomonth as $bkm):
        $lossbm = $bkm['0']['los1'];
    endforeach;

    $bmonth = explode('.', $lossbm);
    $bh = $bmonth['0'];
    $bm = number_format(isset($bmonth[1]) ? $bmonth[1] : 0, 3);
    //$this->set('bmm',$bh);
    //$this->set('bmm1',$bm);
    if ($bm >= 60) {

        $a = $bm / 60;
        $ha = explode('.', $a);
        $hr = $ha['0'];
        //$this->set('aa',$hr);
        $hour = $bh + $hr;
        $b = $bm % 60;
        //$this->set('bb',$hour);

        $d = $hour . "." . $b;
        $this->set('breakdownmonth', $d);


    } else {
        $this->set('breakdownmonth', $breakdowntomonth);

    }

    $breakdowntoyear = $this->TimeLoss->query("SELECT truncate(sum(totalloss),2) as los from time_loss where department_id='$dept' and nepalidate>='$startyear1' and nepalidate<='$date' and type='BreakDown'");
    //  $this->set('breaakdownyear',$breakdowntoyear);
    foreach ($breakdowntoyear as $bky):
        $lossby = $bky['0']['los'];
    endforeach;
    //$lb=number_format($lossby,2);
    //$this->set('breaakdownyear',$lb);

    $byear = explode('.', $lossby);
    $yh = $byear['0'];
    $this->set('aa', $yh);


    $yom = $byear['1'];
    $this->set('bb', $yom);
    //$this->set('yhh',$yh);
    if ($yom >= 60) {
        $a = $yom / 60;
        $ha = explode('.', $a);
        $yhr = $ha['0'];

        //$this->set('cc',$yhr);
        $hour1 = $yh + $yhr;
        //$this->set('dd',$hour1);
        $b = $ym % 60;
        $d = $hour1 . "." . $b;
        $this->set('breaakdownyear', $d);
    } else {
        $this->set('breaakdownyear', $breakdowntoyear);
    }
    //total working hour calculation
}

public function fetch_totalConsumption()
{

    $this->loadModel('TblConsumptionStock');
    $this->loadModel('ConsumptionStock');
    $dd = $this->TblConsumptionStock->query("select nepalidate from tbl_consumption_stock order by nepalidate DESC LIMIT 1");
    foreach ($dd as $d):
        $date = $d['tbl_consumption_stock']['nepalidate'];
    endforeach;

    /*Start: To count the number of days operated in latest month and year*/
    $yrmnth = $this->TblConsumptionStock->query("select nepalidate from tbl_consumption_stock order by nepalidate DESC LIMIT 1");
    foreach ($yrmnth as $d):
        $datacount = $d['tbl_consumption_stock']['nepalidate'];
        list($yrcount, $mnthcount, $ddate) = explode("-", $datacount);
    endforeach;

    $count_yr = $this->TblConsumptionStock->query("select count(distinct nepalidate) as year from tbl_consumption_stock where nepalidate like '$yrcount-%'");
    $count_mnth = $this->TblConsumptionStock->query("select count(distinct nepalidate) as month from tbl_consumption_stock where nepalidate like '%-$mnthcount-%'");

    $this->set('year2', $count_yr);
    $this->set('month2', $count_mnth);
    $this->set('latestyear', $yrcount);
    $this->set('latestmonth', $mnthcount);
    $this->set('latestdate', $ddate);


    /* End: To count the number of days operated in latest month and year*/

    $dt = explode('-', $date);

    $yr = $dt[0];
    $m = $dt[1];
    $d = $dt[2];

    $startmonth = $yr . '-' . $m . '-' . '01';
    $startyear = $yr . '-' . '01' . '-' . '01';
//For contextual information for today, to month and to year
    $todayhead = $this->ConsumptionStock->query("SELECT nepalidate as todayrwsum from consumption_stock ORDER BY nepalidate DESC");
    $this->set('todayhead', $todayhead);

    $dashsrw = $this->ConsumptionStock->query("SELECT sum(quantity) as todayrwsum from consumption_stock where (material_id != 'Scrap Unprinted' and material_id != 'Scrap Laminated' and material_id != 'Scrap Printed' and material_id != 'Scrap Plain' and material_id != 'Scrap CT' and material_id !='Scrap Unprinted' and material_id !='Bought Scrap') and (nepalidate = '$date')");
    $this->set('todayrw', $dashsrw);
    $dashbs = $this->ConsumptionStock->query("SELECT sum(quantity) as todaybs from consumption_stock where (material_id ='Bought Scrap') and (nepalidate = '$date')");
    $this->set('todaybs', $dashbs);
    $dashscrap = $this->ConsumptionStock->query("SELECT sum(quantity) as todaysrapsum from consumption_stock where (material_id='Scrap Unprinted' or material_id ='Scrap Laminated' or material_id ='Scrap Printed' or material_id ='Scrap Plain' or material_id='Scrap CT') and (nepalidate = '$date')");
    $this->set('todayscrap', $dashscrap);


    $newdate =  //date('Y-m-01');
    $dashsrw = $this->ConsumptionStock->query("SELECT sum(quantity) as toMrwsum from consumption_stock where (material_id != 'Scrap Unprinted' and material_id != 'Scrap Laminated' and material_id != 'Scrap Printed' and material_id != 'Scrap Plain' and material_id != 'Scrap CT' and material_id !='Scrap Unprinted' and material_id !='Bought Scrap') and (nepalidate between '$startmonth' and '$date')");
    $this->set('toMrw', $dashsrw);
    $dashbs = $this->ConsumptionStock->query("SELECT sum(quantity) as toMbs from consumption_stock where (material_id ='Bought Scrap') and (nepalidate between '$startmonth' and '$date')");
    $this->set('toMbs', $dashbs);
    $dashscrap = $this->ConsumptionStock->query("SELECT sum(quantity) as toMsrapsum from consumption_stock where (material_id='Scrap Unprinted' or material_id ='Scrap Laminated' or material_id ='Scrap Printed' or material_id ='Scrap Plain' or material_id='Scrap CT') and (nepalidate between '$startmonth' and '$date')");
    $this->set('toMscrap', $dashscrap);


    $dashsrw = $this->ConsumptionStock->query("SELECT sum(quantity) as toyrwsum from consumption_stock where (material_id != 'Scrap Unprinted' and material_id != 'Scrap Laminated' and material_id != 'Scrap Printed' and material_id != 'Scrap Plain' and material_id != 'Scrap CT' and material_id !='Scrap Unprinted' and material_id !='Bought Scrap') and (nepalidate between '$startyear' and  '$date')");
    $this->set('toyrw', $dashsrw);
    $dashbs = $this->ConsumptionStock->query("SELECT sum(quantity) as toybs from consumption_stock where (material_id ='Bought Scrap') and (nepalidate between '$startyear' and  '$date')");
    $this->set('toybs', $dashbs);
    $dashscrap = $this->ConsumptionStock->query("SELECT sum(quantity) as toysrapsum from consumption_stock where (material_id='Scrap Unprinted' or material_id ='Scrap Laminated' or material_id ='Scrap Printed' or material_id ='Scrap Plain' or material_id='Scrap CT') and (nepalidate between '$startyear' and  '$date')");
    $this->set('toyscrap', $dashscrap);


}

public function maintenance()
{
}

public function t()
{
    if ($this->request->is('ajax')) {

        $this->request->onlyAllow('ajax');
        $this->loadModel('Base');
        $d = $this->request->data['id'];
        $type = $this->Base->query("select distinct(dimension) from base where brand='$d'");
        echo '<option value="null">Please select</option>';
        foreach ($type as $t):
            echo '<option value="' . $t['base']['dimension'] . '">' . $t['base']['dimension'] . '</option>';
        endforeach;
        exit;
    }
}

public function data()
{
//echo " <i class='glyphicon glyphiocn-arrow-up'></i> Done by Srijana ";
exit;
$this->request->onlyAllow('ajax');
$dimension = $this->request->data['id'];
$brand = $this->request->data['type'];


$this->loadModel('MixingMaterial');
$this->loadModel('CategoryMaterial');
$allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC ");
$lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1")[0]['tbl_consumption_stock']['nepalidate'];
$month = '%' . substr($lastDate, 0, 4) . '-' . $month . '%';

$allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate like '$month'");

echo '<table class="table table-bordered">';
echo '<tr class="success"><td>Materials</td><td>Quantity</td><td>Percentage</td></tr>';
$totalBroughtScrap = 0;
$totalScrap = 0;

$allTotal = 0;
$totalMaterial = 0;
$allTotalRaw = 0;

foreach ($allMaterials as $m):
    foreach ($allConsumptionStocks as $c):
        $materialJSON = $c['tbl_consumption_stock']['materials'];
        $materialOBJ = json_decode($materialJSON);
        if (property_exists($materialOBJ, $m['mixing_materials']['id'])) {
            $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
        } else {
            $valMaterial = 0;
        }
        if ($m['mixing_materials']['category_id'] == 13) {
            $totalBroughtScrap += $valMaterial;
        } elseif ($m['mixing_materials']['category_id'] == 14) {
            $totalScrap += $valMaterial;
        } else {

            $allTotalRaw = $valMaterial + $allTotalRaw;
        }
    endforeach;
endforeach;
$totalQuantity = $allTotalRaw ? $allTotalRaw : 1;

$allTotal = 0;
$totalMaterial = 0;
$allTotalRaw = 0;
foreach ($allMaterials as $m):
    foreach ($allConsumptionStocks as $c):
        $materialJSON = $c['tbl_consumption_stock']['materials'];
        $materialOBJ = json_decode($materialJSON);
        if (property_exists($materialOBJ, $m['mixing_materials']['id'])) {
            $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
        } else {
            $valMaterial = 0;
        }
        if ($m['mixing_materials']['category_id'] == 13) {
            $totalBroughtScrap += $valMaterial;
        } elseif ($m['mixing_materials']['category_id'] == 14) {
            $totalScrap += $valMaterial;
        } else {
            $totalMaterial += $valMaterial;
            $allTotalRaw = $valMaterial + $allTotalRaw;
            $valMaterial = 0;
        }
        $allTotal += $valMaterial;
    endforeach;
    echo '<tr><td>' . $m['mixing_materials']['name'] . '</td><td>' . number_format($totalMaterial, 2) . '</td><td>' . number_format($totalMaterial * 100 / $totalQuantity, 2) . '%</td></tr>';
    $totalMaterial = 0;
endforeach;
echo '<tr class="success"><td>Total </td><td>' . number_format($allTotalRaw) . '</td><td> 100%</td></tr>';
echo '<tr class="info"><td>Total Brought Scrap </td><td>' . number_format($totalBroughtScrap, 2) . '</td><td></td></tr>';
echo '<tr class="warning"><td>Total Scrap </td><td>' . number_format($totalScrap, 2) . '</td><td></td></tr>';
echo '<tr class="danger"><td>Total Materials </td><td>' . number_format($totalScrap + $totalBroughtScrap + $allTotalRaw, 2) . '</td><td></td></tr>';
echo '</table>';
//echo $allTotal;
//var_dump($allConsumptionStocks);

exit;



/*if ($this->request->is('ajax')) {

    $this->request->onlyAllow('ajax');
    $this->loadModel('ConsumptionStock');
    $this->loadModel('MixingMaterial');
    $this->loadModel('TblConsumptionStock');
    $id = $this->request->data['id'];
    $brnd = $this->request->data['type'];


    echo $id.'<br/>'.$brnd; exit;
    // $type = $this->ConsumptionStock->query("SELECT quantity,material_id, sum(quantity)*100/(select sum(quantity)
    //     FROM consumption_stock where brand='$brnd' and dimension='$id') as rawpercentage
    //     FROM consumption_stock where brand='$brnd' and dimension='$id' group by material_id order by consumption_id asc");
    // //print_r($type);
    // echo "<table class='table table-condensed'>";
    // foreach ($type as $t) {
    //     echo '<tr>';
    //     echo '<td align="left">' . $t['consumption_stock']['material_id'] . '</td>';
    //     echo '<td align="">' . $t['consumption_stock']['quantity'] . '</td>';
    //     echo '<td align="right">' . number_format($t['0']['rawpercentage']) . '%</td>';

    //     echo '</tr>';
    // }
    $total_material=$this->ConsumptionStock->query("select name from mixing_materials where category_id!=13 and category_id!=14");

    $total_sum=$this->TblConsumptionStock->query("select materials as total from tbl_consumption_stock where brand='$brnd' and dimension='$id'");
    $total = $total_sum[0][0]['total'];

    //test
    $total_input=$this->ConsumptionStock->query("SELECT  sum(quantity) as total FROM polychem.consumption_stock
    where material_id<>'Scrap Laminated' and material_id<>'Scrap Printed'
    and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and brand='$brnd' and dimension='$id'");
    foreach($total_input as $t):
        $totalinput=$t['0']['total'];
    endforeach;

    $total_scrap=$this->ConsumptionStock->query("SELECT sum(quantity) as total FROM polychem.consumption_stock where material_id='Scrap Laminated' OR material_id='Scrap Printed' OR material_id='Scrap Unprinted' OR material_id='Scrap Plain' OR material_id='Scrap CT' and brand='$brnd' and dimension='$id'");

    foreach($total_scrap as $sc):
        $totalscrap=$sc['0']['total'];
    endforeach;

    $bought_scrap=$this->ConsumptionStock->query("SELECT sum(quantity) as total FROM polychem.consumption_stock where material_id='Bought Scrap' and brand='$brnd' and dimension='$id'");

    foreach($bought_scrap as $bs):
        $totalboughtscrap=$bs['0']['total'];
    endforeach;
    $input = $totalinput+$totalscrap;


    //end test

   //print'<pre>';print_r($total_material);print'</pre>';die;
  //  echo $total_material[0]['consumption_stock']['material_id'];die;
    echo '<table>';
    foreach($total_material as $m):

        $material=$m['consumption_stock']['material_id'];
        $type=$this->ConsumptionStock->query("select sum(quantity) as indi_sum,material_id from consumption_stock where brand='$brnd' and
        dimension='$id' and material_id='$material'");
        $indi_sum = $type[0][0]['indi_sum'];
        //$material = $type[0][0]['material_id'];
        //print'<pre>';print_r($type);print'</pre>';die;

        echo '<tr>';
        echo '<td style="width:50%">' . $material . '</td>';
        echo '<td style="width:25%">' . number_format($type[0][0]['indi_sum']) . '</td>';
        echo '<td style="width:25%">' . number_format(($indi_sum*100)/$total,2). '%</td>';
        echo '</tr>';


    endforeach;

    echo "</table>";
    */
?><!--
            <table class="table">
                <tr><strong>
                    <td><strong>Total</strong></td>
                    <td align="left" style="width:25%"><strong>
                    <? /*=number_format($total,2)*/ ?></strong>
                    </td></strong>
                </tr>

                <tr><strong>
                    <td><strong>Total Scrap</strong></td>
                    <td align="left" style="width:25%"><strong>
                    <? /*=number_format($totalscrap,2)*/ ?></strong>
                    </td></strong>
                </tr>

                <tr><strong>
                    <td><strong>Bought Scrap</strong></td>
                    <td align="left" style="width:50%"><strong>
                    <? /*=number_format($totalboughtscrap,2)*/ ?></strong>
                    </td></strong>
                </tr>
                <tr><strong>
                    <td><strong>Total Input</strong></td>
                    <td align="left" style="width:50%"><strong>
                    
                    <? /*=number_format($input,2)*/ ?></strong>
                    </td></strong>
                </tr>

                

            </table> 
            <br/>

            <!-- <button class="btn btn-success" onclick="todate_pdf(' .$id.')">Download CSV file</button> -->
--><?php /*
            exit;
                // echo $this->Html->link('Download CSV file',array('controller'=>'pages','action'=>'export_consumption'), 
                //     array('target'=>'_blank','class'=>'btn btn-success'));
        }*/

}




public function time_elapsed($secs)
{
    if (isset($secs)):
        $bit = [
            'Years' => $secs / 31556926 % 12,
            'Weeks' => $secs / 604800 % 52,
            'Days' => $secs / 86400 % 7,
            'Hours' => $secs / 3600 % 24,
            'Minutes' => $secs / 60 % 60,
            'seconds' => $secs % 60
        ];
        foreach ($bit as $k => $v)
            if ($v > 0) {
                $ret[] = $v . ' ' . $k;
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


public function notification()
{
    $this->loadModel('ConsumptionStock');
    $count = $this->ConsumptionStock->query("select DISTINCT(count(nepalidate)) as count from consumption_stock where inserted=0");
    $this->set('ct', $count);
}



//export to csv: monthly report
function export()
{
    $month = isset($_GET['Month'])?$_GET['Month']:'06';
    $this->loadModel('MixingMaterial');
    $this->loadModel('CategoryMaterial');
    $this->loadModel('TblConsumptionStock');
    $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC ");
    $lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock order by nepalidate DESC limit 1")[0]['tbl_consumption_stock']['nepalidate'];
    $month = '%' . substr($lastDate, 0, 4) . '-' . $month . '%';

    $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where nepalidate like '$month'");

    $totalBroughtScrap = 0;
    $totalScrap = 0;

    $allTotal = 0;
    $totalMaterial = 0;
    $allTotalRaw = 0;

    foreach ($allMaterials as $m):
        foreach ($allConsumptionStocks as $c):
            $materialJSON = $c['tbl_consumption_stock']['materials'];
            $materialOBJ = json_decode($materialJSON);
            if (property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
            } else {
                $valMaterial = 0;
            }
            if ($m['mixing_materials']['category_id'] == 13) {
                $totalBroughtScrap += $valMaterial;
            } elseif ($m['mixing_materials']['category_id'] == 14) {
                $totalScrap += $valMaterial;
            } else {

                $allTotalRaw = $valMaterial + $allTotalRaw;
            }
        endforeach;
    endforeach;
    $totalQuantity = $allTotalRaw ? $allTotalRaw : 1;

    $allTotal = 0;
    $totalMaterial = 0;
    $allTotalRaw = 0;
    foreach ($allMaterials as $m):
        foreach ($allConsumptionStocks as $c):
            $materialJSON = $c['tbl_consumption_stock']['materials'];
            $materialOBJ = json_decode($materialJSON);
            if (property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
            } else {
                $valMaterial = 0;
            }
            if ($m['mixing_materials']['category_id'] == 13) {
                $totalBroughtScrap += $valMaterial;
            } elseif ($m['mixing_materials']['category_id'] == 14) {
                $totalScrap += $valMaterial;
            } else {
                $totalMaterial += $valMaterial;
                $allTotalRaw = $valMaterial + $allTotalRaw;
                $valMaterial = 0;
            }
            $allTotal += $valMaterial;
        endforeach;
        $totalMaterialArray[] =$totalMaterial;
        $totalMaterialPercentageArray[] = number_format(($totalMaterial*100)/$totalQuantity, 2);
        $totalMaterial = 0;
    endforeach;
    foreach($allMaterials as $m):
        $mixingMaterials[] = $m['mixing_materials']['name'];
    endforeach;
    $this->set('mixingMaterials', $mixingMaterials);
    $this->set('totalMaterialArray', $totalMaterialArray);
    $this->set('totalMaterialPercentageArray', $totalMaterialPercentageArray);
    $this->set('totalScrap', $totalMaterial);
    $this->set('totalBroughtScrap', $totalBroughtScrap);


    $this->layout = null;

    $this->autoLayout = false;
    Configure::write('debug', '2');

}




//export to csv: to date consumption
function export_consumption()
{
    $brand = isset($_GET['brand'])?$_GET['brand']:'Calio';
    $dim = isset($_GET['dimension'])?$_GET['dimension']:'0.05 x 2150';
        
        $this->loadModel('TblConsumptionStock');
        $this->loadModel('MixingMaterial');
        $this->loadModel('CategoryMaterial');
        $allMaterials = $this->MixingMaterial->query("SELECT * from mixing_materials order BY category_id ASC,name ASC");
        // $lastDate = $this->TblConsumptionStock->query("SELECT distinct(nepalidate) from tbl_consumption_stock");
        $allConsumptionStocks = $this->TblConsumptionStock->query("SELECT * from tbl_consumption_stock where dimension='$dim' and brand='$brand'");
       
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
        $totalMaterialArray[] =$totalMaterial;
        $totalMaterialPercentageArray[] = number_format(($totalMaterial*100)/$totalQuantity, 2);
        $totalMaterial = 0;
    endforeach;
    foreach($allMaterials as $m):
        $mixingMaterials[] = $m['mixing_materials']['name'];
    endforeach;
    $this->set('mixingMaterials', $mixingMaterials);
    //echo'<pre>';print_r($totalMaterialArray);die;
    $this->set('totalMaterialArray', $totalMaterialArray);
    $this->set('totalMaterialPercentageArray', $totalMaterialPercentageArray);
    $this->set('totalScrap', $totalMaterial);
    $this->set('totalBroughtScrap', $totalBroughtScrap);


    $this->layout = null;

    $this->autoLayout = false;
    Configure::write('debug', '2');

}

public function perhouroutput()
{
    $this->loadModel('ConsumptionStock');

    $yrmnth = $this->ConsumptionStock->query("select nepalidate from consumption_stock order by consumption_id DESC LIMIT 1");
    foreach ($yrmnth as $d):
        $datacount = $d['consumption_stock']['nepalidate'];
        list($yrcount, $mnthcount, $ddate) = explode("-", $datacount);
    endforeach;


    $count_yr = $this->ConsumptionStock->query("select count(distinct nepalidate) as year from tbl_consumption_stock where nepalidate like '$yrcount-%'");
    $count_mnth = $this->ConsumptionStock->query("select count(distinct nepalidate) as month from tbl_consumption_stock where nepalidate like '$yrcount-$mnthcount-%'");

    $this->set('year1', $count_yr);
    $this->set('month1', $count_mnth);
    // print_r($count_mnth);die;
    // $this->set('latestyear', $yrcount);
    // $this->set('latestmonth', $mnthcount);
    // $this->set('latestdate', $ddate);


}

public function output()
{

    $this->loadModel('CalenderScrap');
    $this->loadModel('ConsumptionStock');
    $date = $this->CalenderScrap->query("select date from calender_scrap order by id desc limit 1");
    //print_r($date);die;

    // foreach ($date as $d):
    //     $date = $d['calender_scrap']['date'];
    // endforeach;

    $datacount = $date[0]['calender_scrap']['date'];

    list($year, $month, $day) = explode("-", $datacount);
    $scrap_month = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s from calender_scrap where date like '%-$month-%'");
    $this->set('scrap_month', $scrap_month);

    $scrap_year = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s from calender_scrap where date like '$year-%'");
    $this->set('scrap_year', $scrap_year);


    $totalinput_month = $this->ConsumptionStock->query("select sum(quantity) as tot  from consumption_stock where nepalidate like '%-$month-%'");
    $this->set('totalinput_month', $totalinput_month);

    $totalinput_year = $this->ConsumptionStock->query("select sum(quantity) as tot  from consumption_stock where nepalidate like '$year-%'");
    $this->set('totalinput_year', $totalinput_year);

}

function per_working_hour()
{
    $this->loadModel('TimeLoss');

    $current_date = $this->TimeLoss->query("select nepalidate from time_loss order by nepalidate DESC limit 1");
    $nepdate = $current_date[0]['time_loss']['nepalidate'];
//Average working hour for today
    $loss_hour_today_query = $this->TimeLoss->query("select sum(totalloss_sec) as total_sec from time_loss where nepalidate='$nepdate' and type='LossHour'");
    //$loss_hour_today = $work_hour_today[0][0]['total_sec'];

    $break_hour_today_query = $this->TimeLoss->query("select sum(totalloss_sec) as total_sec from time_loss where nepalidate='$nepdate' and type='BreakDown'");
    $break_hour_today = $break_hour_today_query[0][0]['total_sec'];
//end of Average working hour for today

    list($year, $month, $day) = explode("-", $nepdate);

    $working_today = $this->TimeLoss->query("select sum(totalloss_sec) as today_sec from time_loss where nepalidate='$nepdate'");

    $this->set('working_today', $working_today);

    $working_month = $this->TimeLoss->query("select sum(totalloss_sec) as month_sec from time_loss where nepalidate like '%-$month-%'");
    $this->set('working_month', $working_month);

    $working_year = $this->TimeLoss->query("select sum(totalloss_sec) as year_sec from time_loss where nepalidate like '$year-%'");
    $this->set('working_year', $working_year);


}

public function dash_values()
{
    $this->loadModel('TblConsumptionStock');
    $this->loadModel('MixingMaterial');
    $latest_date = $this->TblConsumptionStock->query("select nepalidate from tbl_consumption_stock order by nepalidate desc limit 13");

    $latest_date = $latest_date[0]['tbl_consumption_stock']['nepalidate'];
    //echo $latest_date;die;
    list($y, $mo, $d) = explode("-", $latest_date);
    $latest_month = $y . '-' . $mo;
    $latest_year = $y;

//Latest date, month and year of operation

    $this->set('latest_date', $latest_date);
    $this->set('latest_month', $latest_month);
    $this->set('latest_year', $latest_year);


// End: Latest date, month and year of operation


//Mixing and Calendar Dashboard: Number of days operated
    $operated_in_year = $this->TblConsumptionStock->query("select count(distinct(nepalidate)) as operated_in_year from
            tbl_consumption_stock where nepalidate like '$y-%'");
    $operated_in_month = $this->TblConsumptionStock->query("select count(distinct(nepalidate)) as operated_in_month from
            tbl_consumption_stock where nepalidate like '$y-$mo-%'");


    $this->set('operated_in_year', $operated_in_year);
    $this->set('operated_in_month', $operated_in_month);
//End: Mixing: number of days operated

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~TOTAL OF RAW MATERIALS~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of raw materials: Yearly
    $material_one = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id!=13 and category_id!=14");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_one as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];

        endforeach;
    endforeach;


    $this->set('raw_materials_y', $total);

//End: Sum of raw materials

//Sum of raw materials: Monthly
    $material_one_m = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-$mo-%' ");

    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id!=13 and category_id!=14");
    $total_m = 0;
    foreach ($mix_id as $m):
        foreach ($material_one_m as $mm):
            $materials = json_decode($mm['tbl_consumption_stock']['materials']);
            $total_m += $materials->$m['mixing_materials']['id'];

        endforeach;
    endforeach;


    $this->set('raw_materials_m', $total_m);

//End: Sum of raw materials


//Sum of raw materials: Daily
    $material_one_d = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date'");
    //  print_r($material_one_d);die;
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id!=13 and category_id!=14");
    $total_d = 0;
    foreach ($mix_id as $m):
        foreach ($material_one_d as $md):
            $materials = json_decode($md['tbl_consumption_stock']['materials']);
            $total_d += $materials->$m['mixing_materials']['id'];

        endforeach;
    endforeach;


    $this->set('raw_materials_d', $total_d);

//End: Sum of raw materials


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~BOUGHT SCRAP~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of bought scrap: Yearly
    $material_bought = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=13");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_bought as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('bought_scrap_y', $total);

//End: Sum of bought scrap

//Sum of bought scrap: Monthly
    $material_bought_m = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-$mo%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=13");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_bought_m as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('bought_scrap_m', $total);

//End: Sum of bought scrap

//Sum of bought scrap: Today
    $material_bought_d = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=13");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_bought_d as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('bought_scrap_d', $total);

//End: Sum of bought scrap

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~SCRAP~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of scrap: Yearly
    $material_scrap = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=14");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_scrap as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('scrap_y', $total);

//End: Sum of scrap

//Sum of bought scrap: Monthly
    $material_scrap_m = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-$mo%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=14");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_scrap_m as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('scrap_m', $total);

//End: Sum of scrap

//Sum of scrap: Today
    $material_scrap_d = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id=14");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_scrap_d as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;

    //echo $total;die;
    $this->set('scrap_d', $total);

//End: Sum of scrap


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~TOTAL of all materials~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of total: Yearly
    $material_total = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_total as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('total_y', $total);

//End: Sum of total

//Sum of total: Monthly
    $material_total_m = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate like '$y-$mo%' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_total_m as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('total_m', $total);

//End: Sum of total

//Sum of total: Today
    $material_total_d = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date' ");
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials");
    $total = 0;
    foreach ($mix_id as $m):
        foreach ($material_total_d as $ma):
            $materials = json_decode($ma['tbl_consumption_stock']['materials']);
            $total += $materials->$m['mixing_materials']['id'];
        endforeach;
    endforeach;


    $this->set('total_d', $total);

//End: Sum of total


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LENGTH ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of LENGTH: Yearly
    $length_y = $this->TblConsumptionStock->query("select sum(length) as total_length from tbl_consumption_stock where nepalidate like '$y-%' ");
    $length_total_y = $length_y[0][0]['total_length'];
    $this->set('length_y', $length_total_y);

//End: Sum of length

//Sum of length: Monthly
    $length_m = $this->TblConsumptionStock->query("select sum(length) as total_length from tbl_consumption_stock where nepalidate like '$y-$mo%' ");
    $length_total_m = $length_m[0][0]['total_length'];
    $this->set('length_m', $length_total_m);

//End: Sum of length

//Sum of length: Today

    $length_d = $this->TblConsumptionStock->query("select sum(length) as total_length from tbl_consumption_stock where nepalidate='$latest_date'");
    $length_total_d = $length_d[0][0]['total_length'];
    $this->set('length_d', $length_total_d);
//End: Sum of length


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Total NTWT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of NTWT: Yearly
    $net_y = $this->TblConsumptionStock->query("select sum(ntwt) as total_ntwt from tbl_consumption_stock where nepalidate like '$y-%' ");
    $net_total_y = $net_y[0][0]['total_ntwt'];
    $this->set('net_y', $net_total_y);

//End: Sum of NTWT

//Sum of NTWT: Monthly
    $net_m = $this->TblConsumptionStock->query("select sum(ntwt) as total_ntwt from tbl_consumption_stock where nepalidate like '$y-$mo%' ");
    $net_total_m = $net_m[0][0]['total_ntwt'];
    $this->set('net_m', $net_total_m);


//End: Sum of NTWT

//Sum of NTWT: Today

    $net_d = $this->TblConsumptionStock->query("select sum(ntwt) as total_ntwt from tbl_consumption_stock where nepalidate='$latest_date'");
    $net_total_d = $net_d[0][0]['total_ntwt'];
    $this->set('net_d', $net_total_d);
//End: Sum of NTWT


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ TOTAL SCRAP FROM SCRAP TABLE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//Sum of NTWT: Yearly
    $this->loadModel('CalenderScrap');
    $scrap_total_y = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s_y from calender_scrap where date like '$y-%'");
    $scrap_total = $scrap_total_y[0][0]['total_s_y'];
    //echo '<pre>';print_r($scrap_total_y);die;
    $this->set('scrap_total_y', $scrap_total);

//End: Sum of NTWT

//Sum of total scrap: Monthly
    $scrap_total_m = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s_m from calender_scrap where date like '$y-$mo%'");
    $scrap_total = $scrap_total_m[0][0]['total_s_m'];
    $this->set('scrap_total_m', $scrap_total);


//End: Sum of total scrap

//Sum of total scrap: Today

    $scrap_total_d = $this->CalenderScrap->query("SELECT sum(resuable+lamps_plates)  as total_s_d from calender_scrap where date='$latest_date'");
    $scrap_total = $scrap_total_d[0][0]['total_s_d'];

    $this->set('scrap_total_d', $scrap_total);
//End: Sum of total scrap


//SEMI FINISHED GOODS table

    $this->loadModel('DimensionTarget');
    $this->loadModel('BaseEmboss');
    $q_dim_list = $this->BaseEmboss->query("select distinct(dimension) from baseemboss order by dimension asc");

    $this->set('dim_list', $q_dim_list);
    //print'<pre>';print_r($q_dim_list);print'</pre>';die;
    //print'<pre>';print_r($q_dim_list);print'</pre>';die;
    $i = 0;
    foreach ($q_dim_list as $dim_list):


        $dimen = $dim_list['baseemboss']['dimension'];


        //print'<pre>';echo $dimen;print'</pre>';die;
//year
        $q_dim_yearly = $this->TblConsumptionStock->query("select sum(length) as total_length_year from tbl_consumption_stock where nepalidate like '$y%' and
                                                           Dimension='$dimen'");

        //print'<pre>';print_r($q_dim_yearly);print'</pre>';die;

        if (!$q_dim_yearly[0][0]['total_length_year'])
            $dim_yearly[$i] = '0';
        else
            $dim_yearly[$i] = $q_dim_yearly[0][0]['total_length_year'];

//month
        $q_dim_monthly = $this->TblConsumptionStock->query("select sum(length) as total_length_month from tbl_consumption_stock where nepalidate like '$y-$mo-%' and
                                                           Dimension='$dimen' order by Dimension asc");
        //print'<pre>';print_r($q_dim_yearly);print'</pre>';die;
        if (!$q_dim_monthly[0][0]['total_length_month'])
            $dim_monthly[$i] = '0';
        else
            $dim_monthly[$i] = $q_dim_monthly[0][0]['total_length_month'];
//day
        $q_dim_daily = $this->TblConsumptionStock->query("select sum(length) as total_length_day from tbl_consumption_stock where nepalidate='$latest_date' and
                                                           Dimension='$dimen' order by Dimension asc");
        //print'<pre>';print_r($q_dim_yearly);print'</pre>';die;
        if (!$q_dim_daily[0][0]['total_length_day'])
            $dim_daily[$i] = '0';
        else
            $dim_daily[$i] = $q_dim_daily[0][0]['total_length_day'];
        //$q_dim_monthly = $this->CalenderCpr->query();

        $i++;
    endforeach;


    //print'<pre>';print_r($dim_daily);print'</pre>';die;

    $this->set('dim_yearly', $dim_yearly);
    $this->set('dim_monthly', $dim_monthly);
    $this->set('dim_daily', $dim_daily);


//BREAK DOWN REASONS
    $this->loadModel('TimeLoss');
    $total_breakdown = $this->TimeLoss->query("select count(reasons) as reason_quantity, reasons from time_loss where department_id='calender' and type='BreakDown'");
    //print_r($total_breakdown);die;
    $total_reasons = $total_breakdown[0][0]['reason_quantity'];
    //echo $total_reasons;die;
    $i = 0;
    foreach ($total_breakdown as $t_bd):
        $reason = $total_breakdown[$i]['time_loss']['reasons'];

        $distinct_breakdown = $this->TimeLoss->query("select distinct reasons, count(reasons) as indi_reason_quantity from time_loss where department_id='calender' and type='BreakDown' and reasons='$reason'");

        $one_reason[$i] = $distinct_breakdown[$i][0]['indi_reason_quantity'];
        $percent[$i] = $one_reason[$i] * 100 / $total_reasons;

        $i++;
    endforeach;
    //echo '<pre>';print_r($percent);die;
    $this->set('distinct_breakdown', $distinct_breakdown);
    //echo '<pre>';print_r($distinct_breakdown);die;

// END OF BREAK DOWN REASONS

//TARGET FOR DIMENSIONS
    $this->loadModel('DimensionTarget');
    $dim_tar = $this->DimensionTarget->query("select distinct(dimension), target from dimension_target order by dimension asc");
    //echo'<pre>';print_r($dim_tar);die;
    $this->set('dim_tar', $dim_tar);

//EBD: TARGET FOR DIMENSIONS

}


public function monthly_report()
{
    ob_end_clean();
    //$d= array("orange", "banana");
    $d = array();
    $startday = "01";
    $endday = "32";
    $getmonth = $_POST['id'];
    $this->loadModel('TblConsumptionStock');
    $date = $this->TblConsumptionStock->query("select nepalidate from tbl_consumption_stock order by nepalidate desc limit 1");
    foreach ($date as $n):
        $nepdte = $n['tbl_consumption_stock']['nepalidate'];
    endforeach;
    $nepdate = explode('-', $nepdte);
    $year = $nepdate[0];


    //$startmonth = $year . "-" . $getmonth . "-" . $startday;
    $startmonth = $year . "-06-" . $startday;
    $endmonth = $year . "-06-" . $endday;
    //echo $startmonth;die;
    //$endmonth = $year . "-" . $getmonth . "-" . $endday;
    //echo $startmonth;
    //echo $endmonth;
    $this->set('date1', $endmonth);
    $users = $this->User->find('all');
    $this->set(compact('users'));
    $this->loadModel('TblConsumptionStock');

    //$raws=$this->ConsumptionStock->query("SELECT material_id,sum(quantity) as sum from consumption_stock where material_id!='Scrap Unprinted' and material_id !='Scrap Laminated' and material_id !='Scrap Printed' and material_id !='Scrap Plain' and material_id!='Scrap CT' and date BETWEEN '$startmonth' and '$endmonth' group by material_id order by consumption_id");
    $material_one_d = $this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate between '$startmonth' and '$endmonth'");
    //echo '<pre>';print_r($material_one_d);die;
    // $material_one_d=$this->TblConsumptionStock->query("select materials from tbl_consumption_stock where nepalidate='$latest_date'");
    //print_r($material_one_d);die;
    $mix_id = $this->MixingMaterial->query("select id from mixing_materials where category_id!=13 and category_id!=14");
    //echo '<pre>';print_r($mix_id);die;
    $total_raw = 0;
    foreach ($mix_id as $m):
        foreach ($material_one_d as $md):
            $materials = json_decode($md['tbl_consumption_stock']['materials']);
            //echo '<pre>';print_r($materials);die;
            //echo '<pre>';print_r($materials->$m['mixing_materials']['id']);die;

            $total_raw += $materials->$m['mixing_materials']['id'];

        endforeach;
    endforeach;
    //echo '<pre>';print_r($total_raw);die;


    $mix_id = $this->MixingMaterial->query("select id,name from mixing_materials where category_id!=13 and category_id!=14");
    $i = 0;
    foreach ($mix_id as $m):
        foreach ($material_one_d as $md):
            $materials = json_decode($md['tbl_consumption_stock']['materials']);
            foreach ($materials as $mate):
                $total_raw_indi[$i] = $mate->$m['mixing_materials']['id'];
                $i++;

            endforeach;



        endforeach;
        //echo '<pre>';print_r($total_raw_indi);die;
    endforeach;


    $this->set('raw_materials_d', $total_raw);
//echo'<pre>';print_r($raws)die;


    $total = $this->ConsumptionStock->query("SELECT  sum(quantity) as total FROM polychem.consumption_stock
where material_id<>'Bought Scrap' and material_id<>'Scrap Laminated' and material_id<>'Scrap Printed'
and material_id<>'Scrap Unprinted' and material_id<>'Scrap Plain' and material_id<>'Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth'");
    foreach ($total as $t):
        $totalinput = $t['0']['total'];
    endforeach;

    $scrap = $this->ConsumptionStock->query("SELECT sum(quantity) as total FROM polychem.consumption_stock where material_id='Bought Scrap' OR material_id='Scrap Laminated' OR material_id='Scrap Printed' OR material_id='Scrap Unprinted' OR material_id='Scrap Plain' OR material_id='Scrap CT' and nepalidate BETWEEN '$startmonth' and '$endmonth' ");

    foreach ($scrap as $sc):
        $totalscrap = $sc['0']['total'];
    endforeach;

    echo "<table>";
    foreach ($raws as $r):
        echo "<tr>";
        echo "<td align='left'>" . $r['consumption_stock']['material_id'] . "</td>";
        echo "<td align='right'>&nbsp;&nbsp;" . number_format($r['0']['total'], 2) . "</td>";
        echo "<td align='right'>&nbsp;&nbsp;&nbsp;" . number_format($r['0']['rawpercentage'], 2) . "%</td>";

        echo "</tr>";
    endforeach;
    if (empty($raws)) {
        echo "<tr>";
        echo "<td><strong>Total</strong></td>";
        echo "<td align='right'>" . number_format(0, 2) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Total Scrap</strong></td>";
        echo "<td align='right'>" . number_format(0, 2) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Total Input</strong></td>";
        echo "<td align='right'>" . number_format(0, 2) . "</td>";
        echo "</tr>";

        echo "</table>";
    } else {
        echo "<tr>";
        echo "<td><strong>Total</strong></td>";
        echo "<td align='right'>" . number_format($totalinput, 2) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Total Scrap</strong></td>";
        echo "<td align='right'>" . number_format($totalscrap, 2) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Total Input</strong></td>";
        echo "<td align='right'>" . number_format($totalinput + $totalscrap, 2) . "</td>";
        echo "</tr>";

        echo "</table>";
    }
}


}







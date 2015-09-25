<?php
App::uses('AppController', 'Controller');

class PrintingShiftreportsController extends AppController
{

    public $components = array('Paginator');
    var $date;
    public function index()
    {
        $date = 0;
        $this->PrintingShiftreport->recursive = 0;
        $this->set('printingShiftreports', $this->Paginator->paginate());
        $this->Filter->addFilters(
            array(
                'filter1' => array(
                    'PrintingShiftreport.date' => array(
                        'operator' => 'LIKE',
                        'value' => array(
                            'before' => '%', // optional
                            'after' => '%'  // optional
                        )
                    )
                )
            )
        );
        $this->Filter->setPaginate('order', 'PrintingShiftreport.date ASC'); // optional
        $this->Filter->setPaginate('limit', 60);              // optional
        $this->Filter->setPaginate('conditions', $this->Filter->getConditions());
        $this->set('printingShiftreports', $this->paginate());
       // $date1;
        if (isset($this->request->data['filter']['filter1'])) {
            $date1 = $this->request->data['filter']['filter1'];
        }
        if (isset($date1) == 0) {
            $tot = $this->PrintingShiftreport->query("select sum(input) as totalinput,sum(output) as totaloutput,sum(unprinted_scrap) as totalu ,sum(printed_scrap) as totals from printing_shiftreport");
            $this->set('total', $tot);
        } else {
            $tot = $this->PrintingShiftreport->query("select sum(input) as totalinput,sum(output) as totaloutput,sum(unprinted_scrap) as totalu ,sum(printed_scrap) as totals from printing_shiftreport where date='$date1'");
            $this->set('total', $tot);
        }
    }
    public function view($id = null)
    {
        if (!$this->PrintingShiftreport->exists($id)) {
            throw new NotFoundException(__('Invalid printing shiftreport'));
        }
        $options = array('conditions' => array('PrintingShiftreport.' . $this->PrintingShiftreport->primaryKey => $id));
        $this->set('printingShiftreport', $this->PrintingShiftreport->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        $this->dimension();
        if ($this->request->is('post')) {
            $this->PrintingShiftreport->create();
            echo '<pre>';

            if ($this->PrintingShiftreport->save($this->request->data)) {
                $this->Session->setFlash(__('The printing shiftreport has been saved.'), array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The printing shiftreport could not be saved. Please, try again.'), array('class' => 'alert alert-danger'));
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
        $this->dimension();

        $all=$this->PrintingShiftreport->query("select * from printing_shiftreport where id=$id");
        $this->set('alldata',$all);

        $dimension=$this->PrintingShiftreport->query("select dimension from  printing_shiftreport where id=$id");
        $dmn= $dimension['0']['printing_shiftreport']['dimension'];

        $color_code=$this->PrintingShiftreport->query("select PF_Color from  printing_shiftreport where id=$id");
        $cl_code=$color_code['0']['printing_shiftreport']['PF_Color'];

         $this->loadModel('PrintingDatum');

         $tpe = $this->PrintingDatum->find('list',array('fields'=>array('color','color'),'order'=>array('id asc'),
             'conditions' => array('dimension' => $dmn)));
        $this->set('pfcolor',$tpe);


          $colorcode = $this->PrintingDatum->find('list',array('fields'=>array('color_code','color_code'),'order'=>array('id asc'),
              'conditions' => array('dimension' => $dmn,'color'=>$cl_code)));
                 $this->set('typo',$colorcode);


        if (!$this->PrintingShiftreport->exists($id)) {
            throw new NotFoundException(__('Invalid printing shiftreport'));
        }

        $this->set('PrintingShiftreports', $this->PrintingShiftreport->query("SELECT * FROM printing_shiftreport where id=$id"));


        if ($this->request->is(array('post', 'put'))) {
            if ($this->PrintingShiftreport->save($this->request->data)) {
                $this->Session->setFlash(__('The printing shiftreport has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The printing shiftreport could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PrintingShiftreport.' . $this->PrintingShiftreport->primaryKey => $id));
            $this->request->data = $this->PrintingShiftreport->find('first', $options);
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
        $this->PrintingShiftreport->id = $id;
        if (!$this->PrintingShiftreport->exists()) {
            throw new NotFoundException(__('Invalid printing shiftreport'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PrintingShiftreport->delete()) {
            $this->Session->setFlash(__('The printing shiftreport has been deleted.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('The printing shiftreport could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function dimension()
    {
        $this->loadModel('PrintingDatum');
        $this->loadModel('LaminatingReason');
        $dim = $this->PrintingDatum->find('list', array('fields' => array('dimension', 'dimension')));
        //print_r($dim);
        $this->set('dimension', $dim);
        $unprinted = $this->LaminatingReason->find('list', array('fields' => array('reason', 'reason'), 'order' => array('LaminatingReason.reason' => 'ASC'), 'conditions' => array('type' => 'Unprinted')));

        $printed = $this->LaminatingReason->find('list', array('fields' => array('reason', 'reason'), 'order' => array('LaminatingReason.reason' => 'ASC'), 'conditions' => array('type' => 'Printed')));
        $this->set('unprinted', $unprinted);
        $this->set('printed', $printed);

    }

    public function pfcolor()
    {
        {
            if ($this->request->is('ajax')) {

                $this->request->onlyAllow('ajax');
                $this->loadModel('PrintingDatum');
                $d = $this->request->data['id'];
                $type = $this->PrintingDatum->query("select distinct(color) from printing_data where dimension='$d' order by color asc");
                echo '<option value="null">Please select</option>';
                foreach ($type as $t):

                    echo '<option value="' . $t['printing_data']['color'] . '">' . $t['printing_data']['color'] . '</option>';

                endforeach;


            } else {
                $this->loadModel('PrintingDatum');
                // $d=$this->request->data['id'];
                $type = $this->PrintingDatum->find('list', array('fields' => array('color', 'color')));
                $this->set('color1', $type);
                $type1 = $this->PrintingDatum->find('list', array('fields' => array('color_code', 'color_code')));
                $this->set('colorcode', $type1);

            }

        }
    }

    public function basecolor()
    {
        if ($this->request->is('ajax')) {

            $this->request->onlyAllow('ajax');
            $this->loadModel('PrintingDatum');
            $d = $this->request->data['id'];
            $c = $this->request->data['type'];
            $type = $this->PrintingDatum->query("select distinct(color_code) from printing_data where dimension='$d' and color='$c' order by color_code asc");
            echo '<option value="null">Please select</option>';
            foreach ($type as $t):

                echo '<option value="' . $t['printing_data']['color_code'] . '">' . $t['printing_data']['color_code'] . '</option>';

            endforeach;


        }
    }

    public function total($date)
    {

        if (isset($date)) {

            $tot = $this->PrintingShiftreport->query("select sum(input) as totalinput,sum(output) as totaloutput,sum(unprinted_scrap) as totalu ,sum(printed_scrap) as totals from printing_shiftreport where date='$date'");
            $this->set('total', $tot);
        } else {
            $dat = date('d-m-Y');
            $tot = $this->PrintingShiftreport->query("select sum(input) as totalinput,sum(output) as totaloutput,sum(unprinted_scrap) as totalu ,sum(printed_scrap) as totals from printing_shiftreport where date='$dat'");
            $this->set('total', $tot);
        }
    }

    public function create_printingpdf()
    {
        $this->request->onlyAllow('ajax');

        $date = $_POST['city_id'];
        $this->set('today1', $date);
        $values = $this->PrintingShiftreport->query("select *from printing_shiftreport where date='$date'" );
        $this->set('print', $values);
        $totaltoday = $this->PrintingShiftreport->query("select shift, sum(input) as totalinput,sum(output) as totaloutput,sum(printed_scrap)as pscrap,sum(unprinted_scrap) as uscrap from printing_shiftreport where date='$date' group by shift");
        $this->set('today', $totaltoday);
		$grandtoday = $this->PrintingShiftreport->query("select  sum(input) as gtotalinput,sum(output) as gtotaloutput,sum(printed_scrap)as gpscrap,sum(unprinted_scrap) as guscrap from printing_shiftreport where date='$date'");
        $this->set('grandtoday', $grandtoday);
        $this->loadModel('TimeLoss');
        $time = $this->TimeLoss->query("select * from time_loss where nepalidate='$date' and department_id='printing'");
        $this->set('tl', $time);

        $dt = explode('-', $date);
        $yr = $dt[0];
        $m = $dt[1];
        $d = $dt[2];
        $startm = $yr . '-' . $m . '-' . '01';
        $starty = $yr . '-' . '01' . '-' . '01';
        $tomonth = $this->PrintingShiftreport->query("SELECT sum(input) as monthinput,sum(output) as monthoutput from printing_shiftreport where date between '$startm' and '$date'");
        $this->set('toMbs', $tomonth);


        $dashsrw = $this->PrintingShiftreport->query("SELECT sum(input) as yearinput,sum(output) as yearoutput from printing_shiftreport where date between '$starty' and  '$date'");
        $this->set('year', $dashsrw);


        $this->layout = '/pdf/default';

        $this->render('/pdf/printing_shift_report');


    }

    public function download_pdf()
    {

        $this->viewClass = 'Media';
        //$name="Consumption Report for $date('d-m-Y')";
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
        $this->create_pdf();

    }


}

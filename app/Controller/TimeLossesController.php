<?php
App::uses('AppController', 'Controller');

/**
 * TimeLosses Controller
 *
 * @property TimeLoss $TimeLoss
 * @property PaginatorComponent $Paginator
 */
class TimeLossesController extends AppController
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
        //$this->TimeLoss->recursive = 0;
        //$this->set('timeLosses', $this->Paginator->paginate());
        $this->Filter->addFilters(
            array(
                'filter1' => array(
                    'TimeLoss.nepalidate' => array(
                        'operator' => 'LIKE',
                        'value' => array(
                            'before' => '%', // optional
                            'after' => '%'  // optional
                        )
                    )
                )
            )
        );
        $date = 0;
        $dept = AuthComponent::user('role');
        
        if (isset($this->request->data['filter']['filter1'])) {
            $date = $this->request->data['filter']['filter1'];
        }


        if ($date != 0) {

            $sql = $this->TimeLoss->query("SELECT sum(totalloss_sec) as total FROM time_loss where nepalidate='$date' and department_id='$dept'");
            $totalloss = $this->time_elapsed($sql[0][0]['total']);
            $this->set('losses', $totalloss);
        } else {
            $ql = $this->TimeLoss->query("SELECT sum(totalloss_sec) as total FROM time_loss where department_id='$dept'");
            $totalloss = $this->time_elapsed($ql[0][0]['total']);
            $this->set('losses', $totalloss);
        }


        $this->Filter->setPaginate('order', 'TimeLoss.date ASC'); // optional
        $this->Filter->setPaginate('limit', 20);              // optional

        // Define conditions
        $this->Filter->setPaginate('conditions', $this->Filter->getConditions());

        $this->User->recursive = 0;
        //$date=date('d-m-Y');
        $data = $this->Paginator->paginate('TimeLoss', array('TimeLoss.department_id' => AuthComponent::user('role')));
        $this->set('timeLosses', $data);

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
        if (!$this->TimeLoss->exists($id)) {
            throw new NotFoundException(__('Invalid time loss'));
        }
        $options = array('conditions' => array('TimeLoss.' . $this->TimeLoss->primaryKey => $id));
        $this->set('timeLoss', $this->TimeLoss->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->TimeLoss->create();
            if ($this->TimeLoss->save($this->request->data)) {
                //return $this->flash(__('The time loss has been saved.'), array('action' => 'index'));
                return $this->redirect(array('action' => 'index/sort:nepalidate/direction:desc'));
            }
            //return $this->redirect(array('action' => 'index'));
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
        $this->loadModel('TimelossReason');

        $department = $this->TimelossReason->query("select department_id from time_loss where id=$id");
        $dept = $department['0']['time_loss']['department_id'];

        $wtype = $this->TimelossReason->query("select type from time_loss where id=$id");
        $tp = $wtype['0']['time_loss']['type'];


        $ttype = $this->TimelossReason->find('list', array('fields' => array('reason', 'reason'),
            'conditions' =>
                array('department' => $dept,
                    'type' => $tp)));

        $this->set('type', $ttype);

        $time = $this->TimeLoss->query("Select * from time_loss where id='$id'")[0];
        $this->set('time',$time);

        if (!$this->TimeLoss->exists($id)) {
            throw new NotFoundException(__('Invalid'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->TimeLoss->save($this->request->data)) {
                return $this->redirect(array('action' => 'index/sort:nepalidate/direction:desc'));
                //return $this->flash(__('The mixing cpar has been saved.'), array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('TimeLoss.' . $this->TimeLoss->primaryKey => $id));
            $this->request->data = $this->TimeLoss->find('first', $options);
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
        $this->TimeLoss->id = $id;
        if (!$this->TimeLoss->exists()) {
            throw new NotFoundException(__('Invalid time loss'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->TimeLoss->delete()) {
            //return $this->flash(__('The time loss has been deleted.'), array('action' => 'index'));
            return $this->redirect(array('action' => 'index/sort:nepalidate/direction:desc'));
        } else {
            return $this->flash(__('The time loss could not be deleted. Please, try again.'), array('action' => 'index'));
        }
    }

    public function fetchreason()
    {

        $this->request->onlyAllow('ajax');
        $this->loadModel('TimelossReason');
        $qwt = $this->request->data['id'];
        $did = $this->request->data['departmentid'];
        /*$tp = $this->request->data['type'];*/
        $type = $this->TimelossReason->query("SELECT reason FROM timeloss_reason where type='$qwt' and department='$did' order by reason");

        echo '<option value="null">Please select</option>';
        foreach ($type as $t):

            echo '<option value="' . $t['timeloss_reason']['reason'] . '">' . $t['timeloss_reason']['reason'] . '</option>';
            //echo '<option value="A">a</option>';
        endforeach;
        exit;

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
                'Seconds' => $secs % 60
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

    function exportcsv() 
    {
        $this->loadModel('TimeLoss');
        $result=$this->TimeLoss->query("select * from time_loss order by nepalidate desc");

        
        //print'<pre>';print_r($result);die;print'</pre>';
        $this->set('posts', $result);

        $this->layout = null;

        $this->autoLayout = false;

        Configure::write('debug','2');
    }

}

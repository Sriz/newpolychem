<script>
    $(document).ready(function () {
        $('.nepalidatepicker').nepaliDatePicker();
    });

    $(document).ready(function () {
        $("#nepalidatepicker").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            console.log("focus");
            showCalendarBox('nepalidatepicker');
        });
        $("#type").change(function () {
            var dep = document.getElementById('department').value;
            var type = $(this).val();
            //var dep = 'calender';

            $.post("fetchreason", {id: type, departmentid: dep}, function (response) {
                $(".reason").html(response);
            })

        });
    });
    function elapsed_time(time) {
        var totalSec = parseInt(time);
        var days = parseInt(totalSec / 86400) % 30;
        var hours = parseInt(totalSec / 3600) % 24;
        var minutes = parseInt(totalSec / 60) % 60;
        //var seconds = totalSec % 60;
        var result = (days < 10 ? "0" + days : days) + ':' + (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes);
        return result;
    }

    function fetchdata() {
        var qty
        var department = document.getElementById('department').value;
        var x = document.getElementsByClassName('type');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("type");
            qty = e.options[e.selectedIndex].text;
        }
        var dataString = 'id=' + qty + '&departmentid=' + department;
        $.ajax
        ({
            type: "POST",
            url: "fetchreason",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".reason").html(html);
            }
        });
    }
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(document).ready(function()
    {
       $('#startTimeHour, #startTimeMinute, #endTimeHour, #endTimeMinute').on('change', function(){
            var startTime = $('#startTimeHour').val() * 60*60 + $('#startTimeMinute').val() * 60;
            var endTime = $('#endTimeHour').val() * 60*60 + $('#endTimeMinute').val() * 60;
            $('#starttime').val($('#startTimeHour').val()+'.'+$('#startTimeMinute').val());
            $('#endtime').val($('#endTimeHour').val()+'.'+$('#endTimeMinute').val());
           //add 24 hour if start time is greater than end time
           if(startTime>endTime)
           {
                endTime= endTime+ 24*60*60;
           }
           $("#totalloss").val(elapsed_time(endTime-startTime));
           var timeLossSeconds =endTime-startTime;
           $("#totalloss_sec").val(timeLossSeconds);
       });
    });
</script>
<style>
    .datePick{
        max-width:100px;
        margin: 5px;
    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo __('Add Time Loss'); ?> </div>
    <div class="panel-body">
        <?php echo $this->Form->create('TimeLoss', array('class' => 'form-horizontal',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'control-group'),
                'label' => array('class' => ' col-sm-2 control-label'),
                'between' => '<div class="col-xs-10">',
                'after' => '</div>',
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            )));
        ?>
        <fieldset>
            <?php
            echo $this->Form->input('nepalidate', array('id' => 'nepalidatepicker', 'type' => 'text', 'class' => 'nepalidatepicker form-control input-sm','required'=>'required'));
            //echo $this->Form->input('date',array('type'=>'text','value'=>$date,'class'=>array('form-control input-sm')));
            echo $this->Form->input('shift', array('options' => array('A' => 'A', 'B' => 'B'), 'class' => 'form-control input-sm','required'=>'required'));
            echo $this->Form->input('department_id', array('id' => 'department', 'type' => 'hidden', 'class' => 'form-control input-sm', 'value' => '$dept','required'=>'required','readonly'=>'readonly'));
            echo $this->Form->input('type', array('id' => 'type', 'class' => array('type', 'form-control', 'input-sm'), 'options' => array('Please select' => 'Please select', 'BreakDown' => 'BreakDown', 'LossHour' => 'LossHour')/*,'onchange'=>'fetchdata()'*/,'required'=>'required'));
            echo $this->Form->input('reasons', array('id' => 'reasons', 'type' => 'select', 'class' => 'reason form-control input-sm','required'=>'required'));
            ?>
            <div class="row">
            <label class="col-sm-2 control-label"> Start Time</label>
            <div class="col-sm-2 datePick">
                <select id="startTimeHour" class="form-control" data-toggle="tooltip" title="Hour" required="required">
                    <?php for ($i = 0; $i < 24; $i++): ?>
                        <option value="<?=$i;?>"><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-sm-2 datePick">
                <select id="startTimeMinute" class="form-control" data-toggle="tooltip" title="Minute" required="required">
                    <?php for ($i = 0; $i < 60; $i++): ?>
                        <option value="<?=$i;?>"><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <?=$this->Form->input('time', array('type' => 'hidden', 'label' => array('class' => 'col-sm-2 control-label', 'text' => 'StartTime'), 'class' => array('form-control input-sm', 'starttime'), 'value' => '00:00', 'id' => 'starttime','required'=>'required'));?>
            <div class="col-md-6"></div>
            </div>
            <div class="clearfix"></div>
            <!-- end time -->
            <div class="row">
            <label class="col-sm-2 control-label"> End Time</label>
            <div class="col-sm-2 datePick">
                <select id="endTimeHour" class="form-control" data-toggle="tooltip" title="Hour">
                    <?php for ($i = 0; $i < 24; $i++): ?>
                        <option value="<?=$i;?>"><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-sm-2 datePick">
                <select id="endTimeMinute" class="form-control" data-toggle="tooltip" title="Minute">
                    <?php for ($i = 0; $i < 60; $i++): ?>
                        <option value="<?=$i;?>"><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <?=$this->Form->input('wk_hrs', array('type' => 'hidden', 'class' => array('form-control input-sm', 'endtime'), 'label' => array('class' => 'col-sm-2 control-label', 'text' => 'EndTime'), 'value' => '00:00', 'id' => 'endtime','required'=>'required'));?>
            <!-- end end time -->
            <div class="col-md-6"></div>
            </div>
            <div class="clearfix"></div>


            <?php
            echo $this->Form->input('totalloss', array('id' => 'totalloss', 'type' => 'text', 'class' => 'form-control input-sm totalloss', 'readonly','required'=>'required'));
            echo "<p class='text-danger' id='p_totalloss'></p>";
            echo $this->Form->input('totalloss_sec', array('id' => 'totalloss_sec', 'type' => 'hidden', 'class' => array('totalloss_sec', 'form-control input-sm'),'required'=>'required'));
            ?>            <?php echo $this->Form->end(__('Submit'), ['id' => 'btn_submit']); ?>
        </fieldset>

    </div>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Time Losses'), array('action' => 'index')); ?></li>
    </ul>
</div>
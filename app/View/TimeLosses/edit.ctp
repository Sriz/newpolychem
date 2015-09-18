
<!-- start of start time and end time -->
<script>
    /* $(document).ready(function(){
     // find the input fields and apply the time select to them.
     $('#starttime, #endtime').change(function(){
     calculate();
     });
     });*/
</script>
<!-- end of start time & end time-->
<script>
    $(document).ready(function () {
        $('#next_day').change(function () {
            /*if ($('#next_day').attr('checked')) {*/
            calculate();
            /*}*/
        })
        $('#starttime').change(function(){
            var s1= $('#starttime').val();
            s1 = s1.replace('.', ':');
            var arr0 = s1.split(':');
            if (arr0[0] >= 24 || arr0[1] >= 60) {
                $('#p_starttime').html('Please use 0-23 for <strong>hours</strong> and 0-59 for <strong>minutes</strong>');
                $("#btn_submit").removeClass('btn-primary');
                $("#btn_submit").addClass('disabled');
            } else {
                $('#p_starttime').html('');
                $("#btn_submit").removeClass('disabled');
                $("#btn_submit").addClass('btn-primary');
                calculate();
            }
        });
        $('#endtime').change(function () {
            var e1 = $('#endtime').val();
            if (e1.indexOf('.')) {
                e1 = e1.replace('.', ':');
            }
            var arr0 = e1.split(':');
            if (arr0[0] >= 24 || arr0[1] >= 60) {
                $('#p_endtime').html('Please use 0-23 for <strong>hours</strong> and 0-59 for <strong>minutes</strong>');
                $("#btn_submit").removeClass('btn-primary');
                $("#btn_submit").addClass('disabled');
            } else {
                $('#p_endtime').html('');
                $("#btn_submit").removeClass('disabled');
                $("#btn_submit").addClass('btn-primary');
                calculate();
            }
        });
    });
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
            var type = $(this).val();
            var dep = $("#department").val();
            $.post("fetchreason", {id: type, departmentid: dep}, function (response) {
                $(".reason").html(response);
            })
        });
    });
    function remove_ampm(starttime) {
        var arr0 = starttime.split(':');
        arr0[0] = parseInt(arr0[0]);
        return convert_sec(parseInt(arr0[0]), parseInt(arr0[1]));
    }
    function convert_sec(hours, minutes) {
        return hours * 60 * 60 + minutes * 60;
    }
    function elapsed_time(time) {
        var totalSec = parseInt(time);
        var days = parseInt(totalSec / 86400) % 30;
        var hours = parseInt(totalSec / 3600) % 24;
        var minutes = parseInt(totalSec / 60) % 60;
        //var seconds = totalSec % 60;
        var result = (days < 10 ? "0" + days : days) + ':' + (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes);
        return result;
    }
    function calculate() {
        var starttime = $('#starttime').val();
        var endtime = $('#endtime').val();
        starttime = remove_ampm(starttime);
        endtime = remove_ampm(endtime);
        if (endtime < starttime) {
            endtime = endtime + 24 * 60 * 60;
        }
        console.log(starttime + "<br>" + endtime);
        if (endtime < starttime) {
            $('#p_totalloss').html('Start time should lesser than end time');
            $("#btn_submit").removeClass('btn-primary');
            $("#btn_submit").addClass('disabled');
            total_loss = '';
            totalloss_sec = '';
        } else {
            $('#p_totalloss').html('');
            $("#btn_submit").removeClass('disabled');
            $("#btn_submit").addClass('btn-primary');
            var difference = endtime - starttime;
            //alert('difference = '+difference);
            var total_loss = elapsed_time(difference);
            //alert(total_loss);
            if (isNaN(difference)) {
                $("#totalloss").val("");
                $("#totalloss_sec").val("");
                return;
            }
        }
        $("#totalloss").val(total_loss);
        $("#totalloss_sec").val(difference);
    }
    function fetchdata() {
        var qty;
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
            url: "/polychem/TimeLosses/fetchreason",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".reason").html(html);
            }
        });
    }
</script>
<div class="panel panel-primary">


    <div class="panel-heading"><?php echo __('EDIT Time Loss'); ?></div>
    <div class="panel-body">
        <?php echo $this->Form->create(null, array(
            'url' => array('controller' => 'TimeLosses', 'action' => 'edit'),
            'class' => 'form-horizontal',
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
            //print_r($type);
            //$date= date('d-m-Y');
            echo $this->Form->input('id');
            echo $this->Form->input('nepalidate', array('id' => 'nepalidatepicker', 'type' => 'text', 'class' => 'nepalidatepicker form-control input-sm','required'=>'required'));
            //echo $this->Form->input('date',array('type'=>'text','value'=>$date,'class'=>array('form-control input-sm')));
            echo $this->Form->input('shift', array('options' => array('null' => 'Please Select', 'A' => 'A', 'B' => 'B'), 'class' => 'form-control input-sm','required'=>'required'));
            echo $this->Form->input('department_id', array('id' => 'department', 'type' => 'text', 'value' => 'calender', 'class' => 'form-control input-sm','readonly'=>'readonly','required'=>'required'));
            echo $this->Form->input('type', array('id' => 'type', 'class' => array('type', 'form-control', 'input-sm'), 'options' => array('Please select' => 'Please select', 'BreakDown' => 'BreakDown', 'LossHour' => 'LossHour'), 'onchange' => 'fetchdata()','required'=>'required'));
            echo $this->Form->input('reasons', array('id' => 'reasons', 'options' => $type, 'class' => array('reason', 'form-control input-sm','required'=>'required')));
            echo $this->Form->input('time', array('id' => 'starttime', 'class' => 'form-control input-sm', 'label' => array('class' => 'col-sm-2 control-label', 'text' => 'Start Time'),'required'=>'required','placeholder' => '00:00',));
            echo "<p class='text-danger' id='p_starttime'></p>";
            echo $this->Form->input('wk_hrs', array('label' => array('class' => 'col-sm-2 control-label', 'text' => 'End Time'), 'class' => 'form-control input-sm', 'type' => 'text', 'id' => 'endtime', 'onchange' => 'calculate()','required'=>'required','placeholder' => '00:00'));
            echo "<p class='text-danger' id='p_endtime'></p>";
            //echo $form->input('Contact.name', array('label' => array('class' => 'Your-Class', 'text' => 'Name<span style="color:#f89e01">*</span> :'), 'size' => '25'));
            echo $this->Form->input('totalloss', array('id'=>'totalloss','label' => array('class' => 'col-sm-2 control-label', 'text' => 'Total Loss'), 'id' => 'totalloss', 'readonly', 'class' => array('totalloss', 'form-control input-sm'),'required'=>'required','placeholder' => '00:00'));
            ?>
            <div style="margin-left: 10px;">
                <?php echo $this->Form->end(__('Submit'), ['id' => 'btn_submit']); ?>
            </div>
        </fieldset>

    </div>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Time Losses'), array('action' => 'index')); ?></li>
    </ul>
</div>
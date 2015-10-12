<style>
    .addbtn {
        bottom: 103px;
        left: 636px;
        position: relative;
        width: 137px;
    }
    .addbtnnew {
        bottom: 103px;
        left: 636px;
        position: relative;
        width: 137px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#greenbox").hide();
        $("#redbox").hide();
        $("#bluebox").hide();
        $("#pink").hide();
    });
</script>
<script>
    $(document).ready(function () {
        $('#nepalidatepicker').nepaliDatePicker();
    });
    $(document).ready(function () {
        $("#nepalidatepicker").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            console.log("focus")
            showCalendarBox('nepalidatepicker');
        });
    });
    function fetchdata() {
        var strUser = $('#dimension').val();
        if(strUser.length) {
            var dataString = 'id=' + strUser;
            $.ajax
            ({
                type: "POST",
                url: "<?=$base_url;?>PrintingShiftreports/pfcolor",
                data: dataString,
                cache: false,
                success: function (html) {
                    $(".pfcolor").html(html);
                }
            });
        }
    }
    function fetchcolor() {
        var x = document.getElementsByClassName('dimension');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("dimension");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;
        }
        var y = document.getElementsByClassName('pfcolor');
        for (i = 0; i < y.length; i++) {
            var z = document.getElementById("pfcolor");
            var strUsr = z.options[z.selectedIndex].text;
            y[i].value = strUsr;
        }
        var dataString = 'id=' + strUser + '&type=' + strUsr;
        $.ajax
        ({
            type: "POST",
            url: "<?=$base_url;?>PrintingShiftreports/basecolor",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".colorcode").html(html);
            }
        });
    }
</script>
<script>
    var errorBtn1=0;
    var errorBtn2=0;
    var errorBtn3=0;
    var errorBtn4=0;
    function doi() {
        //  alert("hello");
        var val = $('#unprinted_scrap').val();
        //console.log(val);
        if (val >= 1) {
            // var r = confirm("Press Ok To add More Reason or Cancel to Add Single");
            bootbox.confirm({
                title: 'Unprinted Scrap Reason',
                message: 'Press Single To Add Single Reason or Press Multiple To add Multiple Reason',
                buttons: {
                    'cancel': {
                        label: 'Single',
                        className: 'btn-default pull-left'
                    },
                    'confirm': {
                        label: 'Multiple',
                        className: 'btn-danger pull-right'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $(".red").show();
                        $(".bluebox").hide();
                        $('#unprinted').val('');
                    }
                    else {
                        $(".red").hide();
                        $(".bluebox").show();
                        for(var i=1; i<=5; i++)
                        {
                            $('#UnPrintingShiftreportQuantity'+i).val(0);
                            $('#UnPrintingShiftreportQuantityReason'+i).val('');
                        }
                        errorBtn2=0;
                        //btnCheck();
                    }
                }
            });
        }
        else {
            $(".red").hide();
            $(".bluebox").hide();
        }
    }
    function doi1() {
        var val = $('#printed_scrap').val();
        if (val >= 1) {
            bootbox.confirm({
                title: 'Printed Scrap Reason',
                message: 'Press Single To Add Single Reason or Press Multiple To add Multiple Reason',
                buttons: {
                    'cancel': {
                        label: 'Single',
                        className: 'btn-default pull-left'
                    },
                    'confirm': {
                        label: 'Multiple',
                        className: 'btn-danger pull-right'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $(".green").show();
                        $(".pinkbox").hide();
                        $('#printed').val('');
                    }
                    else {
                        $(".green").hide();
                        $(".pinkbox").show();
                        for(var i=1; i<=5; i++)
                        {
                            $('#PrintingShiftreportQuantity'+i).val(0);
                            $('#PrintingShiftreportQuantityReason'+i).val('');
                        }
                        errorBtn3 = 0;
                        //btnCheck();
                    }
                }
            });
        }
        else {
            $(".green").hide();
            $(".pinkbox").hide();
        }
    }
</script>

<script>
    $(document).ready(function()
    {
        //input output
        $('#PrintingShiftreportInput, #PrintingShiftreportOutput').on('change keyup paste', function()
        {
            var input = parseInt($('#PrintingShiftreportInput').val());
            var output = parseInt($('#PrintingShiftreportOutput').val());
           if(input<output){
               errorBtn1 =1;
               btnCheck();
               $('#PrintingShiftreportOutput').css('border','1px solid red');
               //alert("Output should be lesser than input.")
           }else {
               errorBtn1=0;
               btnCheck();
               $('#PrintingShiftreportOutput').css('border', '1px solid green');
           }
        });
        //$('#unprinted_scrap')
        $("#unprinted_scrap, #UnPrintingShiftreportQuantity1, #UnPrintingShiftreportQuantity2, #UnPrintingShiftreportQuantity3, #UnPrintingShiftreportQuantity4, #UnPrintingShiftreportQuantity5").on('change paste keyup', function(){
            var result = check_calculation($("#unprinted_scrap").val(), [$('#UnPrintingShiftreportQuantity1').val(),$('#UnPrintingShiftreportQuantity2').val(), $('#UnPrintingShiftreportQuantity3').val(), $('#UnPrintingShiftreportQuantity4').val(), $('#UnPrintingShiftreportQuantity5').val()]);
            if(result)
            {
                $('.unprintedClass').css('border','1px solid green');
                //$('#btnSubmit').removeClass('disabled').addClass('btn-primary');
                errorBtn2=0;
                //btnCheck()
            }else{
                $('.unprintedClass').css('border','1px solid red');
                //$('#btnSubmit').removeClass('btn-primary').addClass('disabled');
                errorBtn2=1;
                //btnCheck();
            }
        });
        $("#printed_scrap, #PrintingShiftreportQuantity1, #PrintingShiftreportQuantity2, #PrintingShiftreportQuantity3, #PrintingShiftreportQuantity4, #PrintingShiftreportQuantity5").on('change paste keyup', function()
        {
            var result = check_calculation($("#printed_scrap").val(), [$('#PrintingShiftreportQuantity1').val(),$('#PrintingShiftreportQuantity2').val(), $('#PrintingShiftreportQuantity3').val(), $('#PrintingShiftreportQuantity4').val(), $('#PrintingShiftreportQuantity5').val()]);
            if(result)
            {
                $('.printedClass').css('border','1px solid green');
                //$('#btnSubmit').removeClass('disabled').addClass('btn-primary');
                errorBtn3=0;
                btnCheck();
            }else{
                $('.printedClass').css('border','1px solid red');
                //$('#btnSubmit').removeClass('btn-primary').addClass('disabled');
                errorBtn3=1;
                //btnCheck();
            }
        });
        function check_calculation(total , arr)
        {
            var totalOfItems = parseInt(arr[0])+parseInt(arr[1])+parseInt(arr[2])+parseInt(arr[3])+parseInt(arr[4]);
            if(parseInt(total)==totalOfItems)
            {
                return true;
            }
            return false;
        }
    });
    $('#PrintingShiftreportAddForm').submit(function(){
        if(errorBtn1==1 || errorBtn2==1 || errorBtn3==1) {
            return false;
        }else{
            console.log('validated');
            return true;
        }
    });
    $(document).ready(function() {
        $('#btnSubmit').click(function () {
            if (errorBtn1 == 1){
                alert('Input should be greater than output.');
            }else if(errorBtn2 == 1) {
                alert('Unprinted scrap total does not match.');
            }else if(errorBtn3 == 1) {
                alert('Printed scrap does not match.');
            }else if(parseInt($('#PrintingShiftreportInput').val()) !=( parseInt($('#PrintingShiftreportOutput').val()) + parseInt($('#unprinted_scrap').val()) + parseInt($('#printed_scrap').val()) )){
                alert('Input = Output+Unprinted+Printed');
                return false;
            }else{
                console.log('Validated');
            }
        });
    });
    $(document).ready(function() {
        $('#btnSubmit').click(function () {
            if (errorBtn1 == 1){
                alert('Input/Output Error');
            }else if(errorBtn2 == 1) {
                alert('Unprinted Scrap Error');
            }else if(errorBtn3 == 1) {
                alert('Printed Scrap Error');
            }else if(parseInt($('#PrintingShiftreportInput').val()) !=( parseInt($('#PrintingShiftreportOutput').val()) + parseInt($('#unprinted_scrap').val()) + parseInt($('#printed_scrap').val()) )){
                alert('Input = Output+Unprinted+Printed');
                return false;
            }else{
                console.log('Validated');
            }
        });
    });
    function btnCheck(that)
    {
        var url = $(that).attr('href');
        if(errorBtn1==1 || errorBtn2==1 || errorBtn3==1)
        {
            return false;
        }else{
            return true;
        }
    }
</script>

<div class="printingShiftreports form">
    <?php echo $this->Form->create(array('PrintingShiftreport', 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'col-sm-2 control-label'),
            'between' => '<div class="col-xs-10">',
            'after' => '</div>',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        ))); ?>
    <fieldset>
        <legend><?php echo __('Add Printing Shiftreport'); ?></legend>
        <?php
        $date = date('d-m-Y');
        //print_r($dimension);
        echo $this->Form->input('date', array('type' => 'text', 'id' => 'nepalidatepicker', 'class' => 'form-control input-sm', 'required' => 'required'));
        echo $this->Form->input('shift', array('options' => array('A' => 'A', 'B' => 'B'), 'class' => 'form-control input-sm', 'required' => 'required'));
        echo $this->Form->input('dimension', array('id' => 'dimension', 'class' => array('dimension', 'form-control input-sm'), 'options' => $dimension, 'empty' => 'Please Select', 'onchange' => 'fetchdata()', 'required' => 'required'));
        echo $this->Form->input('PF_Color', array('id' => 'pfcolor', 'class' => array('pfcolor', 'form-control input-sm'), 'type' => 'select', 'onchange' => 'fetchcolor()', 'required' => 'required'));
        echo $this->Form->input('color_code', array('id' => 'colorcode', 'class' => array('colorcode', 'form-control input-sm'), 'type' => 'select', 'required' => 'required'));
        echo $this->Form->input('input', array('class' => 'form-control input-sm', 'required' => 'required'));
        echo $this->Form->input('output', array('class' => 'form-control input-sm', 'required' => 'required'));
        echo $this->Form->input('unprinted_scrap', array('class' => 'form-control input-sm', 'id' => 'unprinted_scrap', 'onchange' => 'doi();', 'required' => 'required'));
        echo '<div class="bluebox" id="bluebox">';
        echo $this->Form->input('unprinted_scrap_reason', array('id' => 'unprinted', 'class' => 'form-control input-sm unprinted', 'options' => array('NULL' => 'Please Select', $unprinted), 'required' => 'required'));
        echo "</div>";
        echo '<div class="red box" id="redbox">';
        echo "<table class='table table-condensed'>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('unprinted_reason_1', array('id'=>'UnPrintingShiftreportQuantityReason1','class' => 'form-control input-sm', 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label'), 'options' => array('Null' => 'Please Select', $unprinted)));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity1', array('id'=>'UnPrintingShiftreportQuantity1','class' => 'form-control input-sm unprintedClass', 'type' => 'text', 'value' => '0', 'label' => array('text' => 'quantity', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('unprinted_reason_2', array('id'=>'UnPrintingShiftreportQuantityReason2','class' => 'form-control input-sm', 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label'), 'options' => array('Null' => 'Please Select', $unprinted)));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity2', array( 'id'=>'UnPrintingShiftreportQuantity2','class' => 'form-control input-sm unprintedClass', 'value' => '0', 'label' => array('text' => 'quantity', 'class' => 'col-sm-2 control-label'), 'type' => 'text'));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('unprinted_reason_3', array('id'=>'UnPrintingShiftreportQuantityReason3','class' => 'form-control input-sm', 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label'), 'options' => array('Null' => 'Please Select', $unprinted)));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity3', array( 'id'=>'UnPrintingShiftreportQuantity3', 'class' => 'form-control input-sm unprintedClass', 'value' => '0', 'label' => array('text' => 'quantity', 'class' => 'col-sm-2 control-label'), 'type' => 'text'));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('unprinted_reason_4', array('id'=>'UnPrintingShiftreportQuantityReason4','class' => 'form-control input-sm', 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label'), 'options' => array('Null' => 'Please Select', $unprinted)));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity4', array('id'=>'UnPrintingShiftreportQuantity4','class' => 'form-control input-sm unprintedClass', 'value' => '0', 'label' => array('text' => 'quantity', 'class' => 'col-sm-2 control-label'), 'type' => 'text'));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('unprinted_reason_5', array('id'=>'UnPrintingShiftreportQuantityReason5','class' => 'form-control input-sm', 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label'), 'options' => array('Null' => 'Please Select', $unprinted)));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity5', array('id'=>'UnPrintingShiftreportQuantity5', 'class' => 'form-control input-sm unprintedClass', 'value' => '0', 'label' => array('text' => 'quantity', 'class' => 'col-sm-2 control-label'), 'type' => 'text'));
        echo "</tr>";
        echo "</table>";
        echo '</div>';
        echo $this->Form->input('department_id', array('id' => 'department', 'type' => 'hidden', 'required' => 'required'));
        echo $this->Form->input('printed_scrap', array('class' => 'form-control input-sm', 'id' => 'printed_scrap', 'onchange' => 'doi1();', 'required' => 'required'));
        echo '<div class="pinkbox" id="pink">';
        echo $this->Form->input('printed_scrap_reason', array('class' => 'form-control input-sm printed', 'id' => 'printed', 'options' => array('Null' => 'Please Select', $printed), 'required' => 'required'));
        echo "</div>";
        //
        echo '<div class="green box" id="greenbox">';
        echo "<table class='table table-condensed'>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('printed_reason_1', array('id'=>'PrintingShiftreportQuantityReason1','options' => array('Null' => 'Please Select', $printed), 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity_1', array('value' => '0','class'=>'printedClass', 'label' => array('text' => 'quantity', 'value' => '0', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('printed_reason_2', array('id'=>'PrintingShiftreportQuantityReason2','options' => array('Null' => 'Please Select', $printed), 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity_2', array('value' => '0', 'class'=>'printedClass','label' => array('text' => 'quantity', 'value' => '0', 'class' => ' col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('printed_reason_3', array('id'=>'PrintingShiftreportQuantityReason3','options' => array('Null' => 'Please Select', $printed), 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity_3', array('value' => '0','class'=>'printedClass', 'label' => array('text' => 'quantity', 'value' => '0', 'class' => ' col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('printed_reason_4', array('id'=>'PrintingShiftreportQuantityReason4','options' => array('Null' => 'Please Select', $printed), 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity_4', array('value' => '0','class'=>'printedClass', 'label' => array('text' => 'quantity', 'value' => '0', 'class' => ' col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $this->Form->input('printed_reason_5', array('id'=>'PrintingShiftreportQuantityReason5','class'=>'form-control', 'options' => array('Null' => 'Please Select', $printed), 'label' => array('text' => 'Reason', 'class' => 'col-sm-2 control-label')));
        echo "</td>";
        echo "<td>";
        echo $this->Form->input('quantity_5', array('value' => '0', 'class'=>'printedClass','label' => array('text' => 'quantity', 'class' => ' col-sm-2 control-label')));
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo '</div>';
        echo '<div class="addbtnnew"> <label></div>';
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit'),['id'=>'btnSubmit', 'onclick'=>'return btnCheck(this);']); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>

</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Unprinted Scrap Extended Reason</h4>
            </div>
            <div class="modal-body">
                <p> <?php echo $this->Form->create('LaminatingReasonOther', array(
                        'url' => array('controller' => 'LaminatingReasonOthers', 'action' => 'add'),
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
                    $date = date('d-m-Y');
                    echo $this->Form->input('date', array('value' => $date));
                    echo $this->Form->input('reason');
                    ?>
                </fieldset>
                <?php echo $this->Form->end(__('Submit')); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Printed Scrap Extended Reason</h4>
            </div>
            <div class="modal-body">
                <p>
                    <?php echo $this->Form->create('LaminatingReasonOther', array(
                        'url' => array('controller' => 'LaminatingReasonOthers', 'action' => 'add'),
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
                    $date = date('d-m-Y');
                    echo $this->Form->input('date', array('value' => $date));
                    echo $this->Form->input('reason');
                    ?>
                </fieldset>
                <?php echo $this->Form->end(__('Submit')); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

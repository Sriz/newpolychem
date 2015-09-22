<script>
    
    //     $('.nepali-datepicker').nepaliDatePicker();
    // });
    // $(document).ready(function () {
    //     $("#nepali-datepicker").focus(function (e) {
    //         //$("span").css("display", "inline").fadeOut(2000);
    //         console.log("focus")
    //         showCalendarBox('nepali-datepicker');
    //     });
    // });


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
            var dep = 'calender';

            $.post("fetchreason", {id: type, departmentid: dep}, function (response) {
                $(".reason").html(response);
            })

        });
    });
        //

    function calculate() {
        var resuable = $('#reuse').val();
        var lamps = $('#lamps').val();
        if(isNaN(parseInt(resuable) + parseInt(lamps)))
        {
            alert('Error: Please use valid number');
        }else {
            $('#total').val(parseInt(resuable) + parseInt(lamps));
        }
    }
    function calculate1() {
        var resuable1 = $('#reuse1').val();
        var lamps1 = $('#lamps1').val();
        $('#total1').val(parseInt(resuable1) + parseInt(lamps1));
    }
</script>
<div class="calenderScraps form">
    <?php echo $this->Form->create(null, array(
        'url' => array('controller' => 'CalenderScraps', 'action' => 'add'),
        'class' => 'form-horizontal',
        
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'control-group'),
            'label' => array('class' => ' col-sm-2 control-label'),
            'between' => '<div class="col-xs-10">',
            'after' => '</div>',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        )));//('CalenderScrap'); ?>
    <fieldset>
        <legend><?php echo __('Add Calendar Scrap'); ?></legend>
        <?php
        echo $this->Form->input('date', array('id' => 'nepalidatepicker', 'type' => 'text', 'class' => 'nepalidatepicker form-comtrol input-sm'));
        echo $this->Form->input('resuable', array('id' => 'reuse','required'=>'required'));
        echo $this->Form->input('lamps_plates', array('id' => 'lamps', 'onchange' => 'calculate();','required'=>'required'));
        echo $this->Form->input('total_scrap_generated', array('id' => 'total', 'readonly'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Calendar Scraps'), array('action' => 'index/sort:date/direction:desc')); ?></li>
    </ul>
</div>

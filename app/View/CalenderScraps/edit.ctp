<script>
 $(document).ready(function () {
        $('.nepali-datepicker').nepaliDatePicker();
    });

    $(document).ready(function () {
        $("#nepali-datepicker").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            console.log("focus")
            showCalendarBox('nepali-datepicker');
        });
    });
 function calculate() {
        var resuable = $('#reuse').val();
        var lamps = $('#lamps').val();
        $('#total').val(parseInt(resuable) + parseInt(lamps));
    }
    function calculate1() {
        var resuable1 = $('#reuse1').val();
        var lamps1 = $('#lamps1').val();
        $('#total1').val(parseInt(resuable1) + parseInt(lamps1));
    }
</script>
<div class="calenderScraps form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'CalenderScraps', 'action' => 'edit'),
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
		<legend><?php echo __('Edit Calender Scrap'); ?></legend>
	<?php
		echo $this->Form->input('id',array('class'=>'input-ms'));
		  echo $this->Form->input('date', array('id' => 'nepali-datepicker', 'class' => 'nepali-datepicker', 'type' => 'text'));              echo $this->Form->input('resuable', array('id' => 'reuse'));
                                echo $this->Form->input('lamps_plates', array('id' => 'lamps', 'onchange' => 'calculate();'));
                                echo $this->Form->input('total_scrap_generated', array('id' => 'total','readonly'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CalenderScrap.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CalenderScrap.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Calender Scraps'), array('action' => 'index/sort:date/direction:desc')); ?></li>
	</ul>
</div>

<script>
	$(document).on("change", ".qty1", function() {
    var sum = 0;
    $(".qty1").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});
	$(document).on("change", ".mt1", function() {
    var sum;
    $(".mt1").each(function(){
        sum=$(this).val();
    });
    $(".material").val(sum);
});
</script>

<script>

 $(document).ready(function(){
           			var value = ''
       			$('.nepalidatepicker').nepaliDatePicker();
       			// Trigger On change/Selected event
       			$.onChangeDatepicker_Ravindra = function(selectedDate){
       				value = $("#nepalidatepicker").val();
       				$('.date').val(value);
       			}

       		});

</script>
<div class="printingIssues form">
	<?php
	$date=date('d-m-Y');
	
	echo $this->Form->input('date',array('id'=>'nepalidatepicker','class'=>'nepalidatepicker','onchange'=>'rest();'));
	echo $this->Form->input('shift',array('options'=>array('A'=>'A' ,'B'=>'B')));
	echo $this->Form->input('material',array('class'=>'mt1'));?>
	
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'PrintingIssues', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('PrintingIssue'); ?>
	<fieldset>
		<legend><?php echo __('Add Printing Issue'); ?></legend>
	<?php
	
	$date=date('d-m-Y');
	
	$i=1;
	echo '<table class="table">';
	echo '<tr class="success">';
	echo '<td></td><td></td><td><h5><b>Pattern</b></h5></td><td><h5><b>Quantity</b></h5></td><td></td>';
	echo '</tr>';
	foreach($rawmaterials as $pattern):
	echo '<tr class="success">';
		//echo $this->Form->input('PrintingIssue.'.$i.'.id');
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.date',array('type'=>'hidden','class'=>'date','id'=>'datepicker'));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.material',array('type'=>'hidden','class'=>'material'));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.pattern',array('value'=>$pattern,'type'=>'text','label'=>false));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.quantity',array('value'=>'0','class'=>'qty1','tabindex'=>$i,'label'=>false));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.total',array('type'=>'hidden','class'=>'total','value'=>'0'));
		echo '</td>	';
		$i++;
		echo '</tr>';
		endforeach;
	
	echo '</table>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printing Issues'), array('action' => 'index/sort:id/direction:asc')); ?></li>
	</ul>
</div>

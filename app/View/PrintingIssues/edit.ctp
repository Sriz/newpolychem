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
              			$('.datepicker').nepaliDatePicker();
              			// Trigger On change/Selected event
              			$.onChangeDatepicker_Ravindra = function(selectedDate){
              				value = $("#datepicker").val();
              				console.log(value);
              				$('.ndate').val(value);
              			}

              		});



</script>
<div class="printingIssues form">
	<?php
	//$date=date('d-m-Y');
	
	echo $this->Form->input('date',array('id'=>'datepicker','class'=>'datepicker','value'=>$datas['0']['printing_issue']['date']));
	echo $this->Form->input('shift',array());
	echo $this->Form->input('material',array('class'=>'mt1','value'=>$datas['0']['printing_issue']['material']));?>
	
<?php echo $this->Form->create('PrintingIssue'); ?>
	<fieldset>
		<legend><?php echo __('Edit  Printing Mixing Report'); ?></legend>
	<?php
	
	$date=date('d-m-Y');
	
	$i=1;
	echo '<table class="table">';
	echo '<tr class="success">';
	echo '<td></td><td></td><td><h5><b>Pattern</b></h5></td><td><h5><b>Quantity</b></h5></td><td></td>';
	
	echo '</tr>';
	foreach($datas as $pattern):
	//echo $pattern['printing_issue']['id'];
	echo '<tr class="success">';
		//echo $this->Form->input('PrintingIssue.'.$i.'.id');
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.date',array('value'=>$pattern['printing_issue']['date'],'type'=>'hidden','class'=>'ndate','id'=>'ndate'));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.material',array('type'=>'hidden','class'=>'material','value'=>$pattern['printing_issue']['material']));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.pattern',array('value'=>$pattern,'type'=>'text','value'=>$pattern['printing_issue']['pattern'],'label'=>false));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.quantity',array('value'=>'0','label'=>false,'class'=>'qty1','value'=>$pattern['printing_issue']['quantity'],'tabindex'=>$i));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('PrintingIssue.'.$i.'.total',array('type'=>'hidden','class'=>'total','value'=>$pattern['printing_issue']['total']));
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

<script>

         $(document).ready(function(){
              $('.nepalidate').nepaliDatePicker();
         });
   	$(document).ready(function(){
    $("#nepalidate").focus(function(e){
        //$("span").css("display", "inline").fadeOut(2000);
		console.log("focus")
		showCalendarBox('nepalidate');
    });
});
	
</script>
<div class="requests form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Requests', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('Request'); ?>
	<fieldset>
		<legend><?php echo __('Edit Request'); ?></legend>
	<?php
		echo $this->Form->input('date',array('class'=>'input input-sm nepalidate','id'=>'nepalidate'));
		echo $this->Form->input('request_id',array('class'=>'input input-sm'));
		echo $this->Form->input('department_id',array('type'=>'text','class'=>'input input-sm'));
		echo $this->Form->input('material_id',array('type'=>'text','class'=>'input input-sm'));
		echo $this->Form->input('quantity',array('class'=>'input input-sm'));
		echo $this->Form->input('remarks',array('class'=>'input input-sm'));
		echo $this->Form->input('user_id',array('type'=>'text','class'=>'input input-sm'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Request.request_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Request.request_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?></li>
	</ul>
</div>

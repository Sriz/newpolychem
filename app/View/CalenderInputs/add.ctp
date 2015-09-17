<div class="calenderInputs form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'CalenderInputs', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('CalenderInput'); ?>
	<fieldset>
		<legend><?php echo __('Add Calender Input'); ?></legend>
	<?php
		echo $this->Form->input('total_input',array('class'=>'input-ms'));
		echo $this->Form->input('actual_raw_material',array('class'=>'input-ms'));
		echo $this->Form->input('DANA',array('class'=>'input-ms'));
		echo $this->Form->input('total_scrap',array('class'=>'input-ms'));
		echo $this->Form->input('date',array('class'=>'input-ms'));
		echo $this->Form->input('shift',array('class'=>'input-ms'));
		echo $this->Form->input('department_id',array('class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Calender Inputs'), array('action' => 'index')); ?></li>
	</ul>
</div>

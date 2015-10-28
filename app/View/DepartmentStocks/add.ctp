<div class="departmentStocks form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'DepartmentStocks', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('DepartmentStock'); ?>
	<fieldset>
		<legend><?php echo __('Add Department Stock'); ?></legend>
	<?php
		echo $this->Form->input('department_id',array('class'=>'input-ms'));
		echo $this->Form->input('material_id',array('class'=>'input-ms'));
		echo $this->Form->input('date',array('class'=>'input-ms'));
		echo $this->Form->input('quantity',array('class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


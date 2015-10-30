<div class="factoryHalts form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'FactoryHalts', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('FactoryHalt'); ?>
	<fieldset>
		<legend><?php echo __('Add Factory Halt'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('status');
		echo $this->Form->input('reason');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Factory Halts'), array('action' => 'index')); ?></li>
	</ul>
</div>

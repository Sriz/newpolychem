<div class="mixingCpars form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'MixingCpars', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('MixingCpar'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mixing Cpar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date');
		echo $this->Form->input('shift');
		echo $this->Form->input('supervisor_name');
		echo $this->Form->input('operator_name');
		echo $this->Form->input('quality');
		echo $this->Form->input('noofcharge');
		echo $this->Form->input('color');
		echo $this->Form->input('material_id');
		echo $this->Form->input('standard');
		echo $this->Form->input('blenderquality');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MixingCpar.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MixingCpar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mixing Cpars'), array('action' => 'index')); ?></li>
	</ul>
</div>

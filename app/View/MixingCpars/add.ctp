<div class="mixingCpars form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'MixingCpars', 'action' => 'add'),
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
		<legend><?php echo __('Add Mixing Cpar'); ?></legend>
	<?php
		echo $this->Form->input('date',array('type'=>'text','id'=>'datetime'));
		echo $this->Form->input('shift',array('id'=>'shift'));
		echo $this->Form->input('supervisor_name');
		echo $this->Form->input('operator_name');
		echo $this->Form->input('quality');
		echo $this->Form->input('noofcharge');
		echo $this->Form->input('color');
		echo $this->Form->input('material_id',array('class'=>'form-control input-sm','options'=>$opt));
		echo $this->Form->input('standard');
		echo $this->Form->input('blenderquality');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mixing Cpars'), array('action' => 'index')); ?></li>
	</ul>
</div>

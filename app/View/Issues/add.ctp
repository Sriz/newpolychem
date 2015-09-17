<div class="issues form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Issues', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('Issue'); ?>
	<fieldset>
		<legend><?php echo __('Add Issue'); ?></legend>
	<?php
		echo $this->Form->input('material_id',array('class'=>'input input-sm'));
		echo $this->Form->input('quantity',array('class'=>'input input-sm'));
		echo $this->Form->input('department_id',array('class'=>'input input-sm'));
		echo $this->Form->input('date',array('class'=>'input input-sm'));
		echo $this->Form->input('issued_to',array('class'=>'input input-sm'));
		echo $this->Form->input('issued_by',array('class'=>'input input-sm'));
		echo $this->Form->input('category_id',array('class'=>'input input-sm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?></li>
	</ul>
</div>

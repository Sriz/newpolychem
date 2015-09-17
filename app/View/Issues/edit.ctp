<div class="issues form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Issues', 'action' => 'edit'),
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
		<legend><?php echo __('Edit Issue'); ?></legend>
	<?php
	//print_r($opt);
	//print_r($department);
		echo $this->Form->input('issue_id',array('class'=>'input input-sm'));
		echo $this->Form->input('material_id',array('class'=>'input input-sm','type'=>'text'));
		echo $this->Form->input('quantity',array('class'=>'input input-sm'));
		echo $this->Form->input('department_id',array('class'=>'input input-sm','type'=>'text'));
		echo $this->Form->input('date',array('class'=>'input input-sm'));
		echo $this->Form->input('issued_to',array('class'=>'input input-sm'));
		echo $this->Form->input('issued_by',array('class'=>'input input-sm'));
		echo $this->Form->input('category_id',array('class'=>'input input-sm','type'=>'text'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Issue.issue_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Issue.issue_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?></li>
	</ul>
</div>

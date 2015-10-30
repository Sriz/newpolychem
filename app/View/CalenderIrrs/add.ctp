<div class="calenderIrrs form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'CalenderIrrs', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('CalenderIrr'); ?>
	<fieldset>
		<legend><?php echo __('Add Calender Irr'); ?></legend>
	<?php
		echo $this->Form->input('date',array('type'=>'text','id'=>'datetime','class'=>'input-ms'));
		echo $this->Form->input('quality',array('class'=>'input-ms'));
		echo $this->Form->input('color',array('class'=>'input-ms'));
		echo $this->Form->input('dimension',array('class'=>'input-ms'));
		echo $this->Form->input('emb',array('class'=>'input-ms'));
		echo $this->Form->input('mtr',array('class'=>'input-ms'));
		echo $this->Form->input('kgs',array('class'=>'input-ms'));
		echo $this->Form->input('remarks',array('class'=>'input-ms'));
		echo $this->Form->input('department_id',array('type'=>'text','id'=>'department','class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Calender Irrs'), array('action' => 'index')); ?></li>
	</ul>
</div>

<div class="laminatingReasonOthers form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'LaminatingReasonOther', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('LaminatingReasonOther'); ?>
	<fieldset>
		<legend><?php echo __('Add Laminating Reason Other'); ?></legend>
	<?php
		echo $this->Form->input('date',array('class'=>'input input-ms'));
		echo $this->Form->input('reason',array('class'=>'input input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Laminating Reason Others'), array('action' => 'index')); ?></li>
	</ul>
</div>

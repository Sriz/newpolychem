<div class="dimensions form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Dimensions', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('Dimension'); ?>
	<fieldset>
		<legend><?php echo __('Edit Dimension'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('dimension');
		echo $this->Form->input('base');
		echo $this->Form->input('quality');
		echo $this->Form->input('color');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Dimension.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Dimension.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Dimensions'), array('action' => 'index')); ?></li>
	</ul>
</div>

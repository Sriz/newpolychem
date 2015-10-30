<div class="venderDetails form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'VenderDetails', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('VenderDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vender Detail'); ?></legend>
	<?php
		echo $this->Form->input('vender_id',array('class'=>'input input-ms'));
		echo $this->Form->input('vender_name',array('class'=>'input input-ms'));
		echo $this->Form->input('vender_phone',array('class'=>'input input-ms'));
		echo $this->Form->input('vender_location',array('class'=>'input input-ms'));
		echo $this->Form->input('vender_mobile',array('class'=>'input input-ms'));
		echo $this->Form->input('vender_email',array('class'=>'input input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VenderDetail.vender_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('VenderDetail.vender_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Vender Details'), array('action' => 'index')); ?></li>
	</ul>
</div>

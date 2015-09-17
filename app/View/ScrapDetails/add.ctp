<div class="scrapDetails form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'ScrapDetails', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('ScrapDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Scrap Detail'); ?></legend>
	<?php
		echo $this->Form->input('resuable',array('class'=>'input-ms'));
		echo $this->Form->input('lumps_plates',array('class'=>'input-ms'));
		echo $this->Form->input('total_scrap_generated',array('class'=>'input-ms'));
		echo $this->Form->input('less_scrap_used',array('class'=>'input-ms'));
		echo $this->Form->input('date',array('class'=>'input-ms'));
		echo $this->Form->input('shift',array('class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Scrap Details'), array('action' => 'index')); ?></li>
	</ul>
</div>

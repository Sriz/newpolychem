<div class="dailyrawmaterialprintingReports form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'DailyrawmaterialprintingReports', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('DailyrawmaterialprintingReport'); ?>
	<fieldset>
		<legend><?php echo __('Edit Dailyrawmaterialprinting Report'); ?></legend>
	<?php
		echo $this->Form->input('id',array('class'=>'input-ms'));
		echo $this->Form->input('cyclo',array('class'=>'input-ms'));
		echo $this->Form->input('mek',array('class'=>'input-ms'));
		echo $this->Form->input('toluene',array('class'=>'input-ms'));
		echo $this->Form->input('stabalizer890',array('class'=>'input-ms'));
		echo $this->Form->input('pvc_regin',array('class'=>'input-ms'));
		echo $this->Form->input('finawax_vl',array('class'=>'input-ms'));
		echo $this->Form->input('black _N_330',array('class'=>'input-ms'));
		echo $this->Form->input('blue_2764',array('class'=>'input-ms'));
		echo $this->Form->input('green_2764',array('class'=>'input-ms'));
		echo $this->Form->input('orange_1475K',array('class'=>'input-ms'));
		echo $this->Form->input('red_562',array('class'=>'input-ms'));
		echo $this->Form->input('silver_paste',array('class'=>'input-ms'));
		echo $this->Form->input('TI02_A',array('class'=>'input-ms'));
		echo $this->Form->input('yellow_137k',array('class'=>'input-ms'));
		echo $this->Form->input('gold',array('class'=>'input-ms'));
		echo $this->Form->input('other',array('class'=>'input-ms'));
		echo $this->Form->input('total',array('class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DailyrawmaterialprintingReport.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DailyrawmaterialprintingReport.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Dailyrawmaterialprinting Reports'), array('action' => 'index')); ?></li>
	</ul>
</div>

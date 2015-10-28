<div class="printingStocks form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'PrintingStocks', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('PrintingStock'); ?>
	<fieldset>
		<legend><?php echo __('Add Printing Stock'); ?></legend>
	<?php
		echo $this->Form->input('printing_rawmaterialid',array('class'=>'form-control input-sm','label'=>array('class'=>'col-sm-2 control-label','text'=>'Material Id'),));
		echo $this->Form->input('quantity',array('class'=>'form-control input-sm'));
		echo $this->Form->input('balance',array('class'=>'form-control input-sm'));
		echo $this->Form->input('issue',array('class'=>'form-control input-sm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printing Stocks'), array('action' => 'index')); ?></li>
	</ul>
</div>

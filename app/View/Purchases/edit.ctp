<div class="purchases form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Purchases', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('Purchase'); ?>
	<fieldset>
		<legend><?php echo __('Edit Purchase'); ?></legend>
	<?php
		echo $this->Form->input('purchase_id',array('class'=>'input input-sm'));
		echo $this->Form->input('material_id',array('type'=>'text','class'=>'input input-sm'));
		echo $this->Form->input('vender_id',array('type'=>'text','class'=>'input input-sm'));
		echo $this->Form->input('category_id',array('type'=>'text','class'=>'input input-sm'));
		echo $this->Form->input('quantity',array('class'=>'input input-sm'));
		echo $this->Form->input('purchase_date',array('class'=>'input input-sm'));
		echo $this->Form->input('purchase_user',array('class'=>'input input-sm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Purchase.purchase_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Purchase.purchase_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('action' => 'index')); ?></li>
	</ul>
</div>

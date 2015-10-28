<div class="purchaseStocks form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'PurchaseStocks', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('PurchaseStock'); ?>
	<fieldset>
		<legend><?php echo __('Edit Purchase Stock'); ?></legend>
	<?php
		echo $this->Form->input('purchase_id',array('class'=>'input-ms'));
		echo $this->Form->input('material_id',array('class'=>'input-ms'));
		echo $this->Form->input('vender_id',array('class'=>'input-ms'));
		echo $this->Form->input('category_id',array('class'=>'input-ms'));
		echo $this->Form->input('quantity',array('class'=>'input-ms'));
		echo $this->Form->input('purchase_date',array('class'=>'input-ms'));
		echo $this->Form->input('purchase_user',array('class'=>'input-ms'));
		echo $this->Form->input('Reorder_level',array('class'=>'input-ms'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PurchaseStock.y')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PurchaseStock.y'))); ?></li>
		<li><?php echo $this->Html->link(__('List Purchase Stocks'), array('action' => 'index')); ?></li>
	</ul>
</div>

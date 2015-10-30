<div class="purchaseStocks view">
<h2><?php echo __('Purchase Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Purchase Id'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['purchase_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Id'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['vender_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Date'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['purchase_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase User'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['purchase_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reorder Level'); ?></dt>
		<dd>
			<?php echo h($purchaseStock['PurchaseStock']['Reorder_level']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Purchase Stock'), array('action' => 'edit', $purchaseStock['PurchaseStock']['y'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Purchase Stock'), array('action' => 'delete', $purchaseStock['PurchaseStock']['y']), null, __('Are you sure you want to delete # %s?', $purchaseStock['PurchaseStock']['y'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchase Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase Stock'), array('action' => 'add')); ?> </li>
	</ul>
</div>

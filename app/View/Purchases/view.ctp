<div class="purchases view">
<h2><?php echo __('Purchase'); ?></h2>
	<dl>
		<dt><?php echo __('Purchase Id'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['purchase_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Id'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['vender_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Date'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['purchase_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase User'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['purchase_user']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Purchase'), array('action' => 'edit', $purchase['Purchase']['purchase_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Purchase'), array('action' => 'delete', $purchase['Purchase']['purchase_id']), null, __('Are you sure you want to delete # %s?', $purchase['Purchase']['purchase_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('action' => 'add')); ?> </li>
	</ul>
</div>

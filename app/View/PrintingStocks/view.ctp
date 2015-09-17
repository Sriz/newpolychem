<div class="printingStocks view">
<h2><?php echo __('Printing Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printingStock['PrintingStock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printing Rawmaterialid'); ?></dt>
		<dd>
			<?php echo h($printingStock['PrintingStock']['printing_rawmaterialid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($printingStock['PrintingStock']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Balance'); ?></dt>
		<dd>
			<?php echo h($printingStock['PrintingStock']['balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue'); ?></dt>
		<dd>
			<?php echo h($printingStock['PrintingStock']['issue']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Stock'), array('action' => 'edit', $printingStock['PrintingStock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Stock'), array('action' => 'delete', $printingStock['PrintingStock']['id']), null, __('Are you sure you want to delete # %s?', $printingStock['PrintingStock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Stock'), array('action' => 'add')); ?> </li>
	</ul>
</div>

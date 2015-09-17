<div class="printingPatterns view">
<h2><?php echo __('Printing Pattern'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printingPattern['PrintingPattern']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pattern Name'); ?></dt>
		<dd>
			<?php echo h($printingPattern['PrintingPattern']['pattern_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Pattern'), array('action' => 'edit', $printingPattern['PrintingPattern']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Pattern'), array('action' => 'delete', $printingPattern['PrintingPattern']['id']), null, __('Are you sure you want to delete # %s?', $printingPattern['PrintingPattern']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Patterns'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Pattern'), array('action' => 'add')); ?> </li>
	</ul>
</div>

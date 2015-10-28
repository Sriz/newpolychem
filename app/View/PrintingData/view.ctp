<div class="printingData view">
<h2><?php echo __('Printing Datum'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printingDatum['PrintingDatum']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($printingDatum['PrintingDatum']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($printingDatum['PrintingDatum']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color Code'); ?></dt>
		<dd>
			<?php echo h($printingDatum['PrintingDatum']['color_code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Datum'), array('action' => 'edit', $printingDatum['PrintingDatum']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Datum'), array('action' => 'delete', $printingDatum['PrintingDatum']['id']), null, __('Are you sure you want to delete # %s?', $printingDatum['PrintingDatum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Data'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Datum'), array('action' => 'add')); ?> </li>
	</ul>
</div>

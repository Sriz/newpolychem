<div class="printingData index">
	<h2><?php echo __('Printing Data'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('dimension'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('color_code'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($printingData as $printingDatum): ?>
	<tr>
		<td><?php echo h($printingDatum['PrintingDatum']['id']); ?>&nbsp;</td>
		<td><?php echo h($printingDatum['PrintingDatum']['dimension']); ?>&nbsp;</td>
		<td><?php echo h($printingDatum['PrintingDatum']['color']); ?>&nbsp;</td>
		<td><?php echo h($printingDatum['PrintingDatum']['color_code']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $printingDatum['PrintingDatum']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printingDatum['PrintingDatum']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printingDatum['PrintingDatum']['id']), null, __('Are you sure you want to delete # %s?', $printingDatum['PrintingDatum']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Printing Datum'), array('action' => 'add')); ?></li>
	</ul>
</div>

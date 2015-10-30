<div class="dimensions index">
	<h2><?php echo __('Dimensions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('dimension'); ?></th>
			<th><?php echo $this->Paginator->sort('base'); ?></th>
			<th><?php echo $this->Paginator->sort('quality'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dimensions as $dimension): ?>
	<tr>
		<td><?php echo h($dimension['Dimension']['id']); ?>&nbsp;</td>
		<td><?php echo h($dimension['Dimension']['dimension']); ?>&nbsp;</td>
		<td><?php echo h($dimension['Dimension']['base']); ?>&nbsp;</td>
		<td><?php echo h($dimension['Dimension']['quality']); ?>&nbsp;</td>
		<td><?php echo h($dimension['Dimension']['color']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dimension['Dimension']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dimension['Dimension']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dimension['Dimension']['id']), null, __('Are you sure you want to delete # %s?', $dimension['Dimension']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Dimension'), array('action' => 'add')); ?></li>
	</ul>
</div>

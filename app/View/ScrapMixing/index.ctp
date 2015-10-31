<div class="mixingMaterials index">
	<h2><?php echo __('Mixing Materials'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('scrap_sent'); ?></th>
			<th><?php echo $this->Paginator->sort('weight'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scrapMixings as $scrapMixing): ?>
	<tr>
		<td><?php echo h($scrapMixing['ScrapMixing']['id']); ?>&nbsp;</td>
		<td><?php echo h($scrapMixing['ScrapMixing']['scrap_sent']); ?>&nbsp;</td>
		<td><?php echo h($scrapMixing['ScrapMixing']['weight']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $scrapMixing['ScrapMixing']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $scrapMixing['ScrapMixing']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scrapMixing['ScrapMixing']['id']), null, __('Are you sure you want to delete # %s?', $scrapMixing['ScrapMixing']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mixing Material'), array('action' => 'add')); ?></li>
	</ul>
</div>

<div class="table">
	<h2><?php echo __('Scrap Details'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
   			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('resuable'); ?></th>
			<th><?php echo $this->Paginator->sort('lumps_plates'); ?></th>
			<th><?php echo $this->Paginator->sort('total_scrap_generated'); ?></th>
			<th><?php echo $this->Paginator->sort('less_scrap_used'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scrapDetails as $scrapDetail): ?>
	<tr>

		<td><?php echo h($scrapDetail['ScrapDetail']['date']); ?>&nbsp;</td>
    	<td><?php echo h($scrapDetail['ScrapDetail']['shift']); ?>&nbsp;</td>
		<td><?php echo h($scrapDetail['ScrapDetail']['resuable']); ?>&nbsp;</td>
		<td><?php echo h($scrapDetail['ScrapDetail']['lumps_plates']); ?>&nbsp;</td>
		<td><?php echo h($scrapDetail['ScrapDetail']['total_scrap_generated']); ?>&nbsp;</td>
		<td><?php echo h($scrapDetail['ScrapDetail']['less_scrap_used']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $scrapDetail['ScrapDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $scrapDetail['ScrapDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scrapDetail['ScrapDetail']['id']), null, __('Are you sure you want to delete # %s?', $scrapDetail['ScrapDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Scrap Detail'), array('action' => 'add')); ?></li>
	</ul>
</div>

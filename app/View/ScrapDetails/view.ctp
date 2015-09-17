<div class="scrapDetails view">
<h2><?php echo __('Scrap Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resuable'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['resuable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lumps Plates'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['lumps_plates']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Scrap Generated'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['total_scrap_generated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Less Scrap Used'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['less_scrap_used']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($scrapDetail['ScrapDetail']['shift']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scrap Detail'), array('action' => 'edit', $scrapDetail['ScrapDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Scrap Detail'), array('action' => 'delete', $scrapDetail['ScrapDetail']['id']), null, __('Are you sure you want to delete # %s?', $scrapDetail['ScrapDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Scrap Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scrap Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>

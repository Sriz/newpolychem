<div class="scrapMains view">
<h2><?php echo __('Scrap Main'); ?></h2>
	<dl>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scap Quantity'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['scap_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Segregated Waste'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['segregated_waste']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Magnetic Waste'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['magnetic_waste']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scrap Out'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['scrap_out']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($scrapMain['ScrapMain']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scrap Main'), array('action' => 'edit', $scrapMain['ScrapMain']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Scrap Main'), array('action' => 'delete', $scrapMain['ScrapMain']['id']), null, __('Are you sure you want to delete # %s?', $scrapMain['ScrapMain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Scrap Mains'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scrap Main'), array('action' => 'add')); ?> </li>
	</ul>
</div>

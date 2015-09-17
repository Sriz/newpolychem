<div class="calenderScraps view">
<h2><?php echo __('Calender Scrap'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resuable'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['resuable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lamps Plates'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['lamps_plates']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Scrap Generated'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['total_scrap_generated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Less Scrap Used'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['less_scrap_used']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($calenderScrap['CalenderScrap']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calender Scrap'), array('action' => 'edit', $calenderScrap['CalenderScrap']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calender Scrap'), array('action' => 'delete', $calenderScrap['CalenderScrap']['id']), null, __('Are you sure you want to delete # %s?', $calenderScrap['CalenderScrap']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calender Scraps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calender Scrap'), array('action' => 'add')); ?> </li>
	</ul>
</div>

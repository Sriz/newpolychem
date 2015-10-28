<div class="calenderCprs view">
<h2><?php echo __('Calender Cpr'); ?></h2>
	<dl>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Embossing'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['embossing']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['Dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Length'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['length']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ntwt'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['ntwt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reusable'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['reusable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lumps Plates'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['lumps_plates']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Scrap Generated'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['total_scrap_generated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Less Scrap Used'); ?></dt>
		<dd>
			<?php echo h($calenderCpr['CalenderCpr']['less_scrap_used']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calender Cpr'), array('action' => 'edit', $calenderCpr['CalenderCpr']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calender Cpr'), array('action' => 'delete', $calenderCpr['CalenderCpr']['id']), null, __('Are you sure you want to delete # %s?', $calenderCpr['CalenderCpr']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calender Cprs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calender Cpr'), array('action' => 'add')); ?> </li>
	</ul>
</div>

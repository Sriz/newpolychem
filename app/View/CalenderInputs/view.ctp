<div class="calenderInputs view">
<h2><?php echo __('Calender Input'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Input'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['total_input']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Actual Raw Material'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['actual_raw_material']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DANA'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['DANA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Scrap'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['total_scrap']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($calenderInput['CalenderInput']['department_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calender Input'), array('action' => 'edit', $calenderInput['CalenderInput']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calender Input'), array('action' => 'delete', $calenderInput['CalenderInput']['id']), null, __('Are you sure you want to delete # %s?', $calenderInput['CalenderInput']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calender Inputs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calender Input'), array('action' => 'add')); ?> </li>
	</ul>
</div>

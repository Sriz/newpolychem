<div class="timeLosses view">
<h2><?php echo __('Time Loss'); ?></h2>
	<dl>
		<dt><?php echo __('Timeloss Id'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['timeloss_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wk Hrs'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['wk_hrs']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reasons'); ?></dt>
		<dd>
			<?php echo h($timeLoss['TimeLoss']['reasons']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Time Loss'), array('action' => 'edit', $timeLoss['TimeLoss']['timeloss_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Time Loss'), array('action' => 'delete', $timeLoss['TimeLoss']['timeloss_id']), null, __('Are you sure you want to delete # %s?', $timeLoss['TimeLoss']['timeloss_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Losses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Loss'), array('action' => 'add')); ?> </li>
	</ul>
</div>

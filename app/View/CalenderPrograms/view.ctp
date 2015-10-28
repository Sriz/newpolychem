<div class="calenderPrograms view">
<h2><?php echo __('Calender Program'); ?></h2>
	<dl>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Mtr'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['order_mtr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calenderProgram['CalenderProgram']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calender Program'), array('action' => 'edit', $calenderProgram['CalenderProgram']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calender Program'), array('action' => 'delete', $calenderProgram['CalenderProgram']['id']), null, __('Are you sure you want to delete # %s?', $calenderProgram['CalenderProgram']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calender Programs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calender Program'), array('action' => 'add')); ?> </li>
	</ul>
</div>

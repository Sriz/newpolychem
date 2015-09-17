<div class="calenderIrrs view">
<h2><?php echo __('Calender Irr'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emb'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['emb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mtr'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['mtr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kgs'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['kgs']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($calenderIrr['CalenderIrr']['department_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calender Irr'), array('action' => 'edit', $calenderIrr['CalenderIrr']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calender Irr'), array('action' => 'delete', $calenderIrr['CalenderIrr']['id']), null, __('Are you sure you want to delete # %s?', $calenderIrr['CalenderIrr']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calender Irrs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calender Irr'), array('action' => 'add')); ?> </li>
	</ul>
</div>

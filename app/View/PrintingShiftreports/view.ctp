<div class="printingShiftreports view">
<h2><?php echo __('Printing Shiftreport'); ?></h2>
	<dl>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PF Color'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['PF_Color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color Code'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['color_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['input']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Output'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['output']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unprinted Scrap'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['unprinted_scrap']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printed Scrap'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['printed_scrap']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Printed Scrap Reason'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['printed_scrap_reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unprinted Scrap Reason'); ?></dt>
		<dd>
			<?php echo h($printingShiftreport['PrintingShiftreport']['unprinted_scrap_reason']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Shiftreport'), array('action' => 'edit', $printingShiftreport['PrintingShiftreport']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Shiftreport'), array('action' => 'delete', $printingShiftreport['PrintingShiftreport']['id']), null, __('Are you sure you want to delete # %s?', $printingShiftreport['PrintingShiftreport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Shiftreports'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Shiftreport'), array('action' => 'add')); ?> </li>
	</ul>
</div>

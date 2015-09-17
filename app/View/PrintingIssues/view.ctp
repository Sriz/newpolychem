<div class="printingIssues view">
<h2><?php echo __('Printing Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printingIssue['PrintingIssue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($printingIssue['PrintingIssue']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material'); ?></dt>
		<dd>
			<?php echo h($printingIssue['PrintingIssue']['material']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pattern'); ?></dt>
		<dd>
			<?php echo h($printingIssue['PrintingIssue']['pattern']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($printingIssue['PrintingIssue']['quantity']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Issue'), array('action' => 'edit', $printingIssue['PrintingIssue']['printing_issueid'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Issue'), array('action' => 'delete', $printingIssue['PrintingIssue']['printing_issueid']), null, __('Are you sure you want to delete # %s?', $printingIssue['PrintingIssue']['printing_issueid'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Issue'), array('action' => 'add')); ?> </li>
	</ul>
</div>

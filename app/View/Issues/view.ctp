<div class="issues view">
<h2><?php echo __('Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Issue Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issue_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issued To'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issued_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issued By'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['issued_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['category_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Issue'), array('action' => 'edit', $issue['Issue']['issue_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Issue'), array('action' => 'delete', $issue['Issue']['issue_id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['issue_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?> </li>
	</ul>
</div>

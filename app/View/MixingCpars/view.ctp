<div class="mixingCpars view">
<h2><?php echo __('Mixing Cpar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supervisor Name'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['supervisor_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Operator Name'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['operator_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Noofcharge'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['noofcharge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Standard'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['standard']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blenderquality'); ?></dt>
		<dd>
			<?php echo h($mixingCpar['MixingCpar']['blenderquality']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mixing Cpar'), array('action' => 'edit', $mixingCpar['MixingCpar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mixing Cpar'), array('action' => 'delete', $mixingCpar['MixingCpar']['id']), null, __('Are you sure you want to delete # %s?', $mixingCpar['MixingCpar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mixing Cpars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mixing Cpar'), array('action' => 'add')); ?> </li>
	</ul>
</div>

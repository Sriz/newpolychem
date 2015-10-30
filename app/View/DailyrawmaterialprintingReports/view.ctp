<div class="dailyrawmaterialprintingReports view">
<h2><?php echo __('Dailyrawmaterialprinting Report'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cyclo'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['cyclo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mek'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['mek']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Toluene'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['toluene']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stabalizer890'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['stabalizer890']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pvc Regin'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['pvc_regin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finawax Vl'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['finawax_vl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Black  N 330'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['black _N_330']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blue 2764'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['blue_2764']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Green 2764'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['green_2764']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orange 1475K'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['orange_1475K']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Red 562'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['red_562']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Silver Paste'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['silver_paste']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TI02 A'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['TI02_A']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yellow 137k'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['yellow_137k']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gold'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['gold']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['other']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['total']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dailyrawmaterialprinting Report'), array('action' => 'edit', $dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dailyrawmaterialprinting Report'), array('action' => 'delete', $dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id']), null, __('Are you sure you want to delete # %s?', $dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dailyrawmaterialprinting Reports'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dailyrawmaterialprinting Report'), array('action' => 'add')); ?> </li>
	</ul>
</div>

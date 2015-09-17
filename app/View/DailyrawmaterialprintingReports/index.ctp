<div class="dailyrawmaterialprintingReports index">
	<h2><?php echo __('Dailyrawmaterialprinting Reports'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('cyclo'); ?></th>
			<th><?php echo $this->Paginator->sort('mek'); ?></th>
			<th><?php echo $this->Paginator->sort('toluene'); ?></th>
			<th><?php echo $this->Paginator->sort('stabalizer890'); ?></th>
			<th><?php echo $this->Paginator->sort('pvc_regin'); ?></th>
			<th><?php echo $this->Paginator->sort('finawax_vl'); ?></th>
			<th><?php echo $this->Paginator->sort('black _N_330'); ?></th>
			<th><?php echo $this->Paginator->sort('blue_2764'); ?></th>
			<th><?php echo $this->Paginator->sort('green_2764'); ?></th>
			<th><?php echo $this->Paginator->sort('orange_1475K'); ?></th>
			<th><?php echo $this->Paginator->sort('red_562'); ?></th>
			<th><?php echo $this->Paginator->sort('silver_paste'); ?></th>
			<th><?php echo $this->Paginator->sort('TI02_A'); ?></th>
			<th><?php echo $this->Paginator->sort('yellow_137k'); ?></th>
			<th><?php echo $this->Paginator->sort('gold'); ?></th>
			<th><?php echo $this->Paginator->sort('other'); ?></th>
			<th><?php echo $this->Paginator->sort('total'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dailyrawmaterialprintingReports as $dailyrawmaterialprintingReport): ?>
	<tr class="success">
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['cyclo']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['mek']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['toluene']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['stabalizer890']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['pvc_regin']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['finawax_vl']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['black _N_330']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['blue_2764']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['green_2764']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['orange_1475K']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['red_562']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['silver_paste']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['TI02_A']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['yellow_137k']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['gold']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['other']); ?>&nbsp;</td>
		<td><?php echo h($dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['total']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id']), null, __('Are you sure you want to delete # %s?', $dailyrawmaterialprintingReport['DailyrawmaterialprintingReport']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	
	<div id="myModal" class="modal fade" role="dialog">
	
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Daily Raw Material Printing Report </h4>
      </div>
      <div class="modal-body">
      <?php echo $this->Form->create(null,array(
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    ?>
	<fieldset>
			
		<?php
		echo $this->Form->input('cyclo',array('class'=>'input input-sm'));
		echo $this->Form->input('mek',array('class'=>'input input-sm'));
		echo $this->Form->input('toluene',array('class'=>'input input-sm'));
		echo $this->Form->input('stabalizer890',array('class'=>'input input-sm'));
		echo $this->Form->input('pvc_regin',array('class'=>'input input-sm'));
		echo $this->Form->input('finawax_vl',array('class'=>'input input-sm'));
		echo $this->Form->input('black _N_330',array('class'=>'input input-sm'));
		echo $this->Form->input('blue_2764',array('class'=>'input input-sm'));
		echo $this->Form->input('green_2764',array('class'=>'input input-sm'));
		echo $this->Form->input('orange_1475K',array('class'=>'input input-sm'));
		echo $this->Form->input('red_562',array('class'=>'input input-sm'));
		echo $this->Form->input('silver_paste',array('class'=>'input input-sm'));
		echo $this->Form->input('TI02_A',array('class'=>'input input-sm'));
		echo $this->Form->input('yellow_137k',array('class'=>'input input-sm'));
		echo $this->Form->input('gold',array('class'=>'input input-sm'));
		echo $this->Form->input('other',array('class'=>'input input-sm'));
		echo $this->Form->input('total',array('class'=>'input input-sm'));
	?>
		

	</fieldset>

      </div>
	   <div class="modal-footer">
              <?php echo $this->Form->end(__('Submit')); ?>
            </div>
     
    </div>

  </div>
</div>
	
	
	
	
	
	
</div>


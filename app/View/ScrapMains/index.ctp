<div class="scrapMains index">
	<h2><?php echo __('Scrap Mains'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('scap_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('segregated_waste'); ?></th>
			<th><?php echo $this->Paginator->sort('magnetic_waste'); ?></th>
			<th><?php echo $this->Paginator->sort('scrap_out'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scrapMains as $scrapMain): ?>
	<tr class="success">
		<td><?php echo h($scrapMain['ScrapMain']['id']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['date']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['type']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['scap_quantity']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['segregated_waste']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['magnetic_waste']); ?>&nbsp;</td>
		<td><?php echo h($scrapMain['ScrapMain']['scrap_out']); ?>&nbsp;</td>
		
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scrapMain['ScrapMain']['id']), null, __('Are you sure you want to delete # %s?', $scrapMain['ScrapMain']['id'])); ?>
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
        <h4 class="modal-title">Scrap Details</h4>
      </div>
      <div class="modal-body">
     <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'ScrapMains', 'action' => 'add'),
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
		echo $this->Form->input('date',array('type'=>'hidden','id'=>'datetime'));
		echo $this->Form->input('type',array('class'=>'form-control input-sm'));
		echo $this->Form->input('scap_quantity',array('class'=>'form-control input-sm'));
		echo $this->Form->input('segregated_waste',array('class'=>'form-control input-sm'));
		echo $this->Form->input('magnetic_waste',array('class'=>'form-control input-sm'));
		echo $this->Form->input('scrap_out',array('class'=>'form-control input-sm'));
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


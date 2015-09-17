<div class="venderDetails index">
	<h2><?php echo __('Vender Details'); ?>
	<?php
			echo'	<div class = "action" style="float:right;">'.
				'<button type="button" style="width: 150px;height: 30px;font-size: 16px;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add Vender</button>'.
				'</div>';		
	?>
	</h2>
	
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('vender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_name'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_location'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_mobile'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_email'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($venderDetails as $venderDetail): ?>
	<tr class="success">
		<td><?php echo h($venderDetail['VenderDetail']['vender_id']); ?>&nbsp;</td>
		<td><?php echo h($venderDetail['VenderDetail']['vender_name']); ?>&nbsp;</td>
		<td><?php echo h($venderDetail['VenderDetail']['vender_phone']); ?>&nbsp;</td>
		<td><?php echo h($venderDetail['VenderDetail']['vender_location']); ?>&nbsp;</td>
		<td><?php echo h($venderDetail['VenderDetail']['vender_mobile']); ?>&nbsp;</td>
		<td><?php echo h($venderDetail['VenderDetail']['vender_email']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $venderDetail['VenderDetail']['vender_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $venderDetail['VenderDetail']['vender_id']), null, __('Are you sure you want to delete # %s?', $venderDetail['VenderDetail']['vender_id'])); ?>
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
        <h4 class="modal-title">Add Vender Details</h4>
      </div>
      <div class="modal-body">
      <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'VenderDetails', 'action' => 'add'),
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
		echo $this->Form->input('vender_name',array('class'=>'form-control input-sm'));
		echo $this->Form->input('vender_phone',array('class'=>'form-control input-sm'));
		echo $this->Form->input('vender_location',array('class'=>'form-control input-sm'));
		echo $this->Form->input('vender_mobile',array('class'=>'form-control input-sm'));
		echo $this->Form->input('vender_email',array('class'=>'form-control input-sm'));
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


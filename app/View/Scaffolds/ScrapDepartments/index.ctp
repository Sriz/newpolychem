<div class="scrapDepartments index">
	<h2><?php echo __('Scrap Departments'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('quality_brand'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scrapDepartments as $scrapDepartment): ?>
	<tr class="success">
		<td><?php echo h($scrapDepartment['ScrapDepartment']['id']); ?>&nbsp;</td>
		<td><?php echo h($scrapDepartment['ScrapDepartment']['department_id']); ?>&nbsp;</td>
		<td><?php echo h($scrapDepartment['ScrapDepartment']['shift']); ?>&nbsp;</td>
		<td><?php echo h($scrapDepartment['ScrapDepartment']['date']); ?>&nbsp;</td>
		<td><?php echo h($scrapDepartment['ScrapDepartment']['quality_brand']); ?>&nbsp;</td>
		<td><?php echo h($scrapDepartment['ScrapDepartment']['quantity']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scrapDepartment['ScrapDepartment']['id']), null, __('Are you sure you want to delete # %s?', $scrapDepartment['ScrapDepartment']['id'])); ?>
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
        <h4 class="modal-title">Add Scrap </h4>
      </div>
      <div class="modal-body">
      <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'ScrapDepartments', 'action' => 'add'),
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
		echo $this->Form->input('department_id',array('class'=>'form-control input-sm','type'=>'hidden','id'=>'department'));
		echo $this->Form->input('shift',array('id'=>'shift','class'=>'form-control input-sm','type'=>'hidden'));
		echo $this->Form->input('date',array('class'=>'form-control input-sm','id'=>'datetime','type'=>'hidden'));
		echo $this->Form->input('quality_brand',array('class'=>'form-control input-sm','options'=>$opt));
	
		echo $this->Form->input('quantity',array('class'=>'form-control input-sm'));
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


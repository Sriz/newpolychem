<script>
function fetchdata()
	{
	 //var department;
	 var qty
	 //department = document.querySelector('#department').value;
	 //alert(department);
	 var x = document.getElementsByClassName('quality');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("quality");
    qty = e.options[e.selectedIndex].text;
 //x[i].value = strUser;
                     

    }
	var dataString = 'id='+ qty ;
        
    $.ajax
({
type: "POST",
url: "/polychem/CalenderIrrs/fetchdimension",
data: dataString,
cache: false,
success: function(html)
{
$(".dimension").html(html);
}
});
	
$.ajax
({
type: "POST",
url: "/polychem/CalenderIrrs/fetchcolor",
data: dataString,
cache: false,
success: function(html)
{
$(".color").html(html);
}
});
      
	  
	$.ajax
({
type: "POST",
url: "/polychem/CalenderIrrs/fetchemb",
data: dataString,
cache: false,
success: function(html)
{
$(".emb").html(html);
}
});
      
        
	 
	}


</script>

<div class="calenderIrrs index">
	<h2><?php echo __('Calender Irrs'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('quality'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('dimension'); ?></th>
			<th><?php echo $this->Paginator->sort('emb'); ?></th>
			<th><?php echo $this->Paginator->sort('mtr'); ?></th>
			<th><?php echo $this->Paginator->sort('kgs'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($calenderIrrs as $calenderIrr): ?>
	<tr class="success">
		<td><?php echo h($calenderIrr['CalenderIrr']['id']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['date']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['quality']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['color']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['dimension']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['emb']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['mtr']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['kgs']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['remarks']); ?>&nbsp;</td>
		<td><?php echo h($calenderIrr['CalenderIrr']['department_id']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calenderIrr['CalenderIrr']['id']), null, __('Are you sure you want to delete # %s?', $calenderIrr['CalenderIrr']['id'])); ?>
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
        <h4 class="modal-title">Calender IRR</h4>
      </div>
      <div class="modal-body">
  <?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'CalenderIrrs', 'action' => 'add'),
	
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    ?>
 <fieldset enabled="enabled">
	<?php
	$date = date('d-m-Y');
		echo $this->Form->input('date',array('type'=>'text','value'=>$date,'class'=>'form-control input input-sm'));
		echo $this->Form->input('quality',array('class'=>array('quality','form-control input input-sm'),'options'=>$quality,'id'=>'quality','onchange'=>'fetchdata()'));
		echo $this->Form->input('dimension',array('class'=>'dimension input input-ms','id'=>'dimension','type'=>'select'));
		echo $this->Form->input('color',array('class'=>'color input input-ms','id'=>'color','type'=>'select'));
		
		echo $this->Form->input('emb',array('class'=>'emb input input-ms','id'=>'emb','type'=>'select'));
		echo $this->Form->input('mtr',array('class'=>'form-control input input-sm'));
		echo $this->Form->input('kgs',array('class'=>'form-control input input-sm'));
		echo $this->Form->input('remarks',array('class'=>'form-control input input-sm'));
		echo $this->Form->input('department_id',array('type'=>'hidden','id'=>'department','class'=>'input-ms'));
	?>
		
 </fieldset>
  <?php echo $this->Form->end(__('Submit')); ?>

      </div>
	   <div class="modal-footer">
            
            </div>
     
    </div>

  </div>
</div>
	
	
	
	
	
	
	
	
	
</div>


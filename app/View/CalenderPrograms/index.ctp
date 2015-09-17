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
url: "/polychem/CalenderPrograms/fetchdimension",
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
url: "/polychem/CalenderPrograms/fetchcolor",
data: dataString,
cache: false,
success: function(html)
{
$(".color").html(html);
}
});
      
        
	 
	}
</script>





<div class="calenderPrograms index">
	<h2><?php echo __('Calender Programs'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('quality'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('dimension'); ?></th>
			<th><?php echo $this->Paginator->sort('order_mtr'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($calenderPrograms as $calenderProgram): ?>
	<tr class="success">
		<td><?php echo h($calenderProgram['CalenderProgram']['id']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['department_id']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['date']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['quality']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['color']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['dimension']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['order_mtr']); ?>&nbsp;</td>
		<td><?php echo h($calenderProgram['CalenderProgram']['remarks']); ?>&nbsp;</td>
		
		<td class="actions">
			
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calenderProgram['CalenderProgram']['id']), null, __('Are you sure you want to delete # %s?', $calenderProgram['CalenderProgram']['id'])); ?>
		
		
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
</div>
<div id="myModal" class="modal fade" role="dialog">
	
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calendar Program</h4>
      </div>
      <div class="modal-body">
   <?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'CalenderPrograms', 'action' => 'add'),
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
		echo $this->Form->input('department_id',array('type'=>'hidden','id'=>'department','class'=>'input-ms'));
		echo $this->Form->input('date',array('type'=>'text','value'=>$date,'class'=>'form-control input-sm'));
		echo $this->Form->input('quality',array('class'=>array('form-control input-sm','quality'),'options'=>$quality,'id'=>'quality','onchange'=>'fetchdata()'));
		echo $this->Form->input('dimension',array('class'=>'dimension input-ms','id'=>'dimension','type'=>'select'));
		echo $this->Form->input('color',array('class'=>'color input-ms','id'=>'color','type'=>'select'));
		
		echo $this->Form->input('order_mtr',array('class'=>'form-control input-sm'));
		echo $this->Form->input('remarks',array('class'=>'form-control input-sm'));
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

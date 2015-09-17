<script>

         $(document).ready(function(){
              $('.search-query').nepaliDatePicker();
         });

	$(document).ready(function(){
    $("#search-query").focus(function(e){
        //$("span").css("display", "inline").fadeOut(2000);
		console.log("focus")
		showCalendarBox('search-query');
    });
});
</script>
<div class="requests index">
	<h2><?php echo __('Requests'); ?></h2>
			<?php
						echo '<table class="table" border="0px"><tr><td width="200px;">'.$this->Search->create('',array('class'=>'form-inline'));
						echo $this->Search->input('filter1',array('type'=>'text','class'=>'search-query','id'=>'search-query'));
						echo  '</td><td>'.$this->Search->end(__('Search',array('class'=>'btn btn-danger'), true)).'</td></tr></table>';
				?>
	<table cellpadding="0" cellspacing="0" class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('request_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th style="text-align:center"><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($requests as $request): ?>
	<tr class="table">
		<td><?php echo h($request['Request']['request_id']); ?>&nbsp;</td>
		<td><?php echo h($request['Request']['date']); ?>&nbsp;</td>
		<td><?php echo h($request['Request']['department_id']); ?>&nbsp;</td>
		<td class="xedit" id="<?php echo $request['Request']['request_id']?>" key="material_id"><?php echo h($request['Request']['material_id']); ?>&nbsp;</td>
		<td align="right" class="xedit" id="<?php echo $request['Request']['request_id']?>" key="quantity" ><?php echo h(number_format($request['Request']['quantity'])); ?>&nbsp;</td>
		<td style="text-align:center"><?php echo h($request['Request']['remarks']); ?>&nbsp;</td>
		<td><?php echo h($request['Request']['user_id']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $request['Request']['request_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $request['Request']['request_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $request['Request']['request_id']), null, __('Are you sure you want to delete # %s?', $request['Request']['request_id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Request'), array('action' => 'add')); ?></li>
	</ul>
	<script type="text/javascript">
jQuery(document).ready(function() {
        $.fn.editable.defaults.mode = 'inline';
        $('.xedit').editable();
		$(document).on('click','.editable-submit',function(){
			var key = $(this).closest('.editable-container').prev().attr('key');
var x = $(this).closest('.editable-container').prev().attr('id');
var y = $('.input-sm').val();
var z = $(this).closest('.editable-container').prev().text(y);

			$.ajax({
				url: "/polychem/Requests/ajaxupdate?id="+x+"&data="+y+'&key='+key,
				type: 'POST',
			success: function(s){
			if(s == 'status'){
			$(z).html(y);}
			if(s == 'error') {
			alert('Error Processing your Request!');}
			},
			error: function(e){
			alert('Error Processing your Request!!');
			}
			});
		});
});
</script>
</div>

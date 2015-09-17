<style>
	 .addbtn
	 {
	  bottom: 103px;
    left: 636px;
    position: relative;
    width: 137px;
	 }
	 .addbtnnew
	 {
	  bottom: 103px;
    left: 636px;
    position: relative;
    width: 137px;
	 }
	  
</style>
<script type="text/javascript">
	    
$(document).ready(function(){
	  $("#greenbox").hide();
	   $("#redbox").hide();
	$("#bluebox").hide();
	$("#pink").hide();
   
});
</script>
<script>
	
         $(document).ready(function(){
              $('#nepalidatepicker').nepaliDatePicker();
         });
   
	$(document).ready(function(){
    $("#nepalidatepicker").focus(function(e){
        //$("span").css("display", "inline").fadeOut(2000);
		console.log("focus")
		showCalendarBox('nepalidatepicker');
    });
});
	  
	function fetchdata()
{
var x = document.getElementsByClassName('dimension');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("dimension");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;	
}
 
  var dataString = 'id='+ strUser;
    $.ajax
({
type: "POST",
url: "/polychem/PrintingShiftreports/pfcolor",
data: dataString,
cache: false,
success: function(html)
{
$(".pfcolor").html(html);
}
});
	
	}
	function fetchcolor()
{
	var x = document.getElementsByClassName('dimension');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("dimension");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
}
  var y = document.getElementsByClassName('pfcolor');
for(i = 0; i < y.length; i++) {
	var z = document.getElementById("pfcolor");
var strUsr = z.options[z.selectedIndex].text;
  y[i].value = strUsr;	
}  
  var dataString = 'id='+ strUser + '&type=' + strUsr;
    $.ajax
({
type: "POST",
url: "/polychem/PrintingShiftreports/basecolor",
data: dataString,
cache: false,
success: function(html)
{
$(".colorcode").html(html);
}
});

	
	
	
	
}
	

</script>
<script>
	 function doi() {
		//  alert("hello");
		var val=$('#unprinted_scrap').val();
		//console.log(val);
if (val>=1) {
	// var r = confirm("Press Ok To add More Reason or Cancel to Add Single");
	bootbox.confirm({
        title: 'Unprinted Scrap Reason',
        message: 'Press Single To Add Single Reason or Press Multiple To add Multiple Reason',
        buttons: {
            'cancel': {
                label: 'Single',
                className: 'btn-default pull-left'
            },
            'confirm': {
                label: 'Multiple',
                className: 'btn-danger pull-right'
            }
        },
        callback: function(result) {
            if (result) {
                 $(".red").show();
                  $(".bluebox").hide();
            }
            else
            {
             $(".red").hide();
            $(".bluebox").show();
            }
        }
    });

	 }
	 else
	 {
	  $(".red").hide();
      $(".bluebox").hide();
	 }
	 }
	 
	  function doi1() {
		   var val=$('#printed_scrap').val();
		   if (val>=1) {

bootbox.confirm({
        title: 'Printed Scrap Reason',
        message: 'Press Single To Add Single Reason or Press Multiple To add Multiple Reason',
        buttons: {
            'cancel': {
                label: 'Single',
                className: 'btn-default pull-left'
            },
            'confirm': {
                label: 'Multiple',
                className: 'btn-danger pull-right'
            }
        },
        callback: function(result) {
            if (result) {
                 $(".green").show();
                  $(".pinkbox").hide();
            }
            else
            {
             $(".green").hide();
            $(".pinkbox").show();
            }
        }
    });

	 }
	 else
	 {
	  $(".green").hide();
      $(".pinkbox").hide();
	 }

	 }
	 
	</script>

<div class="printingShiftreports form">
<?php echo $this->Form->create(array('PrintingShiftreport','class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ))); ?>
	<fieldset>
		<legend><?php echo __('Add Printing Shiftreport'); ?></legend>
	<?php
		$date=date('d-m-Y');
		//print_r($dimension);
		echo $this->Form->input('date',array('type'=>'text','id'=>'nepalidatepicker','class'=>'form-control input-sm'));
		echo $this->Form->input('shift',array('options'=>array('A'=>'A','B'=>'B'),'class'=>'form-control input-sm'));
		echo $this->Form->input('dimension',array('id'=>'dimension','class'=>array('dimension','form-control input-sm'),'options'=>$dimension,'empty'=>'Please Select','onchange'=>'fetchdata()'));
		echo $this->Form->input('PF_Color',array('id'=>'pfcolor','class'=>array('pfcolor','form-control input-sm'),'type'=>'select','onchange'=>'fetchcolor()'));
		echo $this->Form->input('color_code',array('id'=>'colorcode','class'=>array('colorcode','form-control input-sm'),'type'=>'select'));
		echo $this->Form->input('input',array('class'=>'form-control input-sm'));
		echo $this->Form->input('output',array('class'=>'form-control input-sm'));
		echo $this->Form->input('unprinted_scrap',array('class'=>'form-control input-sm','id'=>'unprinted_scrap','onchange'=>'doi();'));
		echo '<div class="bluebox" id="bluebox">';
		echo $this->Form->input('unprinted_scrap_reason',array('id'=>'unprinted','class'=>'form-control input-sm unprinted','options'=>array('NULL'=>'Please Select',$unprinted))); 
		echo "</div>";
			echo '<div class="red box" id="redbox">';
		echo "<table class='table table-condensed'>";
		echo "<tr>";
		echo "<td>"; echo $this->Form->input('unprinted_reason_1',array('class'=>'form-control input-sm','label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label'),'options'=>array('Null'=>'Please Select',$unprinted))); echo "</td>";

		echo "<td>"; echo $this->Form->input('quantity1',array('class'=>'form-control input-sm','type'=>'text','value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label')));echo "</td>";


		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('unprinted_reason_2',array('class'=>'form-control input-sm','label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label'),'options'=>array('Null'=>'Please Select',$unprinted)));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity2',array('class'=>'form-control input-sm','value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label'),'type'=>'text'));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('unprinted_reason_3',array('class'=>'form-control input-sm','label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label'),'options'=>array('Null'=>'Please Select',$unprinted)));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity3',array('class'=>'form-control input-sm','value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label'),'type'=>'text'));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('unprinted_reason_4',array('class'=>'form-control input-sm','label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label'),'options'=>array('Null'=>'Please Select',$unprinted)));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity4',array('class'=>'form-control input-sm','value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label'),'type'=>'text'));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('unprinted_reason_5',array('class'=>'form-control input-sm','label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label'),'options'=>array('Null'=>'Please Select',$unprinted)));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity5',array('class'=>'form-control input-sm','value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label'),'type'=>'text'));
		echo "</tr>";
		echo "</table>";
		echo '</div>';
	
		echo $this->Form->input('department_id',array('id'=>'department','type'=>'hidden'));
		echo $this->Form->input('printed_scrap',array('class'=>'form-control input-sm','id'=>'printed_scrap','onchange'=>'doi1();'));
	   echo '<div class="pinkbox" id="pink">';
	    echo $this->Form->input('printed_scrap_reason',array('class'=>'form-control input-sm printed','id'=>'printed','options'=>array('Null'=>'Please Select',$printed)));
	echo "</div>";
	//	
		echo '<div class="green box" id="greenbox">';
		echo "<table class='table table-condensed'>";
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('printed_reason_1',array('options'=>array('Null'=>'Please Select',$printed),'label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity_1',array('value'=>'0','label' => array('text'=> 'quantity','value'=>'0','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('printed_reason_2',array('options'=>array('Null'=>'Please Select',$printed),'label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity_2',array('value'=>'0','label' => array('text'=> 'quantity','value'=>'0','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('printed_reason_3',array('options'=>array('Null'=>'Please Select',$printed),'label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity_3',array('value'=>'0','label' => array('text'=> 'quantity','value'=>'0','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo $this->Form->input('printed_reason_4',array('options'=>array('Null'=>'Please Select',$printed),'label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity_4',array('value'=>'0','label' => array('text'=> 'quantity','value'=>'0','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
	  	echo $this->Form->input('printed_reason_5',array('options'=>array('Null'=>'Please Select',$printed),'label' => array('text'=> 'Reason','class' =>'col-sm-2 control-label')));
	    echo "</td>";
		echo "<td>";
		echo $this->Form->input('quantity_5',array('value'=>'0','label' => array('text'=> 'quantity','class' =>'col-sm-2 control-label')));
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo '</div>';
		echo '<div class="addbtnnew"> <label></div>';
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printing Shiftreports'), array('action' => 'index')); ?></li>
	</ul>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unprinted Scrap Extended Reason</h4>
      </div>
      <div class="modal-body">
      <p> <?php echo $this->Form->create('LaminatingReasonOther',array(
	'url' => array('controller' => 'LaminatingReasonOthers', 'action' => 'add'),
	
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
	<fieldset>
		
	<?php
	$date=date('d-m-Y');
		echo $this->Form->input('date',array('value'=>$date));
		echo $this->Form->input('reason');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Printed Scrap Extended Reason</h4>
      </div>
      <div class="modal-body">
        <p>
		 <?php echo $this->Form->create('LaminatingReasonOther',array(
	'url' => array('controller' => 'LaminatingReasonOthers', 'action' => 'add'),
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
	<fieldset>
		
	<?php
	$date=date('d-m-Y');
		echo $this->Form->input('date',array('value'=>$date));
		echo $this->Form->input('reason');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

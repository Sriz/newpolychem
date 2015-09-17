<script>
	   $(document).ready(function(){
           			var value = ''
       			$('.nepalidate').nepaliDatePicker();
       			// Trigger On change/Selected event
       			$.onChangeDatepicker_Ravindra = function(selectedDate){
       				value = $("#nepalidate").val();
       				$('.datepicker').val(value);
       			}

       		});
$(document).on("change", ".qty1", function() {
    var sum = 0;
    $(".qty1").each(function(){
        sum += +$(this).val();
	  //alert("hello");
    });
    $(".total").val(sum);
});	  

</script>


<script>
	$( document ).ready(function() {
	
	var a="<?php
	$v=AuthComponent::user('role');	echo $v?>";
	var us="<?php
	$s=AuthComponent::user('username');	echo $s?>";
	    $('#department').val(a);
		$('#user').val(us);
		
});
	

 
	
</script>
<script type="text/javascript">


function test() {
	var x = document.getElementsByClassName('shift');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("shift");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
  console.log(strUser);
}
}

function qwt()
{
	var x = document.getElementsByClassName('quality');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("quality");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
}
  var y = document.getElementsByClassName('brand');
for(i = 0; i < y.length; i++) {
	var z = document.getElementById("brand");
var strUsr = z.options[z.selectedIndex].text;
  y[i].value = strUsr;	
}  
  var dataString = 'id='+ strUser + '&type=' + strUsr;
    $.ajax
({
type: "POST",
url: "/polychem/ConsumptionStocks/dimension",
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
url: "/polychem/ConsumptionStocks/color",
data: dataString,
cache: false,
success: function(html)
{
$(".color").html(html);
}
});

}

function dim()
{
	var x = document.getElementsByClassName('dimension');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("dimension");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
  /*code to populate color*/
  

  
  /*end of the code*/
}
var qt = document.getElementById("quality");
var q = qt.options[qt.selectedIndex].text;
var dim = document.getElementById("dimension");
var dmn = dim.options[dim.selectedIndex].text;
  
  color(q,dmn);
}

function color(a,b)
{
	var select;
	if (a=="Base MT" && b=="0.30 x 1950") {
		
		
	var x = document.getElementById("color");
    var option = document.createElement("option");
    option.text = "Black";
    x.add(option);
	}
	else if(a=="Base UT" && b=="0.30 x 1950")
	{
		var x = document.getElementById("color");
    var option = document.createElement("option");
    option.text = "Pink";
    x.add(option);
	}
	else {
		
	}
}

function colorchange()
{
	var x = document.getElementsByClassName('color');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("color");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
	
	
}
}
    
    
function brandchange()
{
	  //alert("hello");
var x = document.getElementsByClassName('brand');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("brand");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;	
}
 
  var dataString = 'id='+ strUser;
    $.ajax
({
type: "POST",
url: "/polychem/ConsumptionStocks/t",
data: dataString,
cache: false,
success: function(html)
{
$(".quality").html(html);
}
});
    
   

}

</script>
<div class="panel panel-primary">
	<div class="panel-heading"><strong><center>Consumption</center></strong></div>
	<div class="panel-body">
	<?php
$type=$this->Session->read("type");



	$date = date('d-m-Y');
	$nepdate;
	$brd;
	$qlty;
	$dime;
	$clr;
	//print'<pre>';print_r($datas);print'</pre>';die;
	foreach($datas as $data):
	$nepdate=$data['consumption_stock']['nepalidate'];
	$brd=$data['consumption_stock']['brand'];
	$qlty=$data['consumption_stock']['quality_id'];
	$dime=$data['consumption_stock']['dimension'];
	$clr=$data['consumption_stock']['color'];
	endforeach;

	// foreach($material_name as $material_name):
	// 	$mn=$material_name['mixing_materials']['name'];
	// endforeach;

	foreach ($material_name as $mn):
        $mname=$mn['mixing_materials'];
    endforeach;

    

	foreach ($brand as $key=>$b):
        $arr[trim($key)] = trim($b);
    endforeach;

//echo $material_name;
    // foreach($material_name as $mn):
    // 	$names=$mn['mixing_materials']['name'];
    // endforeach;
    $brand = $arr;
	echo $this->Form->input('nepalidate',array('id'=>'nepalidate','class'=>'input-ms nepalidate','onchange'=>'rest();','value'=>$nepdate));
	echo $this->Form->input('shift',array('options'=>array('A'=>'A','B'=>'B'),'id'=>'shift','class'=>'input-ms shift','onchange'=>'test()','default'=>$datas['0']['consumption_stock']['shift']));
	echo $this->Form->input('brand',array('id'=>'brand','class'=>'input-ms brand','onchange'=>'brandchange()','options'=>$brand,'default'=>$brd));
	echo $this->Form->input('quality_id',array('class'=>'input-ms quality','id'=>'quality','options'=>$tp,'onchange'=>'qwt()','default'=>$qlty));
	echo $this->Form->input('dimension',array('class'=>'input-ms dimension','id'=>'dimension','onchange'=>'dim()','options'=>$dn,'default'=>$dime));
	echo $this->Form->input('color',array('class'=>'input-ms color','id'=>'color','options'=>array('select'=>'select color'),'onchange'=>'colorchange()','options'=>$cl,'default'=>$clr,));

?>
<?php echo $this->Form->create(array(
										  'onsubmit' => 'return itsclicked;',
	
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('ConsumptionStock',array('onsubmit' => 'return itsclicked;')); ?>
	<fieldset>
		
	<?php
	$date = date('d-m-Y');
		$i=1;
	echo '<table class="table">';
	echo '<td>Material</td>';
	
// print "<pre>";
// print_r($datas);
// print "</pre>";die;
	  foreach ($datas as $data):

	echo '<tr>';
			
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.shift',array('class'=>'input-ms shiftm','id'=>'shiftm','type'=>'hidden','value'=>$data['consumption_stock']['shift']));
		echo '</td>';
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.brand',array('class'=>'brand input-ms','type'=>'hidden','value'=>$data['consumption_stock']['brand']));
		echo '</td>';
		echo '<td class="success">';
		// echo $this->Form->input('Consumption.'.$i.'.material_id',array('value'=>$material,'type'=>'text','readonly'=>'readonly','label'=>false ));
		// echo '</td>';
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.name',array('value'=>$data['mixing_materials']['name'],'type'=>'text','readonly'=>'readonly','label'=>false ));
		echo '</td>';
		echo '</td>';
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.nepali-date',array('type'=>'hidden','class'=>'datepicker input-ms','id'=>'datepicker','value'=>$data['consumption_stock']['nepalidate']));
		
		echo '</td>';
		
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.date',array('type'=>'hidden','class'=>'date input-ms','id'=>'datepicker','value'=>$data['consumption_stock']['date']));
		
				
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.quality_id',array('type'=>'hidden','class'=>'quality input-ms','value'=>$data['consumption_stock']['quality_id']));
		
		echo '</td>';
		
		
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.dimension',array('type'=>'hidden','class'=>'dimension input-ms','value'=>$data['consumption_stock']['dimension']));
		
		echo '</td>';
		
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.color',array('class'=>'color','type'=>'hidden','value'=>$data['consumption_stock']['color']));
		echo '</td>';
		
		echo '<td class="success">'; 
		// echo $this->Form->input('Consumption.'.$i.'.material_id',array('value'=>$mn['mixing_materials']['name'],'type'=>'text','readonly'=>'readonly','label'=>false ,'class'=>'input-ms'));
		echo '</td>';
		
		echo '<td class="success">';
		echo $this->Form->input('Consumption.'.$i.'.quantity',array('value'=>$data['consumption_stock']['quantity'],'label'=>false,'class'=>'qty1','tabindex'=>$i));
		echo '</td>';
		
		
		echo '<td class="success">';
				echo $this->Form->input('Consumption.'.$i.'.department_id',array('value'=>'mixing','type'=>'hidden','class'=>'input-ms'));
				echo '</td>';
				echo '<td class="success">';
				echo $this->Form->input('Consumption.'.$i.'.total',array('type'=>'hidden','class'=>'total','value'=>$data['consumption_stock']['total']));
				echo '</td>';
				echo '</tr>';
	$i=$i+1;
	endforeach;
	echo '</table>';
	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Consumption Stocks'), array('action' => 'index/sort:consumption_id/direction:asc')); ?></li>
	</ul>
</div>

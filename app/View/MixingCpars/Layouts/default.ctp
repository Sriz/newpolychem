<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $title_for_layout; ?> - <?php echo Configure::read('Application.name') ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<?php echo $this->Html->css(array('bootstrap.min', 'font-awesome/css/font-awesome.min','custom', 'sb-admin', 'style','jquery-ui','admin')); ?>
	<?php echo $this->CakeStrap->automaticCss(); ?>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
	<?php echo $this->Html->script('lib/jquery.min') ?>
	<?php echo $this->Html->script('lib/jquery-ui.min') ?>
		
	<?php echo $this->Html->script('lib/bootstrap-editable') ?>
	<?php echo $this->Html->script(array('lib/bootstrap.min', 'src/scripts.js')); ?>
	<?php echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');?>
	<style>
			.addbox {
       position: relative;
bottom: 46px;
left: 325px;
}
			
	</style>
	<script>
function showEdit(editableObj) {
			$(editableObj).css("background","#A83279");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#e65245 url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
	</script>

		<script>  
   $( document ).ready(function() {
	
	var a="<?php
	$v=AuthComponent::user('role');	echo $v?>";
	var us="<?php
	$s=AuthComponent::user('username');	echo $s?>";
	    $('#department').val(a);
		$('#user').val(us);
		var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$('#datetime').val(dt);
	var dn=dt.getHours();
	if (dn>12) {
			$('#shift').val("B");
			
	}
	else
	{
			$('#shift').val("A");
	}
});
$( document ).ready(function() {
$('#irow').click(function(){
    if($('#row').val()){
        $('#mtable tbody').append($("#mtable tbody tr:last").clone());
        $('#mtable tbody tr:last td:last').html($('#qty').val());
        $('#mtable tbody tr:last td:first').html($('#row').val());
    }else{alert('Enter Text');}
});
});

$( document ).ready(function() {
$('#irow1').click(function(){
    if($('#std').val()){
        $('#mtable1 tbody').append($("#mtable1 tbody tr:last").clone());
        $('#mtable1 tbody tr:last td:last').html($('#std').val());
        $('#mtable1 tbody tr:last td:first').html($('#row1').val());
		$('#mtable1 tbody tr:first td:last').html($('#blender').val());
		
    }else{alert('Enter Text');}
});
});


$( document ).ready(function() {
$('#timeloss').click(function(){
    if($('#row').val()){
        $('#mtable tbody').append($("#mtable tbody tr:last").clone());
        $('#mtable tbody tr:last td:last').html($('#row').val());
        $('#mtable tbody tr:last td:first').html($('#time').val());
    }else{alert('Enter Text');}
});
});


$(document).ready(function(){
       
  $('#mainTable').editableTableWidget();
  $('#textAreaEditor').editableTableWidget({editor: $('<textbox>')});
  window.prettyPrint && prettyPrint();

})
		
		
		
			
</script>


	
</head>
<body class="<?php echo $this->params->params['controller'].'_'.$this->params->params['action']?>">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser
	today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better
	experience this site.</p>
<![endif]-->


<div id="wrapper">

	<?php echo $this->element('nav')?>

	<div id="page-wrapper">

		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<?php echo $this->CakeStrap->automaticScript(); ?>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<script>
	
	
	
	
</script>

</body>
</html>

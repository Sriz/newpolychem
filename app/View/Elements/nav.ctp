<?php if(!Configure::read('Application.maintenance')){?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php echo $this->Html->link(
			Configure::read('Application.name'),
			AuthComponent::user('id') ? "/home" : "/"
			, array('class' => 'navbar-brand')) ?>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">

		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='admin'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'users' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Users <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>users"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>users/add"><i class="fa fa-plus"></i> Register new user</a></li>
					</ul>
				</li>
				
				<li class="dropdown <?php echo $this->params->params['controller'] == 'users' ? '' : ''?>"></li>
					<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Settings<b
							class="caret"></b></a> -->
				<li><a href="<?php echo $this->params->webroot?>PrintingPatterns"><i class="fa fa-plus"></i>Printing Patterns</a></li>
				<li><a href="<?php echo $this->params->webroot?>CategoryPrinting"><i class="fa fa-plus"></i>Printing Material Category</a></li>
				<li><a href="<?php echo $this->params->webroot?>MixingMaterials"><i class="fa fa-plus"></i>Mixing Materials</a></li>
				<li><a href="<?php echo $this->params->webroot?>CategoryMaterials"><i class="fa fa-plus"></i>Mixing Material Category</a></li>
				<li><a href="<?php echo $this->params->webroot?>Products"><i class="fa fa-plus"></i>Laminating Color</a></li>
				<li><a href="<?php echo $this->params->webroot?>BaseEmbosses"><i class="fa fa-plus"></i>Calendar Color</a></li>
			
				<li><a href="<?php echo $this->params->webroot?>PrintingData"><i class="fa fa-plus"></i>Printing Color</a></li>	
				<li><a href="<?php echo $this->params->webroot?>TimeLossReasons"><i class="fa fa-plus"></i>TimeLoss Reason</a></li>				
				<li><a href="<?php echo $this->params->webroot?>LaminatingReasons"><i class="fa fa-plus"></i>Laminating Reason</a></li>
				<li><a href="<?php echo $this->params->webroot?>DimensionTarget"><i class="fa fa-plus"></i>Dimension Target</a></li>

				
				<li><a href="<?php echo $this->params->webroot?>PrintDimensionTarget"><i class="fa fa-plus"></i>Print Dimension Target</a></li>
				<li><a href="#"><i class="fa fa-plus"></i>Empty</a></li>
				
			</ul>
		<?php } ?>
		
		
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='store'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'Requests' ?>"><a href="<?php echo $this->params->webroot?>Requests"><i class="fa fa-dashboard"></i> Purchase Request</a></li>
			
				<li class="<?php echo $this->params->params['controller'] == 'Issues' ?>"><a href="<?php echo $this->params->webroot?>Issues"><i class="fa fa-dashboard"></i> Issues</a></li>
				<li class="<?php echo $this->params->params['controller'] == 'PurchaseStocks' ?>"><a href="<?php echo $this->params->webroot?>PurchaseStocks/stock"><i class="fa fa-dashboard"></i> View Stock</a></li>
				<li class="<?php echo $this->params->params['controller'] == 'Purchases' ?>"><a href="<?php echo $this->params->webroot?>Purchases"><i class="fa fa-dashboard"></i> Add</a></li>
				<li class="<?php echo $this->params->params['controller'] == 'VenderDetails' ?>"><a href="<?php echo $this->params->webroot?>VenderDetails"><i class="fa fa-dashboard"></i> Vender </a></li>	
				<li class="<?php echo $this->params->params['controller'] == 'Materisla' ?>"><a href="<?php echo $this->params->webroot?>Materials"><i class="fa fa-dashboard"></i> Material </a></li>
				<li class="<?php echo $this->params->params['controller'] == 'Categories' ?>"><a href="<?php echo $this->params->webroot?>Categories"><i class="fa fa-dashboard"></i> Category</a></li>
				
			</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='printing'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'PrintingShiftreports' ?>"><a href="<?php echo $this->params->webroot?>PrintingShiftreports/index/sort:date/direction:desc"><i class="fa fa-dashboard"></i> Daily Printing Shift </a></li>
				<li class="<?php echo $this->params->params['controller'] == 'TimeLosses' ?>"><a href="<?php echo $this->params->webroot?>TimeLosses/index/sort:nepalidate/direction:desc"><i class="fa fa-dashboard"></i> Time Loss</a></li>
				<li class="<?php echo $this->params->params['controller'] == 'PrintingIssues' ?>"><a href="<?php echo $this->params->webroot?>TblPrintingIssues/index/sort:id/direction:desc"><i class="fa fa-dashboard"></i> Printing Mixing Report</a></li>
			</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='scrap'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'ScrapMains' ?>"><a href="<?php echo $this->params->webroot?>ScrapMains"><i class="fa fa-dashboard"></i> Scrap Report</a></li>
			
				
				
			</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='laminating'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'ProductionShiftreports' ?>"><a href="<?php echo $this->params->webroot?>ProductionShiftreports/index/sort:date/direction:desc"><i class="fa fa-dashboard"></i> Production Shift Report</a></li>
			   <li class="<?php echo $this->params->params['controller'] == 'TimeLosses' ?>"><a href="<?php echo $this->params->webroot?>TimeLosses/index/sort:nepalidate/direction:desc"><i class="fa fa-dashboard"></i> Time Loss</a></li>
				
				
			</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='calender'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'CalenderCprs' ?>"><a href="<?php echo $this->params->webroot?>CalenderCprs/index/sort:id/direction:desc"><i class="fa fa-dashboard"></i> Calendar Production Report</a></li>
				
				<li class="<?php echo $this->params->params['controller'] == 'TimeLosses' ?>"><a href="<?php echo $this->params->webroot?>TimeLosses/index/sort:nepalidate/direction:desc"><i class="fa fa-dashboard"></i> Time Loss</a></li>
	<li class="<?php echo $this->params->params['controller'] == 'CalenderScraps' ?>"><a href="<?php echo $this->params->webroot?>CalenderScraps/index/sort:date/direction:desc"><i class="fa fa-dashboard"></i>Scrap Details</a></li>

						</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		<?php if(AuthComponent::user('id') and AuthComponent::user('role')=='mixing'){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="<?php echo $this->params->params['controller'] == 'ConsumptionStocks' ?>"><a href="<?php echo $this->params->webroot?>TblConsumptionStocks/index"><i class="fa fa-dashboard"> Consumption</i></a></li>

			</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>
		
		
		
		
		
		



		<?php if(AuthComponent::user('id')){?>

		<ul class="nav navbar-nav navbar-right navbar-user">
			<li class="dropdown user-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo AuthComponent::user('username')?> <b
						class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo $this->params->webroot?>me"><i class="fa fa-user"></i> Profile</a></li>
					<li><a href="<?php echo $this->params->webroot?>me/edit"><i class="fa fa-gear"></i> Settings</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo $this->params->webroot?>logout"><i class="fa fa-power-off"></i> Log Out</a></li>
				</ul>
			</li>
		</ul>
		<?php }?>
	</div>
	<!-- /.navbar-collapse -->
</nav>
<?php } ?>

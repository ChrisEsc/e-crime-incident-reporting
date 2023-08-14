<body>
	<div class="wrapper">
		<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-4.jpg">
			<div class="sidebar-wrapper">
				<div class="logo">
					<a href="#" class="simple-text">e-Crime Incident Reporting System
					</a>
				</div>
				<ul class="nav">
					<li class="active">
                        <a id="crimeslist" data-toggle="collapse" href="#" class="" aria-expanded="true" data-target="#sidebar-priority-code-all">
                            <p id="sidebarpriorityname">All Crimes<span><b class="caret"></b></span></p>
                        </a>
                        <?php include("allcrimes.php"); ?>
                    </li>
				</ul>
			</div>
		</div>

		<div class="main-panel">
			<nav class="navbar navbar-default navbar-fixed">
				<div class="container-fluid">
					<div class="navbar-header">
						<a id="reloadMarkers" class="navbar-brand" href="#">Amhara Region</a>
					</div>
					<div class="collapse navbar-collapse">
	                    <ul class="nav navbar-nav navbar-right">
	                        <li class="dropdown" id="priorityCodes">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p id="navbarpriorityname">All Crimes<b class="caret"></b>
									</p>
	                            </a>
	                            <ul id="navbardropdown" class="dropdown-menu">
	                                <li><a id="priority-code-1" href="#">Priority Code 1</a></li>
	                                <li><a id="priority-code-2" href="#">Priority Code 2</a></li>
	                                <li><a id="priority-code-3" href="#">Priority Code 3</a></li>
	                                <li class="divider"></li>
	                                <li><a id="priority-code-all" href="#">All Crimes</a></li>
	                            </ul>
	                        </li>
							<li class="separator hidden-lg hidden-md"></li>
	                    </ul>
                	</div>
				</div>
			</nav>
			<div id="map"></div>
		</div>
	</div>

	
</body>

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<script type="text/javascript"> 
        <?php include_once("dashboard_functions.js"); ?>
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZxSOt3SpqiSw4SyQu9IwGmBmleBG62DM&callback=initMap" async defer>
  	</script>

</html>
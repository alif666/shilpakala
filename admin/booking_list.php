<?php 
session_start();	
if(empty($_SESSION['UserId'])){
	header("Location: index");
	die();
}
include_once('functions.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<body>



</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link type="text/css" rel="stylesheet" href="style.css"/>
		<script src="jquery.min.js"></script>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo "Shilpakala Admin"?></title>

	
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="maxcdnbootstrapcdn/font-awesome/4.4.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->
		<link rel="stylesheet" href="dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="dist/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="dist/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="dist/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="dist/js/html5shiv.min.js"></script>
		<script src="dist/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<?php require"header.php"; ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<?php require"leftmenu.php"; ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">HallBooking</a>
							</li>
							<li class="active">Hall Booking  List</li>
						</ul><!-- /.breadcrumb -->

						<!--<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>--><!-- /.nav-search -->
					</div>

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								<?php echo isset($_REQUEST["msg"])? $_REQUEST["msg"]:"Hall Booking List"; ?>
								
							</h1>
						</div><!-- /.page-header -->

						

								<div class="row">
									<div class="col-xs-12">
										<!--<h3 class="header smaller lighter blue">jQuery dataTables</h3>-->

										<!--<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>-->
										<div class="table-header">
											Results for "Hall Booking"
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div id="calendar_div">
											<?php echo getCalender(); ?>
										</div>
								</div>

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
							
							<!--table result for hallbooking-->
								<h1><center>ALL BOOKING</center></h1>
								<?php
								include_once('connection/utility.php');
								$resultQuery=mysqli_query($conn,"SELECT * FROM hallbooking inner join events on hallbooking.hallbooking_id=events.title"); 
 ?>
								
								                        <div class="row">
															<div class="col-xs-12">
																<!--<h3 class="header smaller lighter blue">jQuery dataTables</h3>-->

																<!--<div class="clearfix">
																	<div class="pull-right tableTools-container"></div>
																</div>-->
																<div class="table-header">
																	Results for "Bookings"
																</div>

																<!-- div.table-responsive -->

																<!-- div.dataTables_borderWrap -->
																<div>
																	<table id="dynamic-table" class="table  table-striped table-bordered table-hover table-responsive">
																		 <thead>
																			<tr >
																			  <th width="40" align="center" ><strong>SL</strong></th>
																			  <th><strong>Booking Id</strong></th>
																			  <th><strong>Hallname</strong></th>
																			  <th><strong>ApplicantName</strong></th>
																			  <th><strong>Designation</strong></th>
																			  <th><strong>Telephone</strong></th>
																			  <th><strong>Email</strong></th>
																			  <th><strong>Organization</strong></th>
																			  <th><strong>Organization Head</strong></th>
																			  <th><strong>Date</strong></th>

																			</tr>
																	 </thead>
																	 <tbody>
																	<?php
																			
																	$sl=0;
																	
																	 while($resultRow=mysqli_fetch_array($resultQuery))
										
																	{		
																	  ++$sl;
							   
																	?>
																			<tr>
																			  <td  align="center"><?php echo $sl; ?></td>
																			  <td ><?php echo $resultRow['hallbooking_id'];?></td>
																			  <td ><?php echo $resultRow['hallname'];?></td>
																			  <td ><?php echo $resultRow['applicant_name'];?></td>
																			  <td><?php echo $resultRow['designation'];?></td>
																			  <td><?php echo $resultRow['telephone'];?></td>
																			  <td><?php echo $resultRow['applicant_email'];?></td>
																			  <td><?php echo $resultRow['organization'];?></td>
																			  <td><?php echo $resultRow['organization_head'];?></td>
																			  <td><?php echo $resultRow['date'];?></td>

																			</tr>
																			  <?php } ?>
																			   
																		</tbody>
																	</table>
																</div>
															</div>
														</div>

														<!-- PAGE CONTENT ENDS -->
											</div><!-- /.col -->
								
								
							<!--table Result for hallbooking ends-->
							
							
							
							
							
							
							
							
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php require"footer.php"; ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="ajaxgoogleapis/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='dist/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="netdnabootstrapcdn/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="dist/js/dataTables/jquery.dataTables.min.js"></script>
		<script src="dist/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
		<script src="dist/js/dataTables/extensions/buttons/dataTables.buttons.min.js"></script>
		<script src="dist/js/dataTables/extensions/buttons/buttons.flash.min.js"></script>
		<script src="dist/js/dataTables/extensions/buttons/buttons.html5.min.js"></script>
		<script src="dist/js/dataTables/extensions/buttons/buttons.print.min.js"></script>
		<script src="dist/js/dataTables/extensions/buttons/buttons.colVis.min.js"></script>
		<script src="dist/js/dataTables/extensions/select/dataTables.select.min.js"></script>

		<!-- ace scripts -->
		<script src="dist/js/ace-elements.min.js"></script>
		<script src="dist/js/ace.min.js"></script>
		
		<!-- inline scripts related to this page -->
        		<script>

					function ConfirmDelete(id)
					{
					   //alert(""+id);
						var result = confirm("Are you sure you want to Delete this Slide?");
						if (result==true)
						{
							window.location = "file_list?del=ok&FileID="+id;
						}
					}
			</script>
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: true,
					"aoColumns": [
					  { "bSortable": false },
					  null, null, null, null, null, null,null, null,null, 
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					"bPaginate": true,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					"iDisplayLength": 50,
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
			
			})
		</script>
	</body>


</html>

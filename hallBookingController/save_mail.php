<?php
session_start();
if(empty($_SESSION['UserId'])){
	header("Location: index");
	die();
}
include '../admin/connection/utility.php';
require_once('mpdf60/mpdf.php');
$pdf = new mPDF();
$hallBookingId = $_POST['hallbooking_id'];
$applicantsEmail = $_POST['applicants_email'];

$resultQuery=mysqli_query($conn,"SELECT * FROM `hallbooking` WHERE hallbooking.hallbooking_id='".$hallBookingId."'"); 
	while($resultRow=mysqli_fetch_array($resultQuery)){
		$hallBookingId = $resultRow['hallbooking_id'];
		$hallname = $resultRow['hallname']; 
		$applicantName = $resultRow['applicant_name']; 
		$designation = $resultRow['designation'];
		$telephone = $resultRow['telephone'];
		$applicantsEmail = $resultRow['applicants_email'];
		$organization = $resultRow['organization'];
		$organizationHead = $resultRow['organization_head'];
		$organizationHeadTel = $resultRow['organization_head_telephone'];
		$organizationHeadDesignation = $resultRow['organization_head_designation'];
		$nameOfDrama = $resultRow['name_of_drama'];
		$writerName  = $resultRow['writer_name'];
		
		$director  = $resultRow['director'];
		$productionDuration  = $resultRow['production_duration'];
		$startDate  = $resultRow['start_date'];
		$endDate  = $resultRow['end_date'];
		$totalStageShow  = $resultRow['total_stage_show'];
		$beforeDiscussion = $resultRow['before_discussion'];
	}
	
	//getting hall use time
	$hallusetime ='';
	$resultQuery1=mysqli_query($conn,"SELECT * FROM `hallusetime` WHERE hallusetime.hallbooking_id='".$hallBookingId."'"); 
	while($resultRow1=mysqli_fetch_array($resultQuery1)){
			$hallusetime = $hallusetime."  ".$resultRow1['hall_use_time'];
	}

	//getting hall use time ends
	
	//production type starts
	$productionType ='';
	$resultQuery2=mysqli_query($conn,"SELECT * FROM `productiontype` WHERE productiontype.hallbooking_id='".$hallBookingId."'"); 
	while($resultRow2=mysqli_fetch_array($resultQuery2)){
			$productionType = $productionType." ".$resultRow2['production_type'];
	}
	//production type ends here
	
$html = '
<style>
/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #333;
	padding: 0px 10px;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
img{
	height :100px;
}
h1{
	color: #eee;
}
/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Style the content */
.content {
    background-color: #ddd;
    padding: 50px;
    height: 400px; /* Should be removed. Only for demonstration */
}

/* Style the footer */
.footer {
    background-color: #333;
}
</style>
<div class="topnav">
  <a href="#"><img src = "sticky-logo.png"></a>
  <center><h1>    Booking ID : '.$hallBookingId.'</h1></center>
</div>
<div class="content">
  <h2>Booking Information</h2>
	  <p>
		<table cellspacing ="6px">
			<tr>
			<td>Name :
				'.$applicantName.'</td>
			</tr>
			<tr>
				<td>Hall Name:
					'.$hallname.'</td>
			</tr>
			<tr>
				<td>Email : 
					'.$applicantsEmail.'</td>
				<td>Designation :
					'.$designation.'</td>
				<td>Telephone :
					'.$telephone.'</td>
				
			</tr>
			<tr>
				<td>Organization :
					'.$organization.'</td>
				<td>Organizaion Head:
					'.$organizationHead.'</td>
				<td>Tel :
					'.$organizationHeadTel.'</td>
			</tr>
			<tr>
				<td>Name Of Drama :
					'.$nameOfDrama.'</td>
				<td>Writers Name :
					'.$writerName.'</td>
				<td>Total Stage Show :
					'.$totalStageShow.'</td>
			</tr>
			<tr>
				<td>Starting DATE :
					'.$hallBookingId.'</td>
				<td>Hall Use Time :
					'.$hallBookingId.'</td>
			</tr>
			<tr>
				<td>Production Type : 
					'.$startDate.'</td>
				<td>Before Discussion :
					'.$beforeDiscussion.'</td>
			</tr>

		</table>
	  </p>
</div>
';
//Code to generate PDF file from options above
$pdf->WriteHTML($html); // html body ta pdf e add korar jonno
$filename="my_pdfs/".$hallBookingId.".pdf";
$pdfdoc = $pdf->Output($filename,'F');
//$pdfname = $hallBookingId.".pdf";

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Booking</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}

body {
  margin: 0;
}

/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #333;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
img{
	height :100px;
}
h1{
	color: #eee;
}
/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Style the content */
.content {
    background-color: #ddd;
    padding: 50px;
    height: 600px; /* Should be removed. Only for demonstration */
}

/* Style the footer */
.footer {
    background-color: #f1f1f1;
    padding: 10px;
}
</style>
</head>
<body>

<div class="topnav">
  <a href="#"><img src = "sticky-logo.png"></a>
  <h1>Booking ID : <?php echo$hallBookingId;?></h1>
</div>

<div class="content">
  <h2>Booking Information</h2>
	  <p>
		<table cellspacing = "35px">
			<tr>
				<td>Name :
					<?php echo$applicantName;?></td>
			</tr>
			<tr>
				<td>Hall Name:
					<?php echo$hallname ;?></td>
			</tr>
			<tr>
				<td>Email : 
					<?php echo$applicantsEmail;?></td>
				<td>Designation :
					<?php echo$designation;?></td>
				<td>Telephone :
					<?php echo$telephone;?></td>
				
			</tr>

			<tr>
				<td>Organization :
					<?php echo$organization ;?></td>
				<td>Organizaion Head:
					<?php echo$organizationHead;?></td>
				<td>Tel :
					<?php echo$organizationHeadTel;?></td>
			</tr>
			<tr>
				<td>Name Of Drama :
					<?php echo$nameOfDrama;?></td>
				<td>Writers Name :
					<?php echo$writerName;?></td>
				<td>Total Stage Show :
					<?php echo$totalStageShow;?></td>
			</tr>
			<tr>
				<td>Starting DATE :
					<?php echo$hallBookingId;?></td>
				<td>Hall Use Time :
					<?php echo$hallBookingId;?></td>
			</tr>
			<tr>
				<td>Production Type : 
					<?php echo$startDate;?></td>
				<td>Before Discussion :
					<?php echo$beforeDiscussion;?></td>
			</tr>
			
		
		
		</table>
	  </p>
</div>

<div class="footer">
  <p>Copyright@Bangladesh Shilpakala Academy   </p>
  
  <button onclick="myFunction()">Print this page</button>


</div>

</body>

<!--for printing-->
	<script>
	function myFunction() {
		window.print();
	}
	</script>

<!--for printing ends-->


</html>

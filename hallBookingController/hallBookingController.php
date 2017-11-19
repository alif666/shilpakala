<?php
include ("../admin/connection/utility.php");
require_once('PHPMailer-master/class.phpmailer.php');


$hallName = $_POST['hall_name'];
$applicantsEmail = $_POST['applicants_email'];

$applicantName = '';
if (!empty($_POST['applicants_name'])) {
	$applicantName = $_POST['applicants_name'];
}


$designation = '';
if (!empty($_POST['designation'])) {
	$designation = $_POST['designation'];
}


$telephone ='';
if (!empty($_POST['telephone'])) {
	$telephone = $_POST['telephone'];
}



$organization = '';
if (!empty($_POST['organization'])) {
	$organization = $_POST['organization'];
}


$address = '';
if (!empty($_POST['address'])) {
	$address = $_POST['address'];
}


$organizationHead = '';
if (!empty($_POST['organization_head'])) {
	$organizationHead = $_POST['organization_head'];
}


$organizationHeadTelephone = '';
if (!empty($_POST['organization_head_telephone'])) {
	$organizationHeadTelephone = $_POST['organization_head_telephone'];
}

$organizationHeadDesignation = '';
if (!empty($_POST['organization_head_designation'])) {
	$organizationHeadDesignation = $_POST['organization_head_designation'];
}



$nameOfDrama = '';
if (!empty($_POST['name_of_drama'])) {
	$nameOfDrama = $_POST['name_of_drama'];
}

$writerName = '';
if (!empty($_POST['writer_name'])) {
	$writerName = $_POST['writer_name'];
}

$director = '';
if (!empty($_POST['director'])) {
	$director = $_POST['director'];
}

$productionDuration ='';
if (!empty($_POST['production_duration'])) {
	$productionDuration = $_POST['production_duration'];
}


// echo str_replace("/","-",$_POST['start_date']);

//changing date format 
$startDate = date('Y-m-d', strtotime(str_replace("/","-",$_POST['start_date'])));
$endDate = date('Y-m-d', strtotime(str_replace("/","-",$_POST['end_date'])));




$hallUseTimes='';
$typeOfProductions = '';
$typesOfStages ='';


$totalStageShow='';
if (!empty($_POST['total_stage_show'])) {
	$totalStageShow = $_POST['total_stage_show'];
}


$beforeDiscussion='';
	if (!empty($_POST['before_discussion'])) {
		$beforeDiscussion = $_POST['before_discussion'];
	}
	
$hallBookingId = date("Ymdhis");

			//inserting in hallbooking
					$rs=mysqli_query($conn, "INSERT INTO hallbooking 
								(
								hallbooking_id,
								hallname,
								designation,
								telephone,
								organization ,
								address,
								organization_head ,
								organization_head_telephone,
								organization_head_designation, 
								name_of_drama ,
								writer_name,
								director,
								production_duration ,
								start_date,
								end_date,
								total_stage_show,
								before_discussion,
								applicant_name,
								applicants_email
								)
								VALUES
								(
								'".$hallBookingId."',
								'".$hallName."',
								'".$designation."',
								'".$telephone."',
								'".$organization."',
								'".$address."',
								'".$organizationHead."',
								'".$organizationHeadTelephone."',
								'".$organizationHeadDesignation."',
								'".$nameOfDrama."',
								'".$writerName."',
								'".$director."',
								'".$productionDuration."',
								'".$startDate."',
								'".$endDate."',
								'".$totalStageShow."',
								'".$beforeDiscussion."',
								'".$applicantName."',
								'".$applicantsEmail."'
								
								)"); 
			if($rs){
				//echo "insertion in hallbooking is successful";
			}else{
				echo "couldn't insert in hallbooking";
			}

								
			//inserting in hall booking ends
						//inserting in hallbooking
						$status = 1;
					$rs=mysqli_query($conn, "INSERT INTO events 
								(
								title,
								date,
								created,
								modified,
								status
								)
								VALUES
								(
								'".$hallBookingId."',
								'".$startDate."',
								'".$startDate."',
								'".$endDate."',
								'".$status."'
								)"); 
			if($rs){
				//echo "insertion in events is successful";
			}else{
				echo "couldn't insert in events";
			}

								
			//inserting in events ends
			
			
			
			


			//inserting in hall use time
			if (!empty($_POST['hall_use_time'])) {
				$hallUseTime = $_POST['hall_use_time'];
				foreach($hallUseTime as $key){
					$hallUseTimes.="  ".$key;
							$rs1=mysqli_query($conn, "INSERT INTO hallusetime 
								(
								hallbooking_id,
								hall_use_time ,
								hallname 
								)
								VALUES
								(
								'".$hallBookingId."',
								'".$key."',
								'".$hallName."'
								)");	
				}
				if($rs1){
				//echo "insertion in hallusetime  is successful";
				}else{
					echo "couldn't insert in hallusetime ";
				}
			}
			//inserting in hall use time ends








			//inserting in productionType
			if (!empty($_POST['production_type'])) {
				$productionType = $_POST['production_type'];
				foreach($productionType as $key){
					$typeOfProductions.="  ".$key; 
								$rs2=mysqli_query($conn, "INSERT INTO productiontype
									(
									hallbooking_id,
									production_type ,
									hallname 
									)
									VALUES
									(
									'".$hallBookingId."',
									'".$key."',
									'".$hallName."'
									)");	
				}
					if($rs2){
					//echo "insertion in productionType  is successful";
					}else{
						echo "couldn't insert in productionType ";
					}
			}
			//inserting in productionType ends







			//inserting in type of stage
			if (!empty($_POST['type_of_stage'])) {
				$typeOfStage = $_POST['type_of_stage'];
				foreach($typeOfStage as $key){
					$typesOfStages.="  ".$key;
								$rs3=mysqli_query($conn, "INSERT INTO typeofstage
									(
									hallbooking_id,
									type_of_stage ,
									hallname 
									)
									VALUES
									(
									'".$hallBookingId."',
									'".$key."',
									'".$hallName."'
									)");	
					}
					
					if($rs3){
					//echo "insertion in typeofstage  is successful";
					}else{
						echo "couldn't insert in typeofstage ";
					}
			}
			//inserting in type of stage ends

			echo "<br> your hall booking id is :".$hallBookingId;















//check whether all the value from form came into this page

/*echo "applicant name is ".$applicantName."<br>";
echo "designation is ".$designation."<br>";
echo "telephone is ".$telephone ."<br>";
echo "organization is ".$organization."<br>";
echo "address head is ".$address."<br>";
echo "organization head is ".$organizationHead."<br>";
echo "organization head telephone is ".$organizationHeadTelephone ."<br>";
foreach($productionType as $key){
	echo "production types are".$key."<br>";

}

echo "name of drama is ".$nameOfDrama."<br>";
echo "writer name is ".$writerName."<br>";
echo "director is ".$director."<br>";
echo "production duration is ".$productionDuration."<br>";

foreach($typeOfStage as $key){
	echo "types of stages are".$key."<br>";

}

echo "start date is ".$startDate."<br>";
echo "end date is ".$endDate."<br>";

foreach($hallUseTime as $key){
	echo "hall use time is ".$key."<br>";

}

echo "total stage show ".$totalStageShow."<br>";
echo "before discussion is ".$beforeDiscussion."<br>";*/

//check whether all the value from form came into this page ends 


$email = new PHPMailer(); // thik ase..........................
$email->From = "info@control.net"; // thik.......................


$email->AddAddress("enamulkarim97@gmail.com");
$email->AddAddress("aliflodi@gmail.com");
$email->AddAddress($applicantsEmail);


//Send HTML or Plain Text email
$email->isHTML(true); // thik............................................
$email->Subject   = 'Booking information Shilpakala BOOKING ID:'.$hallBookingId; //thik............................
$msg = '';

$msg='<!--mail form-->
<body>
	<div style ="padding:5px; border-style: solid;"> 
	<form class="form-horizontal  form_style" method="post" name="hall_national_theater_studio" action="hallBookingController/hallBookingController.php" style=" ">
							  
							  <div class="form-group" style ="padding:5px;">
								<h3>HALL BOOKING on : <label>"'.$hallName.'"</label></h3>
							<div class="col-sm-12">								
								 Name of Applicant: <label>"'.$applicantName.'"</label>
								</div>
							  </div>
							  
							  <div class="form-group>
								<div class="col-md-6" style ="padding:5px;">
								  Designation :<label>"'.$designation.'"</label>
								</div>
								<div class="col-md-6" style ="padding:5px;">
								  Telephone numbers :<label>"'.$telephone.'"</label>
								</div>

							  
							  <div class="form-group" style ="padding:5px;">
								<div class="col-sm-12">
								  Organization :<label>"'.$organization.'"</label>
								</div>
							  </div>
							  
							  <div class="form-group" style ="padding:5px;">
								<div class="col-sm-12">
								  Address :<label>"'.$address.'"</label>
								</div>
							 </div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
								  organization Head<label>"'.$organizationHead.'"</label>
								</div>
							  </div>
							  
							  <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
								  organization headtelephone number:<label>"'.$organizationHeadTelephone.'"</label>
								</div>
							 </div>
							 
							<div class="form-group"style ="padding:5px;">
								<div class="col-sm-11 check_style" style=""style ="padding:5px;">
								Type of productions:<br>
									<label>"'.$typeOfProductions.'"</label>
								</div>
							</div>
							
							<div class="form-group"style ="padding:5px;">
								<div class="col-sm-12"style ="padding:5px;">
								  Name of Drama: <label>"'.$nameOfDrama.'"</label>
								</div>
							 </div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12"style ="padding:5px;">
								  Writer name :<label>"'.$writerName.'"</label>
								</div>
							 </div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
								  Director name: <label>"'.$director.'"</label>
								</div>
							 </div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
								  Production Duration :<label>"'.$productionDuration.'"</label>
								</div>
							 </div>
							
							<div class="form-group"style ="padding:5px;">
								<div class="col-sm-11 check_style" style="">
								  Kind of Stage for Playing Drama<br>
									<label>"'.$typesOfStages.'"</label>
								</div>
							</div>
							  
							  <div class="form-group"style ="padding:5px;">
								  <div class="col-sm-11 check_style" style="">
										Expected Staging Date:<br><br>
										<div class=" col-sm-6" style ="padding:5px;">
										   Starting date: <label>"'.$startDate.'"</label>
										</div>
										
										<div class=" col-sm-6" style ="padding:5px;">
										   Ending date: <label>"'.$endDate.'"</label>
										</div>
								  </div>
								</div>
							  
							  
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-11 check_style" style="">
								  Time of Use:<br>
									<label>"'.$hallUseTimes.'"</label>
								</div>
							</div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
								  total Stage Show:<label>"'.$totalStageShow.'"</label>
								</div>
							 </div>
							 
							 <div class="form-group"style ="padding:5px;">
								<div class="col-sm-12">
									Before Discussion: <label>"'.$beforeDiscussion.'"</label></div>
							 </div>
						</form> 
						</div>
					</div>
	</body>';
$email->Body   = $msg; 


$email->Send();


?>






<?php echo $msg;?>

















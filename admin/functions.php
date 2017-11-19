<?php
/*
 * Function requested by Ajax
 */
if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		default:
			break;
	}
}

/*
 * Get calendar full HTML
 */
function getCalender($year = '',$month = '')
{
	$dateYear = ($year != '')?$year:date("Y");
	$dateMonth = ($month != '')?$month:date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </h2>
		<div id="event_list" class="none"></div>
		<div id="calender_section_top">
			<ul>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						$flag =0;
						//Current date
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						$eventNum = 0;
						//Include db configuration file
						include 'connection/dbConfig.php';
						//Get number of events based on the current date
						$result = $db->query("SELECT * FROM events INNER JOIN hallbooking ON events.title = hallbooking.hallbooking_id WHERE date = '".$currentDate."'");

						
						
						$eventNum = $result->num_rows;
						while($row = $result->fetch_assoc()){
							if($row['status']==1){
								$flag =1;
							}elseif($row['status']==2){
								$flag =2;
							}
							
						}
						//Define date cell color
							if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
								echo '<li date="'.$currentDate.'" class="grey date_cell">';
							}elseif($flag ==2){
								echo '<li date="'.$currentDate.'" class="light_red date_cell">';
							}elseif($flag ==1){
								echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
							}else{
								echo '<li date="'.$currentDate.'" class=" date_cell">';
							}
						
						//Date cell
						echo '<span>';
						echo $dayCount;
						echo '</span>';
						
						//Hover event popup
						echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo '<div class="popup_event">Events ('.$eventNum.')</div>';
						echo ($eventNum > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">view events</a>':'';
						echo '</div></div>';
						
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>
		</div>
	</div>

	<script type="text/javascript">
		function getCalendar(target_div,year,month){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getCalender&year='+year+'&month='+month,
				success:function(html){
					$('#'+target_div).html(html);
				}
			});
		}
		
		function getEvents(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getEvents&date='+date,
				success:function(html){
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}
		
		function addEvent(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=addEvent&date='+date,
				success:function(html){
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}
		
		$(document).ready(function(){
			$('.date_cell').mouseenter(function(){
				date = $(this).attr('date');
				$(".date_popup_wrap").fadeOut();
				$("#date_popup_"+date).fadeIn();	
			});
			$('.date_cell').mouseleave(function(){
				$(".date_popup_wrap").fadeOut();		
			});
			$('.month_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$('.year_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$(document).click(function(){
				$('#event_list').slideUp('slow');
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 10)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = ''){
	$options = '';
	for($i=2015;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}

/*
 * Get events by date
 */
function getEvents($date = ''){
	//Include db configuration file
	$bookingTime ='';
	include 'connection/dbConfig.php';
	$eventListHTML = '';
	$date = $date?$date:date("Y-m-d");
	//Get events based on the current date
	$result = $db->query("SELECT * FROM events INNER JOIN hallbooking ON events.title = hallbooking.hallbooking_id WHERE date = '".$date."'");
	if($result->num_rows > 0){
		$eventListHTML = '<h2>Events on '.date("l, d M Y",strtotime($date)).'</h2>';
		$eventListHTML .= '<ul>';
		while($row = $result->fetch_assoc()){
			$sql="SELECT * FROM hallusetime WHERE hallbooking_id='".$row['title']."'";
			$resultTime = $db->query($sql);	
			//traversing through hall use time table
			if($resultTime->num_rows > 0){
				while($row1 = $resultTime->fetch_assoc()) {
					$bookingTime .= $row1['hall_use_time'];
				}
			}
			
			//traversing through hall use time table ends
            if($row['status']==1){
			$eventListHTML .= '<li style = "border:2px;border-style: inset;padding : 5px;"><b>Hall Booking Id :</b>'.$row['hallbooking_id'].'<br><b><b>Hall name :</b>'.$row['hallname'].'<br><b> Applicant name :</b> '.$row['applicant_name'].'<br><b>Telephone :</b>'.$row['telephone'].' <br><b>Ending date :</b>'.$row['end_date'].'<br><b>Booking Time:</b>'.$bookingTime.
				'<br><div style=""><div style="margin-top:10px;"><form action = "../hallBookingController/approve_mail.php" method = "POST"><input type = "hidden" value = "'.$row['hallbooking_id'].'" name = "hallbooking_id"><input type = "hidden" value = "'.$row['applicants_email'].'" name = "applicants_email"><button type = "submit" class = "btn btn-info">APPROVE</button></form></div>
				<div style="margin-top:10px;"><form action ="../hallBookingController/deny_mail.php" method = "POST"><input type = "hidden" value = "'.$row['hallbooking_id'].'" name = "hallbooking_id"><input type = "hidden" value = "'.$row['applicants_email'].'" name = "applicants_email"><button type = "submit" class = "btn btn-info">Deny</button></form></div>
				<div style="margin-top:10px;"><form action ="../hallBookingController/save_mail.php" method = "POST"><input type = "hidden" value = "'.$row['hallbooking_id'].'" name = "hallbooking_id"><input type = "hidden" value = "'.$row['applicants_email'].'" name = "applicants_email"><button type = "submit" class = "btn btn-info">PRINT</button></form></div></div></li><li></li>';
			}else if($row['status']==2){
				$eventListHTML .= '<li style = "border:2px;border-style: inset;padding : 5px;"><h3>Approved Booking Order</h3><b>hall Booking :</b>'.$row['hallbooking_id'].'<br><b>hall name :</b>'.$row['hallname'].'<br><b> applicant name :</b> '.$row['applicant_name'].'<br><b>telephone :</b>'.$row['telephone'].' <br><b>ending date :</b>'.$row['end_date'].'<br><b>Booking Time:</b>'.$bookingTime.
				'<br>
				<br><form action = "../hallBookingController/save_mail.php" method = "POST"><input type = "hidden" value = "'.$row['hallbooking_id'].'" name = "hallbooking_id"><input type = "hidden" value = "'.$row['applicants_email'].'" name = "applicants_email"><button type = "submit" class = "btn btn-info">PRINT</button></form></li>';
			}
		}
		$eventListHTML .= '</ul>';
	}
	echo $eventListHTML;
}
?>
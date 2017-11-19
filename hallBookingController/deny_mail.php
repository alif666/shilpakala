<?php
session_start();
include '../admin/connection/utility.php';
require_once('PHPMailer-master/class.phpmailer.php');
$hallBookingId = $_POST['hallbooking_id'];
$applicantsEmail = $_POST['applicants_email'];
echo $hallBookingId;

$rs=mysqli_query($conn, "DELETE FROM `events` WHERE `title` ='".$hallBookingId."'");

echo $rs;

$email = new PHPMailer(); // thik ase..........................
$email->From = "info@control.net"; // thik.......................


$email->AddAddress("enamulkarim97@gmail.com");
$email->AddAddress("aliflodi@gmail.com");
$email->AddAddress($applicantsEmail);
//Send HTML or Plain Text email
$email->isHTML(true); // thik............................................
$email->Subject   = 'Booking information Shilpakala'; //thik............................
$msg = '';

$msg='<html><body><b>DENIED BOOKING<br>YOUR INVITATION FOR BOOKING HAS BEEN DENIED YOUR BOOKING ID : <label>"'.$hallBookingId.'"</label></b></body></html>';
$email->Body   = $msg; 


$email->Send();


echo "<script> window.location.href = '../admin/booking_list.php';</script>";


//header('Location: ../admin/booking_list.php');
?>
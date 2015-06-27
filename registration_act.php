<?php
	include_once("_lib/class.phpmailer.php");
	include_once("_lib/class.smtp.php");
	include_once("sendMail.php");
	include_once "dbconn.php";
	include_once "function.php";
	$project = "Tropicana The Residences";
	$title = $_POST['contact-title'];
	$name = $_POST['contact-name'];
	$address = $_POST['contact-mailingaddress1'];
	$address2 = $_POST['contact-mailingaddress2'];
	$tpc = $_POST['contact-ismember'];
	$investmentrange = $_POST['contact-investmentrange'];
	//$data = array();
	$postcode = $_POST['contact-postcode'];
	$area =  $_POST['contact-area'];
	$state =  $_POST['contact-state'];
	$country = $_POST['contact-country'];
	$email = $_POST['contact-email'];
	$contact = $_POST['contact-mobileno'];


	$gender = $_POST['contact-gender'];
	$occupation = $_POST['contact-occupation'];
	$age = $_POST['contact-agegroup'];
	/*$interested1 = $_POST['interested1'];
	$interested2 = $_POST['interested2'];
	$interested3 = $_POST['interested3'];
	$interested4 = $_POST['interested4'];
	$interested5 = $_POST['interested5'];
	$interested6 = $_POST['interested6'];
			
	$strInterestedArray = $interested1.", ".$interested2.", ".$interested3.", ".$interested4.", ".$interested5.", ".$interested6;*/
	$strInterested = $_POST["contact-interested"];
	/*while (list ($key,$val) = @each ($strInterested)) {
		$strInterestedArray .= "$val, ";
		$i++;
	}
	$strInterestedArray = $strInterestedArray."0";
	$strInterestedArray = str_replace(", 0","",$strInterestedArray); */
	$preference = $_POST['contact-preference'];
	$getknowus = $_POST['contact-knowus'];
	$remarks = $_POST['contact-remarks'];
	$strReceiveFutureEDMSMS	= $_POST["contact-subscribe"];
	$picemail = $_POST['contact-personinchargeemail'];
	$sub_time = date("H:i:s");
	$date = date("Y-m-d");
	$systemDateTime = $date." ".$sub_time;
	
	$len = rand(6, 6); 
	$randomID = substr(str_shuffle("0123456789"),0,$len);
	
	
	/*
	if (strlen($contact03) <= 6) {
	echo "number not valid";
	alert("Please enter a valid phone number");
	forward("javascript:history.back()");
	}
	*/

	if (strpos($name,'http') !== false || strpos($address,'http') !== false || strpos($email,'http') !== false || strpos($contact,'http') !== false || strpos($occupation,'http') !== false || strpos($remarks,'http') !== false) 
	{
	alert("Input error. Please do not input any URL in the form.");
	forward("javascript:history.back()");
	}
	
	if($name == '' || $address == '' || $email == '' || $contact == '' || $gender = '')
	{
	alert("Please fill up all the mandatory(*) fields.");
	forward("javascript:history.back()");
	}
	
	$check_duplicate = Database::getInstance() ->query("SELECT * FROM all_microsites_registrations WHERE Title = '$title' AND Name = '$name' AND Email = '$email' AND Gender = '$gender' AND project = '$project'");
	$count_row = mysql_num_rows($check_duplicate);
	
	if($count_row >= 1){
	alert("You have already registered. Thanks for the interest.");
	forward("javascript:history.back()");
	}
	
	$insert = Database::getInstance()->query("INSERT INTO all_microsites_registrations (Title, Name, Address1, Address2, Address3, Postcode, Area, State, Country, Email, Mobile, Age, Gender, Occupation, Preference, Interested, GetToKnowUs, Created_DateTime, remarks, uniqueID,ReceiveFutureEDMSMS, Project, PicEmail, Tpc, InvestmentRange) VALUES 
	('$title', '$name', '$address', '$address2', '', '$postcode', '$area', '$state', '$country', '$email', '$contact', '$age', '$gender', '$occupation', '$preference', '$strInterested', '$getknowus', '$systemDateTime','$remarks', '$randomID', '$strReceiveFutureEDMSMS', '$project', '$picemail', '$tpc', '$investmentrange')" );
	
	
	if (!$insert) {
		alert("Failed to insert into database.");
		forward("javascript:history.back()");
	}
	else 
	{ 
	$replySubject = "Greetings from ".$project."";
	$replyMessage .= "Dear $name, \r\n";
	$replyMessage .= "\n";	
	$replyMessage .= "Thank you for registering your interest in ".$project.". We will keep you updated with our latest progress. \n";
	$replyMessage .= "\n";
	$replyMessage .= "$systemDateTime";
	
    $sendingSubject = $replySubject;
	$sendingMessage = $replyMessage;
			
	$sendingAddress = array($name => $email);
	sendMail($sendingAddress, $sendingSubject, $sendingMessage);
		
	$adminSubject = "".$project." Future Launches Registration Form";
	$adminMessage .= "Title:  $title";	
	$adminMessage .= "\r\n";
	$adminMessage .= "Full Name: $name";
	$adminMessage .= "\r\n";
	$adminMessage .= "Email: $email";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Mobile: $contact";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Mailing Address Line1: $address";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Mailing Address Line2: $address2";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Postcode/Zip: $postcode";
	$adminMessage .= "\r\n";
	$adminMessage .= "Area: $area";
   	$adminMessage .= "\r\n";
	$adminMessage .= "State: $state";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Country: $country";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Age: $age";
	$adminMessage .= "\r\n";
	$adminMessage .= "Contact Preference: $preference";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Interested in: $strInterested";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Get to know us: $getknowus";
	$adminMessage .= "\r\n";
   	$adminMessage .= "Remarks: $remarks";
   	$adminMessage .= "\r\n";
	$adminMessage .= "Would you like to receive future updates from us : $strReceiveFutureEDMSMS\r\n";
 
	$adminMessage .= "$systemDateTime";
	$adminMessage .= "\r\n";
	$adminMessage .= "\r\n";
	$mailHeaders = "From:$emailAddress";

	$sendingAdminSubject = $adminSubject;
	$sendingAdminMessage = $adminMessage;
	$AdminName = "Registration Details";
    $mailTo = "enquiry@dijayacorp.com";
	$sendingAdminAddress = array($AdminName => $mailTo);
	sendMail($sendingAdminAddress, $sendingAdminSubject, $sendingAdminMessage);
	 
	 
	$picSubject = "".$project." Future Launches Registration Form";
	$picMessage .= "Title:  $title";	
	$picMessage .= "\r\n";
	$picMessage .= "Full Name: $name";
	$picMessage .= "\r\n";
	$picMessage .= "Email: $email";
   	$picMessage .= "\r\n";
	$picMessage .= "Mobile: $contact";
   	$picMessage .= "\r\n";
	$picMessage .= "Mailing Address Line1: $address";
   	$picMessage .= "\r\n";
	$picMessage .= "Mailing Address Line2: $address2";
   	$picMessage .= "\r\n";
	$picMessage .= "Postcode/Zip: $postcode";
	$picMessage .= "\r\n";
	$picMessage .= "Area: $area";
   	$picMessage .= "\r\n";
	$picMessage .= "State: $state";
   	$picMessage .= "\r\n";
	$picMessage .= "Country: $country";
   	$picMessage .= "\r\n";
	$picMessage .= "Age: $age";
	$picMessage .= "\r\n";
	$picMessage .= "Contact Preference: $preference";
   	$picMessage .= "\r\n";
	$picMessage .= "Interested in: $strInterested";
   	$picMessage .= "\r\n";
	$picMessage .= "Get to know us: $getknowus";
	$picMessage .= "\r\n";
   	$picMessage .= "Remarks: $remarks";
   	$picMessage .= "\r\n";
	$picMessage .= "Would you like to receive future updates from us : $strReceiveFutureEDMSMS\r\n";
 
	$picMessage .= "$systemDateTime";
	$picMessage .= "\r\n";
	$picMessage .= "\r\n";
	$mailHeaders = "From:$emailAddress";

	$sendingpicSubject = $picSubject;
	$sendingpicMessage = $picMessage;
	$picName = "Registration Details";
    $picmailTo = "$picemail";
	$sendingpicAddress = array($picName => $picmailTo);
	sendMail($sendingpicAddress, $sendingpicSubject, $sendingpicMessage);
	alert("Submitted successfully.");
	forward("register.html");
	?>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		
<?php 	
	}
?>
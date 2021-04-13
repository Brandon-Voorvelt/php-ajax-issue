<?php
// Declare Variables
	// User Details
	$fName = strip_tags(htmlspecialchars($_POST['fName'])); 	// Client First Name
	$lName = strip_tags(htmlspecialchars($_POST['lName']));	// Client Surname
	$phone = strip_tags(htmlspecialchars($_POST["phone"]));	// Client Phone Number
	$email = strip_tags(htmlspecialchars($_POST["email"]));	// Client Email Address - Must Sanitize first and then only validate
	
	// Delivery Details
	$del_from = strip_tags(htmlspecialchars($_POST["del_from"]));	// Collection Address
	$del_to = strip_tags(htmlspecialchars($_POST["del_to"]));		// Delivery Address
	$del_type = strip_tags(htmlspecialchars($_POST["del_type"]));	// Delivery Type = Economical, Next Day etc...

	// Package Details
	$pac_q = strip_tags(htmlspecialchars($_POST["pac_q"]));		//Package Quantity - Customer to give dimensions of largest package if > 1 !!
	$pac_size = strip_tags(htmlspecialchars($_POST["pac_size"]));		//Package Width
	$pac_weight = strip_tags(htmlspecialchars($_POST["pac_weight"]));		//Package Height
	$pac_frag = strip_tags(htmlspecialchars($_POST["pac_frag"])); //Package Fragile? Yes or No

    // Check for empty fields
if (	
    (empty($fName)) || 
    (empty($lName)) || 
    (empty($phone)) || 
    (empty($del_from)) || 
    (empty($del_to)) || 
    (empty($del_type)) || 
    (empty($pac_frag)) || 
    (empty($pac_q)) || 
    ($pac_q < 1) ||
    (empty($pac_size)) || 
    (empty($pac_weight)) || 
    (empty($email))	 )// Just check user details for now
	{
	echo "You have fields that are incomplete!";
    return false;
	// If no empty fields, then sanitize and validate user data!!!!!
	}
    else {
		filter_var($fName, FILTER_SANITIZE_STRING);		// Do not allow tags in #fName
		filter_var($lName, FILTER_SANITIZE_STRING); 	// Do not allow tags in #lName
        filter_var($del_from, FILTER_SANITIZE_STRING);		// Do not allow tags in #del_from
        filter_var($del_to, FILTER_SANITIZE_STRING);		// Do not allow tags in #del_to
		filter_var($phone, FILTER_SANITIZE_NUMBER_INT);	// Only allow numbers, and "+ -"
        filter_var($pac_q, FILTER_SANITIZE_NUMBER_INT);	// Only allow numbers, and "+ -"
		filter_var($email, FILTER_SANITIZE_EMAIL);		 // Remove all illegal characters from email
		filter_var($email, FILTER_VALIDATE_EMAIL); // Validate e-mail
				
	}
// Create the email and send the message
$to = 'info@coledon.co.za'; 
$email_subject = "Booking Form:  $fName" . " " . "$lName";
$email_body = 
    "<html>
<head>
	<title>Booking: $fName $lName</title>
    <style>
    table {width:100%;}
    table * {text-align:center;}
    th{background-color:#21aaex;border:2px solid #000000;padding:5px;}
    td{border-bottom:1px dotted #000000;padding:5px 3px;border-left:2px solid #000000;border-right:2px solid #000000;}
    </style>
</head>
<body>
<p>You have a new booking from your website! (landing.html) <br/> Here are the details:</p><br/>

<table>
	<tr>
		<th colspan=2>
			Client Details
		</th>
	</tr>
	<tr>
		<td>
			<b>Client Name</b>
		</td>
		<td>
			$fName $lName
		</td>
	</tr>
	<tr>
		<td>
			<b>Client Phone</b>
		</td>
		<td>
			$phone
		</td>
	</tr>
	<tr>
		<td>
			<b>Client Email</b>
		</td>
		<td>
			$email
		</td>
	</tr>
	<tr>
		<th colspan=2>
			Delivery Details
		</th>
	</tr>
		<td>
			<b>Collection Address</b>
		</td>
		<td>
			$del_from
		</td>
	</tr>
	<tr>
		<td>
			<b>Delivery Address</b>
		</td>
		<td>
			$del_to
		</td>
	</tr>
	<tr>
		<td>
			<b>Delivery Type</b>
		</td>
		<td>
			$del_type
		</td>
	</tr>
	<tr>
		<th colspan=2>
			Package Details
		</th>
	</tr>
	<tr>
		<td>
			<b>Quantity</b>
		</td>
		<td>
			$pac_q
		</td>
	</tr>
	<tr>
		<td>
			<b>Package Size</b>
		</td>
		<td>
			$pac_size
		</td>
	</tr>
	<tr>
		<td>
			<b>Package Weight</b>
		</td>
		<td>
			$pac_weight
		</td>
	</tr>
	<tr>
		<td>
			<b>Fragile?</b>
		</td>
		<td>
			$pac_frag
		</td>
	</tr>
	
</table>
<br/><br/><br/>
<i>Website Designed By <b>Coledon Projects</b></i>
</body>
</html>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@coledon.co.za>' . "\r\n";
mail($to,$email_subject,$email_body,$headers);
return true; 
	

?>
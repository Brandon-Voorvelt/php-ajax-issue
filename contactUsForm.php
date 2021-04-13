<?php
// Check for empty fields
if(empty($_POST['c_fName'])      ||
   empty($_POST['c_lName'])      ||
   empty($_POST['c_email'])     ||
   empty($_POST['c_phone'])     ||
   empty($_POST['c_message'])   ||
   !filter_var($_POST['c_email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Contact details were not given in the form!";
   return false;
   }
   
$fName = strip_tags(htmlspecialchars($_POST['c_fName']));
$lName = strip_tags(htmlspecialchars($_POST['c_lName']));
$email_address = strip_tags(htmlspecialchars($_POST['c_email']));
$phone = strip_tags(htmlspecialchars($_POST['c_phone']));
$message = strip_tags(htmlspecialchars($_POST['c_message']));
   
// Create the email and send the message
$to = 'info@coledon.co.za'; 
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $fName $lName\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: info@coledon.co.za\n"; 
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;         
?>
